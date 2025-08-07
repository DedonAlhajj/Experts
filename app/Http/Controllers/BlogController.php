<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Services\BlogService;

class BlogController extends Controller
{
    public function __construct(public BlogService $service) {}

    public function index()
    {
        try {
            $blogs = $this->service->index();
            return view('blogs.index', compact('blogs'));
        }catch (\Throwable $e) {
            return back()->with('error', 'Unable to load blogs.');
        }
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(StoreBlogRequest $request)
    {
        try {
            $this->service->store($request->validated());
            return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
        }catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Blog creation failed.');
        }
    }

    public function show(Blog $blog)
    {
        try {
            $latestBlogs = $this->service->show($blog);

            return view('blogs.show', compact('blog', 'latestBlogs'));
        }catch (\Throwable $e){
            return back()->with('error', 'Blog not found.');
        }
    }


    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(StoreBlogRequest $request, Blog $blog)
    {
        try {
            $this->service->update($request->validated(), $blog);
            return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
        }catch (\Throwable $e) {
            return back()->with('error', 'Blog update failed.');
        }
    }

    public function destroy(Blog $blog)
    {
        try {
            $this->service->destroy($blog);
            return redirect()->route('blogs.index')->with('success', 'Blog deleted.');
        }catch (\Throwable $e) {
            return back()->with('error', 'Failed to delete blog.');
        }
    }
}

