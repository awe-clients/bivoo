<?php
/**
 * The main template file
 *
 * @package Bivoo
 */

get_header();
?>

<main id="main-content" class="site-main">

    <?php if (have_posts()) : ?>

    <!-- Page Header -->
    <div class="page-header bg-gradient-to-r from-[#EC7430] to-orange-600 text-white py-12 lg:py-20">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-4xl">
                <?php if (is_home() && !is_front_page()) : ?>
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                    <?php single_post_title(); ?>
                </h1>
                <?php elseif (is_archive()) : ?>
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                    <?php the_archive_title(); ?>
                </h1>
                <?php if (get_the_archive_description()) : ?>
                <div class="archive-description text-lg text-orange-100">
                    <?php the_archive_description(); ?>
                </div>
                <?php endif; ?>
                <?php elseif (is_search()) : ?>
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                    <?php printf(esc_html__('Resultados da busca por: %s', 'bivoo'), '<span class="search-query">' . get_search_query() . '</span>'); ?>
                </h1>
                <?php else : ?>
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                    <?php esc_html_e('Blog', 'bivoo'); ?>
                </h1>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="container mx-auto px-4 lg:px-8 py-12 lg:py-16">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('card group'); ?>>

                <?php if (has_post_thumbnail()) : ?>
                <div class="relative overflow-hidden">
                    <a href="<?php the_permalink(); ?>" class="block">
                        <?php the_post_thumbnail('bivoo-listing-thumb', array('class' => 'w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500')); ?>
                    </a>

                    <!-- Post Meta Overlay -->
                    <div class="absolute top-4 left-4 right-4 flex items-center justify-between">
                        <?php
                                    $categories = get_the_category();
                                    if ($categories) :
                                        ?>
                        <span class="bg-[#EC7430] text-white text-xs font-semibold px-3 py-1 rounded-full">
                            <?php echo esc_html($categories[0]->name); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="card-body">
                    <!-- Post Meta -->
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <time datetime="<?php echo get_the_date('c'); ?>">
                            <i class="far fa-calendar mr-1"></i>
                            <?php echo get_the_date(); ?>
                        </time>
                        <span class="mx-2">•</span>
                        <span>
                            <i class="far fa-user mr-1"></i>
                            <?php the_author(); ?>
                        </span>
                    </div>

                    <!-- Post Title -->
                    <h2 class="entry-title text-xl font-bold mb-3 line-clamp-2">
                        <a href="<?php the_permalink(); ?>"
                            class="text-gray-900 hover:text-[#EC7430] transition-colors">
                            <?php the_title(); ?>
                        </a>
                    </h2>

                    <!-- Post Excerpt -->
                    <div class="entry-summary text-gray-600 mb-4 line-clamp-3">
                        <?php the_excerpt(); ?>
                    </div>

                    <!-- Read More -->
                    <a href="<?php the_permalink(); ?>"
                        class="inline-flex items-center text-[#EC7430] hover:text-[#D66328] font-semibold transition-colors">
                        <?php esc_html_e('Leia mais', 'bivoo'); ?>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </article>

            <?php endwhile; ?>

        </div>

        <!-- Pagination -->
        <?php if (function_exists('bivoo_pagination')) : ?>
        <div class="mt-12">
            <?php bivoo_pagination(); ?>
        </div>
        <?php else : ?>
        <div class="mt-12 flex items-center justify-between">
            <div class="prev-posts">
                <?php previous_posts_link('<i class="fas fa-chevron-left mr-2"></i>' . esc_html__('Posts Anteriores', 'bivoo')); ?>
            </div>
            <div class="next-posts">
                <?php next_posts_link(esc_html__('Próximos Posts', 'bivoo') . '<i class="fas fa-chevron-right ml-2"></i>'); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php else : ?>

    <!-- No Posts Found -->
    <div class="container mx-auto px-4 lg:px-8 py-12 lg:py-16">
        <div class="max-w-2xl mx-auto text-center">
            <div class="bg-white rounded-2xl shadow-lg p-12">
                <i class="fas fa-search text-6xl text-gray-300 mb-6"></i>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    <?php esc_html_e('Nenhum conteúdo encontrado', 'bivoo'); ?>
                </h2>
                <p class="text-gray-600 mb-8">
                    <?php
                        if (is_search()) :
                            esc_html_e('Desculpe, mas nada foi encontrado para sua busca. Tente novamente com palavras-chave diferentes.', 'bivoo');
                        else :
                            esc_html_e('Parece que não há nada aqui. Que tal fazer uma busca?', 'bivoo');
                        endif;
                        ?>
                </p>

                <!-- Search Form -->
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="flex gap-2">
                        <input type="search"
                            class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-[#EC7430] focus:ring-2 focus:ring-[#EC7430]/20 outline-none transition-all"
                            placeholder="<?php echo esc_attr_x('Buscar...', 'placeholder', 'bivoo'); ?>"
                            value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" class="btn btn-primary px-6">
                            <i class="fas fa-search mr-2"></i>
                            <?php echo esc_html_x('Buscar', 'submit button', 'bivoo'); ?>
                        </button>
                    </div>
                </form>

                <div class="mt-8">
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                        class="text-[#EC7430] hover:text-[#D66328] font-semibold">
                        <i class="fas fa-home mr-2"></i>
                        <?php esc_html_e('Voltar para a página inicial', 'bivoo'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

</main><!-- #main-content -->

<?php
get_footer();