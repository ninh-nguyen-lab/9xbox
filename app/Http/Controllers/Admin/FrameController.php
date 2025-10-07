<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrameRequest;
use App\Models\Frame;
use App\Models\FrameType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class FrameController extends Controller
{
    public function index(Request $request)
    {
        $frameTypes = FrameType::orderBy('name')->get();

        return view('admin.frames.index', compact('frameTypes'));
    }

    public function getData(Request $request)
    {
        $query = Frame::with('frameType')->latest();

        // 👉 filter loại khung nếu có
        if ($request->has('frame_type_id') && $request->frame_type_id) {
            $query->where('frame_type_id', $request->frame_type_id);
        }

        return DataTables::of($query)
            ->addIndexColumn() 
            ->addColumn('avatar', function ($frame) {
                return $frame->avatar ? Storage::url($frame->avatar) : null;
            })
            ->addColumn('frame_type', function ($frame) {
                return $frame->frameType ? $frame->frameType->name : '—';
            })
            ->addColumn('price', function ($frame) {
                return number_format($frame->price, 0, ',', '.') . 'đ';
            })
            ->addColumn('sale_price', function ($frame) {
                return $frame->sale_price
                    ? number_format($frame->sale_price, 0, ',', '.') . 'đ'
                    : '—';
            })
            ->addColumn('action', function ($frame) {
                return view('admin.partials.actions', [
                    'routeBase' => 'frames',
                    'item'      => $frame
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $frameTypes = FrameType::where('status', 1)->get();
        return view('admin.frames.create', compact('frameTypes'));
    }

    public function store(FrameRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = FileHelper::uploadFile($request->file('avatar'), 'frames/avatar');
        }

        if ($request->hasFile('album')) {
            $data['album'] = FileHelper::uploadFiles($request->file('album'), 'frames/album');
        }

        $data['frame_type_id'] = $request->frame_type;
        $frame = Frame::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thêm khung hình thành công!',
                'data'    => $frame
            ]);
        }

        return redirect()->route('frames.index')->with('success', 'Thêm khung hình thành công!');
    }

    public function edit(Frame $frame)
    {
        $frameTypes = FrameType::where('status', 1)->get();
        return view('admin.frames.edit', compact('frame', 'frameTypes'));
    }

    public function getJson($id)
    {
        $frame = Frame::findOrFail($id);
        $avatar_url = $frame->avatar ? asset('storage/' . $frame->avatar) : null;

        $album = is_array($frame->album) ? $frame->album : json_decode($frame->album, true);
        $album_urls = [];
        if ($album) {
            foreach ($album as $img) {
                $album_urls[] = asset('storage/' . $img);
            }
        }

        return response()->json([
            'id' => $frame->id,
            'name' => $frame->name,
            'frame_type_id' => $frame->frame_type_id,
            'price'      => $frame->price ? number_format($frame->price, 0, ',', '.') . 'đ' : null,
            'sale_price' => $frame->sale_price ? number_format($frame->sale_price, 0, ',', '.') . 'đ' : null,
            'description' => $frame->description,
            'content' => $frame->content,
            'tags' => $frame->tags,
            'keywords' => $frame->keywords,
            'status' => $frame->status ? 1 : 0,
            'is_hot' => $frame->is_hot ? 1 : 0,
            'avatar_url' => $avatar_url,
            'album_urls' => $album_urls,
        ]);
    }

    public function update(FrameRequest $request, $id)
    {
        $frame = Frame::findOrFail($id);
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('avatar')) {
            FileHelper::deleteFile($frame->avatar);
            $data['avatar'] = FileHelper::uploadFile($request->file('avatar'), 'frames/avatar');
        }

        if ($request->hasFile('album')) {
            FileHelper::deleteFiles($frame->album);
            $data['album'] = FileHelper::uploadFiles($request->file('album'), 'frames/album');
        }

        $data['frame_type_id'] = $request->frame_type;
        $frame->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật khung hình thành công!',
                'data'    => $frame
            ]);
        }

        return redirect()->route('frames.index')->with('success', 'Cập nhật khung hình thành công!');
    }

    public function destroy(Frame $frame)
    {
        FileHelper::deleteFile($frame->avatar);
        FileHelper::deleteFiles($frame->album);

        $frame->delete();

        return redirect()->route('frames.index')->with('success', 'Xoá khung hình thành công!');
    }

    public function active(Frame $frame)
    {
        $blog = Frame::findOrFail($frame->id);
        $blog->status = 1;
        $blog->save();

        return redirect()->route('frames.index')->with('success', 'Hiện khung hình thành công.');
    }

    public function unactive(Frame $frame)
    {
        $blog = Frame::findOrFail($frame->id);
        $blog->status = 0;
        $blog->save();

        return redirect()->route('frames.index')->with('success', 'Ẩn khung hình thành công.');
    }
}
