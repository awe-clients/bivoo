<?php

/**
 * Template for displaying single Experiencia (Experience Detail)
 *
 * @package Bivoo
 */

get_header();

// Get custom fields (se houver)
$duracao = get_post_meta(get_the_ID(), '_bivoo_experiencia_duracao', true);
$preco = get_post_meta(get_the_ID(), '_bivoo_experiencia_preco', true);
$grupo_max = get_post_meta(get_the_ID(), '_bivoo_experiencia_grupo_max', true);
$nivel = get_post_meta(get_the_ID(), '_bivoo_experiencia_nivel', true);
$idiomas = get_post_meta(get_the_ID(), '_bivoo_experiencia_idiomas', true);
$inclusos = get_post_meta(get_the_ID(), '_bivoo_experiencia_inclusos', true);
$nao_inclusos = get_post_meta(get_the_ID(), '_bivoo_experiencia_nao_inclusos', true);

// Get taxonomies
$categorias = get_the_category();
$tags = get_the_tags();
?>

<main id="main-content" class="site-main">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Hero Section with Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <section class="relative h-[500px] lg:h-[600px] overflow-hidden">
                    <?php the_post_thumbnail('bivoo-hero', array('class' => 'w-full h-full object-cover')); ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

                    <!-- Content Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 lg:p-12">
                        <div class="container mx-auto px-4 lg:px-8">
                            <div class="max-w-4xl">
                                <!-- Breadcrumbs -->
                                <nav class="text-sm text-white/80 mb-4">
                                    <a href="<?php echo home_url(); ?>" class="hover:text-white">Início</a>
                                    <span class="mx-2">/</span>
                                    <a href="<?php echo get_post_type_archive_link('experiencia'); ?>" class="hover:text-white">Experiências</a>
                                    <?php if ($categorias) : ?>
                                        <span class="mx-2">/</span>
                                        <a href="<?php echo get_category_link($categorias[0]); ?>" class="hover:text-white">
                                            <?php echo esc_html($categorias[0]->name); ?>
                                        </a>
                                    <?php endif; ?>
                                </nav>

                                <!-- Category Badge -->
                                <?php if ($categorias) : ?>
                                    <div class="mb-4">
                                        <span class="inline-block bg-[#EC7430] text-white text-sm font-semibold px-4 py-2 rounded-full">
                                            <i class="fas fa-tag mr-1"></i>
                                            <?php echo esc_html($categorias[0]->name); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <!-- Title -->
                                <h1 class="text-3xl lg:text-5xl font-bold text-white mb-4">
                                    <?php the_title(); ?>
                                </h1>

                                <!-- Meta Info -->
                                <div class="flex flex-wrap items-center gap-4 text-white/90 text-sm">
                                    <?php if ($duracao) : ?>
                                        <div class="flex items-center">
                                            <i class="far fa-clock mr-2"></i>
                                            <span><?php echo esc_html($duracao); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($grupo_max) : ?>
                                        <div class="flex items-center">
                                            <i class="fas fa-users mr-2"></i>
                                            <span>Até <?php echo esc_html($grupo_max); ?> pessoas</span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($nivel) : ?>
                                        <div class="flex items-center">
                                            <i class="fas fa-signal mr-2"></i>
                                            <span><?php echo esc_html($nivel); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (get_comments_number()) : ?>
                                        <div class="flex items-center">
                                            <i class="fas fa-star text-yellow-400 mr-2"></i>
                                            <span class="font-semibold">4.8</span>
                                            <span class="mx-1">·</span>
                                            <a href="#avaliacoes" class="hover:underline"><?php echo get_comments_number(); ?> avaliações</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="absolute top-6 right-6 flex items-center gap-2">
                        <button onclick="shareExperience()" class="w-10 h-10 bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-all shadow-lg">
                            <i class="fas fa-share-alt text-gray-700"></i>
                        </button>
                        <button class="favorite-button w-10 h-10 bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-all shadow-lg" data-post-id="<?php the_ID(); ?>">
                            <i class="far fa-heart text-gray-700"></i>
                        </button>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Main Content -->
            <div class="container mx-auto px-4 lg:px-8 py-12 lg:py-16">
                <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">

                    <!-- Left Column - Content -->
                    <div class="lg:col-span-2">

                        <!-- Description -->
                        <div class="mb-12">
                            <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-6">Sobre esta experiência</h2>
                            <div class="prose prose-lg max-w-none text-gray-700">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <!-- What's Included -->
                        <?php if ($inclusos) : ?>
                            <div class="mb-12 pb-12 border-b border-gray-200">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    O que está incluído
                                </h2>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <?php
                                    $inclusos_array = is_array($inclusos) ? $inclusos : explode("\n", $inclusos);
                                    foreach ($inclusos_array as $item) :
                                        if (trim($item)) :
                                    ?>
                                            <div class="flex items-start gap-3">
                                                <i class="fas fa-check text-green-500 mt-1"></i>
                                                <span class="text-gray-700"><?php echo esc_html(trim($item)); ?></span>
                                            </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- What's NOT Included -->
                        <?php if ($nao_inclusos) : ?>
                            <div class="mb-12 pb-12 border-b border-gray-200">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                    <i class="fas fa-times-circle text-red-500 mr-2"></i>
                                    O que NÃO está incluído
                                </h2>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <?php
                                    $nao_inclusos_array = is_array($nao_inclusos) ? $nao_inclusos : explode("\n", $nao_inclusos);
                                    foreach ($nao_inclusos_array as $item) :
                                        if (trim($item)) :
                                    ?>
                                            <div class="flex items-start gap-3">
                                                <i class="fas fa-times text-red-500 mt-1"></i>
                                                <span class="text-gray-700"><?php echo esc_html(trim($item)); ?></span>
                                            </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Itinerary -->
                        <div class="mb-12 pb-12 border-b border-gray-200">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                <i class="fas fa-route text-[#EC7430] mr-2"></i>
                                Itinerário
                            </h2>

                            <div class="space-y-6">
                                <!-- Sample itinerary - would be dynamic -->
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-[#EC7430] text-white rounded-full flex items-center justify-center font-bold">
                                        1
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-2">Ponto de encontro</h3>
                                        <p class="text-gray-700">Encontro no local combinado. Briefing sobre a experiência e distribuição de equipamentos.</p>
                                    </div>
                                </div>

                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-[#EC7430] text-white rounded-full flex items-center justify-center font-bold">
                                        2
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-2">Início da atividade</h3>
                                        <p class="text-gray-700">Partida para o local principal da experiência com todas as orientações de segurança.</p>
                                    </div>
                                </div>

                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-[#EC7430] text-white rounded-full flex items-center justify-center font-bold">
                                        3
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-2">Experiência completa</h3>
                                        <p class="text-gray-700">Aproveite cada momento desta experiência única com acompanhamento de guia especializado.</p>
                                    </div>
                                </div>

                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 bg-green-500 text-white rounded-full flex items-center justify-center font-bold">
                                        <i class="fas fa-flag-checkered"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-2">Retorno</h3>
                                        <p class="text-gray-700">Retorno ao ponto de encontro original com lembranças inesquecíveis!</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Important Info -->
                        <div class="mb-12 pb-12 border-b border-gray-200">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                Informações importantes
                            </h2>

                            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg mb-6">
                                <h3 class="font-bold text-blue-900 mb-3">Antes de reservar</h3>
                                <ul class="space-y-2 text-blue-900 text-sm">
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check mt-1"></i>
                                        <span>Idade mínima recomendada: 12 anos</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check mt-1"></i>
                                        <span>Roupas confortáveis e calçados apropriados são recomendados</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check mt-1"></i>
                                        <span>Protetor solar e repelente são essenciais</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fas fa-check mt-1"></i>
                                        <span>Chegue com 15 minutos de antecedência</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Weather dependent -->
                                <div class="flex gap-4">
                                    <i class="fas fa-cloud-sun text-2xl text-[#EC7430]"></i>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-1">Dependente do clima</h3>
                                        <p class="text-sm text-gray-600">Pode ser cancelada em caso de mau tempo. Reembolso total ou remarcação.</p>
                                    </div>
                                </div>

                                <!-- Cancellation policy -->
                                <div class="flex gap-4">
                                    <i class="fas fa-undo text-2xl text-[#EC7430]"></i>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-1">Política de cancelamento</h3>
                                        <p class="text-sm text-gray-600">Cancelamento gratuito até 24h antes. Após isso, taxa de 50%.</p>
                                    </div>
                                </div>

                                <!-- Physical condition -->
                                <div class="flex gap-4">
                                    <i class="fas fa-heartbeat text-2xl text-[#EC7430]"></i>
                                    <div>
                                        <h3 class="font-bold text-gray-900 mb-1">Condição física</h3>
                                        <p class="text-sm text-gray-600">Nível <?php echo $nivel ? esc_html($nivel) : 'moderado'; ?>. Consulte em caso de dúvidas.</p>
                                    </div>
                                </div>

                                <!-- Languages -->
                                <?php if ($idiomas) : ?>
                                    <div class="flex gap-4">
                                        <i class="fas fa-language text-2xl text-[#EC7430]"></i>
                                        <div>
                                            <h3 class="font-bold text-gray-900 mb-1">Idiomas</h3>
                                            <p class="text-sm text-gray-600"><?php echo esc_html($idiomas); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Meeting Point -->
                        <div class="mb-12 pb-12 border-b border-gray-200">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                Ponto de encontro
                            </h2>

                            <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-xl overflow-hidden mb-4">
                                <div class="w-full h-96 flex items-center justify-center text-gray-500">
                                    <div class="text-center">
                                        <i class="fas fa-map-marked-alt text-5xl mb-3"></i>
                                        <p class="font-semibold">Mapa do ponto de encontro</p>
                                        <p class="text-sm">Localização exata enviada após confirmação</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-700">
                                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                    O endereço exato e instruções detalhadas serão enviados por e-mail após a confirmação da reserva.
                                </p>
                            </div>
                        </div>

                        <!-- Reviews -->
                        <div class="mb-12" id="avaliacoes">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                <i class="fas fa-star text-yellow-400 mr-2"></i>
                                Avaliações
                            </h2>

                            <!-- Overall Rating -->
                            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 mb-8 border border-gray-200">
                                <div class="flex items-center gap-8">
                                    <div class="text-center">
                                        <div class="text-6xl font-bold text-gray-900 mb-2">4.8</div>
                                        <div class="flex items-center justify-center gap-1 mb-2">
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star text-yellow-400"></i>
                                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                                        </div>
                                        <p class="text-sm text-gray-600"><?php echo get_comments_number(); ?> avaliações</p>
                                    </div>

                                    <div class="flex-1 space-y-2">
                                        <?php
                                        $rating_bars = array(
                                            5 => 85,
                                            4 => 10,
                                            3 => 3,
                                            2 => 1,
                                            1 => 1,
                                        );

                                        foreach ($rating_bars as $stars => $percentage) :
                                        ?>
                                            <div class="flex items-center gap-3">
                                                <span class="text-sm font-medium text-gray-700 w-12"><?php echo $stars; ?> estrelas</span>
                                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                    <div class="bg-yellow-400 h-2 rounded-full" style="width: <?php echo $percentage; ?>%"></div>
                                                </div>
                                                <span class="text-sm text-gray-600 w-12 text-right"><?php echo $percentage; ?>%</span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Comments -->
                            <?php if (comments_open() || get_comments_number()) : ?>
                                <?php comments_template(); ?>
                            <?php endif; ?>
                        </div>

                        <!-- Host Info -->
                        <div class="mb-12">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Conheça seu anfitrião</h2>

                            <div class="bg-gradient-to-br from-[#EC7430]/10 to-orange-50 rounded-2xl p-8 border border-[#EC7430]/30">
                                <div class="flex items-start gap-6">
                                    <div class="flex-shrink-0">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 96, '', '', array('class' => 'rounded-full shadow-lg ring-4 ring-white')); ?>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                            <?php the_author(); ?>
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-4">
                                            <i class="fas fa-shield-alt text-green-500 mr-1"></i>
                                            Anfitrião verificado · Membro desde <?php echo get_the_author_meta('user_registered') ? date('Y', strtotime(get_the_author_meta('user_registered'))) : '2020'; ?>
                                        </p>

                                        <?php if (get_the_author_meta('description')) : ?>
                                            <div class="text-gray-700 mb-6">
                                                <?php echo wpautop(get_the_author_meta('description')); ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="flex flex-wrap gap-4 text-sm text-gray-700 mb-6">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <span><strong>124</strong> avaliações</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-certificate text-[#EC7430]"></i>
                                                <span>Especialista certificado</span>
                                            </div>
                                        </div>

                                        <button onclick="contactHost()" class="px-6 py-3 bg-white hover:bg-gray-50 border-2 border-[#EC7430] text-[#EC7430] rounded-lg font-semibold transition-all">
                                            <i class="fas fa-envelope mr-2"></i>
                                            Contatar anfitrião
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column - Booking Card (Sticky) -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-24">
                            <div class="bg-white border-2 border-gray-300 rounded-2xl shadow-xl p-6">

                                <!-- Price -->
                                <?php if ($preco) : ?>
                                    <div class="mb-6 pb-6 border-b border-gray-200">
                                        <div class="flex items-baseline gap-2">
                                            <span class="text-4xl font-bold text-gray-900">
                                                R$ <?php echo number_format($preco, 2, ',', '.'); ?>
                                            </span>
                                            <span class="text-gray-600">/ pessoa</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-2">
                                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                                            <span class="font-semibold">4.8</span> · <?php echo get_comments_number(); ?> avaliações
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <!-- Quick Info -->
                                <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                                    <?php if ($duracao) : ?>
                                        <div class="flex items-center gap-3 text-gray-700">
                                            <i class="far fa-clock text-[#EC7430] w-5"></i>
                                            <span class="text-sm"><?php echo esc_html($duracao); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($grupo_max) : ?>
                                        <div class="flex items-center gap-3 text-gray-700">
                                            <i class="fas fa-users text-[#EC7430] w-5"></i>
                                            <span class="text-sm">Até <?php echo esc_html($grupo_max); ?> pessoas</span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($idiomas) : ?>
                                        <div class="flex items-center gap-3 text-gray-700">
                                            <i class="fas fa-language text-[#EC7430] w-5"></i>
                                            <span class="text-sm"><?php echo esc_html($idiomas); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($nivel) : ?>
                                        <div class="flex items-center gap-3 text-gray-700">
                                            <i class="fas fa-signal text-[#EC7430] w-5"></i>
                                            <span class="text-sm">Nível: <?php echo esc_html($nivel); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Booking Form -->
                                <form id="experience-booking-form" class="space-y-4 mb-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 mb-2">Data</label>
                                        <input type="date"
                                            id="booking-date"
                                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-[#EC7430] focus:ring-2 focus:ring-[#EC7430]/20 outline-none transition-all"
                                            required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 mb-2">Horário</label>
                                        <select class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-[#EC7430] focus:ring-2 focus:ring-[#EC7430]/20 outline-none transition-all">
                                            <option>09:00</option>
                                            <option>14:00</option>
                                            <option>16:00</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-900 mb-2">Número de pessoas</label>
                                        <select id="num-guests" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-[#EC7430] focus:ring-2 focus:ring-[#EC7430]/20 outline-none transition-all">
                                            <?php for ($i = 1; $i <= ($grupo_max ? $grupo_max : 10); $i++) : ?>
                                                <option value="<?php echo $i; ?>">
                                                    <?php echo $i; ?> <?php echo $i == 1 ? 'pessoa' : 'pessoas'; ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                    <button type="submit" class="w-full bg-gradient-to-r from-[#EC7430] to-orange-600 hover:from-[#D66328] hover:to-orange-700 text-white py-4 rounded-lg font-bold text-lg transition-all transform hover:scale-105 shadow-lg">
                                        Reservar agora
                                    </button>

                                    <p class="text-center text-xs text-gray-600">
                                        Você ainda não será cobrado
                                    </p>
                                </form>

                                <!-- Price Breakdown -->
                                <?php if ($preco) : ?>
                                    <div class="space-y-3 text-sm pt-6 border-t border-gray-200">
                                        <div class="flex justify-between text-gray-700">
                                            <span>R$ <?php echo number_format($preco, 2, ',', '.'); ?> x <span id="num-people">1</span> pessoa(s)</span>
                                            <span id="subtotal-price">R$ <?php echo number_format($preco, 2, ',', '.'); ?></span>
                                        </div>
                                        <div class="flex justify-between text-gray-700">
                                            <span class="underline">Taxa de serviço</span>
                                            <span>R$ <?php echo number_format($preco * 0.1, 2, ',', '.'); ?></span>
                                        </div>
                                        <div class="flex justify-between pt-3 border-t border-gray-200 font-bold text-gray-900">
                                            <span>Total</span>
                                            <span id="total-price-display">R$ <?php echo number_format($preco * 1.1, 2, ',', '.'); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Trust Badges -->
                                <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                                    <div class="flex items-center gap-3 text-sm text-gray-700">
                                        <i class="fas fa-check-circle text-green-500"></i>
                                        <span>Confirmação imediata</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-sm text-gray-700">
                                        <i class="fas fa-shield-alt text-blue-500"></i>
                                        <span>Reserva 100% segura</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-sm text-gray-700">
                                        <i class="fas fa-undo text-orange-500"></i>
                                        <span>Cancelamento grátis até 24h</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Card -->
                            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-6 text-center">
                                <i class="fas fa-headset text-3xl text-blue-600 mb-3"></i>
                                <h3 class="font-bold text-gray-900 mb-2">Dúvidas?</h3>
                                <p class="text-sm text-gray-700 mb-4">Entre em contato conosco</p>
                                <a href="tel:08008870248" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold">
                                    <i class="fas fa-phone"></i>
                                    0800 887 0248
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Related Experiences -->
            <?php
            $related_args = array(
                'post_type'      => 'experiencia',
                'posts_per_page' => 4,
                'post__not_in'   => array(get_the_ID()),
                'orderby'        => 'rand',
            );

            if ($categorias) {
                $related_args['category__in'] = wp_get_post_categories(get_the_ID());
            }

            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()) :
            ?>
                <section class="py-16 lg:py-24 bg-gray-50">
                    <div class="container mx-auto px-4 lg:px-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8">
                            Outras experiências que você pode gostar
                        </h2>

                        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                <article class="card group">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>" class="block relative overflow-hidden">
                                            <?php the_post_thumbnail('bivoo-listing-thumb', array('class' => 'w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500')); ?>
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        </a>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h3 class="text-xl font-bold mb-2 line-clamp-2">
                                            <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-[#EC7430] transition-colors">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <div class="text-sm text-gray-500 mb-3">
                                            <?php
                                            $exp_duracao = get_post_meta(get_the_ID(), '_bivoo_experiencia_duracao', true);
                                            $exp_preco = get_post_meta(get_the_ID(), '_bivoo_experiencia_preco', true);

                                            if ($exp_duracao) :
                                                echo '<i class="far fa-clock mr-1"></i>' . esc_html($exp_duracao);
                                            endif;
                                            ?>
                                        </div>
                                        <?php if ($exp_preco) : ?>
                                            <div class="flex items-baseline gap-1">
                                                <span class="text-2xl font-bold text-gray-900">
                                                    R$ <?php echo number_format($exp_preco, 0, ',', '.'); ?>
                                                </span>
                                                <span class="text-sm text-gray-600">/ pessoa</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </article>
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

<script>
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('booking-date').setAttribute('min', today);

    // Experience booking form
    document.getElementById('experience-booking-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const date = document.getElementById('booking-date').value;
        const numGuests = document.getElementById('num-guests').value;

        if (date && numGuests) {
            alert(`Reserva solicitada!\n\nData: ${date}\nPessoas: ${numGuests}\n\nVocê receberá confirmação em breve.`);
        }
    });

    // Update price based on number of guests
    document.getElementById('num-guests').addEventListener('change', function() {
        const numPeople = parseInt(this.value);
        const pricePerPerson = <?php echo $preco ? $preco : 0; ?>;
        const subtotal = numPeople * pricePerPerson;
        const serviceFee = subtotal * 0.1;
        const total = subtotal + serviceFee;

        document.getElementById('num-people').textContent = numPeople;
        document.getElementById('subtotal-price').textContent = 'R$ ' + subtotal.toFixed(2).replace('.', ',');
        document.getElementById('total-price-display').textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
    });

    // Share functionality
    function shareExperience() {
        if (navigator.share) {
            navigator.share({
                title: '<?php echo esc_js(get_the_title()); ?>',
                text: 'Confira esta experiência incrível!',
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(window.location.href);
            alert('Link copiado para a área de transferência!');
        }
    }

    // Contact host
    function contactHost() {
        alert('Funcionalidade de contato será implementada em breve!');
    }
</script>

<?php
get_footer();
