<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function home()
    {
        $product = new Product();
        $category = new Category();
        $banner = new Banner();
        $this->v['products'] = $product->getListHome();
        $this->v['listProHomeSale'] = $product->getListHomeSale();
        $this->v['categories'] = $category->LoadListWithPager();
        $this->v['banners'] = $banner->LoadListWithPager();
        $this->v['getNameCate'] = $category->loadListClient();
        return view('client.home.home', $this->v);
    }

    public function listproduct()
    {
        $product = new Product();
        $category = new Category();
        $this->v['getNameCate'] = $category->loadListClient();
        $this->v['products1'] = $product->LoadListWithPager();
        $this->v['categories'] = $category->LoadListWithPager();
        return view('client.home.listproduct', $this->v);
    }

    public function productdetail($id)
    {
        $product = new Product();
        $category = new Category();
        $this->v['products'] = $product->getListHome();
        $this->v['listProHomeSale'] = $product->getListHomeSale();
        $this->v['categories'] = $category->LoadListWithPager();
        $this->v['objPro'] = $product->getProductDetail($id);
        $this->v['listProCate'] = $product->getListProductAsCategory($id);
        $this->v['getNameCate'] = $category->loadListClient();
        return view('client.home.productdetail', $this->v);
    }

    public function productAsCategory($id) {
        $product = new Product();
        $category = new Category();
        $cate = new Category();
        $this->v['listProCates'] = $product->getListProductAsCategory($id);
        $this->v['getNameCate'] = $category->loadListClient();
        $this->v['categories'] = $category->LoadListWithPager();
        $this->v['objCate'] = $cate->loadListClient($id);

        return view('client.home.listcategoryproduct', $this->v);
    }

    // trang bill giỏ hàng
    public function viewBill() {
        return view('client.home.view-bill');
    }

    public function saveBill(Request $request) {
        $params = [];
        $params = $request->post();
        unset($params['_token']);
        $params['ngaylap'] = date("d/m/Y");
        // dd($params);
        $bill = DB::table('bill')->insertGetId($params);
        // dd($bill);


        if(Session('cart') != null){
            // dd(Session('cart')->products);
            foreach(Session('cart')->products as $item){

                DB::table('bill_detail')->insert([
                    'id_pro' => $item['productInfo']['id'],
                    'image_pro' => $item['productInfo']['image'],
                    'name_pro' => $item['productInfo']['name'],
                    'price_pro' => $item['productInfo']['price'],
                    'quantily_pro' => $item['productInfo']['quantity'],
                    'total_price' => $item['price'],
                    'bill_id' => $bill,
                    'id_user' => $params['user_id'],
                    'id_config' => $item['productInfo']['config'],
                    'id_color' => $item['productInfo']['color'],
                ]);

            }

        }

        Session()->forget('cart');
        return Redirect::to('/home/view-bill-detail'.'/'.$params['user_id']);


    }

    public function billDetail($id) {
        $Listbill = DB::table('bill')->where('user_id', $id)->get();

        return view('client.home.bill-detail', compact('Listbill'));
    }

    public function billProDetail($id) {
        $ListProBill = DB::table('bill_detail')->where('bill_id', $id)->get();

        return view('client.home.bill-pro-detail', compact('ListProBill'));
    }

    public function deleteBill($id) {
        DB::table('bill_detail')->where('bill_id', $id)->delete();
        DB::table('bill')->where('id', $id)->delete();

        return back();
    }

    public function nhanHang($id) {
        DB::table('bill')->where('id', $id)->update(['trangthai' =>  3]);
        return back();
    }
}
