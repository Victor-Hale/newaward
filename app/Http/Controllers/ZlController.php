<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class ZlController extends Controller
{
    public function Tzlcommitcompany(Request $request){
        $grade = $request['grade'];
        $major = $request['major'];
        $class = $request['class'];
        $stuname = $request['stuname'];
        $stuid = $request['stuid'];
        $companyname = $request['companyname'];
        $vp = $request['vp'];
        $ranking = $request['ranking'];
        $signuptime = $request['signuptime'];
        $scale = $request['scale'];
        $url = $request['url'];

        $data = Company::Tzlcompany($grade,$major,$class,$stuname,$stuid,$companyname,$vp,$ranking,$signuptime,$scale,$url);
        if (is_error($data)){
            return json_fail('添加双创之星失败！',$data,100);
        }else{
            return json_success('添加双创之星成功！',$data,200);
        }
    }
    public function Tzlgetcompany(){
        $stuid = auth('api')->user()->stuid;
        $data=Company::Tzlgetcompany($stuid); //使用学号参数
        if (is_error($data)){
            return json_fail('获取双创之星失败！',100);
        }else{
            return json_success('获取双创之星成功！',200);
        }
    }
    public function Tzleditcompany(Request $request){
        $id = $request['id'];
        $companyname = $request['companyname'];
        $vp = $request['vp'];
        $ranking = $request['ranking'];
        $signuptime = $request['signuptime'];
        $scale = $request['scale'];
        $url = $request['url'];

        $datate = Company::Findcompany($id);

        if ($datate == 0){
            $data= Company::Tzleditcompany($id,$companyname,$vp,$ranking,$signuptime,$scale,$url);
            if (is_error($data)){
                return json_fail('修改双创之星失败！',100);
            }else{
                return json_success('修改双创之星成功!',200);
            }
        }
        return json_fail('该表单已经审批过！',100);
    }
    public function TzlgetreasonShuangc(){

    }
    public function Tzldelete(){

    }
}
