<?php
/**
 * The template for displaying all single posts.
 *
 * @package Infinity
 */
$tm_dione_heading_image = Kirki::get_option( 'tm-dione', 'post_bg_image' );
$tm_dione_layout        = 'content-sidebar';//Kirki::get_option( 'tm-dione', 'post_layout' );
get_header(); ?>

    <div class="container services-single-container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope"
                                 itemtype="http://schema.org/CreativeWork">
                            <div class="entry-content">
                                <?php forbes_project_navigation(); ?>
                                <?php get_template_part( 'template-parts/content', 'single-services' ); ?>
                            </div>
                            
                            
                            <?php
                                $term = get_the_terms(get_the_ID(), 'project-taxonomy');
                                if(isset($term[0]->slug)) {
                                    do_shortcode('[related-forbes-projects category="'. $term[0]->slug .'"]');
                                }
                            ?>
                            
                            
                            <!-- .entry-content -->
                        </article><!-- #post-## -->
                    <?php endwhile; // end of the loop. ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>