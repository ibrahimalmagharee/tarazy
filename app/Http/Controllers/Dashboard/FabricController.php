<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\FabricRequest;
use App\Http\Resources\FabricResource;
use App\Models\Category;
use App\Models\Color;
use App\Models\Fabric;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class FabricController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['vendors'] = Vendor::select('id','company_name')->get();
        $data['colors'] = Color::select('id','color')->get();
        $data['offers'] = Offer::select('id','name')->get();
        $data['categories'] = Category::active()->select('id','name')->child()->with('childrenCategories')->where('parent_id', 2)->get();
        $fabrics = Fabric::all();
        FabricResource::collection($fabrics);

        if ($request->ajax()) {

            return DataTables::of($fabrics)
                ->addIndexColumn()
                ->addColumn('color_id',  function ($row){
                    return $row->color->color;
                })
                ->addColumn('category_id', function ($row) {
                    return $row->product->category->name;
                })
                ->addColumn('price', function ($row) {
                    return $row->product->price;
                })
                ->addColumn('offer_id', function ($row) {
                    return $row->product->offer->name;
                })
                ->addColumn('vendor_id', function ($row) {
                    return $row->product->vendor->company_name;
                })
                ->addColumn('photo', function ($row) {
                    return '<img src="'. $row->getPhoto($row->image->photo) .'" border="0" style="width: 140px; height: 150px;" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($row) {
                    $url = route('edit.fabric', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editFabric" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteFabric" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['color_id', 'category_id', 'price', 'offer_id', 'vendor_id', 'photo', 'action'])
                ->make(true);

        }
        return view('admin.products.fabrics.index', compact( 'data'));
    }

    public function store(FabricRequest $request)
    {
        DB::beginTransaction();
        $fabric= Fabric::create([
            'name' => $request->name,
            'color_id' => $request->color_id,
            'description' => $request->description,
        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('fabrics', $request->photo);
            $image = Image::create([
                'photo' => $filePath
            ]);
            $fabric->image()->save($image);
        }
        $product = Product::create([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer_id' => $request->offer_id,
            'vendor_id' => $request->vendor_id,
        ]);
        $fabric->product()->save($product);



        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة المنتج بنجاح'
        ]);
    }

    public function edit($id)
    {
        $fabric = Fabric::find($id);

        $notification = array(
            'message' => 'هذا القماش غير موجود',
            'alert-type' => 'error'
        );

        if (!$fabric)
            return redirect()->route('index.fabrics')->with($notification);

        $data = [];
        $data['vendors'] = Vendor::select('id', 'company_name')->get();
        $data['colors'] = Color::select('id', 'color')->get();
        $data['offers'] = Offer::select('id', 'name')->get();
        $data['categories'] = Category::active()->select('id', 'name')->child()->with('childrenCategories')->where('parent_id', 1)->get();

        return view('admin.products.fabrics.edit', compact('fabric', 'data'));
    }

    public function update($id, FabricRequest $request)
    {
        $fabric = Fabric::find($id);

        $notification = array(
            'message' => 'هذا القماش غير موجود',
            'alert-type' => 'error'
        );

        if (!$fabric)
            return redirect()->route('index.fabrics')->with($notification);

        DB::beginTransaction();
        $fabric->where('id', $id)->update([
            'name' => $request->name,
            'color_id' => $request->color_id,
            'description' => $request->description,
        ]);


        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('fabrics', $request->photo);
            $image = Image::where('imageable_id', $fabric->id)->update([
                'photo' => $filePath
            ]);
        }
        $product = Product::where('productable_id', $fabric->id)->update([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer_id' => $request->offer_id,
            'vendor_id' => $request->vendor_id,
        ]);

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث القماش بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.fabrics')->with($notification);
    }

    public function destroy($id)
    {

        $fabric = Fabric::find($id);
        if (!$fabric) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا القماش غير موجود',
            ]);
        } else {
            $image_path = public_path('assets/images/products/fabrics/') . $fabric->image->photo;
            unlink($image_path);
            $fabric->delete();
            $fabric->image->delete();
            $fabric->product->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف القماش بنجاح',
            ]);
        }


    }
}
