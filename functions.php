<?php

/**
 * Bivoo Theme Functions
 * 
 * @package Bivoo
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define Constants
 */
define('BIVOO_VERSION', '1.0.0');
define('BIVOO_THEME_DIR', get_template_directory());
define('BIVOO_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function bivoo_theme_setup()
{
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Set default thumbnail size
    set_post_thumbnail_size(1200, 675, true);

    // Add additional image sizes
    add_image_size('bivoo-listing-thumb', 600, 400, true);
    add_image_size('bivoo-hero', 1920, 800, true);
    add_image_size('bivoo-gallery', 800, 600, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'bivoo'),
        'footer'  => esc_html__('Footer Menu', 'bivoo'),
        'mobile'  => esc_html__('Mobile Menu', 'bivoo'),
    ));

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'f9fafb',
    ));

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for wide and full alignments
    add_theme_support('align-wide');

    // Add theme support for block styles
    add_theme_support('wp-block-styles');

    // Load text domain for translations
    load_theme_textdomain('bivoo', BIVOO_THEME_DIR . '/languages');
}
add_action('after_setup_theme', 'bivoo_theme_setup');

/**
 * Set Content Width
 */
function bivoo_content_width()
{
    $GLOBALS['content_width'] = apply_filters('bivoo_content_width', 1200);
}
add_action('after_setup_theme', 'bivoo_content_width', 0);

/**
 * Register Widget Areas
 */
