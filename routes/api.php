<?php

use App\Http\Controllers\TzlController;
use App\Http\Controllers\ZlController;
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
