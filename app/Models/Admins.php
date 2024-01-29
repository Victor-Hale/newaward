<?php

namespace App\Models;

use Exception;
use http\Client\Curl\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admins extends Authenticatable implements JWTSubject
{

    use HasFactory;
    protected $table = "admins";
    // 指定开启时间戳
    public $timestamps = true;
    // 指定主键
    protected $primaryKey = "id";
    // 指定不允许自动填充的字段，字段修改的黑名单
    protected $guarded = [];
    protected $fillable = [
        'account', 'password','judge'
    ];


    /**
     * 获取会存储到 jwt 声明中的标识
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 返回包含要添加到 jwt 声明中的自定义键值对数组
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return ["role" => "admins"];
    }

    public static function YyhcheckNumber($account)
    {
        try {
            $count = Admins::select('account')
                ->where('account', $account)
                ->count();
            return $count;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }
    public static function YyhcreateUser($registeredInfo)
    {
        try {
            $student_id = Admins::create([
                'account' => $registeredInfo['account'],
                'password' => $registeredInfo['password'],
                'judge'=>$registeredInfo['judge']
            ])->id;
            return $student_id;

        } catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }



}
