<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesRequest;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function getData()
    {
        $data   =   Categories::all();

        return response()->json([
            'categories'  =>  $data

        ]);
    }

    //trả về danh mục có id tương ứng
    public function getDataById($id)
    {
        $data = Categories::find($id);

        if (!$data) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json([
            'category' => $data
        ]);
    }


    // lấy danh mục con bằng ID của danh mục cha
    public function getChildCategories($parentId)
    {
        $childCategories = Categories::where('parent_category_id', $parentId)
            ->select('id', 'category_name')
            ->get();

        if ($childCategories->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy danh mục con'], 404);
        }

        return response()->json([
            'parent_id' => $parentId,
            'child_categories' => $childCategories
        ]);
    }



    public function store(CategoriesRequest $request)
    {
        $data   =   $request->all();
        Categories::create($data);

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới thể loại thành công!'
        ]);
    }
    public function destroy($id)
    {
        Categories::find($id)->delete();

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã xoá thể loại thành công!'
        ]);
    }
    public function update(Request $request)
    {
        $data   = $request->all();
        Categories::find($request->id)->update($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã cập nhật thể loại thành công!'
        ]);
    }

    public function getPostsByCategory($id)
    {
        $category = Categories::with('posts')->find($id);

        if ($category) {
            return response()->json($category->posts, 200);
        } else {
            return response()->json([
                '
            message' => 'Category không tồn tại'
            ]);
        }
    }
}
