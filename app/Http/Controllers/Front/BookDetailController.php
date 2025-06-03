<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BookDetailController extends Controller
{
    public function detail($slug)
    {
        $data = Post::where('status', 'publish')->where('slug', $slug)->firstOrfail();
        $pagination = $this->pagination($data->id);
        return view('components.front.detail-book', compact(['data', 'pagination']));
    }

    public function pagination($id)
    {
        $dataPrev = Post::where('status', 'publish')->where('id', '<', $id)->orderBy('id', 'desc')->first();
        $dataNext = Post::where('status', 'publish')->where('id', '>', $id)->orderBy('id', 'asc')->first();

        $data = [
            'prev' => $dataPrev,
            'next' => $dataNext
        ];
        return $data;
    }
}
