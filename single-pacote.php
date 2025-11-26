<?php

/**
 * Template for displaying single Pacote (Package Detail)
 *
 * @package Bivoo
 */

get_header();

// Get custom fields
$preco_total = get_post_meta(get_the_ID(), '_bivoo_pacote_preco', true);
$duracao_dias = get_post_meta(get_the_ID(), '_bivoo_pacote_duracao_dias', true);
$duracao_noites = get_post_meta(get_the_ID(), '_bivoo_pacote_duracao_noites', true);
$tipo_hospedagem = get_post_meta(get_the_ID(), '_bivoo_pacote_hospedagem', true);
$refeicoes = get_post_meta(get_the_ID(), '_bivoo_pacote_refeicoes', true);
$transporte = get_post_meta(get_the_ID(), '_bivoo_pacote_transporte', true);
$passeios = get_post_meta(get_the_ID(), '_bivoo_pacote_passeios', true);
$min_pessoas = get_post_meta(get_the_ID(), '_bivoo_pacote_min_pessoas', true);
$max_pessoas = get_post_meta(get_the_ID(), '_bivoo_pacote_max_pessoas', true);
$saida_de = get_post_meta(get_the_ID(), '_bivoo_pacote_saida_de', true);
$destinos = get_post_meta(get_the_ID(), '_bivoo_pacote_destinos', true);

// Get taxonomies
$categorias = get_the_category();
$tags = get_the_tags();
?>

