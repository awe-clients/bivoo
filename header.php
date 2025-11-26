<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <a class="skip-link screen-reader-text" href="#main-content">
        <?php esc_html_e('Skip to content', 'bivoo'); ?>
    </a>

    <div id="page" class="site">

        <!-- HEADER BIVOO -->
        <header id="masthead" class="site-header bg-white shadow-sm sticky top-0 z-50">
            <div class="container mx-auto px-4 lg:px-8">

                <!-- Top Bar -->
                <div class="flex items-center justify-between py-4 border-b border-gray-200">
                    <!-- Logo -->
                    <div class="site-branding">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center" rel="home">
                                <h1 class="site-title text-2xl font-bold text-gray-900">
                                    <?php bloginfo('name'); ?>
                                </h1>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Right Side Links Desktop -->
                    <div class="hidden lg:flex items-center space-x-6">
                        <!-- Vendas -->
                        <?php if (get_theme_mod('bivoo_phone')) : ?>
                            <a href="tel:<?php echo esc_attr(str_replace(' ', '', get_theme_mod('bivoo_phone', '08008870248'))); ?>"
                                class="flex items-center text-[#726983] hover:text-[#EC7430] transition-colors text-sm">
                                <i class="fas fa-phone-alt text-[#0099CC] mr-2"></i>
                                <span>Vendas: <strong class="font-semibold"><?php echo esc_html(get_theme_mod('bivoo_phone', '0800 887 0248')); ?></strong></span>
                            </a>
                        <?php endif; ?>

                        <!-- Iniciar sessão -->
                        <a href="<?php echo wp_login_url(); ?>"
                            class="flex items-center text-[#726983] hover:text-[#EC7430] transition-colors text-sm">
                            <i class="fas fa-sign-in-alt text-[#0099CC] mr-2"></i>
                            <span><?php esc_html_e('Iniciar sessão', 'bivoo'); ?></span>
                        </a>

                        <!-- Minhas viagens -->
                        <?php if (is_user_logged_in()) : ?>
                            <a href="<?php echo esc_url(home_url('/minhas-viagens')); ?>"
                                class="flex items-center text-[#726983] hover:text-[#EC7430] transition-colors text-sm">
                                <i class="fas fa-map-marker-alt text-[#0099CC] mr-2"></i>
                                <span><?php esc_html_e('Minhas viagens', 'bivoo'); ?></span>
                            </a>
                        <?php endif; ?>

                        <!-- Para onde ir? -->
                        <a href="<?php echo esc_url(home_url('/destinos')); ?>"
                            class="flex items-center text-[#726983] hover:text-[#EC7430] transition-colors text-sm">
                            <i class="far fa-question-circle text-[#0099CC] mr-2"></i>
                            <span><?php esc_html_e('Para onde ir?', 'bivoo'); ?></span>
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-toggle"
                        class="lg:hidden text-gray-700 hover:text-[#EC7430] transition-colors"
                        aria-label="<?php esc_attr_e('Abrir menu', 'bivoo'); ?>"
                        aria-expanded="false">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>

                <!-- Main Navigation -->
                <nav id="site-navigation" class="main-navigation hidden lg:block" role="navigation" aria-label="<?php esc_attr_e('Menu principal', 'bivoo'); ?>">
                    <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'primary',
                        'menu_id'         => 'primary-menu',
                        'menu_class'      => 'flex items-center justify-start space-x-8 py-4',
                        'container'       => false,
                        'fallback_cb'     => 'bivoo_default_menu',
                        'walker'          => new Bivoo_Walker_Nav_Menu(),
                    ));
                    ?>
                </nav>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
                <nav class="container mx-auto px-4 py-4" role="navigation" aria-label="<?php esc_attr_e('Menu mobile', 'bivoo'); ?>">
                    <ul class="space-y-2">
                        <!-- Top Links Mobile -->
                        <li class="pb-2 mb-2 border-b border-gray-200">
                            <?php if (get_theme_mod('bivoo_phone')) : ?>
                                <a href="tel:<?php echo esc_attr(str_replace(' ', '', get_theme_mod('bivoo_phone'))); ?>"
                                    class="block px-4 py-2 text-[#726983] hover:text-[#EC7430] hover:bg-gray-50 rounded-lg transition-all">
                                    <i class="fas fa-phone-alt text-[#0099CC] mr-2"></i>
                                    Vendas: <strong><?php echo esc_html(get_theme_mod('bivoo_phone')); ?></strong>
                                </a>
                            <?php endif; ?>
                        </li>
                        <li class="pb-2 mb-2 border-b border-gray-200">
                            <a href="<?php echo wp_login_url(); ?>"
                                class="block px-4 py-2 text-[#726983] hover:text-[#EC7430] hover:bg-gray-50 rounded-lg transition-all">
                                <i class="fas fa-sign-in-alt text-[#0099CC] mr-2"></i>
                                <?php esc_html_e('Iniciar sessão', 'bivoo'); ?>
                            </a>
                        </li>
                        <?php if (is_user_logged_in()) : ?>
                            <li class="pb-2 mb-2 border-b border-gray-200">
                                <a href="<?php echo esc_url(home_url('/minhas-viagens')); ?>"
                                    class="block px-4 py-2 text-[#726983] hover:text-[#EC7430] hover:bg-gray-50 rounded-lg transition-all">
                                    <i class="fas fa-map-marker-alt text-[#0099CC] mr-2"></i>
                                    <?php esc_html_e('Minhas viagens', 'bivoo'); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="pb-2 mb-4 border-b border-gray-200">
                            <a href="<?php echo esc_url(home_url('/destinos')); ?>"
                                class="block px-4 py-2 text-[#726983] hover:text-[#EC7430] hover:bg-gray-50 rounded-lg transition-all">
                                <i class="far fa-question-circle text-[#0099CC] mr-2"></i>
                                <?php esc_html_e('Para onde ir?', 'bivoo'); ?>
                            </a>
                        </li>
                    </ul>

                    <!-- Main Navigation Mobile -->
                    <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'mobile',
                        'menu_id'         => 'mobile-menu-items',
                        'menu_class'      => 'space-y-2',
                        'container'       => false,
                        'fallback_cb'     => 'bivoo_default_menu_mobile',
                    ));
                    ?>
                </nav>
            </div>
        </header><!-- #masthead -->

        <div id="content" class="site-content">