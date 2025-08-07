<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $blog = Blog::create([
                'user_id' => 16, // Make sure user with ID 1 exists
                'title' => "Blog Title $i",
                'summary' => "This is a mock summary for blog number $i, created for testing purposes.",
                'content' => "This is the content of blog number $i containing only placeholder information.",
                'is_published' => true,
                'published_at' => now(),
            ]);

            // استخدم mediaUploader لو كان عندك صورة وهمية جاهزة
            // $image = UploadedFile::fake()->image("blog-$i.jpg", 1200, 800);
            // event(new \App\Events\MediaUploaderEvent($blog, $image, 'blog'));
        }
    }
}
