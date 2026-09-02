<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::query()
            ->with(['category', 'author'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(10);

        return view('news.index', compact('news'));
    }

    public function show(string $slug)
    {
        $news = News::query()
            ->with(['category', 'author'])
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('news.show', compact('news'));
    }
}