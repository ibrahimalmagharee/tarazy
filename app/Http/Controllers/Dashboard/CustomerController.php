<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CustomerRequest;
use App\Http\Requests\Dashboard\EditCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers= Customer::get();

        if ($request->ajax()) {

            return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = route('edit.customer', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editBrand" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteCustomer" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }
        return view('admin.customers.index', compact('customers'));
    }

    public function store(CustomerRequest $request)
    {
        if($request->has('terms_conditions')){
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $customer->save();

            return response()->json([
                'status' => true,
                'msg' => 'تم اضافة العميل بنجاح'
            ]);

        }else{
            return response()->json([
                'status' => false,
                'msg' => 'فشلت عملية اضافة العميل'
            ]);
        }

    }

    public function edit($id)
    {
        $customer = Customer::find($id);

        $notification = array(
            'message' => 'هذا العميل غير موجود',
            'alert-type' => 'error'
        );
        if (!$customer)
            return redirect()-> route('index.customers')->with($notification);

        return view('admin.customers.edit', compact('customer'));
    }

    public function update($id, EditCustomerRequest $request)
    {
        $customer = Customer::find($id);
        $notification = array(
            'message' => 'هذا العميل غير موجود',
            'alert-type' => 'error'
        );
        if (!$customer)
            return redirect()-> route('index.customers')->with($notification);

        $customer->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $notification = array(
            'message' => 'تم تحديث العميل بنجاح',
            'alert-type' => 'info'
        );

        return redirect()-> route('index.customers')->with($notification);
    }

    public function destroy($id)
    {

        $customer = Customer::find($id);
        if (!$customer){
            return response() -> json([
                'status' => false,
                'msg' => 'فشلت عملية حذف العميل',
            ]);
        }

        else
        {
            $customer->delete();
            return response() -> json([
                'status' => true,
                'msg' => 'تم حذف العميل بنجاح',
            ]);
        }



    }
}
