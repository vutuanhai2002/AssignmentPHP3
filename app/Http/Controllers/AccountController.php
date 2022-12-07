<?php

namespace App\Http\Controllers;
use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;




class AccountController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $x = new Account();
        $this->v['extParams'] = $request->all();
        $this->v['user'] = $x->LoadListWithPager($this->v['extParams']);
        $this->v['list'] = $x->LoadListWithPager();
        return view("admin.account.index", $this->v);
    }

    public function add(AccountRequest $request)
    {
        $method_route = "route_BackEnd_Account_add";
        $this->v['_title'] = "Thêm người dùng";
        $this->v['role'] = role::all();
        if ($request->isMethod('post')) {
            $params = [];
            $modelTes = new Account();
            $params['cols'] = $request->post();

            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                $params['cols']['avatar'] = $this->uploadFile($request->file('avatar'));
            }
            unset($params['cols']['_token']);
            $res = $modelTes->saveNew(@$params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'Thêm mới thành công người dùng');
                return
                    redirect()->route('route_BackEnd_Account_index');
            } else {
                Session::flash('error', 'Lỗi thêm mới người dùng');
            }
        }
        return view('admin.account.add', $this->v);
    }

    public function uploadFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('images', $fileName, 'public');
    }

    public function detail($id, Request $request)
    {
        $this->v['_title'] = "Chi tiết người dùng";
        $this->v['role'] = role::all();
        $modelNguoiDung = new Account();
        $objItem = $modelNguoiDung->loadOne($id);
        $this->v['objItem'] = $objItem;
        return view('admin.account.detail', $this->v);
    }

    public function update($id, AccountRequest $request)
    {
        $method_route = 'route_BackEnd_Account_Detail';
        $params = [];
        $params['cols'] = $request->post();
        $this->v['role'] = role::all();
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $params['cols']['avatar'] = $this->uploadFile($request->file('avatar'));
        }
        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;
        if (!is_null($params['cols']['password'])) {
            $params['cols']['password'] = Hash::make(($params['cols']['password']));
        } else {
            unset($params['cols']['password']);
        }
        $modelNguoiDung = new Account();

        $res = $modelNguoiDung->saveUpdate($params);
        if ($res == null) {
            return redirect()->route($method_route, ['id' => $id]);
        } elseif ($res == 1) {
//              Session::flash('success','Cập nhật bản ghi'.$id."Thành công");
//            return redirect()->route($method_route,['id'=>$id]);
            return redirect('admin/account')->with('success', ' Sửa tài khoản Thành công');
        } else {
            Session::flash('error', 'Cập nhật bản ghi' . $id);
            return redirect()->route($method_route, ['id' => $id]);
        }

    }

    public function delete($id)
    {
        $delete = Account::destroy($id);
        if (!$delete) {
            return redirect()->back();
        }
        return redirect('admin/account')->with('success', 'Xóa thành công');
    }

}
