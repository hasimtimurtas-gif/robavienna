<?php
/**
 * ROBA Vienna - Üretim Ortamı wp-config.php Şablonu
 * robavienna.com için sertleştirilmiş güvenlik ve performans yapılandırması.
 */

// ** Veritabanı Ayarları ** //
define('DB_NAME', 'roba_vienna_db');
define('DB_USER', 'roba_vienna_user');
define('DB_PASSWORD', 'BURAYA_GUCLU_VERITABANI_SIFRENIZI_YAZIN');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// ** Güvenlik Anahtarları ve Tuzları (Salt) ** //
// https://api.wordpress.org/secret-key/1.1/salt/ adresinden benzersiz üretin
define('AUTH_KEY',         'BURAYA_BENZERSIZ_UZUN_RASTGELE_KARAKTERLER_YAZIN_1');
define('SECURE_AUTH_KEY',  'BURAYA_BENZERSIZ_UZUN_RASTGELE_KARAKTERLER_YAZIN_2');
define('LOGGED_IN_KEY',    'BURAYA_BENZERSIZ_UZUN_RASTGELE_KARAKTERLER_YAZIN_3');
define('NONCE_KEY',        'BURAYA_BENZERSIZ_UZUN_RASTGELE_KARAKTERLER_YAZIN_4');
define('AUTH_SALT',        'BURAYA_BENZERSIZ_UZUN_RASTGELE_KARAKTERLER_YAZIN_5');
define('SECURE_AUTH_SALT', 'BURAYA_BENZERSIZ_UZUN_RASTGELE_KARAKTERLER_YAZIN_6');
define('LOGGED_IN_SALT',   'BURAYA_BENZERSIZ_UZUN_RASTGELE_KARAKTERLER_YAZIN_7');
define('NONCE_SALT',       'BURAYA_BENZERSIZ_UZUN_RASTGELE_KARAKTERLER_YAZIN_8');

// ** Veritabanı Tablo Ön Eki (Güvenlik İçin 'wp_' Kullanmayın) ** //
$table_prefix = 'rbv_';

// ** HTTPS ve SSL Zorunluluğu ** //
define('FORCE_SSL_ADMIN', true);
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

// ** Bellek Limitleri (WooCommerce ve Germanized İçin İdeal Değerler) ** //
define('WP_MEMORY_LIMIT', '512M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// ** Güvenlik Kısıtlamaları ** //
// Admin panelinden tema ve eklenti PHP dosyalarının doğrudan düzenlenmesini kapatır
define('DISALLOW_FILE_EDIT', true);

// ** Veritabanı Optimizasyonu ** //
define('WP_POST_REVISIONS', 5);         // Sayfa revizyonlarını maksimum 5 ile sınırla
define('AUTOSAVE_INTERVAL', 180);       // Otomatik kayıt süresi (saniye)
define('EMPTY_TRASH_DAYS', 14);         // Çöp kutusunu 14 günde bir temizle

// ** Hata Ayıklama (Canlı Ortamda Hatalar Ekrana Basılmamalıdır) ** //
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);

// ** LiteSpeed Object Cache (Redis / Memcached) ** //
define('WP_CACHE', true);

/* Hepsi bu kadar. Mutlu bloglamalar / satışlar! */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}
require_once ABSPATH . 'wp-settings.php';
