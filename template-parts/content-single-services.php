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
            <!--<div class="post-thumb">-->
            <!--    <a href="<? //php echo get_permalink(); ?>"><?php //the_post_thumbnail( 'full' ); ?></a>-->
            <!--</div>-->
        <?php } ?>
    <?php } ?>    

    <!--<div class="blog-entry-meta text-center">-->
    <!--    <span class="date"><? //php the_time( 'M d, Y' ) ?></span>-->
    <!--</div>-->


    
    <div class="services-single-content">

        <div class="services-single-content__right services-single-content__item col-lg-4">
                <?php $img = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' ); ?>
                <div class="services-single-content__item--holder" style="background-image: url('<?php echo $img[0]; ?>');">
                     <?php //the_post_thumbnail( 'full' ); ?>
                </div>
             
            </div>

          <div class="services-single-content__left services-single-content__item col-lg-8">
                  <div>
                      <h2><?php the_title() ?></h2>
                    <?php the_content(); ?>
                  </div>
                </div>
        
            
              
    </div>
  
    
    
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
