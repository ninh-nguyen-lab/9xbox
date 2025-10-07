<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function getData(Request $request)
    {
        $query = Product::query()->latest();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('avatar', function ($product) {
                return $product->avatar ? Storage::url($product->avatar) : null;
            })
            ->addColumn('price', function ($product) {
                return number_format($product->price, 0, ',', '.') . 'đ';
            })
            ->addColumn('sale_price', function ($product) {
                return $product->sale_price
                    ? number_format($product->sale_price, 0, ',', '.') . 'đ'
                    : '—';
            })
            ->addColumn('action', function ($product) {
                return view('admin.partials.actions', [
                    'routeBase' => 'products',
                    'item'      => $product
                ])->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = FileHelper::uploadFile($request->file('avatar'), 'products/avatar');
        }

        if ($request->hasFile('album')) {
            $data['album'] = FileHelper::uploadFiles($request->file('album'), 'products/album');
        }

        $product = Product::create($data);
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thêm sản phẩm thành công!',
                'data'    => $product
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function getJson($id)
    {
        $product = Product::findOrFail($id);
        $avatar_url = $product->avatar ? asset('storage/' . $product->avatar) : null;

        $album = is_array($product->album) ? $product->album : json_decode($product->album, true);
        $album_urls = [];
        if ($album) {
            foreach ($album as $img) {
                $album_urls[] = asset('storage/' . $img);
            }
        }

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price'      => $product->price ? number_format($product->price, 0, ',', '.') . 'đ' : null,
            'sale_price' => $product->sale_price ? number_format($product->sale_price, 0, ',', '.') . 'đ' : null,
            'description' => $product->description,
            'content' => $product->content,
            'tags' => $product->tags,
            'keywords' => $product->keywords,
            'status' => $product->status ? 1 : 0,
            'avatar_url' => $avatar_url,
            'album_urls' => $album_urls,
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('avatar')) {
            FileHelper::deleteFile($product->avatar);
            $data['avatar'] = FileHelper::uploadFile($request->file('avatar'), 'products/avatar');
        }

        if ($request->hasFile('album')) {
            FileHelper::deleteFiles($product->album);
            $data['album'] = FileHelper::uploadFiles($request->file('album'), 'products/album');
        }

        $product->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật sản phẩm thành công!',
                'data'    => $product
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy(Product $product)
    {
        FileHelper::deleteFile($product->avatar);
        FileHelper::deleteFiles($product->album);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Xoá sản phẩm thành công!');
    }

    public function active(Product $product)
    {
        $product = Product::findOrFail($product->id);
        $product->status = 1;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Hiện sản phẩm thành công.');
    }

    public function unactive(Product $product)
    {
        $product = Product::findOrFail($product->id);
        $product->status = 0;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Ẩn sản phẩm thành công.');
    }
}
