<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Home_model extends Model
{
    protected $fillable =['name', 'area', 'address', 'website_link', 'image_link'];

    public $timestamps  = false;
    protected $table    = "tbl_profile";

    static public function home_author()
    {
          $data['data']= DB::table('tbl_profile')->first();

         if($data['data'])
         {
           return $data['data'];
         }
    }

    static public function collaborators()
    {
    	 $data['data']= DB::table('tbl_parent_info')->get();

         if($data['data'])
         {
           return $data['data'];
         }
    }

    static public function publications()
    {
    	 $data['data']= DB::table('tbl_scholar')->orderBy('id', 'desc')
    	                                            ->take(4)->get();

         if($data['data'])
         {
           return $data['data'];
         }
    }
}
