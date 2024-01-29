<?php

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
Route::middleware('jwt.role:userss')->prefix('user')->group(function () {
    Route::post('logoutUser',[YyhController::class,'logoutUser']);//登出用户
    Route::get('getreasonJingsai',[YyhController::class,'YyhSelectJingsai']);//查询竞赛之星
    Route::get('getreasonShuangc',[YyhController::class,'YyhSelectShuangchuang']);//查询双创
    Route::get('getreasonSic',[YyhController::class,'YyhSelectSic']);//查询科研
    Route::post('deleteJingsai',[YyhController::class,'YyhDeleteJingsai']);//删除竞赛
    Route::post('deleteShuangc',[YyhController::class,'YyhDeleteShuangchuang']);//删除双创
    Route::post('deleteSic',[YyhController::class,'YyhDeleteSic']);//删除科研
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






