<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    use HasFactory;
    protected $table = "product";
    protected  $fillable = [
        'product.id',
        'product.name',
        'product.image',
        'product.price',
        'product.quantity',
        'product.view',
        'product.discount',
        'product.desc',
        'product.status',
        'categories.name as category_name'
    ];

    public function loadListWithPager($param = [])  {
        $query = DB::table($this->table)->join('categories','categories.id','=','product.cate_id')
            ->select($this->fillable);

        $lists = $query->paginate(15);
        return $lists;
    }
    //Thêm mới
    public function saveNew($params) {
        $data = array_merge($params['cols']
        );
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }

    public function loadOne($id, $params = []) {
        $query = DB::table($this->table)->where('product.id', '=',$id);
        $obj = $query->first();
        return $obj;
    }

    // Sửa
    public function saveUpdate($params) {
        if(empty($params['cols']['id'])) {
            Session::push('errors','Không xác định bản ghi cập nhật');
        }

        $dataUpdate = [];
        foreach ($params['cols'] as $colName=>$val) {
            if($colName == 'id') continue;
            $dataUpdate[$colName] = (strlen($val) == 0) ? null:$val;

        }
        $res = DB::table($this->table)->where('product.id', $params['cols']['id'])->update($dataUpdate);
        return $res;

    }

    public function getListHome() {
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->where('product.status', '=', '1')->join('categories','categories.id','=','product.cate_id')
            ->orderBy('product.id', 'desc');

        $lists = $query->paginate(8);
        return $lists;
    }

    public function getListHomeSale() {
        $query = DB::table($this->table)->join('categories','categories.id','=','product.cate_id')
            ->select($this->fillable)
            ->where('product.status', '=', '1')
            ->where('product.discount', '>', '0')
            ->orderBy('product.id', 'desc');

        $lists = $query->paginate(8);
        return $lists;
    }
    //Lấy sản phẩm theo id
    public function getListProductAsCategory($id) {
        $query = DB::table($this->table)->join('categories','categories.id','=','product.cate_id')
            ->select($this->fillable)
            ->where('product.status', '=', '1')
            ->where('product.cate_id', '=', $id)
            ->orderBy('id', 'desc');

        $lists = $query->paginate(8);
        return $lists;
    }
// Lấy chi tiết sản phẩm theo id
    public function getProductDetail($id) {
        $query = DB::table($this->table)->join('categories','categories.id','=','product.cate_id')
            ->select($this->fillable)
            ->where('product.status', '=', '1')
            ->where('product.id', '=', $id);

        $lists = $query->first();
        return $lists;
    }
}
