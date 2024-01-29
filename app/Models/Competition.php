<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $table = "competition";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    public static function fieldcompetitionsearch($field)
    {
        try {
            if (empty($field)) {
                return [
                    'status' => 'fail',
                    'message' => '请输入查询内容',
                    'code' => 100
                ];
            }

            // 进行模糊查询 专业、姓名、竞赛名称、状态 字段
            $result = self::where('major', 'like', "%$field%")
                ->orWhere('stuname', 'like', "%$field%")
                ->orWhere('entryname', 'like', "%$field%")
                ->orWhere('state', 'like', "%$field%")

                //获取字段信息
                ->get(['id', 'grade', 'major', 'class', 'stuname', 'entryname', 'signuptime', 'url', 'state']);

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
