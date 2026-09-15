<?php
/**
 * Plugin Name: ROBA Vienna - Lüks Mağaza Tasarımı & Tipografi
 * Description: ROBA Vienna için lüks bej/toprak renk paletini, Playfair tipografisini ve modern e-ticaret kart tasarımlarını her temaya uygular.
 * Version: 1.1.0
 * Author: ROBA Vienna Dev Team
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_head', 'roba_inject_luxury_design_styles', 999);
function roba_inject_luxury_design_styles() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <style id="roba-vienna-luxury-custom-css">
        :root {
            --roba-primary: #4A3E35;
            --roba-primary-hover: #6E5C4F;
            --roba-sand: #D8C8B8;
            --roba-cream: #FAF8F5;
            --roba-taupe: #8C7A6B;
            --roba-charcoal: #2B2B2B;
            --roba-border: #E8E2DA;
            --roba-card-bg: #FFFFFF;
        }

        /* 1. Genel Gövde ve Tipografi */
        body, html {
            background-color: var(--roba-cream) !important;
            color: var(--roba-charcoal) !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6,
        .entry-title, .product-title, .page-title,
        .ast-site-identity, .site-title, .site-title a {
            font-family: 'Playfair Display', Georgia, serif !important;
            color: var(--roba-primary) !important;
            font-weight: 600 !important;
            letter-spacing: -0.01em !important;
        }

        /* 2. Header (Üst Menü ve Logo) */
        .site-header, .main-header-bar, #masthead, .ast-primary-header-bar {
            background: #FFFFFF !important;
            border-bottom: 1px solid var(--roba-border) !important;
            box-shadow: 0 2px 10px rgba(74, 62, 53, 0.03) !important;
            padding: 10px 0 !important;
        }

        .site-title a {
            font-size: 1.85rem !important;
            letter-spacing: 0.08em !important;
            text-transform: uppercase !important;
            font-weight: 700 !important;
            color: var(--roba-primary) !important;
        }

        .custom-logo-link img,
        .site-logo img,
        .custom-logo {
            max-height: 52px !important;
            width: auto !important;
            border-radius: 6px !important;
            box-shadow: 0 3px 12px rgba(10, 15, 30, 0.15) !important;
            display: inline-block !important;
            vertical-align: middle !important;
            transition: transform 0.2s ease !important;
        }

        .custom-logo-link:hover img {
            transform: scale(1.03) !important;
        }

        .main-header-menu .menu-item > a,
        .nav-menu .menu-item > a,
        #site-navigation a {
            font-family: 'Inter', sans-serif !important;
            font-size: 0.88rem !important;
            font-weight: 500 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.06em !important;
            color: var(--roba-charcoal) !important;
            transition: color 0.2s ease !important;
            padding: 0 16px !important;
        }

        .main-header-menu .menu-item > a:hover,
        .main-header-menu .current-menu-item > a {
            color: var(--roba-taupe) !important;
        }

        /* 3. Lüks Ürün Kartları (Shop & Archive) */
        .woocommerce ul.products li.product,
        .ast-woocommerce-container ul.products li.product {
            background: var(--roba-card-bg) !important;
            border-radius: 8px !important;
            border: 1px solid var(--roba-border) !important;
            padding: 18px !important;
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease !important;
            text-align: center !important;
            overflow: hidden !important;
        }

        .woocommerce ul.products li.product:hover,
        .ast-woocommerce-container ul.products li.product:hover {
            transform: translateY(-4px) !important;
            box-shadow: 0 12px 30px rgba(74, 62, 53, 0.08) !important;
            border-color: var(--roba-sand) !important;
        }

        .woocommerce ul.products li.product img,
        .ast-woocommerce-container ul.products li.product img {
            border-radius: 6px !important;
            margin-bottom: 14px !important;
            transition: transform 0.3s ease !important;
        }

        .woocommerce ul.products li.product:hover img {
            transform: scale(1.02) !important;
        }

        .woocommerce ul.products li.product .woocommerce-loop-product__title,
        .ast-loop-product__link h2 {
            font-family: 'Playfair Display', serif !important;
            font-size: 1.12rem !important;
            line-height: 1.35 !important;
            color: var(--roba-primary) !important;
            margin: 10px 0 6px 0 !important;
        }

        .woocommerce ul.products li.product .price,
        .ast-woocommerce-container ul.products li.product .price {
            font-family: 'Inter', sans-serif !important;
            font-size: 1.05rem !important;
            font-weight: 600 !important;
            color: var(--roba-primary) !important;
            margin-bottom: 12px !important;
        }

        /* 4. Butonlar (Sepete Ekle & Satın Al) */
        .button,
        .button.alt,
        .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce a.button.alt,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce #respond input#submit,
        .single_add_to_cart_button,
        #place_order {
            background-color: var(--roba-primary) !important;
            color: #FFFFFF !important;
            border: 1px solid var(--roba-primary) !important;
            border-radius: 4px !important;
            font-family: 'Inter', sans-serif !important;
            font-size: 0.82rem !important;
            font-weight: 500 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.06em !important;
            padding: 10px 22px !important;
            transition: all 0.2s ease !important;
            box-shadow: none !important;
        }

        .button:hover,
        .button.alt:hover,
        .woocommerce a.button:hover,
        .woocommerce button.button:hover,
        .woocommerce a.button.alt:hover,
        .woocommerce button.button.alt:hover,
        .woocommerce input.button.alt:hover,
        .woocommerce #respond input#submit:hover,
        .single_add_to_cart_button:hover,
        #place_order:hover {
            background-color: var(--roba-primary-hover) !important;
            border-color: var(--roba-primary-hover) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 15px rgba(74, 62, 53, 0.15) !important;
        }

        /* 5. DACH Fiyat ve KDV Rozetleri */
        .legal-price-info, .wc-gzd-additional-info {
            font-size: 0.76rem !important;
            color: #7E756F !important;
            font-weight: 400 !important;
            margin-top: 4px !important;
        }

        /* 6. Sepet & Bildirim Çubukları */
        .woocommerce-message, .woocommerce-info {
            border-top-color: var(--roba-primary) !important;
            background: #FFFFFF !important;
            border-radius: 4px !important;
            box-shadow: 0 4px 15px rgba(74, 62, 53, 0.05) !important;
        }

        .woocommerce-message::before, .woocommerce-info::before {
            color: var(--roba-primary) !important;
        }
    </style>
    <?php
}
