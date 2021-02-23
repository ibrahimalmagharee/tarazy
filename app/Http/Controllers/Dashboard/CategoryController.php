<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumeration\CategoryType;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::parent()
            ->orderBy('id', 'DESC')
            ->get();

        $categories_table = Category::with('_parent')
            ->with('childrenCategories')
            ->orderBy('id', 'DESC')
            ->get();

        if ($request->ajax()) {

            return DataTables::of($categories_table)
                ->addIndexColumn()
                ->addColumn('parent_id', function ($row) {
                    return $row->_parent->name ?? '--';
                })
                ->addColumn('is_active', function ($row) {
                    return $row->is_active == 1 ? 'مفعل' : 'غير مفعل';
                })
                ->addColumn('action', function ($row) {
                    $url = route('edit.category', $row->id);
                    $btn = '<td><a href="' . $url . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="تعديل" id="editCustomer" class="primary box-shadow-3 mb-1 editCategory" style="width: 80px"><i class="la la-edit font-large-1"></i></a></td>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn = $btn . ' <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="حذف" class="danger box-shadow-3 mb-1 deleteCategory" style="width: 80px"><i class="la la-trash font-large-1"></i></a></td>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);


        }


        return view('admin.categories.index', compact('categories'));
    }


    public function store(CategoryRequest $request)
    {
        if (!$request->has('is_active')) {
            $request->request->add(['is_active' => 0]);

        } else {
            $request->request->add(['is_active' => 1]);

        }

        // if user choose main category then we must remove parent_id

        if ($request->type == CategoryType::mainCategory) {  // type = 1 . mean add main category. >>>> if type = 2 . mean add sub category
            $request->request->add(['parent_id' => null]);
        }
        // if user choose sub category then we must add parent_id

        // $category = Category::create($request->except('token'));

        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'is_active' => $request->is_active
        ]);

        $category->save();


        return response()->json([
            'status' => true,
            'msg' => 'تم اضافة القسم نجاح',
        ]);
    }

    public function edit($id)
    {
        $notification = array(
            'message' => 'هذا القسم غير موجود',
            'alert-type' => 'error'
        );
        $categories = Category::find($id);
        if (!$categories)
            return redirect()->route('index.categories')->with($notification);

        $mainCategories = Category::parent()
            ->with('childrenCategories')
            ->orderBy('id', 'DESC')
            ->get();

        return view('admin.categories.edit', compact('categories', 'mainCategories'));


    }


    public function update($id, CategoryRequest $request)
    {
        $category = Category::find($id);

        $notification = array(
            'message' => 'هذا القسم غير موجود',
            'alert-type' => 'error'
        );
        $categories = Category::find($id);
        if (!$categories)
            return redirect()->route('index.categories')->with($notification);


        if (!$request->has('is_active')) {
            $request->request->add(['is_active' => 0]);

        } else {
            $request->request->add(['is_active' => 1]);

        }

        if ($request->type == CategoryType::mainCategory) {
            $category->where('id', $id)->update([
                'name' => $request->name,
                'is_active' => $request->is_active,
            ]);

        } else {
            $category->where('id', $id)->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'is_active' => $request->is_active,
            ]);
        }

        $notification = array(
            'message' => 'تم تحديث القسم بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('index.categories')->with($notification);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا القسم غير موجود'
            ]);

        } else {
            if ($category->parent_id == null)
            {
                return response()->json([
                    'status' => false,
                    'msg' => 'هذا قسم رئيسي لا يمكن حذفه',
                ]);
            }

            else
            {
                $category->delete();
                return response()->json([
                    'status' => true,
                    'msg' => 'تم حذف القسم بنجاح',
                ]);
            }

        }
    }
}
