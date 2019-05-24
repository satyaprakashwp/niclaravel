<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbl_children_releation extends Model
{
	protected $fillable =['pid', 'people_id', 'children_name', 'address', 
	                      'image_name'];
	protected $table    = "tbl_children_releation";
	public $timestamps  = false;
    
    static public function children_releation($data)
	   {

		   	$children = New tbl_children_releation($data);
		   	
		   	if($children->save())
		   	{
	          $lastInsertedID = $children->id;
	          return $lastInsertedID;
		   	}
	   }
}
