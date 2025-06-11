<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $search = $request->search;
        $data = Post::where('status', 'publish')->where(function ($query) use ($search){
            if ($search) {
                $query->where('title', 'like', "%{$search}%");
            }
        })->orderBy('id', 'desc')->paginate(3)->withQueryString();

        return view('components.front.home-page', compact('data', 'categories'));
    }

    public function byCategory(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
         $search = $request->search;
        $data = Post::where('status', 'publish')->where(function ($query) use ($search){
            if ($search) {
                $query->where('title', 'like', "%{$search}%");
            }
        })->where('category_id', $category->id)->latest()->paginate(3)->withQueryString();

        $categories = Category::all();

        return view('components.front.home-page', compact('data', 'categories', 'category'));
    }
}
