<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected  $fillable = ['id', 'name','status'];

    public function loadListWithPager($param = [])  {
        $query = DB::table($this->table)
            ->select($this->fillable);

        $lists = $query->paginate(10);
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
        $query = DB::table($this->table)->where('id', '=',$id);
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
        $res = DB::table($this->table)->where('id', $params['cols']['id'])->update($dataUpdate);
        return $res;

    }
    // Lấy danh sách thanh menu
    public function loadListClient($param = []){
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->where('status', '=', '1')
            ->orderBy('id', 'desc');

        $lists = $query->get();
        return $lists;
    }
}
