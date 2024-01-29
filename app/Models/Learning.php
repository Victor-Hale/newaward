<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Learning extends Model
{
    protected $table = "learning";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    public static function findgetlearning($grade, $major, $state)
    {
        try {
            if (empty($grade) && empty($major) && empty($state)) {
                return [
                    'status' => 'fail',
                    'message' => '未选择数据',
                    'data' => null,
                    'code' => 100
                ];
            }

            if (empty($grade) || empty($major) || empty($state)) {
                return [
                    'status' => 'fail',
                    'message' => '请将数据选择完整',
                    'data' => null,
                    'code' => 100
                ];
            }

            $query = self::where('grade', $grade)
                ->where('major', $major);

            if ($state == '学习之星') {
                $result = $query->orderByRaw('CONVERT(neworder, SIGNED)')->get([
                    'id', 'grade', 'major', 'class', 'stuid', 'stuname', 'oldgrade', 'newgrade', 'oldorder', 'neworder', 'progress'
                ]);

                // 过滤 neworder 为 0 和 progress 为 'N/A' 的数据
                $result = $result->reject(function ($item) {
                    return $item->neworder == 0 || $item->progress == 'N/A';
                });

                // 取前10%的数据
                $result = $result->slice(0, ceil(0.1 * $result->count()));
            } elseif ($state == '进步之星') {
                $result = $query->orderByDesc('progress')
                    ->where('neworder', '!=', 0) // 排除 neworder 为 0 的情况
                    ->where('progress', '!=', 'N/A') // 排除 progress 为 'N/A' 的情况
                    ->get([
                        'id', 'grade', 'major', 'class', 'stuid', 'stuname', 'oldgrade', 'newgrade', 'oldorder', 'neworder', 'progress'
                    ]);

                // 取前10%的数据
                $result = $result->slice(0, ceil(0.1 * $result->count()));
            }

            $status = $result->isEmpty() ? 'fail' : 'success';

            return [
                'status' => $status,
                'message' => $status === 'fail' ? '数据库为空' : '查询成功',
                'data' => $result,
                'code' => $status === 'fail' ? 100 : 200
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'message' => '未找到相关数据',
                'data' => null,
                'code' => 100
            ];
        }
    }
}
