<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Account extends Model
{
    use HasFactory;
    protected $table = "users";
    protected  $fillable = [
        'users.id',
        'users.name',
        'users.email',
        'users.avatar',
        'users.address',
        'users.phone',
        'users.status',
        'role.name as role_name'];

    public function loadListWithPager($param = [])  {
        $query = DB::table($this->table)->join('role','role.id','=','users.role_id')
            ->select($this->fillable);

        $lists = $query->paginate(10);
        return $lists;
    }
    //Thêm mới
    public function saveNew($params) {
        $data = array_merge($params['cols'],[
                'password'=>Hash::make($params['cols']['password'])
            ]
        );
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }
    // Load ra chi tiết người dùng
    public function loadOne($id, $params = []) {
        $query = DB::table($this->table)->where('id', '=',$id);
        $obj = $query->first();
        return $obj;
    }

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

// đăng ký
    public function saveNewUser($params) {
        $data = array_merge($params['cols'], [
            'password' => Hash::make($params['cols']['password']),
        ]);
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }

}
