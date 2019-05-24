<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentReleation extends Model
{
    protected $fillable = ['super_parent_id', 'children_id', 'parents_name', 
                            'address'];
    protected $table    = "tbl_parents_releation";

    public $timestamps = false;

   
}
