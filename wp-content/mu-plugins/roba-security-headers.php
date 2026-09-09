<?php
/**
 * Plugin Name: ROBA Vienna - Kurumsal Güvenlik Başlıkları (Security Headers)
 * Description: robavienna.com için HSTS, X-Frame-Options, CSP ve tarayıcı güvenlik başlıklarını zorunlu kılar.
 * Version: 1.0.0
 * Author: ROBA Vienna Dev Team
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('send_headers', 'roba_send_security_headers');
function roba_send_security_headers() {
    if (headers_sent()) {
        return;
    }

    // 1. HSTS (HTTP Strict Transport Security) - 1 Yıl zorunlu HTTPS ve alt alan adları
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');

    // 2. Clickjacking Koruması (Sitenin harici iframe'lerde yüklenmesini engeller)
    header('X-Frame-Options: SAMEORIGIN');

    // 3. MIME Sniffing Koruması
    header('X-Content-Type-Options: nosniff');

    // 4. Referrer Policy (Gizlilik & Veri Koruması)
    header('Referrer-Policy: strict-origin-when-cross-origin');

    // 5. İzin Politikaları (Kamera, Mikrofon ve Konum isteklerini kısıtlar)
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');

    // 6. PHP Sürüm bilgisini başlıktan kaldır
    if (function_exists('header_remove')) {
        header_remove('X-Powered-By');
    }
}
