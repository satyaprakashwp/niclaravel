<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class tbl_parent_info extends Model
{
    protected $fillable = ['pid', 'name', 'address', 'image_name'];
    protected $table    = "tbl_parent_info";
    public $timestamps  = false;


        static public function DublicateParentInfo($data)
         {
         	
	        $user = DB::table('tbl_parent_info')->where($data)->first();

	        if($user)
	        {
	           return true;
	        }else
	        {
	          return false;
	        }
         } 

	   static public function parent_info($data)
	   {

		   	$parent = New tbl_parent_info($data);
		   	
		   	if($parent->save())
		   	{
	          $lastInsertedID = $parent->id;
	          return $lastInsertedID;
		   	}
	   }
}



