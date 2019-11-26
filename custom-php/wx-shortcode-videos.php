<?php 
function tm_get_all_videos() {
    $args      = array(
        'hide_empty' => true,
        'post_status'      => 'publish',
        'post_type' => 'videos'
        //'fields'     => 'id=>name',
    );
    $custom = get_posts($args);
	$menu_result = array();
	$menu_result[''] = esc_html__( 'Default Menu', 'tm-dione' );
	foreach ($custom as $post) {
		setup_postdata($post);
		$menu_result[$post->post_title] = $post->ID;
	}
	
    return $menu_result;
}

function video_l( $atts ) {
	global $wpdb;


   $atts = shortcode_atts(
		array(
			'vcounter' => '',
			'vfeatured' => '' 
		), $atts
	);

	$post_id = $atts['vfeatured'];

    $count =  $atts['vcounter'];

    
     

	$output = '<div class="main-wrapper-video" id="'.$post_id.'">';

    
         if($post_id==""){ }else{
			    
			    $video_type = get_field("video_type",$post_id);

			    if($video_type=="Url"){
			    $urlmain =get_field("url",$post_id);	
			    $urlextract = explode("v=",$urlmain);

			        $output .= "<div class='featured-videos'>";
		   		    $output .= '<div class="col-md-12" style="padding-bottom:20px"><iframe style="width:100%" height="100%" src="https://www.youtube.com/embed/'.$urlextract[1].'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen  ></iframe></div>';
		   		    $output .= "</div>";
	   		    }
	   		    if($video_type=="Upload"){
	   		       
	   		       $attachment_ids = get_field('upload',$post_id);
			       $urlmain = wp_get_attachment_url( $attachment_ids ); 

	   		    	$output .= '<video width="100%" height="100%" controls>
						  <source src="'.$urlmain.'" type="video/mp4">
						 Your browser does not support the video tag.
						</video>';
	   		    }


	   		}
 
	   	 
    $args = array( 'post_type' => 'videos', 'posts_per_page' => $count  );
	$loop = new WP_Query( $args );

	while ( $loop->have_posts() ) : $loop->the_post();
		$filesize="";
		$title= get_the_title();
		$vID = get_the_ID();

		if ( has_post_thumbnail() ) {
  			  $featured_image = get_the_post_thumbnail_url($vID,'medium'); 
			}
		$video_type =get_field("video_type",$vID);
		if($video_type=="Url"){ 
			
			$fancy="videolink"; 

			$urlmain =get_field("url",$vID);	
		    $urlextract = explode("v=",$urlmain);
		    $url ="https://www.youtube.com/embed/$urlextract[1]";
		}
		if($video_type=="Upload"){ 
			$upload =get_field("upload",$vID); 
			 
		 	$fancy="videolink2"; 

			$attachment_id = get_field('upload',$vID);
			$urlvid = wp_get_attachment_url( $attachment_id); 
			$filesize = filesize( get_attached_file( $attachment_id ) );
			$filesize = size_format($filesize, 2);
			$url = "#content-vid$vID"; 
			$urlid = "content-vid$vID"; 
		}
		
		
	   		if($post_id!=$vID) { 

				$output .= "<div class='video-list' id='".$vID ."'>";
				$output .= '<div class="col-md-2">
						<div class="video-thumbnail">
			                <a  href="'.$url.'" class="'.$fancy.'" data-fancybox-type="iframe">
			                    <img src="'.$featured_image.'" >
			                </a>
		            	</div>
					</div>
					<div class="col-md-10">
            		   <label class="vtitle"><a  href="'.$url.'" class="'.$fancy.'" data-fancybox-type="iframe">'.$title.'</a></label>
            			<label class="vsubtitle">'.$filesize.'</label>
        			</div>
        			<div class="clear clearfix"></div>';
				$output .= "</div>"; 
				if($video_type=="Upload"){ 
	   			$output .= '<div style="display:none"><div id="'.$urlid.'"  ><video width="100%" height="480" controls>
						  <source src="'.$urlvid.'" type="video/mp4">
						 Your browser does not support the video tag.
					   </video></div></div>';
				}
				 
			}
	    
 	
	endwhile;
 
$output .= "</div>"; 

 

$scripts = '<script>
					 jQuery(".videolink").fancybox({
						  "type":"iframe"
						}); 

						jQuery(".videolink2").fancybox({
						              width: 560,
						              height: 480
						}); 
			</script>';

return	$output.$scripts ;

}
add_shortcode( 'video-l', 'video_l' );

function vl_integratedWithVC() {
	vc_map( array( 
		'name'				=>	__( 'Video List' ),
		'base'				=>	'video-l',
		'class'				=>	'',
		"category" => __( "WX Custom Shortcode", "tm-dione"),
		'params'			=>	array(
									array(
										'type'			=>	'textfield',
										'class'			=>	'',
										'heading'		=>	__( 'Count' ),
										'description'	=>	_x( 'Example 6', 'backend', 'vc-elements-pt' ),
										'param_name'	=>	'vcounter',
									),
									array(
										'type'			=>	'dropdown',
										'heading'		=>	__( 'Featured' ),
										'description'	=>	_x( 'Choose featured videos for this page', 'backend', 'vc-elements-pt' ),
										'param_name'	=>	'vfeatured',
										'value'			=>	 tm_get_all_videos()
									)	 
								)
	) );
}
add_action( 'vc_before_init', 'vl_integratedWithVC' );
 
