<?php

/**
 * Template for displaying single Hospedagem (Listing Detail)
 *
 * @package Bivoo
 */

get_header();

// Get custom fields
$preco_noite = get_post_meta(get_the_ID(), '_bivoo_preco_noite', true);
$quartos = get_post_meta(get_the_ID(), '_bivoo_quartos', true);
$banheiros = get_post_meta(get_the_ID(), '_bivoo_banheiros', true);
$hospedes = get_post_meta(get_the_ID(), '_bivoo_hospedes', true);
$avaliacao = get_post_meta(get_the_ID(), '_bivoo_avaliacao', true);

// Get taxonomies
$destinos = get_the_terms(get_the_ID(), 'destino');
$comodidades = get_the_terms(get_the_ID(), 'comodidade');
?>

<main id="main-content" class="site-main">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Gallery Section -->
            <section class="relative bg-black">
                <div class="container mx-auto px-4 lg:px-8 py-4">

                    <!-- Breadcrumbs -->
                    <nav class="text-sm text-white/80 mb-4">
                        <a href="<?php echo home_url(); ?>" class="hover:text-white">Início</a>
                        <span class="mx-2">/</span>
                        <a href="<?php echo get_post_type_archive_link('hospedagem'); ?>" class="hover:text-white">Hospedagens</a>
                        <?php if ($destinos && !is_wp_error($destinos)) : ?>
                            <span class="mx-2">/</span>
                            <a href="<?php echo get_term_link($destinos[0]); ?>" class="hover:text-white">
                                <?php echo esc_html($destinos[0]->name); ?>
                            </a>
                        <?php endif; ?>
                    </nav>

                    <?php if (has_post_thumbnail()) : ?>
                        <!-- Main Gallery Grid -->
                        <div class="grid lg:grid-cols-2 gap-2 mb-4">
                            <!-- Large Image -->
                            <div class="relative h-96 lg:h-[600px] rounded-lg overflow-hidden cursor-pointer group" onclick="openGallery(0)">
                                <?php the_post_thumbnail('bivoo-hero', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500')); ?>
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                            </div>

                            <!-- Small Images Grid -->
                            <div class="hidden lg:grid grid-cols-2 gap-2">
                                <?php
                                // Get gallery images (simulate with featured image)
                                for ($i = 1; $i <= 4; $i++) :
                                ?>
                                    <div class="relative h-[294px] rounded-lg overflow-hidden cursor-pointer group" onclick="openGallery(<?php echo $i; ?>)">
                                        <?php the_post_thumbnail('bivoo-gallery', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500')); ?>
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                                        <?php if ($i === 4) : ?>
                                            <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                                <button class="text-white font-semibold text-lg">
                                                    <i class="fas fa-images mr-2"></i>
                                                    Ver todas as 25 fotos
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <!-- Mobile: Show All Photos Button -->
                        <button onclick="openGallery(0)" class="lg:hidden w-full bg-white/10 backdrop-blur-sm text-white py-3 rounded-lg font-semibold">
                            <i class="fas fa-images mr-2"></i>
                            Ver todas as fotos
                        </button>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Main Content -->
            <div class="container mx-auto px-4 lg:px-8 py-8 lg:py-12">
                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Left Column - Property Details -->
                    <div class="lg:col-span-2">

                        <!-- Title & Quick Info -->
                        <div class="mb-8">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                                        <?php the_title(); ?>
                                    </h1>

                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                        <?php if ($avaliacao) : ?>
                                            <div class="flex items-center">
                                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                                <span class="font-semibold"><?php echo number_format($avaliacao, 1); ?></span>
                                                <span class="mx-1">·</span>
                                                <a href="#avaliacoes" class="hover:underline"><?php echo get_comments_number(); ?> avaliações</a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($destinos && !is_wp_error($destinos)) : ?>
                                            <div class="flex items-center">
                                                <i class="fas fa-map-marker-alt text-[#EC7430] mr-1"></i>
                                                <span><?php echo esc_html($destinos[0]->name); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Share & Favorite -->
                                <div class="flex items-center gap-2">
                                    <button onclick="shareProperty()" class="flex items-center gap-2 text-gray-700 hover:text-[#EC7430] px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                        <i class="fas fa-share-alt"></i>
                                        <span class="hidden sm:inline">Compartilhar</span>
                                    </button>
                                    <button class="favorite-button flex items-center gap-2 text-gray-700 hover:text-red-500 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors" data-post-id="<?php the_ID(); ?>">
                                        <i class="far fa-heart"></i>
                                        <span class="hidden sm:inline">Salvar</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Property Stats -->
                            <?php if ($hospedes || $quartos || $banheiros) : ?>
                                <div class="flex flex-wrap items-center gap-6 py-4 border-t border-b border-gray-200">
                                    <?php if ($hospedes) : ?>
                                        <div class="flex items-center text-gray-700">
                                            <i class="fas fa-user-friends text-xl text-[#EC7430] mr-3"></i>
                                            <div>
                                                <div class="font-semibold"><?php echo esc_html($hospedes); ?> hóspedes</div>
                                                <div class="text-sm text-gray-500">Capacidade</div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($quartos) : ?>
                                        <div class="flex items-center text-gray-700">
                                            <i class="fas fa-bed text-xl text-[#EC7430] mr-3"></i>
                                            <div>
                                                <div class="font-semibold"><?php echo esc_html($quartos); ?> quartos</div>
                                                <div class="text-sm text-gray-500">Espaço</div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($banheiros) : ?>
                                        <div class="flex items-center text-gray-700">
                                            <i class="fas fa-bath text-xl text-[#EC7430] mr-3"></i>
                                            <div>
                                                <div class="font-semibold"><?php echo esc_html($banheiros); ?> banheiros</div>
                                                <div class="text-sm text-gray-500">Completos</div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Description -->
                        <div class="mb-8 pb-8 border-b border-gray-200">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Sobre este espaço</h2>
                            <div class="prose prose-lg max-w-none text-gray-700">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <!-- Amenities -->
                        <?php if ($comodidades && !is_wp_error($comodidades)) : ?>
                            <div class="mb-8 pb-8 border-b border-gray-200" id="comodidades">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">O que este lugar oferece</h2>

                                <div class="grid md:grid-cols-2 gap-4">
                                    <?php
                                    $count = 0;
                                    foreach ($comodidades as $comodidade) :
                                        if ($count >= 10) break;
                                        $count++;

                                        // Icon mapping
                                        $icons = array(
                                            'Wi-Fi' => 'fa-wifi',
                                            'Piscina' => 'fa-swimming-pool',
                                            'Ar-condicionado' => 'fa-snowflake',
                                            'Estacionamento' => 'fa-parking',
                                            'Churrasqueira' => 'fa-fire',
                                            'Cozinha' => 'fa-utensils',
                                            'TV' => 'fa-tv',
                                            'Pet Friendly' => 'fa-paw',
                                        );

                                        $icon = isset($icons[$comodidade->name]) ? $icons[$comodidade->name] : 'fa-check';
                                    ?>
                                        <div class="flex items-center text-gray-700">
                                            <i class="fas <?php echo esc_attr($icon); ?> text-[#EC7430] mr-3 w-6"></i>
                                            <span><?php echo esc_html($comodidade->name); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <?php if (count($comodidades) > 10) : ?>
                                    <button onclick="showAllAmenities()" class="mt-6 px-6 py-3 border-2 border-gray-900 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                                        Mostrar todas as <?php echo count($comodidades); ?> comodidades
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Location -->
                        <div class="mb-8 pb-8 border-b border-gray-200" id="localizacao">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Onde você estará</h2>

                            <?php if ($destinos && !is_wp_error($destinos)) : ?>
                                <p class="text-gray-700 mb-4">
                                    <i class="fas fa-map-marker-alt text-[#EC7430] mr-2"></i>
                                    <?php echo esc_html($destinos[0]->name); ?>
                                </p>
                            <?php endif; ?>

                            <!-- Map Placeholder -->
                            <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-xl overflow-hidden">
                                <div class="w-full h-96 flex items-center justify-center text-gray-500">
                                    <div class="text-center">
                                        <i class="fas fa-map-marked-alt text-4xl mb-2"></i>
                                        <p>Mapa interativo</p>
                                        <p class="text-sm">A localização exata será fornecida após a reserva</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews -->
                        <div class="mb-8" id="avaliacoes">
                            <div class="flex items-center mb-6">
                                <?php if ($avaliacao) : ?>
                                    <i class="fas fa-star text-yellow-400 text-2xl mr-2"></i>
                                    <h2 class="text-2xl font-bold text-gray-900">
                                        <?php echo number_format($avaliacao, 1); ?> · <?php echo get_comments_number(); ?> avaliações
                                    </h2>
                                <?php endif; ?>
                            </div>

                            <!-- Rating Breakdown -->
                            <div class="grid md:grid-cols-2 gap-6 mb-8">
                                <?php
                                $rating_categories = array(
                                    'Limpeza' => 4.9,
                                    'Comunicação' => 5.0,
                                    'Check-in' => 4.8,
                                    'Precisão' => 4.9,
                                    'Localização' => 5.0,
                                    'Custo-benefício' => 4.7,
                                );

                                foreach ($rating_categories as $category => $rating) :
                                    $percentage = ($rating / 5) * 100;
                                ?>
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-medium text-gray-700"><?php echo $category; ?></span>
                                            <span class="text-sm font-semibold"><?php echo number_format($rating, 1); ?></span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-gray-900 h-2 rounded-full" style="width: <?php echo $percentage; ?>%"></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Comments -->
                            <?php if (comments_open() || get_comments_number()) : ?>
                                <?php comments_template(); ?>
                            <?php endif; ?>
                        </div>

                        <!-- Host Info -->
                        <div class="mb-8 pb-8 border-t border-gray-200 pt-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Conheça o anfitrião</h2>

                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-6 border border-gray-200">
                                <div class="flex items-start gap-6">
                                    <div class="flex-shrink-0">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 96, '', '', array('class' => 'rounded-full shadow-lg')); ?>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                                            <?php the_author(); ?>
                                        </h3>
                                        <p class="text-sm text-gray-500 mb-4">
                                            Anfitrião desde <?php echo get_the_author_meta('user_registered') ? date('Y', strtotime(get_the_author_meta('user_registered'))) : '2020'; ?>
                                        </p>

                                        <?php if (get_the_author_meta('description')) : ?>
                                            <div class="text-gray-700 mb-4">
                                                <?php echo wpautop(get_the_author_meta('description')); ?>
                                            </div>
                                        <?php endif; ?>

                                        <button onclick="contactHost()" class="px-6 py-3 bg-[#EC7430] hover:bg-[#D66328] text-white rounded-lg font-semibold transition-colors">
                                            Contatar anfitrião
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Policies -->
                        <div class="mb-8 pb-8 border-t border-gray-200 pt-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Coisas que você deve saber</h2>

                            <div class="grid md:grid-cols-3 gap-8">
                                <!-- House Rules -->
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-3">Regras da casa</h3>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li>Check-in: 14:00 - 22:00</li>
                                        <li>Check-out: 12:00</li>
                                        <li>Máximo de <?php echo $hospedes ? $hospedes : '6'; ?> hóspedes</li>
                                        <li>Não é permitido fumar</li>
                                        <li>Eventos não permitidos</li>
                                    </ul>
                                </div>

                                <!-- Safety -->
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-3">Saúde e segurança</h3>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li>Detector de fumaça</li>
                                        <li>Extintor de incêndio</li>
                                        <li>Kit de primeiros socorros</li>
                                        <li>Câmeras de segurança externas</li>
                                    </ul>
                                </div>

                                <!-- Cancellation -->
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-3">Política de cancelamento</h3>
                                    <p class="text-sm text-gray-700 mb-2">
                                        Cancelamento gratuito por 48 horas.
                                    </p>
                                    <p class="text-sm text-gray-700">
                                        Cancele antes de 5 dias do check-in para reembolso parcial.
                                    </p>
                                    <a href="#" class="text-sm text-[#EC7430] hover:underline font-semibold">Saiba mais</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column - Booking Card (Sticky) -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-24">
                            <div class="bg-white border border-gray-300 rounded-2xl shadow-xl p-6">

                                <!-- Price -->
                                <?php if ($preco_noite) : ?>
                                    <div class="mb-6">
                                        <div class="flex items-baseline gap-1">
                                            <span class="text-3xl font-bold text-gray-900">
                                                R$ <?php echo number_format($preco_noite, 2, ',', '.'); ?>
                                            </span>
                                            <span class="text-gray-600">/ noite</span>
                                        </div>
                                        <?php if ($avaliacao) : ?>
                                            <div class="flex items-center gap-1 text-sm mt-2">
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <span class="font-semibold"><?php echo number_format($avaliacao, 1); ?></span>
                                                <span class="text-gray-500">·</span>
                                                <a href="#avaliacoes" class="text-gray-700 underline"><?php echo get_comments_number(); ?> avaliações</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Booking Form -->
                                <form id="booking-form" class="space-y-4">
                                    <div class="grid grid-cols-2 gap-2 border border-gray-300 rounded-lg overflow-hidden">
                                        <div class="p-3 border-r border-gray-300">
                                            <label class="block text-xs font-semibold text-gray-900 mb-1">CHECK-IN</label>
                                            <input type="date"
                                                id="checkin-date"
                                                class="w-full text-sm border-0 p-0 focus:ring-0"
                                                required>
                                        </div>
                                        <div class="p-3">
                                            <label class="block text-xs font-semibold text-gray-900 mb-1">CHECK-OUT</label>
                                            <input type="date"
                                                id="checkout-date"
                                                class="w-full text-sm border-0 p-0 focus:ring-0"
                                                required>
                                        </div>
                                    </div>

                                    <div class="border border-gray-300 rounded-lg p-3">
                                        <label class="block text-xs font-semibold text-gray-900 mb-1">HÓSPEDES</label>
                                        <select class="w-full text-sm border-0 p-0 focus:ring-0">
                                            <?php for ($i = 1; $i <= ($hospedes ? $hospedes : 8); $i++) : ?>
                                                <option value="<?php echo $i; ?>">
                                                    <?php echo $i; ?> <?php echo $i == 1 ? 'hóspede' : 'hóspedes'; ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                    <button type="submit" class="w-full bg-gradient-to-r from-[#EC7430] to-orange-600 hover:from-[#D66328] hover:to-orange-700 text-white py-4 rounded-lg font-bold text-lg transition-all transform hover:scale-105 shadow-lg">
                                        Reservar
                                    </button>

                                    <p class="text-center text-sm text-gray-600">
                                        Você ainda não será cobrado
                                    </p>
                                </form>

                                <!-- Price Breakdown -->
                                <div id="price-breakdown" class="mt-6 pt-6 border-t border-gray-200 hidden">
                                    <div class="space-y-3 text-sm">
                                        <div class="flex justify-between">
                                            <span class="underline">R$ <?php echo number_format($preco_noite, 2, ',', '.'); ?> x <span id="nights-count">5</span> noites</span>
                                            <span id="subtotal">R$ <?php echo number_format($preco_noite * 5, 2, ',', '.'); ?></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="underline">Taxa de limpeza</span>
                                            <span>R$ <?php echo number_format($preco_noite * 0.1, 2, ',', '.'); ?></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="underline">Taxa de serviço</span>
                                            <span>R$ <?php echo number_format($preco_noite * 0.15, 2, ',', '.'); ?></span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between pt-4 mt-4 border-t border-gray-200 font-bold">
                                        <span>Total</span>
                                        <span id="total-price">R$ <?php echo number_format($preco_noite * 6.25, 2, ',', '.'); ?></span>
                                    </div>
                                </div>

                                <!-- Report Button -->
                                <button onclick="reportListing()" class="w-full mt-6 text-sm text-gray-600 hover:text-gray-900 flex items-center justify-center gap-2 underline">
                                    <i class="fas fa-flag"></i>
                                    Denunciar este anúncio
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Related Properties -->
            <?php
            $related_args = array(
                'post_type'      => 'hospedagem',
                'posts_per_page' => 4,
                'post__not_in'   => array(get_the_ID()),
                'orderby'        => 'rand',
            );

            if ($destinos && !is_wp_error($destinos)) {
                $related_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'destino',
                        'field'    => 'term_id',
                        'terms'    => $destinos[0]->term_id,
                    ),
                );
            }

            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()) :
            ?>
                <section class="py-16 bg-gray-50">
                    <div class="container mx-auto px-4 lg:px-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8">
                            Outras hospedagens em <?php echo $destinos ? esc_html($destinos[0]->name) : 'destinos próximos'; ?>
                        </h2>

                        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                <?php get_template_part('template-parts/content', 'hospedagem-card'); ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>
            <?php
                wp_reset_postdata();
            endif;
            ?>

        </article>

    <?php endwhile; ?>

