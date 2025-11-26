<?php
/**
 * Template Name: Homepage
 * Template Post Type: page
 *
 * @package Bivoo
 */

get_header();
?>

<main id="main-content" class="site-main">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-purple-900 via-purple-800 to-transparent h-[600px] lg:h-[550px]">
        <div class="absolute inset-0">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-bg.jpg'); ?>" 
                 alt="<?php esc_attr_e('Background Hero', 'bivoo'); ?>" 
                 class="w-full h-full object-cover">
        </div>
        
        <div class="absolute inset-0 bg-gradient-to-r from-purple-900/90 via-purple-800/60 to-transparent"></div>
        
        <div class="relative h-full flex items-center">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="w-full lg:w-1/2">
                    <h1 class="text-4xl lg:text-6xl font-bold text-white mb-6">
                        <?php esc_html_e('Seu refúgio na praia, do seu jeito.', 'bivoo'); ?>
                    </h1>
                    <p class="text-xl lg:text-2xl text-white/90 mb-8">
                        <?php esc_html_e('Casas por temporada, hotéis e experiências únicas nos melhores destinos de praia do Brasil', 'bivoo'); ?>
                    </p>
                    <a href="<?php echo esc_url(home_url('/hospedagens')); ?>" 
                       class="inline-flex items-center bg-white text-purple-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-bold text-lg transition-all transform hover:-translate-y-1 shadow-lg hover:shadow-xl">
                        <?php esc_html_e('Explorar destinos', 'bivoo'); ?>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 right-6 lg:right-12 bg-white/95 backdrop-blur-sm px-6 py-3 rounded-full shadow-xl">
            <p class="flex items-center text-purple-600 font-semibold">
                <i class="fas fa-map-marker-alt mr-2"></i>
                <?php esc_html_e('Pipa, RN', 'bivoo'); ?>
            </p>
        </div>
    </section>

    <!-- Search Form Section -->
    <section class="py-8 lg:py-12 bg-gray-50">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl p-6 lg:p-8 -mt-20 relative z-10">
                <form action="<?php echo esc_url(home_url('/hospedagens')); ?>" method="get" class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    <!-- Destination -->
                    <div>
                        <label for="destino" class="block text-sm font-semibold text-gray-700 mb-2">
                            <?php esc_html_e('Destino', 'bivoo'); ?>
                        </label>
                        <select id="destino" name="destino" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC7430] focus:border-transparent">
                            <option value=""><?php esc_html_e('Todos os destinos', 'bivoo'); ?></option>
                            <?php
                            $destinos = get_terms(array('taxonomy' => 'destino', 'hide_empty' => true));
                            foreach ($destinos as $destino) :
                                ?>
                                <option value="<?php echo esc_attr($destino->slug); ?>">
                                    <?php echo esc_html($destino->name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Check-in -->
                    <div>
                        <label for="checkin" class="block text-sm font-semibold text-gray-700 mb-2">
                            <?php esc_html_e('Check-in', 'bivoo'); ?>
                        </label>
                        <input type="date" id="checkin" name="checkin" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC7430] focus:border-transparent">
                    </div>

                    <!-- Check-out -->
                    <div>
                        <label for="checkout" class="block text-sm font-semibold text-gray-700 mb-2">
                            <?php esc_html_e('Check-out', 'bivoo'); ?>
                        </label>
                        <input type="date" id="checkout" name="checkout" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC7430] focus:border-transparent">
                    </div>

                    <!-- Guests -->
                    <div>
                        <label for="hospedes" class="block text-sm font-semibold text-gray-700 mb-2">
                            <?php esc_html_e('Hóspedes', 'bivoo'); ?>
                        </label>
                        <select id="hospedes" name="hospedes" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC7430] focus:border-transparent">
                            <option value="2">2 <?php esc_html_e('hóspedes', 'bivoo'); ?></option>
                            <option value="4">4 <?php esc_html_e('hóspedes', 'bivoo'); ?></option>
                            <option value="6">6 <?php esc_html_e('hóspedes', 'bivoo'); ?></option>
                            <option value="8">8+ <?php esc_html_e('hóspedes', 'bivoo'); ?></option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-gradient-to-r from-[#EC7430] to-orange-600 hover:from-[#D66328] hover:to-orange-700 text-white font-bold px-6 py-3 rounded-lg transition-all transform hover:scale-105 shadow-lg">
                            <i class="fas fa-search mr-2"></i>
                            <?php esc_html_e('Buscar', 'bivoo'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="py-16 lg:py-24 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    <?php esc_html_e('Destinos - Experiências Únicas', 'bivoo'); ?>
                </h2>
                <p class="text-xl text-gray-600">
                    <?php esc_html_e('Explore os lugares mais incríveis do Brasil', 'bivoo'); ?>
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                // Get featured destinations
                $destinos_args = array(
                    'taxonomy'   => 'destino',
                    'number'     => 4,
                    'hide_empty' => true,
                );
                $destinos = get_terms($destinos_args);

                foreach ($destinos as $destino) :
                    $thumbnail_id = get_term_meta($destino->term_id, 'thumbnail_id', true);
                    $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : get_template_directory_uri() . '/assets/img/placeholder.jpg';
                    ?>
                    <a href="<?php echo esc_url(get_term_link($destino)); ?>" 
                       class="group relative block h-96 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2">
                        <img src="<?php echo esc_url($image_url); ?>" 
                             alt="<?php echo esc_attr($destino->name); ?>" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-[#EC7430] transition-colors">
                                <?php echo esc_html($destino->name); ?>
                            </h3>
                            <p class="text-white/90 text-sm">
                                <?php printf(esc_html__('%s propriedades', 'bivoo'), $destino->count); ?>
                            </p>
                        </div>
                        <div class="absolute inset-0 bg-[#EC7430]/0 group-hover:bg-[#EC7430]/10 transition-colors"></div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Featured Listings -->
    <section class="py-16 lg:py-24 bg-gray-50">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                        <?php esc_html_e('Casas por Temporada', 'bivoo'); ?>
                    </h2>
                    <p class="text-xl text-gray-600">
                        <?php esc_html_e('Propriedades exclusivas para sua estadia perfeita', 'bivoo'); ?>
                    </p>
                </div>
                <a href="<?php echo esc_url(home_url('/hospedagens')); ?>" 
                   class="hidden lg:inline-flex items-center text-[#EC7430] hover:text-[#D66328] font-semibold transition-colors">
                    <?php esc_html_e('Ver todas', 'bivoo'); ?>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                $listings_args = array(
                    'post_type'      => 'hospedagem',
                    'posts_per_page' => 4,
                    'orderby'        => 'rand',
                );
                $listings_query = new WP_Query($listings_args);

                if ($listings_query->have_posts()) :
                    while ($listings_query->have_posts()) : $listings_query->the_post();
                        get_template_part('template-parts/content', 'hospedagem-card');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <div class="mt-8 text-center lg:hidden">
                <a href="<?php echo esc_url(home_url('/hospedagens')); ?>" 
                   class="inline-flex items-center text-[#EC7430] hover:text-[#D66328] font-semibold transition-colors">
                    <?php esc_html_e('Ver todas', 'bivoo'); ?>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Services CTA -->
    <section class="py-16 lg:py-24 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8">
                
                <!-- Insurance Card -->
                <a href="<?php echo esc_url(home_url('/seguros')); ?>" 
                   class="group relative bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-8 lg:p-12 text-white overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2">
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-shield-alt text-3xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold mb-4">
                            <?php esc_html_e('Seguro Viagem', 'bivoo'); ?>
                        </h3>
                        <p class="text-blue-100 mb-6">
                            <?php esc_html_e('Viaje com tranquilidade e proteção completa', 'bivoo'); ?>
                        </p>
                        <span class="inline-flex items-center font-semibold">
                            <?php esc_html_e('Fazer cotação', 'bivoo'); ?>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                        </span>
                    </div>
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
                </a>

                <!-- Transfer Card -->
                <a href="<?php echo esc_url(home_url('/transfer')); ?>" 
                   class="group relative bg-gradient-to-br from-[#EC7430] to-orange-600 rounded-2xl p-8 lg:p-12 text-white overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2">
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-car text-3xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold mb-4">
                            <?php esc_html_e('Transfer', 'bivoo'); ?>
                        </h3>
                        <p class="text-orange-100 mb-6">
                            <?php esc_html_e('Transporte confortável do aeroporto ao seu destino', 'bivoo'); ?>
                        </p>
                        <span class="inline-flex items-center font-semibold">
                            <?php esc_html_e('Reservar transfer', 'bivoo'); ?>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full -ml-32 -mb-32"></div>
                </a>
            </div>
        </div>
    </section>

</main><!-- #main-content -->

<?php
get_footer();