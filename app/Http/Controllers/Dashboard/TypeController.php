<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    public function index(Request $request)
    {
        $types = Type::get();

        if ($request->ajax()) {

            return DataTables::of($types)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = route('edit.type', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editType" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteType" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }
        return view('admin.types.index', compact('types'));
    }

    public function store(TypeRequest $request)
    {

        $type = Type::create([
            'name' => $request->name,
        ]);

        $type->save();

        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة الصنف بنجاح'
        ]);
    }

    public function edit($id)
    {
        $type = Type::find($id);
        $notification = array(
            'message' => 'هذا الصنف غير موجود',
            'alert-type' => 'error'
        );
        if (!$type)
            return redirect()->route('index.types')->with($notification);

        return view('admin.types.edit', compact('type'));
    }

    public function update($id, TypeRequest $request)
    {
        $type = Type::find($id);
        $notification = array(
            'message' => 'هذا الصنف غير موجود',
            'alert-type' => 'error'
        );
        if (!$type)
            return redirect()->route('index.types')->with($notification);

        $type->where('id', $id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'تم تحديث الصنف بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('index.types')->with($notification);
    }

    public function destroy($id)
    {

        $type = Type::find($id);
        if (!$type){
            return response()->json([
                'status' => false,
                'msg' => 'هذا الصنف غير موجود',
            ]);
        } else {
            $type->delete();
            return response()->json([
                'status' => true,
                'msg' => 'تم حذف الصنف بنجاح',
            ]);
        }


    }
}
