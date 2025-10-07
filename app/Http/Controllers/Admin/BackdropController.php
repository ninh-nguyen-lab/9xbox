<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BackdropRequest;
use App\Models\Backdrop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BackdropController extends Controller
{
    public function index()
    {
        $backdrops = Backdrop::latest()->paginate(10);
        return view('admin.backdrops.index', compact('backdrops'));
    }

    public function getData(Request $request)
    {
        $query = Backdrop::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('avatar', function ($blog) {
                return $blog->avatar ? Storage::url($blog->avatar) : null;
            })
            ->addColumn('price', function ($backdrop) {
                return number_format($backdrop->price, 0, ',', '.') . 'đ';
            })
            ->addColumn('action', function ($backdrop) {
                return view('admin.partials.actions', [
                    'routeBase' => 'backdrops',
                    'item'      => $backdrop
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.backdrops.create');
    }

    public function store(BackdropRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = FileHelper::uploadFile($request->file('avatar'), 'backdrops/avatar');
        }

        $backdrop = Backdrop::create($data);
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thêm phông nền thành công!',
                'data'    => $backdrop
            ]);
        }

        return redirect()->route('backdrops.index')->with('success', 'Thêm phông nền thành công!');
    }

    public function edit(Backdrop $backdrop)
    {
        return view('admin.backdrops.edit', compact('backdrop'));
    }

    public function getJson($id)
    {
        $backdrop = Backdrop::findOrFail($id);
        $avatar_url = $backdrop->avatar ? asset('storage/' . $backdrop->avatar) : null;

        return response()->json([
            'id' => $backdrop->id,
            'name' => $backdrop->name,
            'price' => $backdrop->price ? number_format($backdrop->price, 0, ',', '.') . 'đ' : null,
            'description' => $backdrop->description,
            'tags' => $backdrop->tags,
            'keywords' => $backdrop->keywords,
            'status' => $backdrop->status ? 1 : 0,
            'avatar_url' => $avatar_url
        ]);
    }

    public function update(BackdropRequest $request, $id)
    {
        $backdrop = Backdrop::findOrFail($id);
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('avatar')) {
            FileHelper::deleteFile($backdrop->avatar);
            $data['avatar'] = FileHelper::uploadFile($request->file('avatar'), 'backdrops/avatar');
        }

        $backdrop->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật phông nền thành công!',
                'data'    => $backdrop
            ]);
        }

        return redirect()->route('backdrops.index')->with('success', 'Cập nhật phông nền thành công!');
    }

    public function destroy(Backdrop $backdrop)
    {
        FileHelper::deleteFile($backdrop->avatar);

        $backdrop->delete();

        return redirect()->route('backdrops.index')->with('success', 'Xoá phông nền thành công!');
    }

    public function active(Backdrop $backdrop)
    {
        $backdrop = Backdrop::findOrFail($backdrop->id);
        $backdrop->status = 1;
        $backdrop->save();

        return redirect()->route('backdrops.index')->with('success', 'Hiện phông nền thành công.');
    }

    public function unactive(Backdrop $backdrop)
    {
        $backdrop = Backdrop::findOrFail($backdrop->id);
        $backdrop->status = 0;
        $backdrop->save();

        return redirect()->route('backdrops.index')->with('success', 'Ẩn phông nền thành công.');
    }
}
