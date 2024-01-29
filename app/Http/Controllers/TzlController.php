<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Competition;
use App\Models\Learning;
use App\Models\Sci;
use Illuminate\Http\Request;

class TzlController extends Controller
{
    public function Tzlgetlearning(Request $request)
    {
        $grade = $request->input('grade');
        $major = $request->input('major');
        $state = $request->input('state');

        $result = Learning::findgetlearning($grade, $major, $state);

        return response()->json($result);
    }

    public function Tzlgetcompetition()
    {
        try {
            $competitionData = Competition::select('id', 'grade', 'major', 'class', 'stuname', 'entryname', 'signuptime', 'url', 'state')->get();

            if ($competitionData->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => '数据库为空',
                    'code' => 200
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => '获取数据成功！',
                'data' => $competitionData,
                'code' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => '获取数据失败，发生异常: ' . $e->getMessage(),
                'code' => 100
            ]);
        }
    }

    public function Tzlcompetitionsearch(Request $request)
    {
        $field = $request->input('field');

        // 在模型中定义的一个模糊查询的方法
        $result = Competition::fieldcompetitionsearch($field);

        if ($result['code'] !== 200) {
            return response()->json($result);
        } else {
            return response()->json($result);
        }
    }

    public function Tzlgetsci()
    {
        try {
            $competitionData = Sci::select('id', 'grade', 'major', 'class', 'stuname', 'scitype', 'sciname', 'scigrade', 'signuptime','ranking','url','state')->get();

            if ($competitionData->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => '数据库为空',
                    'code' => 200
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => '获取数据成功！',
                'data' => $competitionData,
                'code' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => '获取数据失败，发生异常: ' . $e->getMessage(),
                'code' => 100
            ]);
        }
    }

    public function Tzlscisearch(Request $request)
    {
        $field = $request->input('field');

        // 在模型中定义的一个模糊查询的方法
        $result = Sci::fieldscisearch($field);

        if ($result['code'] !== 200) {
            return response()->json($result);
        } else {
            return response()->json($result);
        }
    }


    public function Tzlgetcompany()
    {
        try {
            $competitionData = Company::select('id', 'grade', 'major', 'class', 'stuname', 'companyname', 'vp', 'ranking', 'signuptime','scale','url','state')->get();

            if ($competitionData->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => '数据库为空',
                    'code' => 200
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => '获取数据成功！',
                'data' => $competitionData,
                'code' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => '获取数据失败，发生异常: ' . $e->getMessage(),
                'code' => 100
            ]);
        }

    }

    public function Tzlcompanysearch(Request $request)
    {
        $field = $request->input('field');

        // 在模型中定义的一个模糊查询的方法
        $result = Company::fieldcompanysearch($field);

        if ($result['code'] !== 200) {
            return response()->json($result);
        } else {
            return response()->json($result);
        }
    }
}
