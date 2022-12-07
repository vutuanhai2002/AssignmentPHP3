<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request) {
        $x = new Product();
        $this->v['extParams'] = $request->all();

        $this->v['user'] = $x->LoadListWithPager($this->v['extParams']);
        $this->v['list'] = $x->LoadListWithPager();
        return view("admin.product.index", $this->v);
    }

    public function add(ProductRequest $request) {
        $method_route = "route_BackEnd_Product_add";
        $this->v['_title'] = "Thêm sản phẩm";
        $this->v['category'] = category::all();
        if ($request->isMethod('post')) {
            $params = [];
            $modelTes = new Product();
            $params['cols'] = $request->post();
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $params['cols']['image'] = $this->uploadFile($request->file('image'));
            }
            unset($params['cols']['_token']);
            $res = $modelTes->saveNew(@$params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới thành công sản phẩm');
                return
                    redirect()->route('route_BackEnd_Product_index');
            } else {
                Session::flash('error', 'Lỗi thêm mới sản phẩm');
            }
        }
        return view('admin.product.add', $this->v);
    }

    public function uploadFile($file) {
        $fileName = time().'_'.$file->getClientOriginalName();
        return $file->storeAs('images', $fileName , 'public');
    }
    public function detail($id, Request $request) {
        $this->v['_title'] = "Chi tiết sản phẩm";
        $this->v['category'] = category::all();
        $modelProduct = new Product();
        $objItem = $modelProduct->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('admin.product.detail', $this->v);
    }

    public function update($id, ProductRequest $request) {
        $method_route = 'route_BackEnd_Product_Detail';
        $params = [];
        $params['cols'] = $request->post();
        $this->v['category'] = Category::all();
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $params['cols']['image'] = $this->uploadFile($request->file('image'));
        }
        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;

        $modelProduct = new Product();

        $res = $modelProduct->saveUpdate($params);
        if($res == null) {
            return redirect()->route($method_route,['id'=>$id]);
        }elseif ($res == 1) {
//            Session::flash('success','Cập nhật bản ghi'.$id."Thành công");
//            return redirect()->route($method_route,['id'=>$id]);
            return redirect('admin/product')->with('success', ' Sửa sản phẩm Thành công');
        }else {
            Session::flash('error','Cập nhật bản ghi'.$id);
            return redirect()->route($method_route,['id'=>$id]);
        }
    }

    public function delete($id)
    {
        $delete = Product::destroy($id);
        if(!$delete) {
            return redirect()->back();
        }
        return redirect('admin/product')->with('success','Xóa thành công');
    }
}
