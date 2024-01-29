<?php

namespace App\Http\Controllers;

use App\Exports\YourExportClassNameJingsai;
use App\Exports\YourExportClassNameShuangc;
use App\Exports\YourExportClassNameSic;
use App\Models\Admins;
use App\Models\Company;
use App\Models\Competition;
use App\Models\Sci;
use App\Models\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class YyhController extends Controller
{
    protected function YyhAdminHandle($request)   //对密码进行哈希256加密
    {
        $registeredInfo['account'] = $request['account'];
        $registeredInfo['judge'] = $request['judge'];
        $registeredInfo['password'] = bcrypt($request['password']);
        return $registeredInfo;
    }
    protected function YyhUserHandle($request)   //对密码进行哈希256加密
    {
        $registeredInfo['grade'] = $request['grade'];
        $registeredInfo['major'] = $request['major'];
        $registeredInfo['class'] = $request['class'];
        $registeredInfo['stuname'] = $request['stuname'];
        $registeredInfo['stuid'] = $request['stuid'];
        $registeredInfo['email'] = $request['email'];
        $registeredInfo['password'] = bcrypt($request['password']);
        return $registeredInfo;
    }
    public function YyhAdminregister(Request $request){

        $registeredInfo = self::YyhAdminHandle($request);
        $account = $registeredInfo['account'];
        $count = Admins::Yyhchecknumber($account);   //检测账号密码是否存在
        if (is_error($count) == true){
            return json_fail('注册失败!检测是否存在的时候出错啦',$count,100  ) ;
        }
        if ($count == 0){
            $student_id = Admins::YyhcreateUser($registeredInfo);
            if (is_error($student_id) == true){
                return json_fail('注册失败!添加数据的时候有问题',$student_id,100  ) ;
            }
            return json_success('注册成功!',$student_id,200  ) ;
        }
        return json_fail('注册失败!该用户信息已经被注册过了',null,101 ) ;
    }

    public function YyhUserregister(Request $request){

        $registeredInfo = self::YyhUserHandle($request);
        $account = $registeredInfo['stuid'];
        $count = Users::Yyhchecknumber($account);   //检测账号密码是否存在
        if (is_error($count) == true){
            return json_fail('注册失败!检测是否存在的时候出错啦',$count,100  ) ;
        }
        if ($count == 0){
            $student_id = Users::YyhcreateUser($registeredInfo);

            if (is_error($student_id) == true){
                return json_fail('注册失败!添加数据的时候有问题',$student_id,100  ) ;
            }
            return json_success('注册成功!',$student_id,200  ) ;
        }
        return json_fail('注册失败!该用户信息已经被注册过了',null,101 ) ;
    }

    public function YyhAdminLogin(Request $request): JsonResponse
    {
        $credentials['account'] = $request['account'];
        $credentials['password'] = $request['password'];
        $token = auth('admin')->attempt($credentials);
        return $token?
            json_success('登录成功!',$token,  200):
            json_fail('登录失败!账号或密码错误',null, 100 ) ;
    }
    public function YyhUserLogin(Request $request): JsonResponse

    {
        $credentials['stuid'] = $request['stuid'];
        $credentials['password'] = $request['password'];
        $token = auth('user')->attempt($credentials);
        return $token?
            json_success('登录成功!',$token,  200):
            json_fail('登录失败!账号或密码错误',null, 100 ) ;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 邮箱发送
     */
    public function Yyhemail(Request $request): JsonResponse
    {
        $email =  $request['email'];
        $project=Users::Yyhsend($email);
        return $project ?
            json_success('成功',$project,200):
            json_fail('失败',null,100);

    }

    public function YyhSelectnianji(Request $request){
        $data = Users::YyhInquire_a();
        if(is_error($data) == true){
            return json_fail('查询失败',$data,100);
        }else{
            return json_success('查询成功',$data,200);
        }

    }
    public function YyhSelectzhunaye(Request $request){
        $data = Users::YyhInquire_b();

        if(is_error($data) == true){
            return json_fail('查询失败',$data,100);
        }else{
            return json_success('查询成功',$data,200);
        }

    }
    public function YyhSelectbanji(Request $request){
        $data = Users::YyhInquire_c();

        if(is_error($data) == true){
            return json_fail('查询失败',$data,100);
        }else{
            return json_success('查询成功',$data,200);
        }

    }
    public function YyhSelectJingsai(Request $request): JsonResponse
    {


        $id =  $request['form_id'];

            $data = Competition::Yyhchaxun_a($id);
            if(is_error($data) == true){
                return json_fail('查询失败',$data,100);
            }else{
                return json_success('查询成功',$data,200);
            }


    }
    public function YyhSelectShuangchuang(Request $request): JsonResponse
    {


        $id =  $request['form_id'];

            $data = Company::Yyhchaxun_a($id);
            if(is_error($data) == true){
                return json_fail('查询失败',$data,100);
            }else{
                return json_success('查询成功',$data,200);

    }}
    public function YyhSelectSic(Request $request): JsonResponse
    {

        $id =  $request['form_id'];
            $data = Sci::Yyhchaxun_a($id);
            if(is_error($data) == true){
                return json_fail('查询失败',$data,100);
            }else{
                return json_success('查询成功',$data,200);
            }

    }
    public function YyhDeleteJingsai(Request $request): JsonResponse
    {
        $id = $request['form_id'];
        $data = Competition::Yyhsahnchu_a($id);
        if(is_error($data) == true){
            return json_fail('删除失败',$data,100);
        }else{
            return json_success('删除成功',$data,200);
        }

    }
    public function YyhDeleteShuangchuang(Request $request): JsonResponse
    {
        $id = $request['form_id'];
        $data = Company::Yyhsahnchu_a($id);
        if(is_error($data) == true){
            return json_fail('删除失败',$data,100);
        }else{
            return json_success('删除成功',$data,200);
        }

    }
    public function YyhDeleteSic(Request $request): JsonResponse
    {
        $id = $request['form_id'];
        $data = Sci::Yyhsahnchu_a($id);
        if(is_error($data) == true){
            return json_fail('删除失败',$data,100);
        }else{
            return json_success('删除成功',$data,200);
        }

    }
    public function YyhExcelJingsai(Request $request){
        $idsSr = $request['ids'];
        $ids = explode(",", $idsSr);
        return Excel::download(new YourExportClassNameJingsai($ids), 'competition_data.xlsx');

    }
    public function YyhExcelShuangc(Request $request){
        $idsSr = $request['ids'];
        $ids = explode(",", $idsSr);
        return Excel::download(new YourExportClassNameShuangc($ids), 'competition_data.xlsx');

    }
    public function YyhExcelSic(Request $request){
        $idsSr = $request['ids'];
        $ids = explode(",", $idsSr);
        return Excel::download(new YourExportClassNameSic($ids), 'competition_data.xlsx');

    }

    public function YyhSucceedJingsai(Request $request){
        $stateSr = $request['state'];
        $state = (int)$stateSr;
        $id = $request['id'];
        if($state == 0){
            $data = Competition::YyhSucceed_a($id);
            if(is_error($data) == true){
                return json_fail('审批状态修改失败',$data,100);
            }else{
                return json_success('审批状态修改成功',$data,200);
            }
        }elseif ($state == 1){
            return json_fail('已审批',$state,100);
        }
        return json_fail('已审批',$state,100);
    }
    public function YyhSucceedShuangc(Request $request){
        $stateSr = $request['state'];
        $state = (int)$stateSr;
        $id = $request['id'];
        if($state == 0){
            $data = Company::YyhSucceed_b($id);
            if(is_error($data) == true){
                return json_fail('审批状态修改失败',$data,100);
            }else{
                return json_success('审批状态修改成功',$data,200);
            }
        }elseif ($state == 1){
            return json_fail('已审批',$state,100);
        }
        return json_fail('已审批',$state,100);
    }
    public function YyhSucceedSic(Request $request){
        $stateSr = $request['state'];
        $state = (int)$stateSr;
        $id = $request['id'];
        if($state == 0){
            $data = Sci::YyhSucceed_c($id);
            if(is_error($data) == true){
                return json_fail('审批状态修改失败',$data,100);
            }else{
                return json_success('审批状态修改成功',$data,200);
            }
        }elseif ($state == 1){
            return json_fail('已审批',$state,100);
        }
        return json_fail('已审批',$state,100);
    }
    public function YyhFailJingsai(Request $request){

        $id = $request['id'];
        $reason = $request['reason'];
        $data = Competition::Yyhfail_a($id);
        if(is_error($data) == true){
            return json_fail('审批状态修改失败',$data,100);
        }else{
            $data_a = Competition::Yyhtian_a($id,$reason);
            if(is_error($data) == true){
                return json_fail('拒绝理由添加失败',$data_a,100);
            }else{
                return json_success('拒绝理由添加成功',$data_a,200);
            }
        }
    }
    public function YyhFailShuangc(Request $request){

        $id = $request['id'];
        $reason = $request['reason'];
        $data = Company::Yyhfail_b($id);
        if(is_error($data) == true){
            return json_fail('审批状态修改失败',$data,100);
        }else{
            $data_a = Company::Yyhtian_b($id,$reason);
            if(is_error($data) == true){
                return json_fail('拒绝理由添加失败',$data_a,100);
            }else{
                return json_success('拒绝理由添加成功',$data_a,200);
            }
        }
    }
    public function YyhFailSic(Request $request){

        $id = $request['id'];
        $reason = $request['reason'];
        $data = Sci::Yyhfail_c($id);
        if(is_error($data) == true){
            return json_fail('审批状态修改失败',$data,100);
        }else{
            $data_a = Sci::Yyhtian_c($id,$reason);
            if(is_error($data) == true){
                return json_fail('拒绝理由添加失败',$data_a,100);
            }else{
                return json_success('拒绝理由添加成功',$data_a,200);
            }
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * 登出
     */
    public function logoutAdmin(){
        auth('admin')->logout();
        return json_success("用户退出登录成功",null,200);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     * 登出
     */
    public function logoutUser(){
        auth('user')->logout();
        return json_success("用户退出登录成功",null,200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * 添加
     */
    public function submitcompetition(Request $request){
        $grade = $request['grade'];
        $major = $request['major'];
        $class= $request['class'];
        $stuname = $request['stuname'];
        $stuid = $request['stuid'];
        $entryname = $request['entryname'];
        $signuptime = $request['signuptime'];
        $url = $request['url'];

        $data = Competition::YyhCreate($grade,$major,$class,$stuname,$stuid,$entryname,$signuptime,$url);
        if(is_error($data) == true){
            return json_fail('添加失败',$data,100);
        }else{
            return json_success('添加成功',$data,200);
        }
    }
    public function getcompetition(){
        $stuid = auth('user')->user()->stuid;
        $data = Competition::YyhSelect($stuid);
        if(is_error($data) == true){
            return json_fail('查询失败',$data,100);
        }else{
            return json_success('查询成功',$data,200);
        }
    }
    public function editcompetition(Request $request){

        $id = $request['id'];
        $entryname = $request['entryname'];
        $signuptime = $request['signuptime'];
        $url = $request['url'];
        $data = Competition::YyhUpdate($id,$entryname,$signuptime,$url);
        if(is_error($data) == true){
            return json_fail('修改失败',$data,100);
        }else{
            return json_success('修改成功',$data,200);
        }

    }

}
