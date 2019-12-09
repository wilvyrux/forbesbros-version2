<?php
/**
 * Template part for displaying single posts.
 *
 * @package Infinity
 */
$tm_dione_post_hide_author         = Kirki::get_option( 'tm-dione', 'post_hide_author' );
$tm_dione_post_hide_featured_image = get_post_meta( get_the_ID(), "post_hide_featured_image", true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post blog-entry' ); ?>>
    
    <div class="row project-single--row">
        <div class="col-md-6 post-meta project-single-details">
            <!--project-single-details__holder-->
            <div class="project-single-details__holder">
                    <div class="projects-container__next">
                         <?php forbes_project_navigation(); ?>
                    </div>
                    
                    <div class="project-single-details__contents">
                          <h2 class="project-single-details__title"><?php the_title() ?></h2>
                    
                            <ul class="project-single-details__information">
                                <!--<li><strong>Client:</strong> <?php //echo get_field('client', $post->ID); ?></li>-->
                                <li><strong>Client:</strong> <?php echo get_field('client', $post->ID); ?></li>
                                <li><strong>Length:</strong> <?php echo get_field('length', $post->ID); ?></li>
                                <li><strong>Completion: </strong><?php echo get_field('completion', $post->ID); ?></li>
                                <li><strong>Highlight:</strong> <?php echo get_field('highlight', $post->ID); ?></li>
                            </ul>
                            <!--<h3></h3>-->
                            <!--<h3></h3>-->
                            <!--<h3></h3>-->
                            <!--<h3></h3>-->
                            <div class="project-single-details__description">
                                 <?php the_content(); ?>
                                
                            </div>
                        
                    </div>
                  
                    
                    <p class="project-category project-single-details__category">
                        <?php
                            $cat = get_the_terms($post->ID, 'project-taxonomy');
        
                            if(isset($cat[0])) {
                                $cat_image_id = get_term_meta($cat[0]->term_id, 'category-image-id', true);
                                echo wp_get_attachment_image($cat_image_id, 'thumbnail') . ' - ' . $cat[0]->name;
                            }
                        ?>
                    </p>
                 <!--project-single-details__holder-->
            </div>
            
        </div>
        
        
        <?php if ( has_post_format( 'gallery' ) ) { ?>
            <?php $gallery_images = get_post_meta( get_the_ID(), '_format_gallery_images', true ); ?>
            <?php $gallery_type = get_post_meta( get_the_ID(), '_format_gallery_type', true ); ?>
            <?php if ( $gallery_images ) { ?>
                <div class="post-img post-gallery<?php echo ' ' . esc_attr( $gallery_type ); ?>">
                    <?php if ( 'masonry' == $gallery_type ) { ?>
                        <div class="grid-thumb-sizer"></div><?php } ?>
                    <?php foreach ( $gallery_images as $image ) { ?>
                        <?php if ( 'masonry' == $gallery_type ) {
                            $img = wp_get_attachment_image_src( $image, 'full' );
                        } else {
                            $img = wp_get_attachment_image_src( $image, 'full' );
                        } ?>
                        <?php $caption = get_post_field( 'post_excerpt', $image ); ?>
                        <?php if ( 'masonry' == $gallery_type ) { ?>
                            <a href="<?php echo esc_url( $img[0] ); ?>" class="thumb-masonry-item ndSvgFill">
                                <img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php echo '' . $caption; ?>"/>
                                <svg viewBox="0 0 30 30" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" x="0px" y="0px"
                                     width="30px" height="30px">
    							<g>
                                    <rect x="13" y="0" width="4" height="30"></rect>
                                    <rect x="0" y="13" width="30" height="4"></rect>
                                </g>
    						</svg>
                            </a>
                        <?php } else { ?>
                            <div><img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php echo '' . $caption; ?>"/></div>
                        <?php } ?>
                    <?php } // endforeach ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <?php if ( has_post_thumbnail() && $tm_dione_post_hide_featured_image != 'on' ) { ?>
                <div class="post-thumb col-md-6 project-single-details__image">
                    <!--<a href="<?php //echo get_permalink(); ?>"></a>-->
                       <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' ); ?>
                    <div class="project-single-details__image--holder" style="background-image: url('<?php echo $img[0]; ?>');">
                          <?php //the_post_thumbnail( 'full' ); ?>
                    </div>
                  
                </div>
            <?php } ?>
        <?php } ?>
    </div>    

    <!--<div class="blog-entry-meta text-center">-->
    <!--    <span class="date"><?//php the_time( 'M d, Y' ) ?></span>-->
    <!--</div>-->

    <!--<h3 class="blog-entry-title text-center"><?php the_title() ?></h3>-->
   
    <?php
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'tm-dione' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'tm-dione' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
    ?>

    

</article><!-- #post-## -->