</main>

<!-- Gallery Modal -->
<div id="gallery-modal" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-4">
    <button onclick="closeGallery()" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 transition-colors z-10" aria-label="Fechar galeria">
        <i class="fas fa-times"></i>
    </button>

    <button onclick="previousPhoto()" class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition-colors" aria-label="Foto anterior">
        <i class="fas fa-chevron-left"></i>
    </button>

    <button onclick="nextPhoto()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition-colors" aria-label="Próxima foto">
        <i class="fas fa-chevron-right"></i>
    </button>

    <div class="max-w-6xl w-full">
        <img id="modal-image" src="" alt="Foto da hospedagem" class="w-full h-auto max-h-[80vh] object-contain rounded-lg">
        <p id="modal-counter" class="text-white text-center mt-4"></p>
    </div>
</div>

<script>
    // Gallery functionality
    let currentPhotoIndex = 0;
    const totalPhotos = 25; // Adjust based on actual gallery

    function openGallery(index) {
        currentPhotoIndex = index;
        updateModalPhoto();
        document.getElementById('gallery-modal').classList.remove('hidden');
        document.getElementById('gallery-modal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeGallery() {
        document.getElementById('gallery-modal').classList.add('hidden');
        document.getElementById('gallery-modal').classList.remove('flex');
        document.body.style.overflow = '';
    }

    function previousPhoto() {
        currentPhotoIndex = (currentPhotoIndex - 1 + totalPhotos) % totalPhotos;
        updateModalPhoto();
    }

    function nextPhoto() {
        currentPhotoIndex = (currentPhotoIndex + 1) % totalPhotos;
        updateModalPhoto();
    }

    function updateModalPhoto() {
        // Update image source (use actual gallery images)
        const modalImage = document.getElementById('modal-image');
        modalImage.src = '<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>';

        // Update counter
        document.getElementById('modal-counter').textContent = `${currentPhotoIndex + 1} / ${totalPhotos}`;
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('gallery-modal');
        if (!modal.classList.contains('hidden')) {
            if (e.key === 'Escape') closeGallery();
            if (e.key === 'ArrowLeft') previousPhoto();
            if (e.key === 'ArrowRight') nextPhoto();
        }
    });

    // Booking form
    document.getElementById('booking-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const checkin = document.getElementById('checkin-date').value;
        const checkout = document.getElementById('checkout-date').value;

        if (checkin && checkout) {
            const checkinDate = new Date(checkin);
            const checkoutDate = new Date(checkout);
            const nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));

            if (nights > 0) {
                alert(`Reserva solicitada!\n\nCheck-in: ${checkin}\nCheck-out: ${checkout}\nNoites: ${nights}\n\nVocê receberá confirmação em breve.`);
            } else {
                alert('Por favor, selecione datas válidas.');
            }
        }
    });

    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('checkin-date').setAttribute('min', today);

    document.getElementById('checkin-date').addEventListener('change', function() {
        document.getElementById('checkout-date').setAttribute('min', this.value);
    });

    // Share functionality
    function shareProperty() {
        if (navigator.share) {
            navigator.share({
                title: '<?php echo esc_js(get_the_title()); ?>',
                text: 'Confira esta hospedagem incrível!',
                url: window.location.href
            });
        } else {
            // Fallback: copy to clipboard
            navigator.clipboard.writeText(window.location.href);
            alert('Link copiado para a área de transferência!');
        }
    }

    // Contact host
    function contactHost() {
        alert('Funcionalidade de contato será implementada em breve!');
    }

    // Show all amenities
    function showAllAmenities() {
        alert('Modal com todas as comodidades será exibido aqui!');
    }

    // Report listing
    function reportListing() {
        if (confirm('Tem certeza que deseja denunciar este anúncio?')) {
            alert('Sua denúncia foi registrada. Obrigado por nos ajudar a manter a comunidade segura.');
        }
    }
</script>

<?php
get_footer();
