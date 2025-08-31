<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RecipeCategory;
use App\Models\Recipe;
use App\Models\User;
use Carbon\Carbon;

class RecipeSeeder extends Seeder
{
    /**
     * Tarif sistemini örnek verilerle doldur
     */
    public function run(): void
    {
        // Önce kategorileri oluştur
        $categories = [
            [
                'name' => 'Ana Yemek',
                'slug' => 'ana-yemek',
                'description' => 'Nefis ana yemek tarifleri',
                'color' => '#ff6b35',
                'icon' => 'fas fa-drumstick-bite',
                'sort_order' => 1
            ],
            [
                'name' => 'Tatlı',
                'slug' => 'tatli',
                'description' => 'Lezzetli tatlı tarifleri',
                'color' => '#e83e8c',
                'icon' => 'fas fa-birthday-cake',
                'sort_order' => 2
            ],
            [
                'name' => 'Çorba',
                'slug' => 'corba',
                'description' => 'Sıcacık çorba tarifleri',
                'color' => '#17a2b8',
                'icon' => 'fas fa-bowl-hot',
                'sort_order' => 3
            ],
            [
                'name' => 'Salata',
                'slug' => 'salata',
                'description' => 'Taze ve sağlıklı salata tarifleri',
                'color' => '#28a745',
                'icon' => 'fas fa-leaf',
                'sort_order' => 4
            ],
            [
                'name' => 'İçecek',
                'slug' => 'icecek',
                'description' => 'Serinleten içecek tarifleri',
                'color' => '#20c997',
                'icon' => 'fas fa-coffee',
                'sort_order' => 5
            ]
        ];

        foreach ($categories as $categoryData) {
            RecipeCategory::create($categoryData);
        }

        // Test kullanıcısı oluştur (eğer yoksa)
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test Chef',
                'password' => bcrypt('password')
            ]
        );

        // Kategorileri al
        $anaYemekCategory = RecipeCategory::where('slug', 'ana-yemek')->first();
        $tatliCategory = RecipeCategory::where('slug', 'tatli')->first();
        $corbaCategory = RecipeCategory::where('slug', 'corba')->first();
        $salataCategory = RecipeCategory::where('slug', 'salata')->first();
        $icecekCategory = RecipeCategory::where('slug', 'icecek')->first();

        // Örnek tarifleri oluştur
        $recipes = [
            [
                'title' => 'Ev Yapımı Mantarli Spagetti',
                'slug' => 'ev-yapimi-mantarli-spagetti',
                'description' => 'Kremsi mantar soslu nefis spagetti tarifi. Evde kolayca yapabileceğiniz restaurant lezzeti.',
                'instructions' => '<h3>Hazırlık Aşaması</h3><p>Makarnayı kaynar tuzlu suda al dente olana kadar pişirin.</p><h3>Sos Hazırlama</h3><p>Tavada tereyağını eritin, mantarları ekleyin ve kavurun.</p><p>Krema ve baharatları ekleyip karıştırın.</p><h3>Sunum</h3><p>Makarna ile sosu karıştırıp sıcak servis yapın.</p>',
                'ingredients' => [
                    '400g spagetti makarna',
                    '300g taze mantar',
                    '200ml krema',
                    '2 diş sarımsak',
                    '1 soğan',
                    '50g tereyağı',
                    'Tuz, karabiber',
                    'Rendelenmiş parmesan peyniri'
                ],
                'user_id' => $user->id,
                'recipe_category_id' => $anaYemekCategory->id,
                'prep_time' => 15,
                'cook_time' => 25,
                'total_time' => 40,
                'servings' => 4,
                'difficulty' => 'orta',
                'tags' => ['makarna', 'mantar', 'kremali', 'italyan'],
                'chef_notes' => 'Mantarları iyi kavurmak lezzeti artırır.',
                'rating' => 4.5,
                'rating_count' => 23,
                'views' => 1250,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5)
            ],
            [
                'title' => 'Çikolatalı Sufle',
                'slug' => 'cikolatali-sufle',
                'description' => 'İçi akıkan, dışı çıtır nefis çikolatalı sufle. Misafirlerinizi etkileyecek desert.',
                'instructions' => '<h3>Sufle Hazırlığı</h3><p>Çikolata ve tereyağını benmari usulü eritin.</p><p>Yumurta sarılarını şekerle çırpın.</p><h3>Pişirme</h3><p>Karışımı kaliplara doldurun.</p><p>220°C fırında 12 dakika pişirin.</p>',
                'ingredients' => [
                    '200g bitter çikolata',
                    '100g tereyağı',
                    '4 yumurta',
                    '80g toz şeker',
                    '2 yemek kaşığı un',
                    'Vanilin',
                    'Tereyağı (kalip için)'
                ],
                'user_id' => $user->id,
                'recipe_category_id' => $tatliCategory->id,
                'prep_time' => 20,
                'cook_time' => 12,
                'total_time' => 32,
                'servings' => 6,
                'difficulty' => 'zor',
                'tags' => ['çikolata', 'sufle', 'desert', 'fırın'],
                'chef_notes' => 'Sufleyi hemen servis edin, bekletmeyin.',
                'rating' => 4.8,
                'rating_count' => 15,
                'views' => 890,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(8)
            ],
            [
                'title' => 'Mercimek Çorbası',
                'slug' => 'mercimek-corbasi',
                'description' => 'Geleneksel Türk mutfağının vazgeçilmez lezzeti mercimek çorbası.',
                'instructions' => '<h3>Mercimek Hazırlığı</h3><p>Kırmızı mercimeği yıkayıp süzdürün.</p><h3>Pişirme</h3><p>Sebzelerle birlikte haşlayın.</p><p>Blender\'dan geçirip kreması haline getirin.</p>',
                'ingredients' => [
                    '1 su bardağı kırmızı mercimek',
                    '1 orta boy soğan',
                    '1 havuç',
                    '2 yemek kaşığı zeytinyağı',
                    '1 tatlı kaşığı domates salçası',
                    'Tuz, karabiber',
                    'Limon'
                ],
                'user_id' => $user->id,
                'recipe_category_id' => $corbaCategory->id,
                'prep_time' => 10,
                'cook_time' => 30,
                'total_time' => 40,
                'servings' => 4,
                'difficulty' => 'kolay',
                'tags' => ['mercimek', 'çorba', 'geleneksel', 'sağlıklı'],
                'chef_notes' => 'Servis sırasında limon sıkmayı unutmayın.',
                'rating' => 4.3,
                'rating_count' => 31,
                'views' => 2180,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(12)
            ],
            [
                'title' => 'Çoban Salatası',
                'slug' => 'coban-salatasi',
                'description' => 'Taze sebzelerle hazırlanan geleneksel çoban salatası. Hafif ve lezzetli.',
                'instructions' => '<h3>Sebze Hazırlığı</h3><p>Tüm sebzeleri küçük küp şeklinde doğrayın.</p><h3>Karıştırma</h3><p>Büyük bir kasede tüm malzemeleri karıştırın.</p><p>Sos malzemelerini ekleyip karıştırın.</p>',
                'ingredients' => [
                    '3 domates',
                    '2 salatalık',
                    '1 yesil biber',
                    '1 kırmızı soğan',
                    '100g beyaz peynir',
                    'Maydanoz',
                    '3 yemek kaşığı zeytinyağı',
                    '1 yemek kaşığı limon suyu',
                    'Tuz'
                ],
                'user_id' => $user->id,
                'recipe_category_id' => $salataCategory->id,
                'prep_time' => 15,
                'cook_time' => 0,
                'total_time' => 15,
                'servings' => 4,
                'difficulty' => 'kolay',
                'tags' => ['salata', 'taze', 'geleneksel', 'sağlıklı'],
                'chef_notes' => 'Sebzeleri servis öncesinde doğrayın.',
                'rating' => 4.1,
                'rating_count' => 18,
                'views' => 743,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(15)
            ],
            [
                'title' => 'Ev Yapımı Limonata',
                'slug' => 'ev-yapimi-limonata',
                'description' => 'Serinleten, taze limonlardan hazırlanan ev yapımı limonata.',
                'instructions' => '<h3>Şerbet Hazırlığı</h3><p>Şeker ve suyu kaynatıp şerbet yapın.</p><h3>Karıştırma</h3><p>Limon suyunu soğuk şerbete karıştırın.</p><p>Buzla servis yapın.</p>',
                'ingredients' => [
                    '6 taze limon',
                    '1 su bardağı şeker',
                    '4 su bardağı su',
                    'Buz',
                    'Nane yaprakları (süsleme)'
                ],
                'user_id' => $user->id,
                'recipe_category_id' => $icecekCategory->id,
                'prep_time' => 10,
                'cook_time' => 5,
                'total_time' => 15,
                'servings' => 4,
                'difficulty' => 'kolay',
                'tags' => ['limonata', 'serinletici', 'yaz', 'ev yapımı'],
                'chef_notes' => 'Limonları sıkmadan önce oda sıcaklığında bekletin.',
                'rating' => 4.0,
                'rating_count' => 12,
                'views' => 560,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(18)
            ]
        ];

        foreach ($recipes as $recipeData) {
            Recipe::create($recipeData);
        }
    }
}
