<?php

namespace App\Http\Controllers;


use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request) {
        $x = new Category();
        $this->v['extParams'] = $request->all();
        $this->v['user'] = $x->LoadListWithPager($this->v['extParams']);
        $this->v['list'] = $x->LoadListWithPager();
        return view("admin.category.index", $this->v);
    }

    public function add(CategoryRequest $request) {
        $method_route = "route_BackEnd_Category_add";
        $this->v['_title'] = "Thêm danh mục";
        if ($request->isMethod('post')) {
            $params = [];
            $modelTes = new Category();
            $params['cols'] = $request->post();
            unset($params['cols']['_token']);
            $res = $modelTes->saveNew(@$params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới danh mục thành công');
                return
                    redirect()->route('route_BackEnd_Category_index');
            } else {
                Session::flash('error', 'Lỗi thêm mới danh mục');
            }
        }
        return view('admin.category.add', $this->v);
    }

    public function detail($id, Request $request) {
        $this->v['_title'] = "Chi tiết danh mục";
        $modelDanhMuc = new Category();
        $objItem = $modelDanhMuc->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('admin.category.detail', $this->v);
    }

    public function update($id, CategoryRequest $request) {
        $method_route = 'route_BackEnd_Category_Detail';
        $params = [];
        $params['cols'] = $request->post();
        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;

        $modelDanhMuc = new Category();

        $res = $modelDanhMuc->saveUpdate($params);
        if($res == null) {
            return redirect()->route($method_route,['id'=>$id]);
        }elseif ($res == 1) {
//            Session::flash('success','Cập nhật bản ghi'.$id."Thành công");
//            return redirect()->route($method_route,['id'=>$id]);
            return redirect('admin/category')->with('success', ' Sửa danh mục Thành công');
        }else {
            Session::flash('error','Cập nhật bản ghi'.$id);
            return redirect()->route($method_route,['id'=>$id]);
        }
    }

    public function delete($id)
    {
        $delete = Category::destroy($id);
        if(!$delete) {
            return redirect()->back();
        }
        return redirect('admin/category')->with('success','Xóa thành công');
    }
}
