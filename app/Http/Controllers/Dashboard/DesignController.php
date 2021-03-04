<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DesignRequest;
use App\Http\Resources\DesignResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Design;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Type;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class DesignController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['vendors'] = Vendor::select('id', 'company_name')->get();
        $data['types'] = Type::select('id', 'name')->get();
        $data['offers'] = Offer::select('id', 'name')->get();
        $data['categories'] = Category::active()->select('id', 'name')->child()->with('childrenCategories')->where('parent_id', 1)->get();
        $designs = Design::all();
        DesignResource::collection($designs);

        if ($request->ajax()) {

            return DataTables::of($designs)
                ->addIndexColumn()
                ->addColumn('type_id', function ($row) {
                    return $row->type->name;
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
                    $url = route('edit.design', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editDesign" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteDesign" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['type_id', 'category_id', 'price', 'offer_id', 'vendor_id', 'photo', 'action'])
                ->make(true);

        }
        return view('admin.products.designs.index', compact('data'));
    }

    public function store(DesignRequest $request)
    {
        DB::beginTransaction();
        $design = Design::create([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'description' => $request->description,
        ]);

        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('designs', $request->photo);
            $image = Image::create([
                'photo' => $filePath
            ]);
            $design->image()->save($image);
        }
        $product = Product::create([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer_id' => $request->offer_id,
            'vendor_id' => $request->vendor_id,
        ]);
        $design->product()->save($product);


        DB::commit();


        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة المنتج بنجاح'
        ]);
    }

    public function edit($id)
    {
        $design = Design::find($id);

        $notification = array(
            'message' => 'هذا التفصيل غير موجود',
            'alert-type' => 'error'
        );

        if (!$design)
            return redirect()->route('index.designs')->with($notification);

        $data = [];
        $data['vendors'] = Vendor::select('id', 'company_name')->get();
        $data['types'] = Type::select('id', 'name')->get();
        $data['offers'] = Offer::select('id', 'name')->get();
        $data['categories'] = Category::active()->select('id', 'name')->child()->with('childrenCategories')->where('parent_id', 1)->get();

        return view('admin.products.designs.edit', compact('design', 'data'));
    }

    public function update($id, DesignRequest $request)
    {
        $design = Design::find($id);

        $notification = array(
            'message' => 'هذا التفصيل غير موجود',
            'alert-type' => 'error'
        );

        if (!$design)
            return redirect()->route('index.designs')->with($notification);

        DB::beginTransaction();
        $design->where('id', $id)->update([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'description' => $request->description,
        ]);


        $filePath = "";
        if ($request->has('photo')) {
            $filePath = uploadImage('designs', $request->photo);
            $image = Image::where('imageable_id', $design->id)->update([
                'photo' => $filePath
            ]);
        }
        $product = Product::where('productable_id', $design->id)->update([
            'category_id' => $request->category_id,
            'price' => $request->price,
            'offer_id' => $request->offer_id,
            'vendor_id' => $request->vendor_id,
        ]);

        DB::commit();

        $notification = array(
            'message' => 'تم تحديث التفصيل بنجاح',
            'alert-type' => 'info'
        );


        return redirect()->route('index.designs')->with($notification);
    }

    public function destroy($id)
    {

        $design = Design::find($id);
        if (!$design) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا التفصيل غير موجود',
            ]);
        } else {
            $image_path = public_path('assets/images/products/designs/') . $design->image->photo;
            unlink($image_path);
            $design->delete();
            $design->image->delete();
            $design->product->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف اللون بنجاح',
            ]);
        }


    }
}
