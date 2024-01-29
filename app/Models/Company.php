<?php

namespace App\Models;


use http\Env\Request;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "company";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function fieldcompanysearch($field)
    {
        try {
            if (empty($field)) {
                return [
                    'status' => 'fail',
                    'message' => '请输入查询内容',
                    'code' => 100
                ];
            }

            // 进行模糊查询 年级、专业、姓名、公司名称、实体虚体、申请人排名、公司规模、状态 字段
            $result = self::where('major', 'like', "%$field%")
                ->orWhere('stuname', 'like', "%$field%")
                ->orWhere('grade', 'like', "%$field%")
                ->orWhere('companyname', 'like', "%$field%")
                ->orWhere('vp', 'like', "%$field%")
                ->orWhere('ranking', 'like', "%$field%")
                ->orWhere('scale', 'like', "%$field%")
                ->orWhere('state', 'like', "%$field%")

                //获取字段 年级、专业、班级、姓名、注册公司名称、实体虚体、申报人排名、注册时间、公司规模、佐证材料、状态
                ->get(['id', 'grade', 'major', 'class', 'stuname', 'companyname', 'vp', 'ranking', 'signuptime','scale','url','state']);

            if ($result->isEmpty()) {
                return [
                    'status' => 'fail',
                    'message' => '未找到匹配的记录',
                    'code' => 100
                ];
            }

            return [
                'status' => 'success',
                'message' => '查询成功',
                'data' => $result,
                'code' => 200
            ];
        } catch (Exception $e) {
            return [
                'status' => 'fail',
                'message' => '查询失败，发生异常: ' . $e->getMessage(),
                'code' => 100
            ];
        }
    }
    public static function Tzlcompany($grade, $major, $class, $stuname, $stuid, $companyname, $vp, $ranking, $signuptime, $scale, $url)
    {
        try {
            $res = Company::create([
                'grade' => $grade,
                'major' => $major,
                'class' => $class,
                'stuname' => $stuname,
                'stuid' => $stuid,
                'companyname' => $companyname,
                'vp' => $vp,
                'ranking' => $ranking,
                'signuptime' => $signuptime,
                'scale' => $scale,
                'url' => $url,
            ]);
            return $res;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }

    public static function Tzlgetcompany($stuid){
        try {
            $res = Company::where('stuid',$stuid)->get();
            return $res;
        }catch (\Exception $e){
            return 'error ' . $e->getMessage();
        }
    }

    public static function Tzleditcompany($id,$companyname,$vp,$ranking,$signuptime,$scale,$url){
        try {
            $res = Company::where('id',$id)->update([
                'companyname' => $companyname,
                'vp' => $vp,
                'ranking' => $ranking,
                'signuptime' => $signuptime,
                'scale' => $scale,
                'url' => $url,
            ]);
            return $res;
        }catch (\Exception $e){
            return 'error ' . $e->getMessage();
        }
    }

    public static function Findcompany($id)
    {
        try {
            $state = Company::where('id', $id)->value('state');
            return $state;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    public static function Yyhchaxun_a($id){
        try {
            $data = Company::where('id', $id)->select('reason')->get();

            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }

    }
    public static function Yyhsahnchu_a($id){

        try {
            $data = Company::where('id', $id)->delete();

            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }

    }
    public static function YyhSucceed_b($id){

        try {
            $data = Company::where('id', $id)->update(['state' => '1']);

            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }

    }
    public static function Yyhfail_b($id){

        try {
            $data = Company::where('id', $id)->update(['state' => '2']);

            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }

    }
    public static function Yyhtian_b($id,$reason){

        try {
            $data = Company::where('id', $id)->update(['reason' => $reason]);

            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }

    }
}
