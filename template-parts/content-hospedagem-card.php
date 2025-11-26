<?php

/**
 * Template part for displaying hospedagem card
 *
 * @package Bivoo
 */

$preco_noite = get_post_meta(get_the_ID(), '_bivoo_preco_noite', true);
$quartos = get_post_meta(get_the_ID(), '_bivoo_quartos', true);
$banheiros = get_post_meta(get_the_ID(), '_bivoo_banheiros', true);
$hospedes = get_post_meta(get_the_ID(), '_bivoo_hospedes', true);
$avaliacao = get_post_meta(get_the_ID(), '_bivoo_avaliacao', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card group'); ?>>

    <?php if (has_post_thumbnail()) : ?>
        <div class="relative overflow-hidden">
            <a href="<?php the_permalink(); ?>" class="block">
                <?php the_post_thumbnail('bivoo-listing-thumb', array('class' => 'w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-500')); ?>
            </a>

            <!-- Favorite Button -->
            <button class="favorite-button absolute top-4 right-4 w-10 h-10 bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-all shadow-lg"
                data-post-id="<?php the_ID(); ?>"
                aria-label="<?php esc_attr_e('Adicionar aos favoritos', 'bivoo'); ?>">
                <i class="far fa-heart text-gray-700 hover:text-red-500 transition-colors"></i>
            </button>

            <!-- Overlay Gradiente -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#EC7430]/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>
    <?php endif; ?>

    <div class="card-body">
        <!-- Rating and Destination -->
        <div class="flex items-center justify-between mb-3">
            <?php if ($avaliacao) : ?>
                <div class="flex items-center text-sm">
                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                    <span class="font-semibold"><?php echo esc_html(number_format($avaliacao, 1)); ?></span>
                </div>
            <?php endif; ?>

            <?php
            $destinos = get_the_terms(get_the_ID(), 'destino');
            if ($destinos && !is_wp_error($destinos)) :
            ?>
                <span class="text-xs text-gray-500">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    <?php echo esc_html($destinos[0]->name); ?>
                </span>
            <?php endif; ?>
        </div>

        <!-- Title -->
        <h3 class="text-xl font-bold mb-3 line-clamp-2 group-hover:text-[#EC7430] transition-colors">
            <a href="<?php the_permalink(); ?>" class="text-gray-900">
                <?php the_title(); ?>
            </a>
        </h3>

        <!-- Property Details -->
        <?php if ($hospedes || $quartos || $banheiros) : ?>
            <div class="flex items-center space-x-4 text-sm text-gray-600 mb-4">
                <?php if ($hospedes) : ?>
                    <span class="flex items-center">
                        <i class="fas fa-user-friends mr-1"></i>
                        <?php printf(esc_html__('%d hóspedes', 'bivoo'), $hospedes); ?>
                    </span>
                <?php endif; ?>

                <?php if ($quartos) : ?>
                    <span class="flex items-center">
                        <i class="fas fa-bed mr-1"></i>
                        <?php printf(esc_html__('%d quartos', 'bivoo'), $quartos); ?>
                    </span>
                <?php endif; ?>

                <?php if ($banheiros) : ?>
                    <span class="flex items-center">
                        <i class="fas fa-bath mr-1"></i>
                        <?php printf(esc_html__('%d banheiros', 'bivoo'), $banheiros); ?>
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Price -->
        <?php if ($preco_noite) : ?>
            <div class="flex items-baseline justify-between border-t border-gray-200 pt-4">
                <div>
                    <span class="text-2xl font-bold text-gray-900">
                        R$ <?php echo number_format($preco_noite, 2, ',', '.'); ?>
                    </span>
                    <span class="text-sm text-gray-600 ml-1">/ noite</span>
                </div>
                <a href="<?php the_permalink(); ?>"
                    class="inline-flex items-center text-[#EC7430] hover:text-[#D66328] font-semibold transition-colors">
                    <?php esc_html_e('Ver detalhes', 'bivoo'); ?>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</article>