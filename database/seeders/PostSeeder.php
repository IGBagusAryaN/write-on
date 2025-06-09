<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Belajar Laravel Dasar',
                'description' => 'Panduan dasar Laravel untuk pemula.',
                'content' => 'Laravel adalah framework PHP yang elegan dan ekspresif. Sangat cocok untuk membangun aplikasi web modern.',
            ],
            [
                'title' => 'Mengenal Vue.js',
                'description' => 'Vue.js adalah framework frontend progresif.',
                'content' => 'Vue.js sangat ringan dan fleksibel untuk membuat UI interaktif, baik skala kecil maupun besar.',
            ],
            [
                'title' => 'Dasar-dasar REST API',
                'description' => 'REST API digunakan untuk komunikasi antara client dan server.',
                'content' => 'Konsep HTTP method seperti GET, POST, PUT, DELETE sangat penting dalam pembuatan RESTful API.',
            ],
            [
                'title' => 'Apa itu Tailwind CSS?',
                'description' => 'Utility-first CSS framework yang sangat populer.',
                'content' => 'Tailwind CSS memudahkan kita membangun desain UI tanpa meninggalkan HTML.',
            ],
            [
                'title' => 'Membuat CRUD dengan Laravel',
                'description' => 'Langkah-langkah membuat aplikasi CRUD.',
                'content' => 'Dengan Laravel, kita bisa dengan mudah membuat fitur Create, Read, Update, dan Delete.',
            ],
            [
                'title' => 'Git dan GitHub untuk Pemula',
                'description' => 'Versi kontrol penting dalam pengembangan aplikasi.',
                'content' => 'Git digunakan untuk tracking perubahan kode, dan GitHub sebagai remote repository.',
            ],
            [
                'title' => 'Pengenalan React JS',
                'description' => 'React adalah library untuk membangun antarmuka pengguna.',
                'content' => 'React menggunakan konsep komponen dan state management untuk membangun UI yang kompleks.',
            ],
            [
                'title' => 'Cara Deploy Aplikasi Laravel ke Hosting',
                'description' => 'Panduan lengkap deploy Laravel ke shared hosting.',
                'content' => 'Langkah-langkah termasuk upload file, konfigurasi .env, dan migrasi database.',
            ],
            [
                'title' => 'Keamanan di Aplikasi Web',
                'description' => 'Tips menjaga keamanan aplikasi dari serangan.',
                'content' => 'CSRF, XSS, dan SQL Injection adalah contoh ancaman yang harus diantisipasi.',
            ],
            [
                'title' => 'Belajar Database Relasional',
                'description' => 'Konsep dasar database relasional dengan contoh MySQL dan PostgreSQL.',
                'content' => 'Memahami tabel, relasi, foreign key, dan normalisasi sangat penting dalam merancang skema database.',
            ],
        ];

        foreach ($posts as $post) {
            Post::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'description' => $post['description'],
                'content' => $post['content'],
                'status' => 'publish',
                'user_id' => 1,
            ]);
        }
    }
}
