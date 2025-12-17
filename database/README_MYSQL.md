# MySQL Veritabanı Kurulumu

Bu proje artık MySQL veritabanı kullanıyor. Seeder/Factory yerine SQL dosyası kullanılıyor.

## Kurulum Adımları

### 1. MySQL Veritabanı Oluşturma

MySQL'de veritabanını oluşturun:

```sql
CREATE DATABASE recipe_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2. .env Dosyası Yapılandırması

`.env` dosyanızda aşağıdaki ayarları yapın:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=recipe_app
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Migration'ları Çalıştırma

Veritabanı tablolarını oluşturmak için:

```bash
php artisan migrate
```

### 4. Seed Verilerini Yükleme

Seeder/Factory yerine SQL dosyası kullanılıyor. Verileri yüklemek için:

**Yöntem 1: MySQL Komut Satırı**
```bash
mysql -u root -p recipe_app < database/seed_data.sql
```

**Yöntem 2: MySQL Workbench veya phpMyAdmin**
- `database/seed_data.sql` dosyasını açın
- İçeriğini kopyalayıp MySQL'de çalıştırın

**Yöntem 3: Laravel Tinker (Alternatif)**
```bash
php artisan tinker
```
Sonra SQL dosyasını okuyup çalıştırabilirsiniz.

## Notlar

- SQL dosyası seeder/factory yerine kullanılıyor
- `seed_data.sql` dosyası tüm örnek verileri içerir
- Kullanıcı şifresi: `password` (hash'lenmiş hali dosyada)
- Test kullanıcıları:
  - Email: `test@example.com`
  - Email: `chef@example.com`

## Veritabanı Yapısı

- `users` - Kullanıcılar
- `recipe_categories` - Tarif kategorileri
- `recipes` - Tarifler
- `blog_categories` - Blog kategorileri
- `blog_posts` - Blog yazıları

## Sorun Giderme

Eğer bağlantı hatası alırsanız:

1. MySQL servisinin çalıştığından emin olun
2. `.env` dosyasındaki bilgilerin doğru olduğundan emin olun
3. Veritabanı kullanıcısının gerekli yetkilere sahip olduğundan emin olun
4. `php artisan config:clear` komutunu çalıştırın

