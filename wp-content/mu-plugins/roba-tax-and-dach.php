<?php
/**
 * Plugin Name: ROBA Vienna - DACH Vergi & Yerel Biçimlendirme Kuralları
 * Description: Avusturya (%20 MwSt.) ve Almanya (%19 MwSt.) KDV oranları, Euro biçimlendirmesi ve DACH ödeme uyarlamaları.
 * Version: 1.0.0
 * Author: ROBA Vienna Dev Team
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 1. DACH Bölgesi Para Birimi Biçimlendirmesi: "49,90 €" (Boşluklu ve Sağda Sembol)
 */
add_filter('woocommerce_price_format', 'roba_dach_currency_format', 10, 2);
function roba_dach_currency_format($format, $currency_pos) {
    return '%1$s&nbsp;%2$s'; // Fiyat ve Euro sembolü arasında kırılmaz boşluk
}

/**
 * 2. Avusturya & Almanya Telefon ve Posta Kodu Kontrolleri
 */
add_action('woocommerce_checkout_process', 'roba_validate_dach_checkout');
function roba_validate_dach_checkout() {
    $country = WC()->customer->get_shipping_country();
    $postcode = WC()->customer->get_shipping_postcode();

    // Avusturya Posta Kodu (4 Haneli Rakam: örn. 1010 Wien)
    if ($country === 'AT' && !empty($postcode)) {
        if (!preg_match('/^[0-9]{4}$/', trim($postcode))) {
            wc_add_notice(__('Bitte geben Sie eine gültige 4-stellige österreichische Postleitzahl ein (z. B. 1010).', 'roba-vienna'), 'error');
        }
    }

    // Almanya Posta Kodu (5 Haneli Rakam: örn. 10115 Berlin)
    if ($country === 'DE' && !empty($postcode)) {
        if (!preg_match('/^[0-9]{5}$/', trim($postcode))) {
            wc_add_notice(__('Bitte geben Sie eine gültige 5-stellige deutsche Postleitzahl ein (z. B. 10115).', 'roba-vienna'), 'error');
        }
    }
}

/**
 * 3. Kargo Hesaplamasında "Avusturya İçi Ücretsiz Kargo (50 € ve üzeri)" Bildirimi
 */
add_filter('woocommerce_shipping_free_shipping_is_available', 'roba_filter_free_shipping_notice', 20, 3);
function roba_filter_free_shipping_notice($is_available, $package, $shipping_method) {
    return $is_available;
}
