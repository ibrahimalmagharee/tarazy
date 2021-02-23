<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\VendorRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $vendors= Vendor::get();

        if ($request->ajax()) {

            return DataTables::of($vendors)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = route('edit.vendor', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editVendor" class="primary box-shadow-3 mb-1 editBrand" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteVendor" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }
        return view('admin.vendors.index', compact('vendors'));
    }

    public function store(VendorRequest $request)
    {
        $vendor = Vendor::create([
            'company_name' => $request->company_name,
            'location' => $request->location,
            'commercial_registration_No' => $request->commercial_registration_No,
            'mobile_No' => $request->mobile_No,
            'national_Id' => $request->national_Id,
            'email' => $request->email,
            'type_activity' => $request->type_activity,
            'password' => $request->password,

        ]);

        $vendor->save();

        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة التاجر بنجاح'
        ]);
    }

    public function edit($id)
    {
        $vendor = Vendor::find($id);

        $notification = array(
            'message' => 'هذا التاجر غير موجود',
            'alert-type' => 'error'
        );
        if (!$vendor)
            return redirect()-> route('index.vendors')->with($notification);

        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update($id, VendorRequest $request)
    {
        $vendor = Vendor::find($id);

        $notification = array(
            'message' => 'هذا التاجر غير موجود',
            'alert-type' => 'error'
        );
        if (!$vendor)
            return redirect()-> route('index.vendors')->with($notification);

        $vendor->where('id', $id)->update([
            'company_name' => $request->company_name,
            'location' => $request->location,
            'commercial_registration_No' => $request->commercial_registration_No,
            'mobile_No' => $request->mobile_No,
            'national_Id' => $request->national_Id,
            'email' => $request->email,
            'type_activity' => $request->type_activity,
            'password' => $request->password,
        ]);

        $notification = array(
            'message' => 'تم تحديث التاجر بنجاح',
            'alert-type' => 'info'
        );

        return redirect()-> route('index.vendors')->with($notification);
    }

    public function destroy($id)
    {

        $vendor = Vendor::find($id);
        if (!$vendor){
            return response() -> json([
                'status' => false,
                'msg' => 'فشلت عملية حذف التاجر',
            ]);
        }

        else
        {
            $vendor->delete();
            return response() -> json([
                'status' => true,
                'msg' => 'تم حذف التاجر بنجاح',
            ]);
        }



    }
}
