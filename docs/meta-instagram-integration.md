# ROBA Vienna - Meta (Facebook & Instagram) Entegrasyon Kılavuzu

Bu rehber, **ROBA Vienna** Denizli premium havlu koleksiyonunun Meta ekosisteminde (Facebook Mağazası, Instagram Alışveriş, Meta Pixel ve Conversion API) satışa açılması için adım adım izlenmesi gereken tüm teknik süreçleri kapsar.

---

## 1. Ön Gereksinimler ve Hesap Hazırlığı

1. **Meta Business Suite (İşletme Hesabı)**:
   - [business.facebook.com](https://business.facebook.com) adresinden **ROBA Vienna** işletme portföyünü oluşturun.
2. **Instagram Hesabı**:
   - Instagram profilinizi (@robavienna) **Profesyonel / İşletme Hesabı** (Business Profile) statüsüne geçirin.
   - Kategoriyi: *Ev Tekstili / Perakende (Home Decor & Textiles)* olarak seçin.
3. **Sayfa ve Profil Eşleştirmesi**:
   - Meta Business Suite > *Ayarlar > Hesaplar > Instagram Hesapları* alanından Instagram profilinizi Facebook Sayfanıza bağlayın.

---

## 2. Alan Adı Doğrulaması (Domain Verification)

Meta Ticaret Yöneticisi'nin mağazanızı onaylaması için `robavienna.com` alan adının sahibi olduğunuzu doğrulamanız şarttır:

1. Meta Business Suite > *İşletme Ayarları > Marka Uygunluğu > Alan Adları* (Brand Safety > Domains).
2. `robavienna.com` alan adını ekleyin.
3. **DNS TXT Kaydı Yöntemi**'ni seçin.
4. Size verilen doğrulama kodunu (`facebook-domain-verification=...`), **Cloudflare DNS** paneline şu şekilde ekleyin:
   - **Type**: `TXT`
   - **Name**: `@`
   - **Content**: `facebook-domain-verification=BURAYA_GELEN_KOD`
   - **TTL**: `Auto`
5. Cloudflare'e ekledikten sonra Meta ekranında **Doğrula (Verify)** butonuna tıklayın.

---

## 3. WordPress & WooCommerce Entegrasyonu (Facebook for WooCommerce)

1. WordPress panelinden **Facebook for WooCommerce** resmi eklentisini kurup aktifleştirin.
2. *Pazarlama > Facebook* sekmesine girin ve **Get Started** butonuna tıklayın.
3. Açılan Meta penceresinde:
   - **İşletme Yöneticisi**: ROBA Vienna Business Manager'ı seçin.
   - **Facebook Sayfası**: ROBA Vienna'yı seçin.
   - **Instagram Profili**: @robavienna'yı bağlayın.
   - **Katalog**: Yeni bir katalog oluşturun: `ROBA Vienna Towels Catalog`.
   - **Meta Pixel**: Yeni veya mevcut pikselinizi bağlayın.
   - **Dönüşümler API'si (Conversion API - CAPI)**: Mutlaka `Açık` konuma getirin (iOS 14+ ve reklam engelleyicilerden etkilenmeyen sunucu taraflı takip).
4. İzinleri onaylayıp entegrasyonu tamamlayın.

---

## 4. DSGVO / GDPR Çerez Uyumluluğu (Önemli Hukuki Not)

Avusturya ve Almanya veri koruma kuralları gereği Meta Pixel **kullanıcı onay vermeden çalıştırılamaz**:

1. **Complianz** eklentisi ayarlarında *Entegrasyonlar > Facebook Pixel* seçeneğini etkinleştirin.
2. Complianz, ziyaretçi çerez banner'ında "Kabul Et" butonuna basana kadar piksel kodlarını otomatik olarak bloke eder.
3. Onay verildiğinde CAPI ve piksel sinyalleri güvenli şekilde Meta sunucularına iletilir.

---

## 5. Instagram Alışverişi (Instagram Shopping) Onayı

Ürünleri Instagram gönderilerinde ve Reels videolarında etiketleyebilmek için:

1. **Meta Ticaret Yöneticisi (Commerce Manager)** paneline gidin:
   - Mağaza Ayarları > *Ödeme Yöntemi*: **Sitemizde Ödeme (robavienna.com)** seçili olduğunu teyit edin.
   - Para Birimi: **EUR (€)**.
   - Gönderim Bölgesi: **Avusturya & Almanya**.
2. **Instagram Uygulamasından İnceleme Talebi**:
   - Instagram uygulamasını açın > *Profil > Ayarlar > İçerik Üretici / İşletme > Alışveriş Kurulumu*.
   - Senkronize edilen `ROBA Vienna Towels Catalog` kataloğunu seçin.
   - İncelemeye Gönder (Submit for Review) butonuna basın.
3. Genellikle **24 ila 72 saat** içinde Instagram Alışveriş özelliğiniz onaylanır.
4. Onaylandığında yeni fotoğraf/video paylaşırken **Ürünleri Etiketle (Tag Products)** butonu aktif olacaktır.