<main id="main-content" class="site-main">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <!-- Hero Section with Gallery -->
            <?php if (has_post_thumbnail()) : ?>
                <section class="relative h-[500px] lg:h-[700px] overflow-hidden">
                    <?php the_post_thumbnail('bivoo-hero', array('class' => 'w-full h-full object-cover')); ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-black/20"></div>

                    <!-- Floating Badge -->
                    <div class="absolute top-6 left-6">
                        <div class="bg-gradient-to-r from-[#EC7430] to-orange-600 text-white px-6 py-3 rounded-full shadow-2xl">
                            <span class="font-bold text-lg">
                                <?php if ($duracao_dias && $duracao_noites) : ?>
                                    <?php echo esc_html($duracao_dias); ?> dias / <?php echo esc_html($duracao_noites); ?> noites
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="absolute top-6 right-6 flex items-center gap-2">
                        <button onclick="openGallery(0)" class="w-12 h-12 bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-all shadow-lg">
                            <i class="fas fa-images text-gray-700"></i>
                        </button>
                        <button onclick="sharePackage()" class="w-12 h-12 bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-all shadow-lg">
                            <i class="fas fa-share-alt text-gray-700"></i>
                        </button>
                        <button class="favorite-button w-12 h-12 bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-all shadow-lg" data-post-id="<?php the_ID(); ?>">
                            <i class="far fa-heart text-gray-700"></i>
                        </button>
                    </div>

                    <!-- Content Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 lg:p-12">
                        <div class="container mx-auto px-4 lg:px-8">
                            <div class="max-w-5xl">
                                <!-- Breadcrumbs -->
                                <nav class="text-sm text-white/80 mb-4">
                                    <a href="<?php echo home_url(); ?>" class="hover:text-white">Início</a>
                                    <span class="mx-2">/</span>
                                    <a href="<?php echo get_post_type_archive_link('pacote'); ?>" class="hover:text-white">Pacotes</a>
                                    <?php if ($categorias) : ?>
                                        <span class="mx-2">/</span>
                                        <span class="text-white"><?php echo esc_html($categorias[0]->name); ?></span>
                                    <?php endif; ?>
                                </nav>

                                <!-- Category Badge -->
                                <?php if ($categorias) : ?>
                                    <div class="mb-4">
                                        <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-sm font-semibold px-4 py-2 rounded-full border-2 border-white/30">
                                            <i class="fas fa-suitcase-rolling mr-1"></i>
                                            <?php echo esc_html($categorias[0]->name); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <!-- Title -->
                                <h1 class="text-4xl lg:text-6xl font-bold text-white mb-6 drop-shadow-lg">
                                    <?php the_title(); ?>
                                </h1>

                                <!-- Highlights -->
                                <div class="flex flex-wrap items-center gap-6 text-white">
                                    <?php if ($destinos) : ?>
                                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full">
                                            <i class="fas fa-map-marker-alt text-[#EC7430]"></i>
                                            <span class="font-semibold"><?php echo esc_html($destinos); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($tipo_hospedagem) : ?>
                                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full">
                                            <i class="fas fa-hotel text-[#EC7430]"></i>
                                            <span><?php echo esc_html($tipo_hospedagem); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($refeicoes) : ?>
                                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full">
                                            <i class="fas fa-utensils text-[#EC7430]"></i>
                                            <span><?php echo esc_html($refeicoes); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($transporte) : ?>
                                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full">
                                            <i class="fas fa-plane text-[#EC7430]"></i>
                                            <span><?php echo esc_html($transporte); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Price Preview -->
                                <?php if ($preco_total) : ?>
                                    <div class="mt-8 inline-flex items-baseline gap-2 bg-gradient-to-r from-[#EC7430] to-orange-600 px-8 py-4 rounded-2xl shadow-2xl">
                                        <span class="text-white/80 text-lg">A partir de</span>
                                        <span class="text-5xl font-bold text-white">
                                            R$ <?php echo number_format($preco_total, 0, ',', '.'); ?>
                                        </span>
                                        <span class="text-white/80 text-lg">por pessoa</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Main Content -->
            <div class="container mx-auto px-4 lg:px-8 py-12 lg:py-16">
                <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">

                    <!-- Left Column - Content -->
                    <div class="lg:col-span-2">

                        <!-- Quick Overview Cards -->
                        <div class="grid md:grid-cols-3 gap-4 mb-12">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-2xl border-2 border-blue-200">
                                <div class="text-blue-600 text-3xl mb-2">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="text-sm text-blue-600 font-semibold mb-1">Duração</div>
                                <div class="text-xl font-bold text-blue-900">
                                    <?php echo $duracao_dias ? esc_html($duracao_dias) . ' dias' : 'Sob consulta'; ?>
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl border-2 border-green-200">
                                <div class="text-green-600 text-3xl mb-2">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="text-sm text-green-600 font-semibold mb-1">Grupo</div>
                                <div class="text-xl font-bold text-green-900">
                                    <?php
                                    if ($min_pessoas && $max_pessoas) {
                                        echo esc_html($min_pessoas) . ' a ' . esc_html($max_pessoas) . ' pessoas';
                                    } else {
                                        echo 'Flexível';
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-2xl border-2 border-purple-200">
                                <div class="text-purple-600 text-3xl mb-2">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <div class="text-sm text-purple-600 font-semibold mb-1">Saída</div>
                                <div class="text-xl font-bold text-purple-900">
                                    <?php echo $saida_de ? esc_html($saida_de) : 'Várias cidades'; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-12 pb-12 border-b border-gray-200">
                            <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <i class="fas fa-compass text-[#EC7430]"></i>
                                Visão Geral do Pacote
                            </h2>
                            <div class="prose prose-lg max-w-none text-gray-700">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <!-- What's Included -->
                        <div class="mb-12 pb-12 border-b border-gray-200">
                            <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <i class="fas fa-check-double text-green-500"></i>
                                O que está incluído
                            </h2>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Hospedagem -->
                                <?php if ($tipo_hospedagem) : ?>
                                    <div class="bg-gradient-to-br from-amber-50 to-orange-50 p-6 rounded-xl border border-amber-200">
                                        <h3 class="font-bold text-amber-900 mb-4 flex items-center gap-2">
                                            <i class="fas fa-hotel text-amber-600"></i>
                                            Hospedagem
                                        </h3>
                                        <p class="text-amber-900"><?php echo esc_html($tipo_hospedagem); ?></p>
                                        <ul class="mt-3 space-y-2 text-sm text-amber-800">
                                            <li><i class="fas fa-check mr-2"></i>Check-in e check-out</li>
                                            <li><i class="fas fa-check mr-2"></i>Wi-Fi incluído</li>
                                            <li><i class="fas fa-check mr-2"></i>Impostos e taxas</li>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <!-- Refeições -->
                                <?php if ($refeicoes) : ?>
                                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl border border-green-200">
                                        <h3 class="font-bold text-green-900 mb-4 flex items-center gap-2">
                                            <i class="fas fa-utensils text-green-600"></i>
                                            Alimentação
                                        </h3>
                                        <p class="text-green-900"><?php echo esc_html($refeicoes); ?></p>
                                        <ul class="mt-3 space-y-2 text-sm text-green-800">
                                            <li><i class="fas fa-check mr-2"></i>Café da manhã</li>
                                            <?php if (stripos($refeicoes, 'completa') !== false || stripos($refeicoes, 'pensão completa') !== false) : ?>
                                                <li><i class="fas fa-check mr-2"></i>Almoço</li>
                                                <li><i class="fas fa-check mr-2"></i>Jantar</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <!-- Transporte -->
                                <?php if ($transporte) : ?>
                                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-6 rounded-xl border border-blue-200">
                                        <h3 class="font-bold text-blue-900 mb-4 flex items-center gap-2">
                                            <i class="fas fa-plane text-blue-600"></i>
                                            Transporte
                                        </h3>
                                        <p class="text-blue-900"><?php echo esc_html($transporte); ?></p>
                                        <ul class="mt-3 space-y-2 text-sm text-blue-800">
                                            <li><i class="fas fa-check mr-2"></i>Traslados aeroporto</li>
                                            <li><i class="fas fa-check mr-2"></i>Transfers inclusos</li>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <!-- Passeios -->
                                <?php if ($passeios) : ?>
                                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-xl border border-purple-200">
                                        <h3 class="font-bold text-purple-900 mb-4 flex items-center gap-2">
                                            <i class="fas fa-hiking text-purple-600"></i>
                                            Passeios
                                        </h3>
                                        <p class="text-purple-900"><?php echo esc_html($passeios); ?></p>
                                        <ul class="mt-3 space-y-2 text-sm text-purple-800">
                                            <li><i class="fas fa-check mr-2"></i>Guias locais</li>
                                            <li><i class="fas fa-check mr-2"></i>Ingressos inclusos</li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Additional Inclusions -->
                            <div class="mt-6 bg-gray-50 p-6 rounded-xl">
                                <h3 class="font-bold text-gray-900 mb-4">Também incluído:</h3>
                                <div class="grid md:grid-cols-2 gap-3">
                                    <div class="flex items-center gap-2 text-gray-700">
                                        <i class="fas fa-shield-alt text-green-500"></i>
                                        <span>Seguro viagem</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-700">
                                        <i class="fas fa-headset text-green-500"></i>
                                        <span>Suporte 24h</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-700">
                                        <i class="fas fa-file-invoice text-green-500"></i>
                                        <span>Impostos e taxas</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-700">
                                        <i class="fas fa-gift text-green-500"></i>
                                        <span>Kit de boas-vindas</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Itinerary -->
                        <div class="mb-12 pb-12 border-b border-gray-200">
                            <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <i class="fas fa-route text-[#EC7430]"></i>
                                Roteiro Completo
                            </h2>

                            <div class="space-y-6">
                                <?php
                                // Sample itinerary - would be dynamic in production
                                $roteiro = array(
                                    array(
                                        'dia' => '1',
                                        'titulo' => 'Chegada e Check-in',
                                        'descricao' => 'Chegada ao destino, transfer para o hotel e check-in. Tempo livre para conhecer os arredores. Welcome drink e jantar de boas-vindas.',
                                        'icon' => 'fa-plane-arrival',
                                        'color' => 'blue'
                                    ),
                                    array(
                                        'dia' => '2',
                                        'titulo' => 'City Tour',
                                        'descricao' => 'Café da manhã no hotel seguido de city tour pelos principais pontos turísticos. Almoço incluso. Tarde livre para compras ou atividades opcionais.',
                                        'icon' => 'fa-city',
                                        'color' => 'green'
                                    ),
                                    array(
                                        'dia' => '3',
                                        'titulo' => 'Passeios e Experiências',
                                        'descricao' => 'Dia dedicado a passeios exclusivos e experiências locais. Todas as refeições incluídas. Guia especializado durante todo o dia.',
                                        'icon' => 'fa-umbrella-beach',
                                        'color' => 'orange'
                                    ),
                                    array(
                                        'dia' => $duracao_dias ? $duracao_dias : '4',
                                        'titulo' => 'Check-out e Partida',
                                        'descricao' => 'Café da manhã no hotel. Check-out e transfer para o aeroporto. Fim dos nossos serviços com lembranças inesquecíveis!',
                                        'icon' => 'fa-plane-departure',
                                        'color' => 'purple'
                                    ),
                                );

                                foreach ($roteiro as $index => $dia) :
                                    $color_classes = array(
                                        'blue' => 'bg-blue-500 text-white',
                                        'green' => 'bg-green-500 text-white',
                                        'orange' => 'bg-[#EC7430] text-white',
                                        'purple' => 'bg-purple-500 text-white',
                                    );
                                ?>
                                    <div class="flex gap-6 group">
                                        <div class="flex-shrink-0 relative">
                                            <div class="w-16 h-16 <?php echo $color_classes[$dia['color']]; ?> rounded-full flex items-center justify-center font-bold text-2xl shadow-lg group-hover:scale-110 transition-transform">
                                                <?php echo esc_html($dia['dia']); ?>
                                            </div>
                                            <?php if ($index < count($roteiro) - 1) : ?>
                                                <div class="absolute top-16 left-1/2 -translate-x-1/2 w-1 h-12 bg-gray-300"></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-1 pb-12">
                                            <div class="bg-white border-2 border-gray-200 rounded-2xl p-6 group-hover:border-[#EC7430] group-hover:shadow-lg transition-all">
                                                <div class="flex items-center gap-3 mb-3">
                                                    <i class="fas <?php echo $dia['icon']; ?> text-2xl text-[#EC7430]"></i>
                                                    <h3 class="text-2xl font-bold text-gray-900">Dia <?php echo esc_html($dia['dia']); ?> - <?php echo esc_html($dia['titulo']); ?></h3>
                                                </div>
                                                <p class="text-gray-700 leading-relaxed"><?php echo esc_html($dia['descricao']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Important Information -->
                        <div class="mb-12 pb-12 border-b border-gray-200">
                            <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <i class="fas fa-info-circle text-blue-500"></i>
                                Informações Importantes
                            </h2>

                            <div class="space-y-6">
                                <!-- Requirements -->
                                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-xl">
                                    <h3 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                                        <i class="fas fa-clipboard-check"></i>
                                        Documentação Necessária
                                    </h3>
                                    <ul class="space-y-2 text-blue-900">
                                        <li class="flex items-start gap-2">
                                            <i class="fas fa-passport mt-1"></i>
                                            <span>Documento de identidade com foto (RG ou CNH)</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <i class="fas fa-id-card mt-1"></i>
                                            <span>CPF (obrigatório para emissão de passagens)</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <i class="fas fa-child mt-1"></i>
                                            <span>Menores de 18 anos precisam de autorização dos pais</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- What to bring -->
                                <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-r-xl">
                                    <h3 class="font-bold text-green-900 mb-3 flex items-center gap-2">
                                        <i class="fas fa-suitcase"></i>
                                        O que levar
                                    </h3>
                                    <div class="grid md:grid-cols-2 gap-3">
                                        <div class="flex items-center gap-2 text-green-900">
                                            <i class="fas fa-check"></i>
                                            <span>Roupas leves e confortáveis</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-green-900">
                                            <i class="fas fa-check"></i>
                                            <span>Protetor solar e repelente</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-green-900">
                                            <i class="fas fa-check"></i>
                                            <span>Óculos de sol e chapéu</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-green-900">
                                            <i class="fas fa-check"></i>
                                            <span>Calçados confortáveis</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Cancellation Policy -->
                                <div class="bg-amber-50 border-l-4 border-amber-500 p-6 rounded-r-xl">
                                    <h3 class="font-bold text-amber-900 mb-3 flex items-center gap-2">
                                        <i class="fas fa-undo"></i>
                                        Política de Cancelamento
                                    </h3>
                                    <div class="space-y-2 text-amber-900">
                                        <p><strong>• Até 60 dias antes:</strong> Reembolso integral (100%)</p>
                                        <p><strong>• De 59 a 30 dias antes:</strong> Reembolso de 50%</p>
                                        <p><strong>• Menos de 30 dias:</strong> Sem reembolso</p>
                                        <p class="text-sm mt-3 pt-3 border-t border-amber-200">
                                            * Consulte condições especiais para pacotes promocionais
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews -->
                        <div class="mb-12" id="avaliacoes">
                            <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <i class="fas fa-star text-yellow-400"></i>
                                Avaliações de Viajantes
                            </h2>

                            <!-- Overall Rating -->
                            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl p-8 mb-8 border-2 border-yellow-200">
                                <div class="flex items-center justify-center gap-12">
                                    <div class="text-center">
                                        <div class="text-7xl font-bold text-gray-900 mb-3">4.9</div>
                                        <div class="flex items-center justify-center gap-1 mb-2">
                                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                                <i class="fas fa-star text-yellow-400 text-xl"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <p class="text-gray-600">Excelente</p>
                                        <p class="text-sm text-gray-500 mt-1"><?php echo get_comments_number(); ?> avaliações</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Comments -->
                            <?php if (comments_open() || get_comments_number()) : ?>
                                <?php comments_template(); ?>
                            <?php endif; ?>
                        </div>

                    </div>

                    <!-- Right Column - Booking Card (Sticky) -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-24 space-y-6">

                            <!-- Main Booking Card -->
                            <div class="bg-gradient-to-br from-white to-gray-50 border-2 border-gray-300 rounded-2xl shadow-2xl overflow-hidden">
                                <!-- Price Header -->
                                <div class="bg-gradient-to-r from-[#EC7430] to-orange-600 p-6 text-white">
                                    <?php if ($preco_total) : ?>
                                        <div class="text-center">
                                            <div class="text-sm mb-2 opacity-90">A partir de</div>
                                            <div class="text-5xl font-bold mb-2">
                                                R$ <?php echo number_format($preco_total, 0, ',', '.'); ?>
                                            </div>
                                            <div class="text-sm opacity-90">por pessoa</div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Booking Form -->
                                <div class="p-6">
                                    <form id="package-booking-form" class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-900 mb-2">Data de Partida</label>
                                            <input type="date"
                                                id="departure-date"
                                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-[#EC7430] focus:ring-2 focus:ring-[#EC7430]/20 outline-none transition-all"
                                                required>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-900 mb-2">Número de Pessoas</label>
                                            <select id="num-people" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-[#EC7430] focus:ring-2 focus:ring-[#EC7430]/20 outline-none transition-all">
                                                <?php
                                                $min = $min_pessoas ? intval($min_pessoas) : 1;
                                                $max = $max_pessoas ? intval($max_pessoas) : 20;
                                                for ($i = $min; $i <= $max; $i++) :
                                                ?>
                                                    <option value="<?php echo $i; ?>">
                                                        <?php echo $i; ?> <?php echo $i == 1 ? 'pessoa' : 'pessoas'; ?>
                                                    </option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-semibold text-gray-900 mb-2">Tipo de Quarto</label>
                                            <select class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-[#EC7430] focus:ring-2 focus:ring-[#EC7430]/20 outline-none transition-all">
                                                <option>Individual (+ R$ 0)</option>
                                                <option>Duplo (+ R$ 200)</option>
                                                <option>Triplo (+ R$ 300)</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="w-full bg-gradient-to-r from-[#EC7430] to-orange-600 hover:from-[#D66328] hover:to-orange-700 text-white py-4 rounded-lg font-bold text-lg transition-all transform hover:scale-105 shadow-lg">
                                            <i class="fas fa-shopping-cart mr-2"></i>
                                            Solicitar Reserva
                                        </button>

                                        <p class="text-center text-xs text-gray-600">
                                            Confirmação sujeita à disponibilidade
                                        </p>
                                    </form>

                                    <!-- Price Details -->
                                    <?php if ($preco_total) : ?>
                                        <div class="mt-6 pt-6 border-t border-gray-200 space-y-3 text-sm">
                                            <div class="flex justify-between text-gray-700">
                                                <span>Pacote base x <span id="people-count">1</span></span>
                                                <span id="base-price">R$ <?php echo number_format($preco_total, 2, ',', '.'); ?></span>
                                            </div>
                                            <div class="flex justify-between text-gray-700">
                                                <span>Taxa de serviço (5%)</span>
                                                <span id="service-fee">R$ <?php echo number_format($preco_total * 0.05, 2, ',', '.'); ?></span>
                                            </div>
                                            <div class="flex justify-between pt-3 border-t border-gray-200 font-bold text-gray-900">
                                                <span>Total</span>
                                                <span id="total-price">R$ <?php echo number_format($preco_total * 1.05, 2, ',', '.'); ?></span>
                                            </div>
                                            <p class="text-xs text-gray-500 text-center pt-2">
                                                Pague em até 12x sem juros no cartão
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Trust Badges -->
                                <div class="bg-gray-50 p-6 border-t border-gray-200">
                                    <div class="space-y-3 text-sm">
                                        <div class="flex items-center gap-3 text-gray-700">
                                            <i class="fas fa-shield-alt text-green-500 text-lg"></i>
                                            <span>Pagamento 100% seguro</span>
                                        </div>
                                        <div class="flex items-center gap-3 text-gray-700">
                                            <i class="fas fa-check-circle text-blue-500 text-lg"></i>
                                            <span>Melhor preço garantido</span>
                                        </div>
                                        <div class="flex items-center gap-3 text-gray-700">
                                            <i class="fas fa-headset text-purple-500 text-lg"></i>
                                            <span>Suporte 24/7</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Card -->
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-2xl p-6 text-center">
                                <div class="w-16 h-16 bg-blue-500 text-white rounded-full flex items-center justify-center text-2xl mx-auto mb-4">
                                    <i class="fas fa-phone-volume"></i>
                                </div>
                                <h3 class="font-bold text-blue-900 mb-2">Precisa de Ajuda?</h3>
                                <p class="text-sm text-blue-700 mb-4">Nossos especialistas estão prontos para atendê-lo</p>
                                <a href="tel:08008870248" class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                                    <i class="fas fa-phone"></i>
                                    0800 887 0248
                                </a>
                                <p class="text-xs text-blue-600 mt-3">Segunda a Sexta: 8h às 20h</p>
                            </div>

                            <!-- Share Card -->
                            <div class="bg-white border border-gray-200 rounded-xl p-4">
                                <p class="text-sm text-gray-600 text-center mb-3">Compartilhe com seus amigos</p>
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="shareOn('facebook')" class="w-10 h-10 bg-[#1877F2] hover:opacity-80 text-white rounded-full flex items-center justify-center transition-opacity">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                    <button onclick="shareOn('whatsapp')" class="w-10 h-10 bg-[#25D366] hover:opacity-80 text-white rounded-full flex items-center justify-center transition-opacity">
                                        <i class="fab fa-whatsapp"></i>
                                    </button>
                                    <button onclick="shareOn('twitter')" class="w-10 h-10 bg-[#1DA1F2] hover:opacity-80 text-white rounded-full flex items-center justify-center transition-opacity">
                                        <i class="fab fa-twitter"></i>
                                    </button>
                                    <button onclick="shareOn('email')" class="w-10 h-10 bg-gray-700 hover:opacity-80 text-white rounded-full flex items-center justify-center transition-opacity">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </article>

    <?php endwhile; ?>

</main>

<!-- Gallery Modal -->
<div id="gallery-modal" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-4">
    <button onclick="closeGallery()" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 transition-colors" aria-label="Fechar galeria">
        <i class="fas fa-times"></i>
    </button>
    <div class="max-w-6xl w-full">
        <img id="modal-image" src="" alt="Foto do pacote" class="w-full h-auto max-h-[80vh] object-contain rounded-lg">
    </div>
</div>

<script>
    // Set minimum date to 7 days from now (for package bookings)
    const today = new Date();
    today.setDate(today.getDate() + 7);
    document.getElementById('departure-date').setAttribute('min', today.toISOString().split('T')[0]);

    // Package booking form
    document.getElementById('package-booking-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const date = document.getElementById('departure-date').value;
        const numPeople = document.getElementById('num-people').value;

        if (date && numPeople) {
            alert(`Solicitação de reserva enviada!\n\nData de partida: ${date}\nNúmero de pessoas: ${numPeople}\n\nEntraremos em contato em até 24h para confirmação.`);
        }
    });

    // Update price based on number of people
    document.getElementById('num-people').addEventListener('change', function() {
        const numPeople = parseInt(this.value);
        const pricePerPerson = <?php echo $preco_total ? $preco_total : 0; ?>;
        const basePrice = numPeople * pricePerPerson;
        const serviceFee = basePrice * 0.05;
        const total = basePrice + serviceFee;

        document.getElementById('people-count').textContent = numPeople;
        document.getElementById('base-price').textContent = 'R$ ' + basePrice.toLocaleString('pt-BR', {
            minimumFractionDigits: 2
        });
        document.getElementById('service-fee').textContent = 'R$ ' + serviceFee.toLocaleString('pt-BR', {
            minimumFractionDigits: 2
        });
        document.getElementById('total-price').textContent = 'R$ ' + total.toLocaleString('pt-BR', {
            minimumFractionDigits: 2
        });
    });

    // Gallery
    function openGallery(index) {
        document.getElementById('modal-image').src = '<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>';
        document.getElementById('gallery-modal').classList.remove('hidden');
        document.getElementById('gallery-modal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeGallery() {
        document.getElementById('gallery-modal').classList.add('hidden');
        document.getElementById('gallery-modal').classList.remove('flex');
        document.body.style.overflow = '';
    }

    // Share functions
    function sharePackage() {
        if (navigator.share) {
            navigator.share({
                title: '<?php echo esc_js(get_the_title()); ?>',
                text: 'Confira este pacote incrível!',
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(window.location.href);
            alert('Link copiado para a área de transferência!');
        }
    }

    function shareOn(platform) {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent('<?php echo esc_js(get_the_title()); ?>');

        const urls = {
            'facebook': `https://www.facebook.com/sharer/sharer.php?u=${url}`,
            'whatsapp': `https://wa.me/?text=${title}%20${url}`,
            'twitter': `https://twitter.com/intent/tweet?url=${url}&text=${title}`,
            'email': `mailto:?subject=${title}&body=Confira%20este%20pacote:%20${url}`
        };

        if (urls[platform]) {
            window.open(urls[platform], '_blank', 'width=600,height=400');
        }
    }

    // ESC to close gallery
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeGallery();
        }
    });
</script>

<?php
get_footer();
