<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use SweetAlert2\Laravel\Swal;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $categories = Category::all();
        $search = $request->search;
        $data = Post::where('user_id', $user->id)->where(function ($query) use ($search) {
            if ($search) {
                $query->where('title', 'like', "%{$search}%");
                // ->orWhere('content', 'like', "%{$search}%");
            }
        })->orderBy('id', 'desc')->paginate(5)->withQueryString();

        return view('member.books.index', compact('data', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('member.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,jpg,png|max:10240',
            'category_id' => 'required|exists:categories,id'
        ], [
            'title.required' => 'Judul wajib diisi',
            'content.required' => 'Konten wajib diisi',
            'thumbnail.required' => 'Gambar wajib diisi',
            'thumbnail.image' => 'Hanya gambar yang diperbolehkan',
            'thumbnail.mimes' => 'Ekstensi yang diperbolehkan hanya JPEG, JPG, dan PNG',
            'thumbnail.max' => 'Ukuran maksimum untuk thumbnail adalah 10mb',
            'category_id.required' => 'Kategori wajib dipilih'
        ]);

        $thumbnailUrl = null;

        if ($request->hasFile('thumbnail')) {
            $uploadedFile = $request->file('thumbnail');

            if (!$uploadedFile->isValid()) {
                return redirect()->back()->withErrors(['thumbnail' => 'File tidak valid'])->withInput();
            }

            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $result = $cloudinary->uploadApi()->upload(
                $uploadedFile->getRealPath(),
                ['folder' => 'thumbnails']
            );

            $thumbnailUrl = $result['secure_url'];
        }



        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'status' => $request->status,
            'thumbnail' => $thumbnailUrl,
            'category_id' => $request->category_id,
            'slug' => $this->generateSlug($request->title),
            'user_id' => Auth::id()
        ];

        Post::create($data);

     Swal::fire([
            'title' => 'Data berhasil ditambahkan',
            'icon' => 'success',
            'confirmButtonText' => 'OK',
            'confirmButtonColor' => '#E19B2C',
        ]);

        return redirect()->route('member.books.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('edit', $post);
        $categories = Category::all();
        $data = $post;
        // dd($data);
        return view('member.books.edit', compact('data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:10240'
        ], [
            'title.required' => 'Judul wajib diisi',
            'content.required' => 'Konten wajib diisi',
            'thumbnail.image' => 'Hanya gambar yang diperbolehkan',
            'thumbnail.mimes' => 'Ekstensi yang diperbolehkan hanya JPEG, JPG, dan PNG',
            'thumbnail.max' => 'Ukuran maksimum untuk thumbnail adalah 10mb',
        ]);

        $thumbnailUrl = $post->thumbnail; // default gunakan yang lama

        if ($request->hasFile('thumbnail')) {
            $uploadedFile = $request->file('thumbnail');

            if (!$uploadedFile->isValid()) {
                return redirect()->back()->withErrors(['thumbnail' => 'File tidak valid'])->withInput();
            }

            // Optional: Hapus thumbnail lama dari Cloudinary jika kamu menyimpan public_id-nya
            // (Hanya bisa dilakukan jika kamu menyimpan informasi tersebut di DB)

            $cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]);

            $uploadResult = $cloudinary->uploadApi()->upload(
                $uploadedFile->getRealPath(),
                ['folder' => 'thumbnails']
            );

            $thumbnailUrl = $uploadResult['secure_url'];
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'status' => $request->status,
            'thumbnail' => $thumbnailUrl,
            'category_id' => $request->category_id,
            'slug' => $this->generateSlug($request->title, $post->id)
        ];

        $post->update($data);
     Swal::fire([
            'title' => 'Data berhasil di-update',
            'icon' => 'success',
            'confirmButtonText' => 'OK',
            'confirmButtonColor' => '#E19B2C',
        ]);
        return redirect()->route('member.books.index')->with('success', 'Data berhasil di-update');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        if (isset($post->thumbnail) && file_exists(public_path(getenv('CUSTOM_THUMBNAILS_LOCATION')) . "/" . $post->thumbnail)) {
            unlink(public_path(getenv('CUSTOM_THUMBNAILS_LOCATION')) . "/" . $post->thumbnail);
        }

        Post::where('id', $post->id)->delete();

     
        Swal::fire([
            'title' => 'Data berhasil dihapus',
            'icon' => 'success',
            'confirmButtonText' => 'OK',
            'confirmButtonColor' => '#E19B2C',
        ]);

        return redirect()->route('member.books.index')->with('success', 'Data berhasil dihapus');
    }


    private function generateSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $count = Post::where('slug', $slug)->when($id, function ($query, $id) {
            return $query->where('id', '!=', $id);
        })->count();

        if ($count > 0) {
            $slug = $slug . "-" . ($count + 1);
        }

        return $slug;
    }
}
