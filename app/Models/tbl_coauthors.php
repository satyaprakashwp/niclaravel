<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class tbl_coauthors extends Model
{
    protected $fillable =['parent_id', 'email', 'coauthor_name', 'status'];

    public $timestamps  = false;
    protected $table    = "tbl_coauthors";


   static public function DubCoauthors($Coauthors)
    {
        $user = DB::table('tbl_coauthors')->where(['coauthor_name'=>trim($Coauthors)])->first();

        if($user)
        {
           return true;
        }else
        {
          return false;
        }
    }

    static public function AddCoauthors($data)
    {
    	$Coauthors = new tbl_coauthors($data);
    

    	if($Coauthors->save())
    	{
           return true;
    		
    	}else
    	{
    		
           return false;
    	}
    }
}
