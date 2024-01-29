<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sci extends Model
{
    protected $table = "sci";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function fieldscisearch($field)
    {
        try {
            if (empty($field)) {
                return [
                    'status' => 'fail',
                    'message' => '请输入查询内容',
                    'code' => 100
                ];
            }

            // 进行模糊查询专业、姓名、项目名称、项目级别、立项时间、状态字段
            $result = self::where('major', 'like', "%$field%")
                ->orWhere('stuname', 'like', "%$field%")
                ->orWhere('sciname', 'like', "%$field%")
                ->orWhere('scigrade', 'like', "%$field%")
                ->orWhere('signuptime', 'like', "%$field%")
                ->orWhere('state', 'like', "%$field%")

                //获取字段 年级、专业、班级、姓名、项目类别、项目名称、项目级别、立项时间、排名、佐证材料、状态
                ->get(['id', 'grade', 'major', 'class', 'stuname', 'scitype', 'sciname', 'scigrade', 'signuptime','ranking','url','state']);

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
}
