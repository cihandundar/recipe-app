<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    /**
     * Blog ana sayfasını göster - Tüm blog yazılarını listele
     * MySQL veritabanından veri çekerek dark tema ile gösterir
     */
    public function index()
    {
        // Blog yazılarını veritabanından çek - sayfalama ile
        $posts = BlogPost::with('blogCategory')
            ->published()
            ->latest()
            ->paginate(6);

        // Kategorileri çek
        $categories = BlogCategory::active()
            ->ordered()
            ->get();

        return view('pages.blog.index', compact('posts', 'categories'));
    }

    /**
     * Blog yazısı detay sayfasını göster
     * Slug ile yazıyı bul ve görüntülenme sayısını artır
     */
    public function show($slug)
    {
        // Slug ile yazıyı bul
        $post = BlogPost::with('blogCategory')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Görüntülenme sayısını artır
        $post->incrementViews();

        // İlgili yazıları getir (aynı kategoriden)
        $relatedPosts = BlogPost::published()
            ->inCategory($post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('pages.blog.show', compact('post', 'relatedPosts'));
    }
}