function bivoo_widgets_init()
{
    // Sidebar
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'bivoo'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'bivoo'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer Columns (4 columns)
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(esc_html__('Footer Column %d', 'bivoo'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(esc_html__('Widgets for footer column %d', 'bivoo'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'bivoo_widgets_init');

/**
 * Enqueue Scripts and Styles
 */
function bivoo_scripts()
{
    // Google Fonts - Rubik
    wp_enqueue_style('bivoo-google-fonts', 'https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap', array(), null);

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    // Tailwind CSS (Production - usar build customizado)
    wp_enqueue_style('tailwindcss', 'https://cdn.tailwindcss.com', array(), BIVOO_VERSION);

    // Theme stylesheet
    wp_enqueue_style('bivoo-style', get_stylesheet_uri(), array(), BIVOO_VERSION);

    // Theme main JS
    wp_enqueue_script('bivoo-main', BIVOO_THEME_URI . '/assets/js/main.js', array('jquery'), BIVOO_VERSION, true);

    // Localize script for AJAX
    wp_localize_script('bivoo-main', 'bivooAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('bivoo-nonce'),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'bivoo_scripts');

/**
 * Custom Post Types
 */
function bivoo_register_post_types()
{
    // Hospedagens (Listings)
    register_post_type('hospedagem', array(
        'labels' => array(
            'name'               => __('Hospedagens', 'bivoo'),
            'singular_name'      => __('Hospedagem', 'bivoo'),
            'add_new'            => __('Adicionar Nova', 'bivoo'),
            'add_new_item'       => __('Adicionar Nova Hospedagem', 'bivoo'),
            'edit_item'          => __('Editar Hospedagem', 'bivoo'),
            'new_item'           => __('Nova Hospedagem', 'bivoo'),
            'view_item'          => __('Ver Hospedagem', 'bivoo'),
            'search_items'       => __('Buscar Hospedagens', 'bivoo'),
            'not_found'          => __('Nenhuma hospedagem encontrada', 'bivoo'),
            'not_found_in_trash' => __('Nenhuma hospedagem na lixeira', 'bivoo'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-admin-home',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite'             => array('slug' => 'hospedagem'),
        'capability_type'     => 'post',
    ));

    // Experiências
    register_post_type('experiencia', array(
        'labels' => array(
            'name'               => __('Experiências', 'bivoo'),
            'singular_name'      => __('Experiência', 'bivoo'),
            'add_new'            => __('Adicionar Nova', 'bivoo'),
            'add_new_item'       => __('Adicionar Nova Experiência', 'bivoo'),
            'edit_item'          => __('Editar Experiência', 'bivoo'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-palmtree',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'             => array('slug' => 'experiencia'),
    ));

    // Pacotes
    register_post_type('pacote', array(
        'labels' => array(
            'name'               => __('Pacotes', 'bivoo'),
            'singular_name'      => __('Pacote', 'bivoo'),
            'add_new'            => __('Adicionar Novo', 'bivoo'),
            'add_new_item'       => __('Adicionar Novo Pacote', 'bivoo'),
            'edit_item'          => __('Editar Pacote', 'bivoo'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-tickets-alt',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite'             => array('slug' => 'pacote'),
    ));
}
add_action('init', 'bivoo_register_post_types');

/**
 * Register Taxonomies
 */
function bivoo_register_taxonomies()
{
    // Destinos (para Hospedagens)
    register_taxonomy('destino', 'hospedagem', array(
        'labels' => array(
            'name'              => __('Destinos', 'bivoo'),
            'singular_name'     => __('Destino', 'bivoo'),
            'search_items'      => __('Buscar Destinos', 'bivoo'),
            'all_items'         => __('Todos os Destinos', 'bivoo'),
            'edit_item'         => __('Editar Destino', 'bivoo'),
            'update_item'       => __('Atualizar Destino', 'bivoo'),
            'add_new_item'      => __('Adicionar Novo Destino', 'bivoo'),
            'new_item_name'     => __('Novo Destino', 'bivoo'),
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'destino'),
    ));

    // Comodidades (para Hospedagens)
    register_taxonomy('comodidade', 'hospedagem', array(
        'labels' => array(
            'name'              => __('Comodidades', 'bivoo'),
            'singular_name'     => __('Comodidade', 'bivoo'),
        ),
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => array('slug' => 'comodidade'),
    ));
}
add_action('init', 'bivoo_register_taxonomies');

/**
 * Custom Meta Boxes for Hospedagens
 */
function bivoo_add_meta_boxes()
{
    add_meta_box(
        'hospedagem_details',
        __('Detalhes da Hospedagem', 'bivoo'),
        'bivoo_hospedagem_details_callback',
        'hospedagem',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bivoo_add_meta_boxes');

function bivoo_hospedagem_details_callback($post)
{
    wp_nonce_field('bivoo_save_hospedagem_details', 'bivoo_hospedagem_nonce');

    $preco_noite = get_post_meta($post->ID, '_bivoo_preco_noite', true);
    $quartos = get_post_meta($post->ID, '_bivoo_quartos', true);
    $banheiros = get_post_meta($post->ID, '_bivoo_banheiros', true);
    $hospedes = get_post_meta($post->ID, '_bivoo_hospedes', true);
    $avaliacao = get_post_meta($post->ID, '_bivoo_avaliacao', true);
?>
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        <div>
            <label for="bivoo_preco_noite"><strong><?php _e('Preço por Noite (R$)', 'bivoo'); ?></strong></label>
            <input type="number" id="bivoo_preco_noite" name="bivoo_preco_noite" value="<?php echo esc_attr($preco_noite); ?>" style="width: 100%; margin-top: 5px;" step="0.01">
        </div>

        <div>
            <label for="bivoo_quartos"><strong><?php _e('Número de Quartos', 'bivoo'); ?></strong></label>
            <input type="number" id="bivoo_quartos" name="bivoo_quartos" value="<?php echo esc_attr($quartos); ?>" style="width: 100%; margin-top: 5px;">
        </div>

        <div>
            <label for="bivoo_banheiros"><strong><?php _e('Número de Banheiros', 'bivoo'); ?></strong></label>
            <input type="number" id="bivoo_banheiros" name="bivoo_banheiros" value="<?php echo esc_attr($banheiros); ?>" style="width: 100%; margin-top: 5px;">
        </div>

        <div>
            <label for="bivoo_hospedes"><strong><?php _e('Máximo de Hóspedes', 'bivoo'); ?></strong></label>
            <input type="number" id="bivoo_hospedes" name="bivoo_hospedes" value="<?php echo esc_attr($hospedes); ?>" style="width: 100%; margin-top: 5px;">
        </div>

        <div>
            <label for="bivoo_avaliacao"><strong><?php _e('Avaliação (0-5)', 'bivoo'); ?></strong></label>
            <input type="number" id="bivoo_avaliacao" name="bivoo_avaliacao" value="<?php echo esc_attr($avaliacao); ?>" style="width: 100%; margin-top: 5px;" step="0.1" min="0" max="5">
        </div>
    </div>
<?php
}

function bivoo_save_hospedagem_details($post_id)
{
    if (!isset($_POST['bivoo_hospedagem_nonce']) || !wp_verify_nonce($_POST['bivoo_hospedagem_nonce'], 'bivoo_save_hospedagem_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('bivoo_preco_noite', 'bivoo_quartos', 'bivoo_banheiros', 'bivoo_hospedes', 'bivoo_avaliacao');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_hospedagem', 'bivoo_save_hospedagem_details');

/**
 * Custom Excerpt Length
 */
function bivoo_excerpt_length($length)
{
    return 30;
}
add_filter('excerpt_length', 'bivoo_excerpt_length');

/**
 * Custom Excerpt More
 */
function bivoo_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'bivoo_excerpt_more');

/**
 * Add Custom Body Classes
 */
function bivoo_body_classes($classes)
{
    if (!is_singular()) {
        $classes[] = 'archive-page';
    }

    if (is_front_page()) {
        $classes[] = 'home-page';
    }

    return $classes;
}
add_filter('body_class', 'bivoo_body_classes');

/**
 * Custom Walker for Navigation Menu
 */
class Bivoo_Walker_Nav_Menu extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
}

/**
 * Pagination
 */
function bivoo_pagination()
{
    global $wp_query;

    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max   = intval($wp_query->max_num_pages);

    if ($paged >= 1) {
        $links[] = $paged;
    }

    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="pagination" role="navigation"><ul class="pagination-list">';

    if (get_previous_posts_link()) {
        printf('<li>%s</li>', get_previous_posts_link('<i class="fas fa-chevron-left"></i>'));
    }

    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>', $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links)) {
            echo '<li>…</li>';
        }
    }

    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>', $class, esc_url(get_pagenum_link($link)), $link);
    }

    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links)) {
            echo '<li>…</li>';
        }

        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>', $class, esc_url(get_pagenum_link($max)), $max);
    }

    if (get_next_posts_link()) {
        printf('<li>%s</li>', get_next_posts_link('<i class="fas fa-chevron-right"></i>'));
    }

    echo '</ul></nav>';
}

/**
 * Theme Customizer
 */
function bivoo_customize_register($wp_customize)
{
    // Contact Info Section
    $wp_customize->add_section('bivoo_contact_info', array(
        'title'    => __('Informações de Contato', 'bivoo'),
        'priority' => 30,
    ));

    // Phone Number
    $wp_customize->add_setting('bivoo_phone', array(
        'default'           => '0800 887 0248',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('bivoo_phone', array(
        'label'    => __('Telefone', 'bivoo'),
        'section'  => 'bivoo_contact_info',
        'type'     => 'text',
    ));

    // Email
    $wp_customize->add_setting('bivoo_email', array(
        'default'           => 'contato@bivoo.com.br',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('bivoo_email', array(
        'label'    => __('E-mail', 'bivoo'),
        'section'  => 'bivoo_contact_info',
        'type'     => 'email',
    ));

    // Address
    $wp_customize->add_setting('bivoo_address', array(
        'default'           => 'Rua Bem e São Agostinho, Pipa/RN - CEP 59.178-000',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('bivoo_address', array(
        'label'    => __('Endereço', 'bivoo'),
        'section'  => 'bivoo_contact_info',
        'type'     => 'textarea',
    ));

    // Social Media Section
    $wp_customize->add_section('bivoo_social_media', array(
        'title'    => __('Redes Sociais', 'bivoo'),
        'priority' => 31,
    ));

    $social_networks = array('facebook', 'instagram', 'youtube', 'linkedin');

    foreach ($social_networks as $network) {
        $wp_customize->add_setting('bivoo_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('bivoo_' . $network, array(
            'label'    => ucfirst($network),
            'section'  => 'bivoo_social_media',
            'type'     => 'url',
        ));
    }
}
add_action('customize_register', 'bivoo_customize_register');

/**
 * AJAX Search Function
 */
function bivoo_ajax_search()
{
    check_ajax_referer('bivoo-nonce', 'nonce');

    $search_term = sanitize_text_field($_POST['search']);

    $args = array(
        'post_type'      => array('hospedagem', 'experiencia', 'pacote'),
        'posts_per_page' => 5,
        's'              => $search_term,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="search-result-item">';
            echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
            echo '</div>';
        }
    } else {
        echo '<p>' . __('Nenhum resultado encontrado', 'bivoo') . '</p>';
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_bivoo_search', 'bivoo_ajax_search');
add_action('wp_ajax_nopriv_bivoo_search', 'bivoo_ajax_search');

/**
 * Required Plugins (TGM Plugin Activation)
 */
require_once BIVOO_THEME_DIR . '/inc/class-tgm-plugin-activation.php';

function bivoo_register_required_plugins()
{
    $plugins = array(
        array(
            'name'     => 'Contact Form 7',
            'slug'     => 'contact-form-7',
            'required' => true,
        ),
        array(
            'name'     => 'Advanced Custom Fields',
            'slug'     => 'advanced-custom-fields',
            'required' => true,
        ),
        array(
            'name'     => 'Yoast SEO',
            'slug'     => 'wordpress-seo',
            'required' => false,
        ),
    );

    tgmpa($plugins);
}
add_action('tgmpa_register', 'bivoo_register_required_plugins');


function bivoo_pacote_meta_boxes()
{
    add_meta_box(
        'pacote_details',
        __('Detalhes do Pacote', 'bivoo'),
        'bivoo_pacote_details_callback',
        'pacote',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bivoo_pacote_meta_boxes');

function bivoo_pacote_details_callback($post)
{
    wp_nonce_field('bivoo_save_pacote', 'bivoo_pacote_nonce');

    // Get values
    $preco = get_post_meta($post->ID, '_bivoo_pacote_preco', true);
    $duracao_dias = get_post_meta($post->ID, '_bivoo_pacote_duracao_dias', true);
    $duracao_noites = get_post_meta($post->ID, '_bivoo_pacote_duracao_noites', true);
    $hospedagem = get_post_meta($post->ID, '_bivoo_pacote_hospedagem', true);
    $refeicoes = get_post_meta($post->ID, '_bivoo_pacote_refeicoes', true);
    $transporte = get_post_meta($post->ID, '_bivoo_pacote_transporte', true);
    $passeios = get_post_meta($post->ID, '_bivoo_pacote_passeios', true);
    $min_pessoas = get_post_meta($post->ID, '_bivoo_pacote_min_pessoas', true);
    $max_pessoas = get_post_meta($post->ID, '_bivoo_pacote_max_pessoas', true);
    $saida_de = get_post_meta($post->ID, '_bivoo_pacote_saida_de', true);
    $destinos = get_post_meta($post->ID, '_bivoo_pacote_destinos', true);
?>
    <table class="form-table">
        <tr>
            <th><label>Preço por Pessoa (R$)</label></th>
            <td><input type="number" name="bivoo_preco" value="<?php echo esc_attr($preco); ?>" step="0.01" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Duração</label></th>
            <td>
                <input type="number" name="bivoo_duracao_dias" value="<?php echo esc_attr($duracao_dias); ?>" placeholder="Dias" style="width: 80px;">
                dias /
                <input type="number" name="bivoo_duracao_noites" value="<?php echo esc_attr($duracao_noites); ?>" placeholder="Noites" style="width: 80px;">
                noites
            </td>
        </tr>
        <tr>
            <th><label>Hospedagem</label></th>
            <td><input type="text" name="bivoo_hospedagem" value="<?php echo esc_attr($hospedagem); ?>" class="regular-text" placeholder="Ex: Hotel 4★"></td>
        </tr>
        <tr>
            <th><label>Refeições</label></th>
            <td>
                <select name="bivoo_refeicoes" class="regular-text">
                    <option value="Café da manhã" <?php selected($refeicoes, 'Café da manhã'); ?>>Café da manhã</option>
                    <option value="Meia pensão" <?php selected($refeicoes, 'Meia pensão'); ?>>Meia pensão</option>
                    <option value="Pensão completa" <?php selected($refeicoes, 'Pensão completa'); ?>>Pensão completa</option>
                    <option value="All inclusive" <?php selected($refeicoes, 'All inclusive'); ?>>All inclusive</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label>Transporte</label></th>
            <td><input type="text" name="bivoo_transporte" value="<?php echo esc_attr($transporte); ?>" class="regular-text" placeholder="Ex: Aéreo ida e volta"></td>
        </tr>
        <tr>
            <th><label>Passeios</label></th>
            <td><input type="text" name="bivoo_passeios" value="<?php echo esc_attr($passeios); ?>" class="regular-text" placeholder="Ex: 3 passeios inclusos"></td>
        </tr>
        <tr>
            <th><label>Grupo (min - max)</label></th>
            <td>
                <input type="number" name="bivoo_min_pessoas" value="<?php echo esc_attr($min_pessoas); ?>" placeholder="Min" style="width: 80px;">
                a
                <input type="number" name="bivoo_max_pessoas" value="<?php echo esc_attr($max_pessoas); ?>" placeholder="Max" style="width: 80px;">
                pessoas
            </td>
        </tr>
        <tr>
            <th><label>Saída de</label></th>
            <td><input type="text" name="bivoo_saida_de" value="<?php echo esc_attr($saida_de); ?>" class="regular-text" placeholder="Ex: Natal, São Paulo"></td>
        </tr>
        <tr>
            <th><label>Destinos</label></th>
            <td><input type="text" name="bivoo_destinos" value="<?php echo esc_attr($destinos); ?>" class="regular-text" placeholder="Ex: Pipa, Natal, Maracajaú"></td>
        </tr>
    </table>
<?php
}


function bivoo_experiencia_meta_boxes()
{
    add_meta_box(
        'experiencia_details',
        __('Detalhes da Experiência', 'bivoo'),
        'bivoo_experiencia_details_callback',
        'experiencia',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bivoo_experiencia_meta_boxes');

function bivoo_experiencia_details_callback($post)
{
    wp_nonce_field('bivoo_save_experiencia', 'bivoo_experiencia_nonce');

    $duracao = get_post_meta($post->ID, '_bivoo_experiencia_duracao', true);
    $preco = get_post_meta($post->ID, '_bivoo_experiencia_preco', true);
    $grupo_max = get_post_meta($post->ID, '_bivoo_experiencia_grupo_max', true);
    $nivel = get_post_meta($post->ID, '_bivoo_experiencia_nivel', true);
    $idiomas = get_post_meta($post->ID, '_bivoo_experiencia_idiomas', true);
    $inclusos = get_post_meta($post->ID, '_bivoo_experiencia_inclusos', true);
    $nao_inclusos = get_post_meta($post->ID, '_bivoo_experiencia_nao_inclusos', true);
?>
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
        <div>
            <label><strong>Duração</strong></label>
            <input type="text" name="bivoo_duracao" value="<?php echo esc_attr($duracao); ?>" placeholder="Ex: 4 horas" style="width: 100%;">
        </div>

        <div>
            <label><strong>Preço por Pessoa (R$)</strong></label>
            <input type="number" name="bivoo_preco" value="<?php echo esc_attr($preco); ?>" step="0.01" style="width: 100%;">
        </div>

        <div>
            <label><strong>Grupo Máximo</strong></label>
            <input type="number" name="bivoo_grupo_max" value="<?php echo esc_attr($grupo_max); ?>" style="width: 100%;">
        </div>

        <div>
            <label><strong>Nível</strong></label>
            <select name="bivoo_nivel" style="width: 100%;">
                <option value="Fácil" <?php selected($nivel, 'Fácil'); ?>>Fácil</option>
                <option value="Moderado" <?php selected($nivel, 'Moderado'); ?>>Moderado</option>
                <option value="Difícil" <?php selected($nivel, 'Difícil'); ?>>Difícil</option>
            </select>
        </div>

        <div>
            <label><strong>Idiomas</strong></label>
            <input type="text" name="bivoo_idiomas" value="<?php echo esc_attr($idiomas); ?>" placeholder="Português, Inglês" style="width: 100%;">
        </div>
    </div>

    <div style="margin-top: 20px;">
        <label><strong>O que está incluído (um por linha)</strong></label>
        <textarea name="bivoo_inclusos" rows="5" style="width: 100%;"><?php echo esc_textarea($inclusos); ?></textarea>
    </div>

    <div style="margin-top: 20px;">
        <label><strong>O que NÃO está incluído (um por linha)</strong></label>
        <textarea name="bivoo_nao_inclusos" rows="5" style="width: 100%;"><?php echo esc_textarea($nao_inclusos); ?></textarea>
    </div>
<?php
}

function bivoo_save_experiencia_details($post_id)
{
    if (!isset($_POST['bivoo_experiencia_nonce']) || !wp_verify_nonce($_POST['bivoo_experiencia_nonce'], 'bivoo_save_experiencia')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'bivoo_duracao' => '_bivoo_experiencia_duracao',
        'bivoo_preco' => '_bivoo_experiencia_preco',
        'bivoo_grupo_max' => '_bivoo_experiencia_grupo_max',
        'bivoo_nivel' => '_bivoo_experiencia_nivel',
        'bivoo_idiomas' => '_bivoo_experiencia_idiomas',
        'bivoo_inclusos' => '_bivoo_experiencia_inclusos',
        'bivoo_nao_inclusos' => '_bivoo_experiencia_nao_inclusos',
    );

    foreach ($fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_experiencia', 'bivoo_save_experiencia_details');


function bivoo_filter_hospedagem_query($query)
{
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('hospedagem')) {

        // Price filter
        if (isset($_GET['price'])) {
            $price_range = explode('-', $_GET['price']);
            $meta_query = array(
                'key' => '_bivoo_preco_noite',
                'value' => $price_range,
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            );
            $query->set('meta_query', array($meta_query));
        }

        // Guests filter
        if (isset($_GET['guests'])) {
            $meta_query = array(
                'key' => '_bivoo_hospedes',
                'value' => intval($_GET['guests']),
                'compare' => '>=',
                'type' => 'NUMERIC'
            );
            $query->set('meta_query', array($meta_query));
        }

        // Sort by
        if (isset($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'price-asc':
                    $query->set('meta_key', '_bivoo_preco_noite');
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'ASC');
                    break;

                case 'price-desc':
                    $query->set('meta_key', '_bivoo_preco_noite');
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'DESC');
                    break;

                case 'rating-desc':
                    $query->set('meta_key', '_bivoo_avaliacao');
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'DESC');
                    break;

                case 'popular':
                    $query->set('meta_key', '_bivoo_views'); // Criar sistema de views
                    $query->set('orderby', 'meta_value_num');
                    $query->set('order', 'DESC');
                    break;
            }
        }
    }
}
add_action('pre_get_posts', 'bivoo_filter_hospedagem_query');


function bivoo_article_schema()
{
    if (is_single()) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author()
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name')
            ),
            'image' => get_the_post_thumbnail_url()
        );

        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'bivoo_article_schema');


function bivoo_reading_time()
{
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 palavras por minuto

    return sprintf(
        _n('%s min de leitura', '%s min de leitura', $reading_time, 'bivoo'),
        number_format_i18n($reading_time)
    );
}
