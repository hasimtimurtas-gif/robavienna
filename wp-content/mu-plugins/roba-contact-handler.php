<?php
/**
 * Plugin Name: ROBA Vienna - İletişim Formu ve E-Posta Gönderim Motoru
 * Description: /kontakt/ sayfasındaki formu işler, doğrular ve info@robavienna.com adresine kurumsal formatta e-posta gönderir.
 * Version: 1.0.0
 * Author: ROBA Vienna Dev Team
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. AJAX Uç Noktaları ve Güvenlik Nonce Enjeksiyonu
add_action('wp_head', function() {
    echo '<script>window.robaContact = { ajaxurl: "' . admin_url('admin-ajax.php') . '", nonce: "' . wp_create_nonce('roba_contact_nonce') . '" };</script>';
});

add_action('wp_ajax_roba_contact_submit', 'roba_handle_contact_form');
add_action('wp_ajax_nopriv_roba_contact_submit', 'roba_handle_contact_form');

function roba_handle_contact_form() {
    // CSRF Güvenlik Kontrolü
    check_ajax_referer('roba_contact_nonce', 'security');

    // Form Alanlarını Al ve Temizle (Sanitize)
    $name    = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $email   = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? sanitize_text_field($_POST['subject']) : 'Allgemeine Anfrage';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

    if (empty($name) || empty($email) || !is_email($email) || empty($message)) {
        wp_send_json_error(array('message' => 'Bitte füllen Sie alle Pflichtfelder korrekt aus.'));
    }

    // Alıcı E-Posta Adresi
    $to = 'info@robavienna.com';
    $email_subject = '[ROBA Vienna Kontakt] ' . $subject . ' - von ' . $name;

    // Kurumsal HTML E-Posta Şablonu
    $body  = '<div style="font-family:\'Inter\', Arial, sans-serif; max-width:600px; margin:0 auto; padding:20px; border:1px solid #E8E2DA; border-radius:8px; background:#FAF8F5;">';
    $body .= '<div style="text-align:center; padding-bottom:20px; border-bottom:1px solid #D8C8B8;">';
    $body .= '<h2 style="color:#4A3E35; margin:0; font-family:Georgia,serif;">ROBA VIENNA</h2>';
    $body .= '<span style="font-size:12px; color:#8C7A6B; letter-spacing:0.1em; text-transform:uppercase;">Neue Nachricht über das Kontaktformular</span>';
    $body .= '</div>';

    $body .= '<div style="padding:20px 0; line-height:1.6; color:#2B2B2B; font-size:14px;">';
    $body .= '<p><strong>Absender:</strong> ' . esc_html($name) . '</p>';
    $body .= '<p><strong>E-Mail:</strong> <a href="mailto:' . esc_attr($email) . '" style="color:#8C7A6B;">' . esc_html($email) . '</a></p>';
    $body .= '<p><strong>Betreff:</strong> ' . esc_html($subject) . '</p>';
    $body .= '<div style="background:#FFFFFF; border:1px solid #E8E2DA; border-radius:6px; padding:16px; margin:15px 0;">';
    $body .= '<strong>Nachricht:</strong><br>' . nl2br(esc_html($message));
    $body .= '</div>';
    $body .= '<p style="font-size:11px; color:#8C7A6B;">Gesendet am ' . date('d.m.Y H:i:s') . ' von IP: ' . sanitize_text_field($_SERVER['REMOTE_ADDR']) . '</p>';
    $body .= '</div>';

    $body .= '<div style="text-align:center; font-size:11px; color:#9E968F; border-top:1px solid #E8E2DA; padding-top:15px;">';
    $body .= 'ROBA Vienna | Inh. Hicret Turhan Timurtas | Weißenböckstraße 41/2, 1110 Wien';
    $body .= '</div></div>';

    // Başlıklar
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ROBA Vienna Website <noreply@robavienna.com>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    // E-postayı Gönder
    $sent = wp_mail($to, $email_subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(array('message' => 'Vielen Dank! Ihre Nachricht wurde erfolgreich an unser Wiener Team übermittelt. Wir antworten innerhalb von 24 Stunden.'));
    } else {
        wp_send_json_error(array('message' => 'Beim Senden der Nachricht ist ein Fehler aufgetreten. Bitte schreiben Sie uns direkt an info@robavienna.com.'));
    }
}
