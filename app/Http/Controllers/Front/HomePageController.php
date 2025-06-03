<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $data = Post::where('status', 'publish')->orderBy('id', 'desc')->paginate(6);
        return view('components.front.home-page', compact('data'));
    }
}
