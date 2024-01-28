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
Route::post('YyhUserregister',[YyhController::class,'YyhUserregister']);//注册用户
Route::post('YyhUserLogin',[YyhController::class,'YyhUserLogin']);//登录用户
Route::post('Yyhemail',[YyhController::class,'Yyhemail']);//邮箱发送
Route::middleware('jwt.role:userss')->prefix('user')->group(function () {
    Route::get('YyhSelectnianji',[YyhController::class,'YyhSelectnianji']);//查询年级
    Route::post('logoutUser',[YyhController::class,'logoutUser']);//登出用户
    Route::get('YyhSelectnianji',[YyhController::class,'YyhSelectzhunaye']);//查询专业
    Route::get('YyhSelectnianji',[YyhController::class,'YyhSelectbanji']);//查询班级
    Route::get('YyhSelectJingsai',[YyhController::class,'YyhSelectJingsai']);//查询竞赛之星
    Route::get('YyhSelectShuangchuang',[YyhController::class,'YyhSelectShuangchuang']);//查询双创
    Route::get('YyhSelectSic',[YyhController::class,'YyhSelectSic']);//查询科研
    Route::post('YyhDeleteJingsai',[YyhController::class,'YyhDeleteJingsai']);//删除竞赛
    Route::post('YyhDeleteShuangchuang',[YyhController::class,'YyhDeleteShuangchuang']);//删除双创
    Route::post('YyhDeleteSic',[YyhController::class,'YyhDeleteSic']);//删除科研
});
Route::middleware('jwt.role:admins')->prefix('admin')->group(function () {
    Route::post('YyhSucceedJingsai',[YyhController::class,'YyhSucceedJingsai']);//审批成功竞赛
    Route::post('YyhSucceedShuangc',[YyhController::class,'YyhSucceedShuangc']);//审批成功双创
    Route::post('logoutAdmin',[YyhController::class,'logoutAdmin']);//登出管理员
    Route::post('YyhSucceedSic',[YyhController::class,'YyhSucceedSic']);//审批成功科研
    Route::post('YyhFailJingsai',[YyhController::class,'YyhFailJingsai']);//审批失败竞赛
    Route::post('YyhFailShuangc',[YyhController::class,'YyhFailShuangc']);//审批失败双创
    Route::post('YyhFailSic',[YyhController::class,'YyhFailSic']);//审批失败科研
    Route::post('YyhExcelJingsai',[YyhController::class,'YyhExcelJingsai']);//导出excel竞赛
    Route::post('YyhExcelShuangc',[YyhController::class,'YyhExcelShuangc']);//导出excel双创
    Route::post('YyhExcelSic',[YyhController::class,'YyhExcelSic']);//导出excel科研
});






