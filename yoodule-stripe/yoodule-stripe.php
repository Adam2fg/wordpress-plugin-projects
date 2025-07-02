<?php
/*
Plugin Name: Yoodule Stripe
Description: Manage Stripe API credentials and display Stripe prices in a DataTable via shortcode.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) exit;

define('YOODULE_STRIPE_OPTION_KEY', 'yoodule_stripe_api_credentials');

define('YOODULE_STRIPE_PLUGIN_URL', plugin_dir_url(__FILE__));

define('YOODULE_STRIPE_PLUGIN_PATH', plugin_dir_path(__FILE__));

// 1. Add Admin Menu
add_action('admin_menu', function() {
    add_menu_page(
        'Yoodule Stripe',
        'Yoodule Stripe',
        'manage_options',
        'yoodule-stripe',
        'yoodule_stripe_settings_page',
        'dashicons-admin-generic',
        26
    );
});

// 2. Settings Page
function yoodule_stripe_settings_page() {
    if (!current_user_can('manage_options')) return;
    $saved = false;
    $creds = get_option(YOODULE_STRIPE_OPTION_KEY, ['secret_key' => '', 'publishable_key' => '']);
    if (isset($_POST['yoodule_stripe_save'])) {
        check_admin_referer('yoodule_stripe_save');
        $creds['secret_key'] = sanitize_text_field($_POST['yoodule_stripe_secret_key']);
        $creds['publishable_key'] = sanitize_text_field($_POST['yoodule_stripe_publishable_key']);
        update_option(YOODULE_STRIPE_OPTION_KEY, $creds);
        $saved = true;
    }
    ?>
    <div class="wrap">
        <h1>Yoodule Stripe Settings</h1>
        <?php if ($saved): ?><div class="updated"><p>Settings saved.</p></div><?php endif; ?>
        <form method="post">
            <?php wp_nonce_field('yoodule_stripe_save'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="yoodule_stripe_secret_key">Stripe Secret Key</label></th>
                    <td><input type="text" id="yoodule_stripe_secret_key" name="yoodule_stripe_secret_key" value="<?php echo esc_attr($creds['secret_key']); ?>" class="regular-text" required></td>
                </tr>
                <tr>
                    <th><label for="yoodule_stripe_publishable_key">Stripe Publishable Key</label></th>
                    <td><input type="text" id="yoodule_stripe_publishable_key" name="yoodule_stripe_publishable_key" value="<?php echo esc_attr($creds['publishable_key']); ?>" class="regular-text" required></td>
                </tr>
            </table>
            <p><input type="submit" name="yoodule_stripe_save" class="button button-primary" value="Save Settings"></p>
        </form>
    </div>
    <?php
}

// 3. Enqueue Scripts for DataTables
add_action('wp_enqueue_scripts', function() {
    if (!is_singular() && !is_page()) return;
    global $post;
    if (has_shortcode($post->post_content, 'yoodule_stripe')) {
        wp_enqueue_script('jquery');
        wp_enqueue_script('datatables-js', 'https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', ['jquery'], null, true);
        wp_enqueue_style('datatables-css', 'https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css');
        wp_enqueue_script('yoodule-stripe-js', YOODULE_STRIPE_PLUGIN_URL . 'assets/yoodule-stripe.js', ['jquery', 'datatables-js'], null, true);
        wp_localize_script('yoodule-stripe-js', 'yoodule_stripe_ajax', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('yoodule_stripe_fetch')
        ]);
    }
});

// 4. Shortcode
add_shortcode('yoodule_stripe', function() {
    ob_start();
    ?>
    <table id="yoodule-stripe-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Currency</th>
                <th>Unit Amount</th>
                <th>Recurring</th>
            </tr>
        </thead>
    </table>
    <?php
    return ob_get_clean();
});

// 5. AJAX Handler for DataTables
add_action('wp_ajax_yoodule_stripe_fetch_prices', 'yoodule_stripe_fetch_prices');
add_action('wp_ajax_nopriv_yoodule_stripe_fetch_prices', 'yoodule_stripe_fetch_prices');

function yoodule_stripe_fetch_prices() {
    check_ajax_referer('yoodule_stripe_fetch', 'nonce');
    $creds = get_option(YOODULE_STRIPE_OPTION_KEY, ['secret_key' => '', 'publishable_key' => '']);
    if (empty($creds['secret_key'])) {
        wp_send_json(['data' => [], 'recordsTotal' => 0, 'recordsFiltered' => 0]);
    }
    // Pagination params from DataTables
    $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
    $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
    $search = isset($_GET['search']['value']) ? sanitize_text_field($_GET['search']['value']) : '';

    require_once YOODULE_STRIPE_PLUGIN_PATH . 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey($creds['secret_key']);

    $params = [
        'limit' => $length,
        'starting_after' => null
    ];
    // For pagination, calculate starting_after
    if ($start > 0) {
        $all_prices = \Stripe\Price::all(['limit' => $start]);
        $last = end($all_prices->data);
        if ($last) {
            $params['starting_after'] = $last->id;
        }
    }
    $prices = \Stripe\Price::all($params);
    $data = [];
    foreach ($prices->data as $price) {
        $data[] = [
            $price->id,
            isset($price->product) ? $price->product : '',
            strtoupper($price->currency),
            $price->unit_amount / 100,
            isset($price->recurring) ? 'Yes' : 'No'
        ];
    }
    wp_send_json([
        'data' => $data,
        'recordsTotal' => count($data),
        'recordsFiltered' => count($data)
    ]);
} 