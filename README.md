# ROBA Vienna - E-Commerce (WordPress & WooCommerce)

**ROBA Vienna** (`robavienna.com`), Viyana (Wien, Österreich) merkezli, Türkiye'nin Denizli şehrinden ithal edilen 600 GSM premium havlu setlerini Avusturya ve Almanya (DACH) pazarına sunan lüks ev tekstili e-ticaret platformudur.

Bu depo, projenin **Flatsome Child Theme** kodlarını, **DACH yasal ve güvenlik eklentilerini (mu-plugins)**, **Cloudflare/LiteSpeed sunucu optimizasyonlarını** ve **otomatik CI/CD dağıtım hattını** barındırır.

---

## 📂 Dizin Yapısı

```text
├── .github/
│   └── workflows/
│       └── deploy.yml              # Otomatik PHP linting ve canlı sunucu dağıtımı (CI/CD)
├── docs/                           # Detaylı operasyonel ve teknik kılavuzlar
│   ├── cloudflare-configuration.md # Cloudflare DNS, Full SSL, WAF ve Cache Rules
│   ├── meta-instagram-integration.md# Meta CAPI, katalog ve Instagram Shopping onayı
│   ├── stripe-paypal-setup.md      # Stripe (EPS, Klarna, Apple Pay) ve PayPal rehberi
│   └── dach-legal-compliance.md    # Avusturya/Almanya Impressum, Button-Lösung ve AGB kuralları
├── sample-data/
│   └── roba-vienna-products.csv    # WooCommerce içe aktarımına hazır Denizli havlu ürünleri
├── wp-content/
│   ├── mu-plugins/                 # Otomatik yüklenen çekirdek sistem eklentileri
│   │   ├── roba-security-headers.php# HSTS, X-Frame-Options, CSP başlıkları
│   │   └── roba-tax-and-dach.php   # Avusturya %20 / Almanya %19 KDV & Euro biçimlendirmesi
│   └── themes/
│       └── flatsome-child/         # ROBA Vienna özel teması (kum beji, lüks tipografi)
│           ├── style.css
│           ├── functions.php
│           └── assets/css/
├── .htaccess                       # LiteSpeed, Gzip ve WebP önbellekleme
└── wp-config-production-sample.php # Sertleştirilmiş üretim ortamı wp-config şablonu
```

---

## 💻 1. Yerel Ortamda Geliştirme (LocalWP ile Kurulum)

Kendi bilgisayarınızda (Windows/Mac) siteyi anında çalışır halde görmek için en temiz ve hızlı araç **LocalWP**'dir (Ücretsiz).

1. [localwp.com](https://localwp.com) adresinden **LocalWP**'yi indirip kurun.
2. LocalWP'yi açın ve **+ Create a New Site** butonuna tıklayın:
   - Site Name: `robavienna` (Alan adı: `robavienna.local` olacaktır)
   - Environment: **Preferred** (PHP 8.2+, MySQL 8.0, Nginx)
   - WordPress Admin Kullanıcı adı ve şifrenizi belirleyin.
3. Site oluşturulduktan sonra **Open Site Shell** veya **Go to site folder** butonuna tıklayın:
   - Bilgisayarınızdaki yol: `C:\Users\KullaniciAdiniz\Local Sites\robavienna\app\public\wp-content`
4. Bu depodaki dosyaları eşleştirin:
   - Depodaki `wp-content/themes/flatsome-child` klasörünü LocalWP'deki `wp-content/themes/` içine kopyalayın (Ana Flatsome temasını da yanına ekleyin).
   - Depodaki `wp-content/mu-plugins` klasörünü LocalWP'deki `wp-content/` içine kopyalayın.
5. WordPress Admin paneline (`http://robavienna.local/wp-admin`) girip:
   - *Görünüm > Temalar* altından **Flatsome Child - ROBA Vienna** temasını aktifleştirin.
   - *Eklentiler* altından **WooCommerce** ve **Germanized for WooCommerce** eklentilerini kurun.
   - *WooCommerce > Ürünler > İçe Aktar* diyerek `sample-data/roba-vienna-products.csv` dosyasını yükleyin.

---

## 🚀 2. CI/CD Otomatik Dağıtım Hattı (GitHub Actions)

Bu depodaki `main` dalına (branch) her `git push` yaptığınızda:
1. **GitHub Actions** otomatik olarak devreye girer.
2. Tüm PHP kodlarını **sözdizimi (syntax) hatasına** karşı test eder (`php -l`).
3. Kodlar hatasızsa, değişiklikleri canlı sunucunuzdaki WordPress dizinine otomatik yükler.

### GitHub Repository Secrets Ayarları

Otomatik dağıtımın canlı sunucunuza bağlanabilmesi için GitHub reponuzda **Settings > Secrets and variables > Actions** alanından şu anahtarları ekleyin:

| Secret Adı | Değer Örneği | Açıklama |
| :--- | :--- | :--- |
| `DEPLOY_SERVER` | `ftp.robavienna.com` veya `185.xxx.xxx.xxx` | Sunucu FTP/SFTP adresi |
| `DEPLOY_USERNAME` | `u12345678` veya `cpanel_kullanici` | FTP/SFTP kullanıcı adı |
| `DEPLOY_PASSWORD` | `GucluSifre!2026` | FTP/SFTP şifresi |
| `DEPLOY_PORT` | `21` (FTP) veya `22` (SFTP) | Bağlantı portu |
| `DEPLOY_PROTOCOL` | `ftp` veya `ftps` veya `sftp` | Protokol türü |
| `DEPLOY_REMOTE_PATH` | `/public_html/` veya `/httpdocs/` | Sunucudaki WordPress kök dizini |

---

## ⚖️ Hukuk ve Lisans

Bu proje **ROBA Vienna** ve şirket sahibi **Hicret Turhan Timurtas** mülkiyetindedir. Avusturya ve Almanya e-ticaret kanunlarına (ECG, GewO, FAGG, BGB) tam uyumlu olarak tasarlanmıştır.
