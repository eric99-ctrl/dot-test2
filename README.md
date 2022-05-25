## Cara Menggunakan
- pastikan composer sudah diinstall - composer install.
- copykan file .env dari .env.example
- Pastikan file .env sudah disetting untuk databasenya pake MySQL(bedakan dengan database test-1)
- Lakukan proses migrasi database dan seeder - php artisan migrate --seed.
- pastikan koneksi internet stabil
- import data provinsi -> php artisan import:province
- import data kabupaten/kota -> php artisan import:city
- Lakukan start server - php artisan serve.

## Jawaban
- swapable searching untuk provinsi -> GET /api/swab/search/provinces?id={province_id}&fromAPI=true <-- ambil dari API,
                                       GET /api/swab/search/provinces?id={province_id}&fromAPI=false <-- ambil dari database
- swapable searching untuk kab/kota -> GET /api/swab/search/cities?id={city_id}&fromAPI=true <-- ambil dari API,
                                       GET /api/swab/search/cities?id={city_id}&fromAPI=false <-- ambil dari database
- api Login -> POST /api/login -> email = 'admin@google.com',  password ='secret' -> menghasilkan acces_token type bearer token
- pencarian yang perlu autentikasi token -> GET /api/search/provinces?id={province_id},
                                            GET /api/search/cities?id={city_id}