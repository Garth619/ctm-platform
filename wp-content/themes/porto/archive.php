<?php get_header() ?>

<?php
global $porto_settings, $porto_layout;

$post_layout = $porto_settings['post-layout'];
if ( is_category() ) {
    global $wp_query;

    $term = $wp_query->queried_object;
    $term_id = $term->term_id;

    $post_options = get_metadata($term->taxonomy, $term->term_id, 'post_options', true) == 'post_options' ? true : false;

    $post_layout = $post_options ? get_metadata($term->taxonomy, $term->term_id, 'post_layout', true) : $post_layout;
}
?>

<div id="content" role="main" class="<?php if ($porto_layout === 'widewidth' || $porto_layout === 'wide-left-sidebar' || $porto_layout === 'wide-right-sidebar') { echo 'm-t-lg m-b-xl'; if (porto_get_wrapper_type() !=='boxed') echo ' m-r-md m-l-md'; } ?>">

    <?php if ( have_posts() ) : ?>

        <?php if (category_description()) : ?>
            <div class="page-content">
                <?php echo category_description() ?>
            </div>
        <?php endif; ?>

		<?php if ($post_layout == 'timeline') {
            global $prev_post_year, $prev_post_month, $first_timeline_loop, $post_count;

            $prev_post_year = null;
            $prev_post_month = null;
            $first_timeline_loop = false;
            $post_count = 1;
            ?>

        <div class="blog-posts posts-<?php echo $post_layout ?><?php if ($porto_settings['post-style'] == 'related') : ?> blog-posts-related<?php endif; ?>">
            <section class="timeline">
                <div class="timeline-body posts-container">

        <?php } else if ($post_layout == 'grid') { ?>

        <div class="blog-posts posts-<?php echo $post_layout ?><?php if ($porto_settings['post-style'] == 'related') : ?> blog-posts-related<?php endif; ?>">
            <div class="grid row posts-container">

        <?php } else { ?>

        <div class="blog-posts posts-<?php echo $post_layout ?> posts-container">

        <?php } ?>

            <?php
            while (have_posts()) {
                the_post();

                get_template_part('content', 'blog-'.$post_layout);
            }
            ?>

        <?php if ($post_layout == 'timeline') { ?>

                </div>
            </section>

        <?php } else if ($post_layout == 'grid') { ?>

            </div>

        <?php } else { ?>

        <?php } ?>

            <?php porto_pagination(); ?>
        </div>

        <?php wp_reset_postdata(); ?>

    <?php else : ?>

        <h2 class="entry-title"><?php _e( 'Nothing Found', 'porto' ); ?></h2>

        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

            <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'porto' ), admin_url( 'post-new.php' ) ); ?></p>

        <?php elseif ( is_search() ) : ?>

            <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'porto' ); ?></p>
            <?php get_search_form(); ?>

        <?php else : ?>

            <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'porto' ); ?></p>
            <?php get_search_form(); ?>

        <?php endif; ?>

    <?php endif; ?>
</div>

<?php get_footer() ?>