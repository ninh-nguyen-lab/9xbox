<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function getData(Request $request)
    {
        $query = Blog::query()->latest();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('avatar', function ($blog) {
                return $blog->avatar ? Storage::url($blog->avatar) : null;
            })
            ->addColumn('action', function ($blog) {
                return view('admin.partials.actions', [
                    'routeBase' => 'blogs',
                    'item'      => $blog
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(BlogRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = FileHelper::uploadFile($request->file('avatar'), 'blogs/avatar');
        }

        $blog = Blog::create($data);
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thêm tin tức thành công!',
                'data'    => $blog
            ]);
        }
        return redirect()->route('blogs.index')->with('success', 'Thêm tin tức thành công.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function getJson($id)
    {
        $blog = Blog::findOrFail($id);
        $avatar_url = $blog->avatar ? asset('storage/' . $blog->avatar) : null;

        return response()->json([
            'id' => $blog->id,
            'title' => $blog->title,
            'description' => $blog->description,
            'content' => $blog->content,
            'tags' => $blog->tags,
            'keywords' => $blog->keywords,
            'status' => $blog->status ? 1 : 0,
            'avatar_url' => $avatar_url
        ]);
    }

    public function update(BlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('avatar')) {
            FileHelper::deleteFile($blog->avatar);
            $data['avatar'] = FileHelper::uploadFile($request->file('avatar'), 'blogs/avatar');
        }

        $blog->update($data);
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật tin tức thành công!',
                'data'    => $blog
            ]);
        }

        return redirect()->route('blogs.index')->with('success', 'Cập nhật tin tức thành công.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Xóa bài viết thành công.');
    }

    public function active(Blog $blog)
    {
        $blog = Blog::findOrFail($blog->id);
        $blog->status = 1;
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Hiện bài viết thành công.');
    }

    public function unactive(Blog $blog)
    {
        $blog = Blog::findOrFail($blog->id);
        $blog->status = 0;
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Ẩn bài viết thành công.');
    }
}
