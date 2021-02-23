<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        $colors = Color::get();

        if ($request->ajax()) {

            return DataTables::of($colors)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = route('edit.color', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editColor" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteColor" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }
        return view('admin.colors.index', compact('colors'));
    }

    public function store(ColorRequest $request)
    {

        $color= Color::create([
            'color' => $request->color,
        ]);

        $color->save();

        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة اللون بنجاح'
        ]);
    }

    public function edit($id)
    {
        $color = Color::find($id);

        $notification = array(
            'message' => 'هذا اللون غير موجود',
            'alert-type' => 'error'
        );

        if (!$color)
            return redirect()->route('index.colors')->with($notification);

        return view('admin.colors.edit', compact('color'));
    }

    public function update($id, ColorRequest $request)
    {
        $color = Color::find($id);
        $notification = array(
            'message' => 'هذا اللون غير موجود',
            'alert-type' => 'error'
        );
        if (!$color)
            return redirect()->route('index.colors')->with($notification);

        $color->where('id', $id)->update([
            'color' => $request->color,
        ]);

        $notification = array(
            'message' => 'تم تحديث اللون بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('index.colors')->with($notification);
    }

    public function destroy($id)
    {

        $color = Color::find($id);
        if (!$color){
            return response()->json([
                'status' => false,
                'msg' => 'هذا اللون غير موجود',
            ]);
        } else {
            $color->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف اللون بنجاح',
            ]);
        }


    }
}
