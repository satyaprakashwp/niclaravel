<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbl_scholar extends Model
{
    protected $fillable    = ['parent_id', 'links', 'citations', 'year','title', 
                              'publication'];
    protected $table       = "tbl_scholar";
    
    public    $timestamps  = false;

    static public function Add_tbl_scholar($data)
    {
      
      $scholar = new tbl_scholar($data);

      if($scholar->save())
      {
         return true;
      }else
      {
      	return false;
      }
      
    }
}
