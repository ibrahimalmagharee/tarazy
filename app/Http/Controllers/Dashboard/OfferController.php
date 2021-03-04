<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $offers = Offer::get();

        if ($request->ajax()) {

            return DataTables::of($offers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = route('edit.offer', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editOffer" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteOffer" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }
        return view('admin.offers.index', compact('offers'));
    }

    public function store(OfferRequest $request)
    {

        $offer = Offer::create([
            'name' => $request->name,
        ]);

        $offer->save();

        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة العرض بنجاح'
        ]);
    }

    public function edit($id)
    {
        $offer = Offer::find($id);
        $notification = array(
            'message' => 'هذا العرض غير موجود',
            'alert-type' => 'error'
        );
        if (!$offer)
            return redirect()->route('index.offers')->with($notification);

        return view('admin.offers.edit', compact('offer'));
    }

    public function update($id, OfferRequest $request)
    {
        $offer = Offer::find($id);
        $notification = array(
            'message' => 'هذا العرض غير موجود',
            'alert-type' => 'error'
        );
        if (!$offer)
            return redirect()->route('index.offers')->with($notification);

        $offer->where('id', $id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'تم تحديث العرض بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('index.offers')->with($notification);
    }

    public function destroy($id)
    {

        $offer = Offer::find($id);
        if (!$offer){
            return response()->json([
                'status' => false,
                'msg' => 'هذا العرض غير موجود',
            ]);
        } else {
            $offer->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف العرض بنجاح',
            ]);
        }


    }
}
