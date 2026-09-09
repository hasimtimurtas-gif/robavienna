<?php
/**
 * Flatsome Child Theme Functions - ROBA Vienna
 * 
 * @package Flatsome_Child_ROBA_Vienna
 */

if (!defined('ABSPATH')) {
    exit; // Doğrudan erişimi engelle
}

/* ==========================================================================
   1. STİL VE KOMUT DOSYALARININ YÜKLENMESİ (ENQUEUE STYLES & SCRIPTS)
   ========================================================================== */
add_action('wp_enqueue_scripts', 'roba_vienna_enqueue_styles', 100);
function roba_vienna_enqueue_styles() {
    // Ana Flatsome stil dosyası
    wp_enqueue_style('flatsome-main', get_template_directory_uri() . '/style.css');

    // Child theme ana stili
    wp_enqueue_style(
        'roba-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('flatsome-main'),
        '1.0.0'
    );

    // ROBA Özel Mağaza ve Tipografi Stilleri
    if (file_exists(get_stylesheet_directory() . '/assets/css/typography.css')) {
        wp_enqueue_style('roba-typography', get_stylesheet_directory_uri() . '/assets/css/typography.css', array('roba-child-style'), '1.0.0');
    }
    if (file_exists(get_stylesheet_directory() . '/assets/css/custom-shop.css')) {
        wp_enqueue_style('roba-custom-shop', get_stylesheet_directory_uri() . '/assets/css/custom-shop.css', array('roba-child-style'), '1.0.0');
    }
}

/* ==========================================================================
   2. GÜVENLİK VE PERFORMANS SERTLEŞTİRMESİ
   ========================================================================== */

// WordPress Sürüm Numarasını Gizle (Güvenlik)
remove_action('wp_head', 'wp_generator');

// XML-RPC Pingback kapatma
add_filter('xmlrpc_enabled', '__return_false');

// Kullanıcı numaralandırma (REST API User Enumeration) engeli
add_filter('rest_endpoints', function($endpoints) {
    if (!is_user_logged_in() && isset($endpoints['/wp/v2/users'])) {
        unset($endpoints['/wp/v2/users']);
    }
    return $endpoints;
});

/* ==========================================================================
   3. ROBA VIENNA DENİZLİ HAVLU ÖZEL ROZET VE VURGULARI
   ========================================================================== */

// Ürün detayında "Denizli Pamuğu & Lüks Kalite" Güven Rozeti
add_action('woocommerce_single_product_summary', 'roba_display_denizli_quality_badge', 15);
function roba_display_denizli_quality_badge() {
    echo '<div class="roba-badge-container" style="margin: 8px 0 16px 0;">';
    echo '<span class="badge-denizli-cotton">🌿 100% Ägäische Denizli-Baumwolle</span>';
    echo '<span class="badge-denizli-cotton" style="margin-left: 6px;">✨ Premium 600 GSM</span>';
    echo '<span class="badge-denizli-cotton" style="margin-left: 6px;">🌱 OEKO-TEX® Zertifiziert</span>';
    echo '</div>';
}

// Ürün detayında Avusturya & Almanya Tahmini Teslimat Süresi
add_action('woocommerce_single_product_summary', 'roba_display_shipping_estimate', 25);
function roba_display_shipping_estimate() {
    ?>
    <div class="roba-shipping-box" style="background: #F4EFEB; padding: 12px 16px; border-radius: 4px; margin: 15px 0; font-size: 0.85rem; border-left: 3px solid #8C7A6B;">
        <p style="margin: 0 0 4px 0;"><strong>🇦🇹 Österreich:</strong> 1-2 Werktage (Österreichische Post)</p>
        <p style="margin: 0;"><strong>🇩🇪 Deutschland:</strong> 2-4 Werktage (DHL Paket)</p>
        <p style="margin: 6px 0 0 0; font-size: 0.78rem; color: #6E6862;">Kostenloser Versand ab 50 € Bestellwert.</p>
    </div>
    <?php
}

// Sepet ve Ödeme sayfasında Güvenlik ve Ödeme Yöntemi İkonları (EPS, Klarna, Stripe, PayPal)
add_action('woocommerce_review_order_after_submit', 'roba_display_trust_badges', 10);
function roba_display_trust_badges() {
    ?>
    <div class="roba-checkout-trust" style="margin-top: 15px; text-align: center; font-size: 0.8rem; color: #6E6862;">
        <p style="margin-bottom: 6px;">🔒 <strong>Sichere 256-Bit SSL Verschlüsselung</strong></p>
        <p style="margin: 0;">Zahlungsmethoden: EPS-Überweisung, Klarna, Kreditkarte, PayPal, Apple Pay</p>
    </div>
    <?php
}

/* ==========================================================================
   4. DACH & GERMANIZED DESTEKLEYİCİ FİLTRELER
   ========================================================================== */

// Otomatik KDV Bilgilendirme Eki (Germanized olmadan da yedek güvenlik sağlar)
add_filter('woocommerce_get_price_html', 'roba_add_vat_shipping_notice', 100, 2);
function roba_add_vat_shipping_notice($price, $product) {
    if (is_admin() || is_cart() || is_checkout()) {
        return $price;
    }
    $vat_text = '<span class="legal-price-info">inkl. MwSt., zzgl. <a href="/versand-und-rueckgabe" target="_blank" style="text-decoration: underline;">Versandkosten</a></span>';
    return $price . $vat_text;
}

// Sayfa altı telif ve Impressum bilgisi
add_action('flatsome_absolute_footer_bottom', function() {
    echo '<div style="text-align: center; font-size: 0.8rem; opacity: 0.85; margin-top: 10px;">';
    echo 'ROBA Vienna – Premium Home Textiles | Inh. Hicret Turhan Timurtas | Wien, Österreich';
    echo '</div>';
});
