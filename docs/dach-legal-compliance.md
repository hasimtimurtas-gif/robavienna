# ROBA Vienna - Avusturya ve Almanya (DACH) E-Ticaret Hukuki Uyumluluk Rehberi

Avusturya ve Almanya'da faaliyet gösteren e-ticaret siteleri, Avrupa Birliği'nin en sıkı tüketici koruma kanunlarına tabidir. Rakip firmalar veya tüketiciyi koruma dernekleri (Verbraucherschutz), en ufak bir eksiklikte binlerce Euro'luk ihtarlar (**Abmahnung**) gönderebilmektedir.

Bu doküman, **ROBA Vienna** mağazasının hukuki olarak %100 güvende olmasını sağlayacak gereksinimleri ve şablon yönergelerini içerir.

---

## 1. Impressum (Künye Yükümlülüğü - ECG § 5 & GewO)

Avusturya E-Ticaret Yasası (E-Commerce-Gesetz - ECG) uyarınca sitenin her sayfasından tek tıkla ulaşılabilir bir **Impressum** sayfası bulunmalıdır:

### Gerekli Bilgiler:
```text
Impressum

Angaben gemäß § 5 E-Commerce-Gesetz (ECG) und Offenlegungspflicht gemäß § 25 Mediengesetz:

Unternehmensbezeichnung: ROBA Vienna
Inhaberin: Hicret Turhan Timurtas
Rechtsform: Einzelunternehmen
Unternehmensgegenstand: Handel mit Textilwaren (insb. Handtücher und Heimtextilien)
Standort der Gewerbeberechtigung (Geschäftsanschrift): 
Weißenböckstraße 41/2, 1110 Wien, Österreich

Kontakt:
E-Mail: info@robavienna.com
Website: https://www.robavienna.com

Umsatzsteuer-Identifikationsnummer (UID): ATU82689039
Steuernummer: 03 749/6775
GISA-Zahl: 38737541
Zuständige Gewerbebehörde: Magistrat der Stadt Wien (Magistratisches Bezirksamt für den 11. Bezirk)
Mitgliedschaft bei der Wirtschaftskammerorganisation: Wirtschaftskammer Wien (WKO), Sparte Handel
Anwendbare Rechtsvorschriften: Gewerbeordnung (GewO) – abrufbar unter www.ris.bka.gv.at

Online-Streitbeilegung (OS-Plattform):
Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: 
https://ec.europa.eu/consumers/odr
Unsere E-Mail-Adresse finden Sie oben im Impressum. Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
```

---

## 2. Button-Lösung (Sipariş Onay Butonu Yasası)

Avusturya FAGG (Fern- und Auswärtsgeschäfte-Gesetz) ve Almanya BGB § 312j uyarınca sipariş tamamlama butonunun metni çok katı kurallara bağlıdır:

- ❌ **Yasak ve Ceza Sebebi**: *"Bestellen"*, *"Kaufen"*, *"Sipariş Ver"*, *"Weiter"*, *"Registrieren"*.
- ✅ **Yasal Olarak Zorunlu**: *"Kostenpflichtig bestellen"* veya *"Zahlungspflichtig bestellen"*.
- *Germanized for WooCommerce* eklentisi bu butonu otomatik olarak yasal standarda kilitler.

---

## 3. Preisauszeichnung & Kargo Linki (Fiyatlandırma Bildirimi)

Her ürün kartında ve ürün detay sayfasında fiyatın hemen altında şu metin bulunmalıdır:
> **inkl. 20% MwSt., zzgl. [Versandkosten](#)**

- Buradaki *"Versandkosten"* kelimesi doğrudan kargo ücretleri ve teslimat sürelerinin yazılı olduğu sayfaya tıklanabilir bir köprü (link) olmalıdır.

---

## 4. Widerrufsbelehrung (14 Günlük Yasal Cayma Hakkı) & Örnek Form

AB tüketicisinin teslimattan itibaren 14 gün boyunca hiçbir gerekçe göstermeksizin cayma hakkı vardır.

- Mağazada ayrı bir `/widerrufsbelehrung` sayfası açılmalıdır.
- Sayfanın en altında müşterinin doldurup e-posta ile gönderebileceği **Muster-Widerrufsformular** (Örnek Cayma Formu) metni yer almalıdır:

```text
Muster-Widerrufsformular:
(Wenn Sie den Vertrag widerrufen wollen, dann füllen Sie bitte dieses Formular aus und senden Sie es zurück.)
- An: ROBA Vienna, Hicret Turhan Timurtas, [Adres], E-Mail: info@robavienna.com
- Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag über den Kauf der folgenden Waren (*)
- Bestellt am (*)/erhalten am (*)
- Name des/der Verbraucher(s)
- Anschrift des/der Verbraucher(s)
- Unterschrift des/der Verbraucher(s) (nur bei Mitteilung auf Papier)
- Datum
(*) Unzutreffendes streichen.
```

---

## 5. Verpackungsgesetz (Ambalaj Yasaları - Avusturya & Almanya)

Fiziksel ürün (havlu) kargoladığınız için paketleme ambalajlarının geri dönüşüm lisansına dahil edilmesi yasal zorunluluktur:

1. **Almanya İçin**:
   - **LUCID** portalına ([verpackungsregister.org](https://www.verpackungsregister.org)) ücretsiz kayıt olun.
   - Yılda birkaç Euro karşılığında bir çift sistem sağlayıcısı (örn. Activate by Reclay veya Interseroh) ile lisans sözleşmesi yapın.
2. **Avusturya İçin**:
   - Avusturya Ambalaj Yönetmeliği (*Verpackungsverordnung*) gereği ambalaj lisansı (örn. ARA veya ERA) alınmalıdır.

---

## 6. DSGVO / GDPR & Çerez Uyumluluğu

- Google Fonts yerel barındırılmalı (Google CDN sunucularından çekilmemelidir).
- Meta Pixel, Google Analytics, CAPI gibi pazarlama çerezleri ziyaretçi çerez banner'ında açık onay vermeden önce **engellenmelidir**.
- Çerez banner'ı için **Complianz - GDPR/CCPA** eklentisi kurulmalı ve AB Consent Mode v2 entegre edilmelidir.
