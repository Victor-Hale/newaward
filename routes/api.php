<?php


use App\Http\Controllers\TzlController;
use App\Http\Controllers\ZlController;
use App\Http\Controllers\YyhController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['jwt.role:users','cors'])->prefix('stu')->group(function () {

});
Route::middleware(['jwt.role:admins','cors'])->prefix('admin')->group(function () {
});
Route::post('YyhAdminregister',[YyhController::class,'YyhAdminregister']);//注册管理员
Route::post('YyhAdminLogin',[YyhController::class,'YyhAdminLogin']);//登录管理员
Route::post('register',[YyhController::class,'YyhUserregister']);//注册用户
Route::post('login',[YyhController::class,'YyhUserLogin']);//登录用户
Route::post('sendemail',[YyhController::class,'Yyhemail']);//邮箱发送

Route::middleware('jwt.role:users')->prefix('user')->group(function () {


Route::middleware('jwt.role:users')->prefix('stu')->group(function () {

    Route::post('logoutUser',[YyhController::class,'logoutUser']);//登出用户
    Route::get('getreasonJingsai',[YyhController::class,'YyhSelectJingsai']);//查询竞赛之星
    Route::get('getreasonShuangc',[YyhController::class,'YyhSelectShuangchuang']);//查询双创
    Route::get('getreasonSic',[YyhController::class,'YyhSelectSic']);//查询科研
    Route::post('deleteJingsai',[YyhController::class,'YyhDeleteJingsai']);//删除竞赛
    Route::post('deleteShuangc',[YyhController::class,'YyhDeleteShuangchuang']);//删除双创
    Route::post('deleteSic',[YyhController::class,'YyhDeleteSic']);//删除科研
    Route::get('getcompetition',[YyhController::class,'getcompetition']);//查询竞赛
    Route::post('submitcompetition',[YyhController::class,'submitcompetition']);//添加竞赛
    Route::post('editcompetition',[YyhController::class,'editcompetition']);//修改竞赛
});
Route::middleware('jwt.role:admins')->prefix('admin')->group(function () {
    Route::post('acceptJingsai',[YyhController::class,'YyhSucceedJingsai']);//审批成功竞赛
    Route::post('acceptShuangc',[YyhController::class,'YyhSucceedShuangc']);//审批成功双创
    Route::post('logoutAdmin',[YyhController::class,'logoutAdmin']);//登出管理员
    Route::post('acceptSic',[YyhController::class,'YyhSucceedSic']);//审批成功科研
    Route::post('refuseJingsai',[YyhController::class,'YyhFailJingsai']);//审批失败竞赛
    Route::post('refuseShuangc',[YyhController::class,'YyhFailShuangc']);//审批失败双创
    Route::post('refuseSic',[YyhController::class,'YyhFailSic']);//审批失败科研
    Route::get('exportlistJingsai',[YyhController::class,'YyhExcelJingsai']);//导出excel竞赛
    Route::get('exportlistShuangc',[YyhController::class,'YyhExcelShuangc']);//导出excel双创
    Route::get('exportlistSic',[YyhController::class,'YyhExcelSic']);//导出excel科研
    Route::get('YyhSelectnianji',[YyhController::class,'YyhSelectzhunaye']);//查询专业
    Route::get('YyhSelectnianji',[YyhController::class,'YyhSelectbanji']);//查询班级
    Route::get('YyhSelectnianji',[YyhController::class,'YyhSelectnianji']);//查询年级
    Route::get('getreasonJingsai',[YyhController::class,'YyhSelectJingsai']);//查询竞赛之星
    Route::get('getreasonShuangc',[YyhController::class,'YyhSelectShuangchuang']);//查询双创
    Route::get('getreasonSic',[YyhController::class,'YyhSelectSic']);//查询科研
});






Route::middleware(['cors'])->prefix('admin')->group(function () {
    Route::get('getlearning',[TzlController::class,'Tzlgetlearning']); //获取进步之星或学习之星
    Route::get('getcompetition',[TzlController::class,'Tzlgetcompetition']); //获取竞赛之星数据
    Route::post('competitionsearch',[TzlController::class,'Tzlcompetitionsearch']); //竞赛之星搜索
    Route::get('getsci',[TzlController::class,'Tzlgetsci']); //获取科研之星数据
    Route::post('scisearch',[TzlController::class,'Tzlscisearch']); //科研之星搜索
    Route::get('getcompany',[TzlController::class,'Tzlgetcompany']); //双创之星数据
    Route::post('companysearch',[TzlController::class,'Tzlcompanysearch']); //双创之星搜索
});
Route::middleware(['cors'])->prefix('stu')->group(function () {
    Route::post('commitcompany',[ZlController::class,'Tzlcommitcompany']); //提交双创之星表单
    Route::get('getcompany',[ZlController::class,'Tzlgetcompany']); //获取个人双创之星表单
    Route::post('editcompany',[ZlController::class,'Tzleditcompany']); //修改双创之星
    Route::get('getreasonShuangc',[ZlController::class,'TzlgetreasonShuangc']); //查询驳回理由
    Route::post('delete',[ZlController::class,'Tzldelete']); //删除某项表单双创
});