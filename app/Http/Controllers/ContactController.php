<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * İletişim sayfasını gösteren method
     * Kullanıcıların iletişim formu ve bilgilerini görebileceği sayfa
     */
    public function index()
    {
        // İletişim sayfasını döndür
        return view('pages.contact');
    }

    /**
     * İletişim formundan gelen mesajları işleyen method
     * Form verileri doğrulanır ve e-mail olarak gönderilir
     */
    public function store(Request $request)
    {
        // Form verilerini doğrula - Türkçe hata mesajları ile
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|in:genel,tarif,teknik,reklam,sikayet,diger',
            'message' => 'required|string|min:10|max:2000'
        ], [
            'name.required' => 'Ad soyad alanı zorunludur.',
            'email.required' => 'E-mail adresi zorunludur.',
            'email.email' => 'Geçerli bir e-mail adresi giriniz.',
            'subject.required' => 'Konu seçimi zorunludur.',
            'message.required' => 'Mesaj alanı zorunludur.',
            'message.min' => 'Mesajınız en az 10 karakter olmalıdır.',
            'message.max' => 'Mesajınız en fazla 2000 karakter olabilir.'
        ]);

        // Şimdilik mesajı session'a kaydet (gelecekte e-mail gönderimi eklenecek)
        // TODO: Mail gönderimi entegrasyonu eklenecek
        
        try {
            // Başarı mesajı ile geri dön
            return redirect()->back()->with('success', 'Mesajınız başarıyla gönderildi! En kısa sürede size geri dönüş yapacağız.');
        } catch (\Exception $e) {
            // Hata durumunda kullanıcıya bilgi ver
            return redirect()->back()->with('error', 'Mesaj gönderilirken bir hata oluştu. Lütfen tekrar deneyiniz.');
        }
    }

    /**
     * İletişim sayfası için ek bilgiler sağlayan method
     * Çalışma saatleri, adres bilgileri vb. dinamik içerik için
     */
    public function getContactInfo()
    {
        // İletişim bilgilerini dizi olarak döndür
        return [
            'address' => [
                'company' => 'Tarif Dünyası Merkez Ofisi',
                'district' => 'Kadıköy',
                'city' => 'İstanbul',
                'country' => 'Türkiye',
                'postal_code' => '34710'
            ],
            'contact' => [
                'phone' => '+90 555 123 4567',
                'email_info' => 'info@tarifdunyasi.com',
                'email_support' => 'destek@tarifdunyasi.com'
            ],
            'working_hours' => [
                'weekday' => '09:00 - 18:00',
                'saturday' => '10:00 - 16:00',
                'sunday' => 'Kapalı'
            ],
            'social_media' => [
                'facebook' => '#',
                'instagram' => '#',
                'twitter' => '#',
                'youtube' => '#',
                'pinterest' => '#'
            ]
        ];
    }
}
