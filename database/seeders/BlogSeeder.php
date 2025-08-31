<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    /**
     * Blog sistemini örnek verilerle doldur
     */
    public function run(): void
    {
        // Önce kategorileri oluştur
        $categories = [
            [
                'name' => 'Ekmek & Hamur İşleri',
                'slug' => 'ekmek-hamur-isleri',
                'description' => 'Evde ekmek, pasta, börek ve diğer hamur işleri tarifleri',
                'color' => '#ff6b35',
                'icon' => 'fas fa-bread-slice',
                'sort_order' => 1
            ],
            [
                'name' => 'Sağlıklı Beslenme',
                'slug' => 'saglikli-beslenme',
                'description' => 'Sağlıklı yaşam için beslenme önerileri ve tarifleri',
                'color' => '#28a745',
                'icon' => 'fas fa-leaf',
                'sort_order' => 2
            ],
            [
                'name' => 'Mutfak İpuçları',
                'slug' => 'mutfak-ipuclari',
                'description' => 'Mutfakta işinizi kolaylaştıracak pratik ipuçları',
                'color' => '#17a2b8',
                'icon' => 'fas fa-lightbulb',
                'sort_order' => 3
            ],
            [
                'name' => 'Geleneksel Tatlılar',
                'slug' => 'geleneksel-tatlilar',
                'description' => 'Türk mutfağının geleneksel tatlı tarifleri',
                'color' => '#e83e8c',
                'icon' => 'fas fa-birthday-cake',
                'sort_order' => 4
            ],
            [
                'name' => 'Sağlıklı İçecekler',
                'slug' => 'saglikli-icecekler',
                'description' => 'Doğal ve sağlıklı içecek tarifleri',
                'color' => '#20c997',
                'icon' => 'fas fa-glass-whiskey',
                'sort_order' => 5
            ],
            [
                'name' => 'Kahvaltı',
                'slug' => 'kahvalti',
                'description' => 'Güne enerjik başlamak için kahvaltı tarifleri',
                'color' => '#fd7e14',
                'icon' => 'fas fa-coffee',
                'sort_order' => 6
            ]
        ];

        foreach ($categories as $categoryData) {
            BlogCategory::create($categoryData);
        }

        // Kategorileri al
        $ekmekCategory = BlogCategory::where('slug', 'ekmek-hamur-isleri')->first();
        $saglikCategory = BlogCategory::where('slug', 'saglikli-beslenme')->first();
        $ipucuCategory = BlogCategory::where('slug', 'mutfak-ipuclari')->first();
        $tatliCategory = BlogCategory::where('slug', 'geleneksel-tatlilar')->first();
        $icecekCategory = BlogCategory::where('slug', 'saglikli-icecekler')->first();
        $kahvaltiCategory = BlogCategory::where('slug', 'kahvalti')->first();

        // Blog yazılarını oluştur
        $posts = [
            [
                'title' => 'Ev Yapımı Ekmek Tarifi ve Püf Noktaları',
                'slug' => 'ev-yapimi-ekmek-tarifi-puf-noktalari',
                'excerpt' => 'Evde kolayca yapabileceğiniz nefis ekmek tarifi ve başarılı olmanız için önemli püf noktaları. Mutfakta ekmek yapmanın sırlarını keşfedin.',
                'content' => '<h3>Evde Ekmek Yapmanın Temelleri</h3><p>Evde ekmek yapmak sanıldığından çok daha kolay! Doğru malzemeler ve tekniklerle nefis ekmekler yapabilirsiniz.</p><h4>Gerekli Malzemeler:</h4><ul><li>500g un (bread flour tercih edilir)</li><li>300ml ılık su</li><li>7g aktif kuru maya</li><li>1 tatlı kaşığı tuz</li><li>1 yemek kaşığı zeytinyağı</li><li>1 tatlı kaşığı şeker</li></ul><h4>Yapılışı:</h4><ol><li><strong>Maya Aktivasyonu:</strong> Ilık suya şeker ve mayayı karıştırın. 5-10 dakika bekleyerek mayanın köpürmesini sağlayın.</li><li><strong>Hamur Hazırlama:</strong> Büyük bir kaba unu alın, ortasını çukur yapın. Maya karışımını ve zeytinyağını ekleyin.</li><li><strong>Yoğurma:</strong> Tuz dışında her şeyi karıştırın, sonra tuzu ekleyerek 8-10 dakika yoğurun.</li><li><strong>İlk Mayalanma:</strong> Yağlanmış kaba alın, üzerini örtün. 1 saat mayalanmaya bırakın.</li><li><strong>Şekil Verme:</strong> Hamurun havasını alın, istediğiniz şekli verin.</li><li><strong>İkinci Mayalanma:</strong> 30-45 dakika daha mayalayın.</li><li><strong>Pişirme:</strong> 220°C fırında 25-30 dakika pişirin.</li></ol><p>Bu tarif ile evde enfes ekmekler yapabilirsiniz. Sabırla uygulayın ve mutfağınız mis gibi ekmek kokusu ile dolsun!</p>',
                'author_name' => 'Chef Ayşe',
                'author_title' => 'Ekmek Ustası',
                'author_bio' => '20 yıllık deneyime sahip ekmek ustası. Geleneksel ekmek yapım tekniklerini modern mutfaklara uyarlamakta uzman.',
                'blog_category_id' => $ekmekCategory->id,
                'tags' => ['ekmek', 'hamur işi', 'ev yapımı', 'temel tarifler'],
                'reading_time' => '8 dakika',
                'views' => 1250,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(6)
            ],
            [
                'title' => 'Kış Sebzeleri ile Sağlıklı Çorbalar',
                'slug' => 'kis-sebzeleri-saglikli-corbalar',
                'excerpt' => 'Kış aylarında vücudunuzu sıcak tutacak ve bağışıklığınızı güçlendirecek nefis çorba tarifleri ve beslenme önerileri.',
                'content' => '<h3>Kış Sebzelerinin Faydaları</h3><p>Kış mevsiminde doğanın bize sunduğu sebzeler, vücudumuzun bu zorlu dönemde ihtiyaç duyduğu vitaminler ve mineraller açısından çok zengindir.</p><h4>Kış Sebzelerinin Besin Değerleri:</h4><ul><li><strong>Havuç:</strong> Beta karoten, A vitamini, lif</li><li><strong>Kabak:</strong> C vitamini, potasyum, lif</li><li><strong>Brokoli:</strong> C vitamini, K vitamini, folat</li><li><strong>Karnabahar:</strong> C vitamini, folat, lif</li><li><strong>Pırasa:</strong> A vitamini, K vitamini, folat</li></ul><h4>3 Nefis Kış Çorbası Tarifi:</h4><h5>1. Balkabağı Çorbası</h5><p><strong>Malzemeler:</strong> 500g balkabağı, 1 soğan, 2 diş sarımsak, 500ml sebze suyu, tuz, karabiber, tarçın</p><p><strong>Yapılışı:</strong> Sebzeleri kavurun, su ekleyip haşlayın, blender\'dan geçirin.</p><h5>2. Brokoli Çorbası</h5><p><strong>Malzemeler:</strong> 1 brokoli, 1 patates, 1 soğan, 600ml tavuk suyu, krema</p><p><strong>Yapılışı:</strong> Sebzeleri haşlayın, püre yapın, krema ekleyin.</p><p>Bu çorbalar hem bağışıklığınızı güçlendirir hem de kış soğuğunda sizi ısıtır!</p>',
                'author_name' => 'Diyetisyen Mehmet',
                'author_title' => 'Beslenme Uzmanı',
                'author_bio' => 'Beslenme ve diyet uzmanı. Sağlıklı yaşam için pratik öneriler sunmakta uzman.',
                'blog_category_id' => $saglikCategory->id,
                'tags' => ['çorba', 'kış sebzeleri', 'sağlıklı beslenme', 'vitamin'],
                'reading_time' => '6 dakika',
                'views' => 892,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(11)
            ],
            [
                'title' => 'Baklava Yapımının Sırları',
                'slug' => 'baklava-yapiminin-sirlari',
                'excerpt' => 'Geleneksel Türk tatlısı baklavanın evde nasıl yapılacağını, yufka açma tekniklerini ve şerbet püf noktalarını öğrenin.',
                'content' => '<h3>Baklava Yapımının Temelleri</h3><p>Baklava yapımı sabır ve teknik gerektirir. İşte en önemli sırlar...</p><h4>Malzemeler:</h4><ul><li>1 paket hazır yufka (veya evde açılmış)</li><li>200g tereyağı</li><li>2 su bardağı ceviz</li><li>1 yemek kaşığı şeker</li><li>1 tatlı kaşığı tarçın</li></ul><h4>Şerbet için:</h4><ul><li>3 su bardağı şeker</li><li>2.5 su bardağı su</li><li>1 yemek kaşığı limon suyu</li></ul><p>Baklava yapımında en önemli nokta, şerbetin soğuk, baklavanın sıcak olmasıdır!</p>',
                'author_name' => 'Usta Ahmet',
                'author_title' => 'Tatlı Ustası',
                'author_bio' => 'Geleneksel Türk tatlıları konusunda 30 yıllık deneyime sahip usta.',
                'blog_category_id' => $tatliCategory->id,
                'tags' => ['baklava', 'geleneksel tatlı', 'yufka', 'şerbet'],
                'reading_time' => '12 dakika',
                'views' => 2180,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(16)
            ],
            [
                'title' => 'Vitamin C Deposu Meyveli Smoothie Tarifleri',
                'slug' => 'vitamin-c-meyveli-smoothie-tarifleri',
                'excerpt' => 'Bağışıklığınızı güçlendirmek için vitamin C açısından zengin, lezzetli ve besleyici smoothie tarifleri.',
                'content' => '<h3>Smoothie\'lerin Faydaları</h3><p>Smoothie\'ler hem pratik hem besleyici. Vitamin C deposu tarifler...</p><h4>3 Nefis Smoothie Tarifi:</h4><h5>1. Portakal-Mango Smoothie</h5><ul><li>1 portakal</li><li>1/2 mango</li><li>1 muz</li><li>1 su bardağı süt</li></ul><h5>2. Çilek-Kivi Smoothie</h5><ul><li>10 çilek</li><li>2 kivi</li><li>1 yemek kaşığı bal</li><li>1/2 su bardağı yoğurt</li></ul><p>Bu smoothie\'ler sabah kahvaltısında veya ara öğünlerde tüketilebilir.</p>',
                'author_name' => 'Beslenme Uzmanı Zeynep',
                'author_title' => 'Diyet Uzmanı',
                'author_bio' => 'Sağlıklı beslenme ve detoks programları konusunda uzman diyetisyen.',
                'blog_category_id' => $icecekCategory->id,
                'tags' => ['smoothie', 'vitamin C', 'meyve', 'sağlıklı içecek'],
                'reading_time' => '5 dakika',
                'views' => 743,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(19)
            ],
            [
                'title' => 'Kahvaltıda Protein: Yumurtalı Tarifler',
                'slug' => 'kahvaltida-protein-yumurtali-tarifler',
                'excerpt' => 'Güne enerjik başlamak için protein açısından zengin, çeşitli yumurtalı kahvaltı tarifleri ve beslenme önerileri.',
                'content' => '<h3>Kahvaltının Önemi</h3><p>Kahvaltı günün en önemli öğünü. Protein ile güçlü başlayın...</p><h4>5 Farklı Yumurta Tarifi:</h4><h5>1. Scrambled Eggs</h5><p>Kremsi ve lezzetli çırpılmış yumurta</p><h5>2. Omlet</h5><p>Sebzeli ve peynirli omlet çeşitleri</p><h5>3. Menemen</h5><p>Geleneksel Türk kahvaltı lezzeti</p><h5>4. Eggs Benedict</h5><p>Şık sunum için mükemmel seçenek</p><h5>5. Yumurtalı Avokado Toast</h5><p>Modern ve sağlıklı alternatif</p>',
                'author_name' => 'Chef Murat',
                'author_title' => 'Kahvaltı Uzmanı',
                'author_bio' => 'Kahvaltı kültürü ve protein açısından zengin öğünler konusunda uzman şef.',
                'blog_category_id' => $kahvaltiCategory->id,
                'tags' => ['kahvaltı', 'yumurta', 'protein', 'sağlıklı beslenme'],
                'reading_time' => '7 dakika',
                'views' => 1055,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(22)
            ],
            [
                'title' => 'Mutfak Aletleri Nasıl Temizlenir?',
                'slug' => 'mutfak-aletleri-nasil-temizlenir',
                'excerpt' => 'Mutfak aletlerinizi doğru şekilde temizleyerek hem hijyeni koruyun hem de ömürlerini uzatın. Pratik temizlik ipuçları.',
                'content' => '<h3>Mutfak Hijyeni</h3><p>Mutfak hijyeni lezzet kadar önemlidir. Doğru temizlik teknikleri...</p><h4>Temel Temizlik Kuralları:</h4><ul><li>Her kullanımdan sonra temizleyin</li><li>Doğru deterjan seçin</li><li>Sıcak su kullanın</li><li>İyice durulayın</li><li>Kurutun ve saklayın</li></ul><h4>Özel Aletler:</h4><h5>Bıçaklar</h5><p>Keskin kenarlı aletlerin özel bakımı</p><h5>Tahta Kesme Tahtaları</h5><p>Bakterilerden korunma yöntemleri</p><h5>Tencere ve Tavalar</h5><p>Farklı malzemeler için farklı yöntemler</p>',
                'author_name' => 'Ev Hanımı Fatma',
                'author_title' => 'Temizlik Uzmanı',
                'author_bio' => 'Ev hanımı deneyimleriyle pratik temizlik çözümleri sunan uzman.',
                'blog_category_id' => $ipucuCategory->id,
                'tags' => ['temizlik', 'hijyen', 'mutfak aletleri', 'bakım'],
                'reading_time' => '4 dakika',
                'views' => 654,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(25)
            ]
        ];

        foreach ($posts as $postData) {
            BlogPost::create($postData);
        }
    }
}
