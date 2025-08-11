<?php

namespace App\Services;
namespace App\Services;

use App\Action\UploadMediaFileAction;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogService
{
    protected UploadMediaFileAction $mediaUploader;

    public function __construct(UploadMediaFileAction $mediaUploader)
    {
        $this->mediaUploader = $mediaUploader;
    }

    public function index()
    {
        try {
            return Blog::where('is_published', true)
                ->latest()
                ->paginate(8);
        } catch (\Throwable $e) {
            Log::error('Blog index error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function adminIndex()
    {
        try {
            return Blog::latest()->paginate(8); // بدون فلترة
        } catch (\Throwable $e) {
            Log::error('Blog admin index error: ' . $e->getMessage());
            throw $e;
        }
    }


    public function show(Blog $blog)
    {
        try {
           return Blog::where('id', '!=', $blog->id)
                ->latest()
                ->take(5)
                ->get();
        } catch (\Throwable $e) {
            Log::warning('Blog not found: ' . $e->getMessage());
            throw $e;
        }
    }

    public function store(array $data)
    {

        DB::beginTransaction();
        try {
            $blog = Blog::create([
                'user_id' => auth()->id(),
                'title' => $data['title'],
                'summary' => $data['summary'],
                'content' => $data['contentBlog'],
                'is_published' => $data['is_published'],
                'published_at' => now(),
            ]);

            if (!empty($data['image'])) {
                $this->mediaUploader->execute($blog, $data['image'], 'blog_image');
            }


            DB::commit();
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Blog store error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update(array $data, Blog $blog)
    {
        DB::beginTransaction();
        try {
            $blog->update([
                'title' => $data['title'],
                'summary' => $data['summary'],
                'content' => $data['contentBlog'],
                'is_published' => $data['is_published'],
            ]);

            if (!empty($data['image'])) {
                $this->mediaUploader->execute($blog, $data['image'], 'blog_image');
            }

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Blog update error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function destroy(Blog $blog)
    {
        try {
            $blog->clearMediaCollection('blog_image');
            $blog->delete();
        } catch (\Throwable $e) {
            Log::error('Blog deletion error: ' . $e->getMessage());
            throw $e;
        }
    }
}
