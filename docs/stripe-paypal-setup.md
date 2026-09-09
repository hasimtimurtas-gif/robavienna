# ROBA Vienna - Stripe ve PayPal Ödeme Altyapısı Teknik Kurulum Kılavuzu

Bu kılavuz, **robavienna.com** üzerinde güvenli, modern ve Avusturya/Almanya tüketicilerinin en güvendiği ödeme yöntemlerinin (Kredi Kartı, EPS, Klarna, PayPal, Apple Pay) sıfır hata ile yapılandırılması için hazırlanmıştır.

---

## 1. Stripe Altyapısı ve DACH Yerel Ödeme Yöntemleri

### A. Stripe Hesabının Hazırlanması
1. [dashboard.stripe.com](https://dashboard.stripe.com) üzerinde **ROBA Vienna** kurumsal hesabınızı açın.
2. İşletme türü olarak Avusturya merkezli şahıs işletmesi (*Einzelunternehmen*) veya tüzel kişilik seçin.
3. Banka hesabını (Avusturya IBAN) ve şirket sahibi kimlik doğrulamasını tamamlayın.

### B. DACH Ödeme Yöntemlerinin Stripe Panelinde Etkinleştirilmesi
Stripe Dashboard > **Settings > Payment Methods**:
- **Cards (Kredi/Banka Kartları)**: Etkinleştirin (Visa, Mastercard, Maestro, Amex).
- **EPS (Electronic Payment Standard)**: **Zorunlu** (Avusturya bankaları arası anlık havale standardı).
- **Klarna**: **Zorunlu** (Almanya ve Avusturya'da *Pay Now*, *Rechnung / 30 Gün Sonra Öde* ve taksit imkanı).
- **Apple Pay & Google Pay**: Otomatik algılanır (Mobil dönüşümleri %40 artırır).

### C. WooCommerce Stripe Eklentisi Yapılandırması
1. **WooCommerce Stripe Gateway** eklentisini kurup aktifleştirin.
2. *WooCommerce > Ayarlar > Ödemeler > Stripe* sayfasına gidin.
3. Stripe Dashboard > *Developers > API Keys* sayfasından anahtarları kopyalayın:
   - **Publishable Key**: `pk_live_...`
   - **Secret Key**: `sk_live_...`
4. **Stripe Checkout Modu**: "New Checkout Experience" (Stripe Elements) seçeneğini işaretleyin. Böylece kart, Apple Pay ve Google Pay tek bir modern arayüzde sunulur.
5. **EPS ve Klarna Alt Menüleri**:
   - *Stripe EPS* sekmesine girin -> "EPS Etkinleştir" kutusunu işaretleyin.
   - *Stripe Klarna* sekmesine girin -> "Klarna Etkinleştir" kutusunu işaretleyin.

### D. Webhook Kurulumu (Ödemelerin Anında Onaylanması İçin Şart)
EPS ve Klarna gibi yönlendirmeli ödemelerde, müşteri bankadan onay verdikten sonra siparişin WooCommerce tarafında "İşleniyor" (Processing) durumuna geçmesi için Webhook zorunludur.

1. Stripe Dashboard > *Developers > Webhooks > Add Endpoint*.
2. **Endpoint URL**: `https://robavienna.com/?wc-api=wc_stripe`
3. **Dinlenecek Olaylar (Select Events)**:
   - `payment_intent.succeeded`
   - `payment_intent.payment_failed`
   - `charge.refunded`
   - `source.chargeable`
   - `source.canceled`
4. Endpoint oluşturulduktan sonra ekrandaki **Signing Secret** (`whsec_...`) kodunu kopyalayın.
5. WooCommerce Stripe ayarlarındaki **Webhook Secret** alanına yapıştırıp kaydedin.

---

## 2. PayPal Entegrasyonu (WooCommerce PayPal Payments)

### A. Kurulum ve Bağlantı
1. **WooCommerce PayPal Payments** eklentisini kurun ve etkinleştirin.
2. *WooCommerce > Ayarlar > Ödemeler > PayPal* sekmesine gidin.
3. **Connect to PayPal** butonuna tıklayın.
4. Açılan pencerede ROBA Vienna kurumsal PayPal hesabınızla giriş yapın ve izinleri verin. (API anahtarları ve Webhook'lar otomatik olarak entegre edilir).

### B. Ödeme Davranışı ve Buton Stilleri
1. **Pay in 3 / Später Bezahlen (Daha Sonra Öde)**:
   - "Enable Pay in 3 Messaging" seçeneğini aktif edin.
   - Bu sayede ürün detayında ve sepet sayfasında müşteriye "Şimdi al, faizsiz 30 gün sonra öde" mesajı gösterilir.
2. **Smart Payment Buttons**:
   - Buton Rengi: `Gold` veya ROBA kurumsal kimliğine uygun `Black`.
   - Buton Şekli: `Rectangular` (Temanın modern yapısıyla uyumlu).
3. **Vaulting (Güvenli Bilgi Saklama)**:
   - Kayıtlı müşterilerin sonraki siparişlerinde tekrar PayPal girişi yapmadan tek tıkla ödeme yapabilmesi için aktif edin.

---

## 3. Test ve Canlıya Alış Senaryoları

### Stripe Test Prosedürü
1. Stripe ayarlarından **Enable Test Mode** kutusunu işaretleyin. Test anahtarlarını (`pk_test_...`, `sk_test_...`) girin.
2. Sepete bir havlu seti ekleyin ve ödeme sayfasına gidin:
   - **Kredi Kartı**: `4242 4242 4242 4242`, son kullanma tarihi gelecek bir ay/yıl, CVC: `123`. Siparişin başarıyla tamamlandığını doğrulayın.
   - **EPS Testi**: Ödeme yöntemi olarak EPS seçin, test bankası (Erste Bank / Bank Austria) ekranında "Authorize Payment" butonuna basın. Siparişin WooCommerce'te `Processing` durumuna geçtiğini teyit edin.
3. Testler başarılı olduktan sonra Test Modunu kapatıp Canlı Anahtarları girin.

### PayPal Test Prosedürü
1. PayPal Sandbox modunda test alıcı hesabı ile 1 EUR'luk deneme siparişi verin.
2. Siparişin stoktan düştüğünü ve bildirim e-postasının geldiğini teyit ettikten sonra Live moda geçirin.
