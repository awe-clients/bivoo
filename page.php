<?php

/**
 * The template for displaying pages
 *
 * @package Bivoo
 */

get_header();
?>

<main id="main-content" class="site-main">

    <?php
    while (have_posts()) :
        the_post();
    ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php if (has_post_thumbnail() && !is_front_page()) : ?>
                <!-- Page Hero with Featured Image -->
                <div class="relative h-80 lg:h-96 overflow-hidden">
                    <?php the_post_thumbnail('bivoo-hero', array('class' => 'w-full h-full object-cover')); ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 right-0 p-6 lg:p-12">
                        <div class="container mx-auto px-4 lg:px-8">
                            <h1 class="entry-title text-4xl lg:text-5xl font-bold text-white">
                                <?php the_title(); ?>
                            </h1>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <div class="container mx-auto px-4 lg:px-8 py-12 lg:py-16">
                <div class="max-w-4xl mx-auto">

                    <?php if (!has_post_thumbnail() || is_front_page()) : ?>
                        <header class="entry-header mb-8">
                            <?php if (!is_front_page()) : ?>
                                <h1 class="entry-title text-4xl lg:text-5xl font-bold text-gray-900">
                                    <?php the_title(); ?>
                                </h1>
                            <?php endif; ?>
                        </header>
                    <?php endif; ?>

                    <div class="entry-content prose prose-lg max-w-none">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Páginas:', 'bivoo') . '</span>',
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <?php if (get_edit_post_link()) : ?>
                        <footer class="entry-footer mt-8 pt-8 border-t border-gray-200">
                            <?php
                            edit_post_link(
                                sprintf(
                                    wp_kses(
                                        /* translators: %s: Name of current post. Only visible to screen readers */
                                        __('Edit <span class="screen-reader-text">%s</span>', 'bivoo'),
                                        array(
                                            'span' => array(
                                                'class' => array(),
                                            ),
                                        )
                                    ),
                                    wp_kses_post(get_the_title())
                                ),
                                '<span class="edit-link">',
                                '</span>'
                            );
                            ?>
                        </footer>
                    <?php endif; ?>

                </div>
            </div>

        </article>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
        ?>
            <div class="container mx-auto px-4 lg:px-8 pb-12 lg:pb-16">
                <div class="max-w-4xl mx-auto">
                    <?php comments_template(); ?>
                </div>
            </div>
        <?php endif; ?>

    <?php endwhile; // End of the loop. 
    ?>

</main><!-- #main-content -->

<?php
get_footer();
