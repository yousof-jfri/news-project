<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Topic;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function news(News $news)
    {
        $news->views += 1;
        $news->update();
        return view('frontend.news', compact('news'));
    }

    public function topic(Topic $topic)
    {
        $topic->views += 1;
        $topic->update();
        return view('frontend.topic', compact('topic'));
    }

    public function categoryNews(Category $category)
    {
        $newses = $category->news()->where('public', 1)->latest()->get();

        return view('frontend.news-archive', compact('newses'));
    }

    public function archive()
    {
        $topics = Topic::where('public', 1)->latest()->get();
        return view('frontend.topic-archive', compact('topics'));
    }
}
