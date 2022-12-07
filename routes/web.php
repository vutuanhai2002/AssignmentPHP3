<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Chỉ dùng cho đăng nhập
Route::get('/signup', ['as'=>'signup','uses'=> 'Auth\LoginController@getSignup']);
Route::post('/signup', ['as'=>'signup','uses'=> 'Auth\LoginController@postSignup']);
Route::get('/login',['as'=>'login','uses'=>'Auth\LoginController@getLogin']);
Route::post('/login',['as'=>'login','uses'=>'Auth\LoginController@postLogin']);
Route::get('/logout',['as'=>'logout','uses'=>'Auth\LoginController@getLogout']);

Route::middleware(['auth'])->group(function () {
    //Tất cả những đường linh muốn bảo vệ chỉ cần áp vào đây
    Route::get('/home', 'HomeAdminController@index')->name('home');
    //Danh sách tài khoản
    Route::get('/admin/account', "AccountController@index")->name('route_BackEnd_Account_index');
    Route::match(['get','post'],'/admin/account/add',"AccountController@add")->name('route_BackEnd_Account_add');
    Route::get('/admin/account/detail/{id}', 'AccountController@detail')->name('route_BackEnd_Account_Detail');
    Route::post('/admin/account/update/{id}', 'AccountController@update')->name('route_BackEnd_Account_Update');
    Route::get('/admin/account/delete/{id}', 'AccountController@delete')->name('route_BackEnd_Account_Delete');


    // Danh sách danh mục
    Route::get('/admin/category', "CategoryController@index")->name('route_BackEnd_Category_index');;
    Route::match(['get','post'],'/admin/category/add',"CategoryController@add")->name('route_BackEnd_Category_add');
    Route::get('/admin/category/detail/{id}', 'CategoryController@detail')->name('route_BackEnd_Category_Detail');
    Route::post('/admin/category/update/{id}', 'CategoryController@update')->name('route_BackEnd_Category_Update');
    Route::get('/admin/category/delete/{id}', 'CategoryController@delete')->name('route_BackEnd_Category_Delete');

    //Danh sách sản phẩm
    Route::get('/admin/product', "ProductController@index")->name('route_BackEnd_Product_index');;
    Route::match(['get','post'],'/admin/product/add',"ProductController@add")->name('route_BackEnd_Product_add');
    Route::get('/admin/product/detail/{id}', 'ProductController@detail')->name('route_BackEnd_Product_Detail');
    Route::post('/admin/product/update/{id}', 'ProductController@update')->name('route_BackEnd_Product_Update');
    Route::get('/admin/product/delete/{id}', 'ProductController@delete')->name('route_BackEnd_Product_Delete');

    //Danh sách banner
    Route::get('/admin/banner', "BannerController@index")->name('route_BackEnd_Banner_index');;
    Route::match(['get','post'],'/admin/banner/add',"BannerController@add")->name('route_BackEnd_Banner_add');
    Route::get('/admin/banner/detail/{id}', 'BannerController@detail')->name('route_BackEnd_Banner_Detail');
    Route::post('/admin/banner/update/{id}', 'BannerController@update')->name('route_BackEnd_Banner_Update');
    Route::get('/admin/banner/delete/{id}', 'BannerController@delete')->name('route_BackEnd_Banner_Delete');



});

Route::get('/', "client\ClientController@home")->name('route_BackEnd_Client_home');
Route::get('/listproduct', "client\ClientController@listproduct")->name('route_BackEnd_Client_listproduct');
Route::get('/productdetail/{id}', "client\ClientController@productdetail")->name('route_BackEnd_Client_productdetail');
Route::get('/category/{id}', 'client\ClientController@productAsCategory')->name('route_BackEnd_Client_category');

// Cart
Route::get('cart', "CartController@cartList")->name('cart.list');
Route::post('cart', "CartController@addToCart")->name('router_FontEnd_Cart_add');
Route::post('update-cart', "CartController@updateCart" )->name('cart.update');
Route::post('remove', "CartController@removeCart")->name('cart.remove');
Route::post('clear', "CartController@clearAllCart")->name('cart.clear');

Route::get('/view-bill', 'client\ClientController@viewBill')->name('viewBill');
Route::post('/view-bill', 'client\ClientController@saveBill')->name('saveBill');
Route::get('/view-bill-detail/{id}', 'client\ClientController@billDetail')->name('billDetail');
Route::get('/view-bill-detail/product/{id}', 'client\ClientController@billProDetail')->name('billProDetail');
Route::get('/delete-bill-detail/{id}', 'client\ClientController@deleteBill')->name('deleteBill');
Route::get('/nhan-hang/{id}', 'client\ClientController@nhanHang')->name('nhanHang');
