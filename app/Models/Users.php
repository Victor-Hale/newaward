<?php

namespace App\Models;

use Exception;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Users extends \Illuminate\Foundation\Auth\User implements JWTSubject
{
    use HasFactory;
    protected $table = "users";
    // 指定开启时间戳
    public $timestamps = true;
    // 指定主键
    protected $primaryKey = "id";
    // 指定不允许自动填充的字段，字段修改的黑名单
    protected $guarded = [];
    protected $fillable = [
        'stuid', 'password','grade','major','class','stuname','email'
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
        return ["role" => "users"];
    }
    public static function YyhcheckNumber($account)
    {
        try {
            $count = Users::select('stuid')
                ->where('stuid', $account)
                ->count();
            return $count;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }
    public static function YyhcreateUser($registeredInfo)
    {
        try {

            $student_id = Users::create([
                'grade' => $registeredInfo['grade'],
                'major' => $registeredInfo['major'],
                'class'=>$registeredInfo['class'],
                'stuname'=>$registeredInfo['stuname'],
                'password'=>$registeredInfo['password'],
                'stuid'=>$registeredInfo['stuid'],
                'email'=>$registeredInfo['email']
            ])->id;
            return $student_id;
        } catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
    static public function Yyhsend($email)
    {
        $code = rand(100000, 999999);
        Mail::raw('您的验证码为:' . $code, function ($message) use ($email) {
            $message->from('1839078725@qq.com', '岳')
                ->to($email)
                ->subject('验证码');
        });

        return [
            'email' =>$email,
            'code' =>bcrypt($code),

        ];
    }
    public static function YyhInquire_a(){

        $data = Users::select('grade')->distinct()->get();
        return $data;

    }
    public static function YyhInquire_b(){

        $data = Users::select('major')->distinct()->get();
        return $data;

    }

    public static function YyhInquire_c(){

        $data = Users::select('class')->distinct()->get();
        return $data;

    }

}
