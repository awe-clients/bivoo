</div><!-- #content -->

<!-- FOOTER BIVOO -->
<footer id="colophon" class="site-footer bg-gray-900 text-white">
    <div class="container mx-auto px-4 lg:px-8 py-12 lg:py-16">

        <!-- Footer Widgets -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-6 mb-12">

            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-2')) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-3')) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('footer-4')) : ?>
                <div class="footer-column">
                    <?php dynamic_sidebar('footer-4'); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Payment Methods -->
        <div class="border-t border-gray-800 pt-8 pb-8">
            <div class="text-center mb-6">
                <h5 class="text-sm font-semibold text-gray-400 mb-4">
                    <?php esc_html_e('Formas de pagamento', 'bivoo'); ?>
                </h5>
                <div class="flex items-center justify-center flex-wrap gap-4">
                    <div class="bg-white rounded-lg p-2 w-16 h-10 flex items-center justify-center">
                        <i class="fab fa-cc-visa text-3xl text-blue-600"></i>
                    </div>
                    <div class="bg-white rounded-lg p-2 w-16 h-10 flex items-center justify-center">
                        <i class="fab fa-cc-mastercard text-3xl text-orange-600"></i>
                    </div>
                    <div class="bg-white rounded-lg p-2 w-16 h-10 flex items-center justify-center">
                        <i class="fab fa-cc-amex text-3xl text-blue-800"></i>
                    </div>
                    <div class="bg-white rounded-lg p-2 w-16 h-10 flex items-center justify-center">
                        <span class="font-bold text-blue-600 text-xs">ELO</span>
                    </div>
                    <div class="bg-white rounded-lg p-2 w-16 h-10 flex items-center justify-center">
                        <span class="font-bold text-teal-600 text-xs">PIX</span>
                    </div>
                    <div class="bg-white rounded-lg p-2 w-16 h-10 flex items-center justify-center">
                        <i class="fas fa-barcode text-2xl text-gray-700"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="border-t border-gray-800 pt-8">
            <div class="flex flex-col lg:flex-row items-center justify-between space-y-6 lg:space-y-0 gap-6">

                <!-- Logo & Contact Info -->
                <div class="text-center lg:text-left">
                    <div class="mb-3">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <span class="text-xl font-bold text-white">
                                <?php bloginfo('name'); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <?php if (get_theme_mod('bivoo_address')) : ?>
                        <p class="text-sm text-gray-400">
                            <?php echo esc_html(get_theme_mod('bivoo_address')); ?>
                        </p>
                    <?php endif; ?>

                    <?php if (get_theme_mod('bivoo_phone')) : ?>
                        <p class="text-sm text-gray-400 mt-2">
                            <i class="fas fa-phone-alt mr-2 text-[#EC7430]"></i>
                            <a href="tel:<?php echo esc_attr(str_replace(' ', '', get_theme_mod('bivoo_phone'))); ?>"
                                class="hover:text-white transition">
                                <?php echo esc_html(get_theme_mod('bivoo_phone')); ?>
                            </a>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Legal Links -->
                <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-gray-400">
                    <?php
                    $legal_links = array(
                        home_url('/termos-de-uso') => __('Termos de Uso', 'bivoo'),
                        home_url('/privacidade') => __('Privacidade', 'bivoo'),
                        home_url('/cookies') => __('Cookies', 'bivoo'),
                        home_url('/lgpd') => __('LGPD', 'bivoo'),
                    );

                    $count = 0;
                    foreach ($legal_links as $url => $label) :
                        if ($count > 0) : ?>
                            <span class="text-gray-700">•</span>
                        <?php endif; ?>
                        <a href="<?php echo esc_url($url); ?>" class="hover:text-white transition">
                            <?php echo esc_html($label); ?>
                        </a>
                    <?php
                        $count++;
                    endforeach;
                    ?>
                </div>

                <!-- Social Media -->
                <div>
                    <p class="text-sm text-gray-400 mb-3 text-center lg:text-left">
                        <?php esc_html_e('Siga-nos', 'bivoo'); ?>
                    </p>
                    <div class="flex items-center justify-center lg:justify-start space-x-4">
                        <?php if (get_theme_mod('bivoo_facebook')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('bivoo_facebook')); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-10 h-10 bg-gray-800 hover:bg-[#EC7430] rounded-full flex items-center justify-center transition-all transform hover:scale-110"
                                aria-label="<?php esc_attr_e('Facebook da Bivoo', 'bivoo'); ?>">
                                <i class="fab fa-facebook-f text-lg"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (get_theme_mod('bivoo_instagram')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('bivoo_instagram')); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-10 h-10 bg-gray-800 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-500 rounded-full flex items-center justify-center transition-all transform hover:scale-110"
                                aria-label="<?php esc_attr_e('Instagram da Bivoo', 'bivoo'); ?>">
                                <i class="fab fa-instagram text-lg"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (get_theme_mod('bivoo_youtube')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('bivoo_youtube')); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-full flex items-center justify-center transition-all transform hover:scale-110"
                                aria-label="<?php esc_attr_e('YouTube da Bivoo', 'bivoo'); ?>">
                                <i class="fab fa-youtube text-lg"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (get_theme_mod('bivoo_linkedin')) : ?>
                            <a href="<?php echo esc_url(get_theme_mod('bivoo_linkedin')); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-10 h-10 bg-gray-800 hover:bg-blue-700 rounded-full flex items-center justify-center transition-all transform hover:scale-110"
                                aria-label="<?php esc_attr_e('LinkedIn da Bivoo', 'bivoo'); ?>">
                                <i class="fab fa-linkedin-in text-lg"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-8 pt-6 border-t border-gray-800 text-center">
                <p class="text-sm text-gray-400">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                    <?php esc_html_e('Todos os direitos reservados.', 'bivoo'); ?>
                    <?php if (get_theme_mod('bivoo_cnpj')) : ?>
                        <span class="text-gray-600 mx-2">|</span>
                        <?php echo esc_html(get_theme_mod('bivoo_cnpj', 'CNPJ: 00.000.000/0001-00')); ?>
                    <?php endif; ?>
                </p>
                <p class="text-xs text-gray-500 mt-2">
                    <?php esc_html_e('Desenvolvido com', 'bivoo'); ?>
                    <i class="fas fa-heart text-red-500 mx-1"></i>
                    <?php esc_html_e('para conectar pessoas a experiências incríveis', 'bivoo'); ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="back-to-top"
        class="fixed bottom-6 right-6 bg-[#EC7430] hover:bg-[#D66328] text-white w-12 h-12 rounded-full shadow-2xl flex items-center justify-center transition-all transform hover:scale-110 opacity-0 invisible"
        aria-label="<?php esc_attr_e('Voltar ao topo da página', 'bivoo'); ?>">
        <i class="fas fa-arrow-up text-xl"></i>
    </button>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>