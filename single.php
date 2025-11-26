<?php

/**
 * The template for displaying single posts
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

            <!-- Featured Image / Hero -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="relative h-96 lg:h-[500px] overflow-hidden">
                    <?php the_post_thumbnail('bivoo-hero', array('class' => 'w-full h-full object-cover')); ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                    <!-- Post Header Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 lg:p-12">
                        <div class="container mx-auto px-4 lg:px-8">
                            <div class="max-w-4xl">
                                <?php
                                $categories = get_the_category();
                                if ($categories) :
                                ?>
                                    <div class="mb-4">
                                        <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"
                                            class="inline-block bg-[#EC7430] text-white text-sm font-semibold px-4 py-2 rounded-full">
                                            <?php echo esc_html($categories[0]->name); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <h1 class="entry-title text-3xl lg:text-5xl font-bold text-white mb-4">
                                    <?php the_title(); ?>
                                </h1>

                                <div class="flex items-center text-white text-sm">
                                    <time datetime="<?php echo get_the_date('c'); ?>" class="flex items-center">
                                        <i class="far fa-calendar mr-2"></i>
                                        <?php echo get_the_date(); ?>
                                    </time>
                                    <span class="mx-3">•</span>
                                    <span class="flex items-center">
                                        <i class="far fa-user mr-2"></i>
                                        <?php the_author(); ?>
                                    </span>
                                    <span class="mx-3">•</span>
                                    <span class="flex items-center">
                                        <i class="far fa-clock mr-2"></i>
                                        <?php echo bivoo_reading_time(); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Post Content -->
            <div class="container mx-auto px-4 lg:px-8 py-12 lg:py-16">
                <div class="max-w-4xl mx-auto">

                    <!-- Post Header (if no featured image) -->
                    <?php if (!has_post_thumbnail()) : ?>
                        <header class="entry-header mb-8">
                            <?php
                            $categories = get_the_category();
                            if ($categories) :
                            ?>
                                <div class="mb-4">
                                    <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"
                                        class="inline-block bg-[#EC7430] text-white text-sm font-semibold px-4 py-2 rounded-full">
                                        <?php echo esc_html($categories[0]->name); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <h1 class="entry-title text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                                <?php the_title(); ?>
                            </h1>

                            <div class="flex items-center text-gray-600 text-sm">
                                <time datetime="<?php echo get_the_date('c'); ?>" class="flex items-center">
                                    <i class="far fa-calendar mr-2 text-[#EC7430]"></i>
                                    <?php echo get_the_date(); ?>
                                </time>
                                <span class="mx-3">•</span>
                                <span class="flex items-center">
                                    <i class="far fa-user mr-2 text-[#EC7430]"></i>
                                    <?php the_author(); ?>
                                </span>
                                <span class="mx-3">•</span>
                                <span class="flex items-center">
                                    <i class="far fa-clock mr-2 text-[#EC7430]"></i>
                                    <?php echo bivoo_reading_time(); ?>
                                </span>
                            </div>
                        </header>
                    <?php endif; ?>

                    <!-- Post Content -->
                    <div class="entry-content prose prose-lg max-w-none">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Páginas:', 'bivoo') . '</span>',
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <!-- Post Footer -->
                    <footer class="entry-footer mt-12 pt-8 border-t border-gray-200">

                        <!-- Tags -->
                        <?php if (has_tag()) : ?>
                            <div class="mb-6">
                                <h3 class="text-sm font-semibold text-gray-600 mb-3">
                                    <i class="fas fa-tags mr-2"></i>
                                    <?php esc_html_e('Tags:', 'bivoo'); ?>
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    <?php
                                    $tags = get_the_tags();
                                    foreach ($tags as $tag) :
                                    ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>"
                                            class="inline-block bg-gray-100 hover:bg-[#EC7430] hover:text-white text-gray-700 text-sm px-4 py-2 rounded-full transition-colors">
                                            <?php echo esc_html($tag->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Share Buttons -->
                        <div class="share-buttons">
                            <h3 class="text-sm font-semibold text-gray-600 mb-3">
                                <i class="fas fa-share-alt mr-2"></i>
                                <?php esc_html_e('Compartilhar:', 'bivoo'); ?>
                            </h3>
                            <div class="flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex items-center justify-center w-10 h-10 bg-[#1877F2] text-white rounded-full hover:opacity-80 transition-opacity"
                                    aria-label="<?php esc_attr_e('Compartilhar no Facebook', 'bivoo'); ?>">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex items-center justify-center w-10 h-10 bg-[#1DA1F2] text-white rounded-full hover:opacity-80 transition-opacity"
                                    aria-label="<?php esc_attr_e('Compartilhar no Twitter', 'bivoo'); ?>">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex items-center justify-center w-10 h-10 bg-[#25D366] text-white rounded-full hover:opacity-80 transition-opacity"
                                    aria-label="<?php esc_attr_e('Compartilhar no WhatsApp', 'bivoo'); ?>">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex items-center justify-center w-10 h-10 bg-[#0077B5] text-white rounded-full hover:opacity-80 transition-opacity"
                                    aria-label="<?php esc_attr_e('Compartilhar no LinkedIn', 'bivoo'); ?>">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </footer>

                    <!-- Author Bio -->
                    <?php if (get_the_author_meta('description')) : ?>
                        <div class="author-bio bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 mt-12 border border-gray-100">
                            <div class="flex items-start space-x-6">
                                <div class="flex-shrink-0">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 96, '', '', array('class' => 'rounded-full')); ?>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                                        <?php echo get_the_author(); ?>
                                    </h3>
                                    <div class="text-gray-600">
                                        <?php echo wpautop(get_the_author_meta('description')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Related Posts -->
                    <?php
                    $related_args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                        'post__not_in'   => array(get_the_ID()),
                        'orderby'        => 'rand',
                        'category__in'   => wp_get_post_categories(get_the_ID()),
                    );

                    $related_query = new WP_Query($related_args);

                    if ($related_query->have_posts()) :
                    ?>
                        <div class="related-posts mt-16">
                            <h2 class="text-3xl font-bold text-gray-900 mb-8">
                                <?php esc_html_e('Você também pode gostar', 'bivoo'); ?>
                            </h2>
                            <div class="grid md:grid-cols-3 gap-6">
                                <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                    <article class="card group">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('bivoo-listing-thumb', array('class' => 'w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500')); ?>
                                            </a>
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h3 class="text-lg font-bold mb-2 line-clamp-2">
                                                <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-[#EC7430] transition-colors">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <div class="text-sm text-gray-500">
                                                <?php echo get_the_date(); ?>
                                            </div>
                                        </div>
                                    </article>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php
                        wp_reset_postdata();
                    endif;
                    ?>

                    <!-- Comments -->
                    <?php
                    if (comments_open() || get_comments_number()) :
                    ?>
                        <div class="comments-wrapper mt-16">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </article>

    <?php endwhile; ?>

</main><!-- #main-content -->

<?php
get_footer();
