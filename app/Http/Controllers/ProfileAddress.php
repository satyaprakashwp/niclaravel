<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Response;
use DB;

class ProfileAddress extends Controller
{
   public function getAddress(Client $client)
   {

       //DB::table('tbl_profile')->truncate();
       $crawler = $client->request('GET', 'https://neurotree.org/neurotree/peopleinfo.php?pid=1446');
        
        $location = $crawler->filter('.personinfo tr')->text();
        $location = explode(":", $location);

        $content   = $crawler->filter('.personinfo')->text();
        $content   = explode(":", $content);
  
        $name = explode("Mean distance", $content[5]);
        $area = explode("Website", $content[2]);
        $website_link = explode("Google", $content[4]);
     
        $data = array('name' => $name[0], 'area' =>$area[0], 
        	    'address' =>$location[1], 'website_link' => 
        	    $website_link[0]);

        DB::table('tbl_profile')->insert($data);

        $this->ImageUpdate();
   }

    public function ImageUpdate()
     {
        $client   = new\Goutte\Client();
        $crawler = $client->request('GET', 'https://scholar.google.com/citations?user=JicYPdAAAAAJ&amp;hl=en');

        //$page = $crawler->filter('#gsc_art #gsc_lwp #gsc_a_nn')->text();
         
         if($crawler->filter('#gsc_prf_pu img[src]')->count() > 0)
         {
           $authorImage = $crawler->filter('#gsc_prf_pu img[src]')
                                   ->attr('src');
          $image =array('image_link' =>"https://scholar.google.com/".$authorImage);
          //print_r($image); exit;
          DB::table('tbl_profile')->update($image);
         }
        
      }
}
