<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home_model;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
         $id   = trim($req->pid);
         $id   = explode("=", $id);
         
        $data = array(
             'author' => Home_model::home_author(), 

       'collaborators' => Home_model::collaborators(),

       'publications'  => Home_model::publications()
        );
      /* echo "<pre>";
       print_r($data); exit;*/

       //return view('home1', $author, $collaborators, $publications]);
       return view('home1')->with('data', $data);
    }

   
}
