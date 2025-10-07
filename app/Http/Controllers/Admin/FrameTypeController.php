<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrameTypeRequest;
use App\Models\FrameType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class FrameTypeController extends Controller
{
    public function index()
    {
        $frameTypes = FrameType::latest()->paginate(10);
        return view('admin.frame_types.index', compact('frameTypes'));
    }

    public function getData(Request $request)
    {
        $query = FrameType::query()->latest();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($frameType) {
                return view('admin.partials.actions', [
                    'routeBase' => 'frame-types',
                    'item'      => $frameType
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.frame_types.create');
    }

    public function store(FrameTypeRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $frameType = FrameType::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thêm loại khung hình thành công!',
                'data'    => $frameType
            ]);
        }

        return redirect()->route('frame-types.index')->with('success', 'Thêm loại khung hình thành công!');
    }

    public function edit(FrameType $frameType)
    {
        return view('admin.frame_types.edit', compact('frameType'));
    }

    public function getJson(FrameType $frameType)
    {
        return response()->json([
            'id' => $frameType->id,
            'name' => $frameType->name,
            'status' => $frameType->status ? 1 : 0
        ]);
    }

    public function update(FrameTypeRequest $request, FrameType $frameType)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $frameType->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật loại khung hình thành công!',
                'data'    => $frameType
            ]);
        }

        return redirect()->route('frame-types.index')->with('success', 'Cập nhật loại khung hình thành công!');
    }

    public function destroy(FrameType $frameType)
    {
        $frameType->delete();

        return redirect()->route('frame-types.index')->with('success', 'Xoá loại khung hình thành công!');
    }

    public function active(FrameType $frameType)
    {
        $frameType = FrameType::findOrFail($frameType->id);
        $frameType->status = 1;
        $frameType->save();

        return redirect()->route('frame-types.index')->with('success', 'Hiện loại khung hình thành công.');
    }

    public function unactive(FrameType $frameType)
    {
        $frameType = FrameType::findOrFail($frameType->id);
        $frameType->status = 0;
        $frameType->save();

        return redirect()->route('frame-types.index')->with('success', 'Ẩn loại khung hình thành công.');
    }
}
