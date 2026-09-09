# ROBA Vienna - Cloudflare DNS, Güvenlik ve Önbellek Yapılandırma Rehberi

Bu rehber, **robavienna.com** alan adının Cloudflare üzerinde maksimum hız, sıfır sepet çakışması ve askeri düzeyde WordPress güvenliği ile çalışması için gerekli tüm ayarları adım adım içerir.

---

## 1. DNS Kayıtları Yapılandırması

Cloudflare Dashboard > **DNS > Records** bölümünde aşağıdaki kayıtları oluşturun (Turuncu Bulut / Proxied açık olmalıdır):

| Tip | İsim (Name) | İçerik (Content / Target) | Proxy Durumu | TTL |
| :--- | :--- | :--- | :--- | :--- |
| **A** | `@` (robavienna.com) | `SUNUCU_IP_ADRESINIZ` | Proxied (Turuncu) | Auto |
| **CNAME** | `www` | `robavienna.com` | Proxied (Turuncu) | Auto |
| **MX** | `@` | `mail.robavienna.com` (veya kurumsal e-posta sağlayıcınız örn. Google Workspace / Zoho) | DNS Only (Gri) | Auto |
| **TXT** | `@` | `v=spf1 include:_spf.google.com ~all` (Spam önleme) | DNS Only (Gri) | Auto |
| **TXT** | `_dmarc` | `v=DMARC1; p=quarantine; rua=mailto:dmarc-reports@robavienna.com` | DNS Only (Gri) | Auto |

> [!NOTE]
> E-posta kayıtlarının (MX, SPF, DMARC ve webmail alt alan adları) kesinlikle **DNS Only (Gri Bulut)** olması gerekir, aksi takdirde e-posta iletimi aksar.

---

## 2. SSL / TLS Ayarları

Cloudflare Dashboard > **SSL/TLS**:

1. **Overview**:
   - Şifreleme Modu: **Full (Strict)** seçilmelidir.
   *(Sunucunuzda cPanel/Plesk/Nginx üzerinden geçerli bir ücretsiz Let's Encrypt SSL sertifikası kurulu olmalıdır)*.
2. **Edge Certificates**:
   - **Always Use HTTPS**: `ON` (Tüm HTTP isteklerini otomatik HTTPS'e yönlendirir)
   - **Minimum TLS Version**: `TLS 1.2` (Eski ve güvensiz tarayıcı bağlantılarını reddeder)
   - **Opportunistic Encryption**: `ON`
   - **TLS 1.3**: `ON` (0-RTT ile mobil cihazlarda ilk bağlantıyı hızlandırır)
   - **Automatic HTTPS Rewrites**: `ON` (Karma içerik - mixed content hatalarını engeller)

---

## 3. Güvenlik (WAF - Web Application Firewall) Kuralları

Cloudflare Dashboard > **Security > WAF > Custom Rules** bölümünden aşağıdaki 2 kuralı ekleyin:

### Kural 1: WordPress Yönetim Paneli ve Giriş Koruması (Admin Shield)
- **Rule Name**: `WP Admin Protection`
- **Field / Operator / Value**:
  - `URI Path` *contains* `/wp-login.php`
  - **OR**
  - `URI Path` *contains* `/wp-admin` **AND** `URI Path` *does not contain* `/wp-admin/admin-ajax.php`
- **Action**: **Managed Challenge** (veya işletme sahibi sabit IP kullanıyorsa IP Whitelist)

### Kural 2: XML-RPC İsteklerini Kesin Bloklama
- **Rule Name**: `Block XML-RPC Attack Vector`
- **Field / Operator / Value**:
  - `URI Path` *equals* `/xmlrpc.php`
- **Action**: **Block**

---

## 4. Önbellekleme (Cache Rules) - Kritik E-Ticaret Ayarı

WooCommerce sitelerinde sepet, ödeme ve kullanıcı oturumlarının önbelleğe alınması **ciddi sepet karışıklıklarına** neden olur. Cloudflare üzerinde dinamik sayfaların bypass edilmesi zorunludur.

Cloudflare Dashboard > **Caching > Cache Rules**:

### Kural 1: WooCommerce Dinamik Sayfalarını Bypass Et (En Yüksek Öncelik)
- **Rule Name**: `WooCommerce Dynamic Bypass`
- **Expression**:
  ```text
  (http.request.uri.path contains "/cart") or 
  (http.request.uri.path contains "/checkout") or 
  (http.request.uri.path contains "/my-account") or 
  (http.cookie contains "woocommerce_items_in_cart") or 
  (http.cookie contains "wp_woocommerce_session") or 
  (http.cookie contains "wordpress_logged_in_")
  ```
- **Cache Eligibility**: **Bypass cache**

### Kural 2: Statik Medya ve Varlıklar (Görseller, CSS, JS, Fontlar)
- **Rule Name**: `Cache Static Assets Aggressively`
- **Expression**:
  ```text
  (http.request.uri.path.extension in {"jpg" "jpeg" "png" "webp" "avif" "svg" "css" "js" "woff2" "woff" "ttf"})
  ```
- **Cache Eligibility**: **Eligible for cache**
- **Edge Cache TTL**: `Override origin` -> `1 month`
- **Browser Cache TTL**: `Override origin` -> `1 month`

---

## 5. Hız ve Optimizasyon Ayarları

Cloudflare Dashboard > **Speed > Optimization**:
- **Brotli Compression**: `ON` (Gzip'ten %20 daha yüksek sıkıştırma)
- **Early Hints**: `ON` (Tarayıcının CSS ve fontları ana HTML gelmeden yüklemeye başlamasını sağlar)
- **Rocket Loader**: **OFF** *(WooCommerce checkout AJAX scriptleri ile çakışabileceği için mutlaka kapalı kalmalıdır)*
- **Minify**: CSS (`ON`), JavaScript (`ON`), HTML (`ON`)
