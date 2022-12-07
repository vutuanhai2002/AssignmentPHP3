<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class BannerController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request) {
        $x = new Banner();
        $this->v['extParams'] = $request->all();
        $this->v['user'] = $x->LoadListWithPager($this->v['extParams']);
        $this->v['list'] = $x->LoadListWithPager();
        return view("admin.banner.index", $this->v);
    }

    public function add(BannerRequest $request) {
        $method_route = "route_BackEnd_Banner_add";
        $this->v['_title'] = "Thêm banner";
        if ($request->isMethod('post')) {
            $params = [];
            $modelTes = new Banner();
            $params['cols'] = $request->post();
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $params['cols']['image'] = $this->uploadFile($request->file('image'));
            }
            unset($params['cols']['_token']);
            $res = $modelTes->saveNew(@$params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới banner thành công');
                return
                    redirect()->route('route_BackEnd_Banner_index');
            } else {
                Session::flash('error', 'Lỗi thêm mới banner');
            }
        }
        return view('admin.banner.add', $this->v);
    }
    public function uploadFile($file) {
        $fileName = time().'_'.$file->getClientOriginalName();
        return $file->storeAs('images', $fileName , 'public');
    }

    public function detail($id, Request $request) {
        $this->v['_title'] = "Chi tiết danh mục";
        $modelBanner = new Banner();
        $objItem = $modelBanner->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('admin.banner.detail', $this->v);
    }

    public function update($id, BannerRequest $request) {
        $method_route = 'route_BackEnd_Banner_Detail';
        $params = [];
        $params['cols'] = $request->post();
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $params['cols']['image'] = $this->uploadFile($request->file('image'));
        }
        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;

        $modelBanner = new Banner();

        $res = $modelBanner->saveUpdate($params);
        if($res == null) {
            return redirect()->route($method_route,['id'=>$id]);
        }elseif ($res == 1) {
//            Session::flash('success','Cập nhật bản ghi'.$id."Thành công");
//            return redirect()->route($method_route,['id'=>$id]);
            return redirect('admin/banner')->with('success', ' Sửa banner Thành công');
        }else {
            Session::flash('error','Cập nhật bản ghi'.$id);
            return redirect()->route($method_route,['id'=>$id]);
        }
    }
    public function delete($id)
    {
        $delete = Banner::destroy($id);
        if(!$delete) {
            return redirect()->back();
        }
        return redirect('admin/banner')->with('success','Xóa thành công');
    }
}
