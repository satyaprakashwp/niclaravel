<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbl_user extends Model
{
	protected $fillable =['username', 'password', 'email', 'image'];

    public $timestamps  = false;
    protected $table    = "tbl_user";
   
	   static function add_register_record($data){
               
                $scholar = new tbl_user($data);

			      if($scholar->save()){
			         return true;
			      }else{
			      	return false;
			      }
	   }
}
