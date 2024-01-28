<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $table = "competition";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function Yyhchaxun_a($id){

        try {
            $data = Competition::where('id', $id)->select('reason')->get();

            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }


    }
    public static function Yyhsahnchu_a($id){

        try {
            $data = Competition::where('id', $id)->delete();

            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }

    }
    public static function YyhSucceed_a($id){

        try {
            $data = Competition::where('id', $id)->update(['state' => '1']);

            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }

    }
    public static function Yyhfail_a($id){

        try {
            $data = Competition::where('id', $id)->update(['state' => '2']);

            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }
    public static function Yyhtian_a($id,$reason){

        try {
            $data = Competition::where('id', $id)->update(['reason' => $reason]);

            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }

    }


}
