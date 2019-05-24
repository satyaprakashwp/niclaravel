<?php

namespace App\Http\Controllers;

use App\Scholar;
use Illuminate\Http\Request;
use App\Models\tbl_parent_info;
use App\Models\tbl_children_releation;
use App\Models\tbl_parents_releation;
use Goutte\Client;
use Response;
use DB;

class ScholarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {

      DB::table('tbl_parent_info')->truncate();
      DB::table('tbl_children_releation')->truncate();
      DB::table('tbl_parents_releation')->truncate();
 

        $html = file_get_contents('https://neurotree.org/neurotree/peopleinfo.php?pid=985');

        $pokemon_doc = new \DOMDocument();
        libxml_use_internal_errors(TRUE); 

        if(!empty($html))
        { 
            $pokemon_doc->loadHTML($html);
            libxml_clear_errors();   
            $pokemon_xpath = new \DOMXPath($pokemon_doc);
            $pokemon_row = $pokemon_xpath->query("//*[contains(@class, 'leftcol')]//div[1]//div[1]//tr/td/a/@href");

            if($pokemon_row->length > 0)
            {
                foreach($pokemon_row as $row)
                {
                  $datalink = $row->nodeValue;
                  $id       = explode("=", $datalink);
                    if(is_numeric($id['1']))
                    {
                      $this->ParentInfo($id['1']);
                    } 
                }
            }
        }
        //tbl_parent_info::parent_info();

    }

  /*......................... Parent informeation save...................*/

     public function ParentInfo($id)
     {
        $client    = new\Goutte\Client();
        $crawler   = $client->request('GET', 'https://neurotree.org/neurotree/peopleinfo.php?pid='.$id);
        $fullname  = $crawler->filter('.personinfo h1')->text();  
        $location  = $crawler->filter('.personinfo tr')->text();
        //$Website   = $crawler->filter('.boxinline a[href]')->eq(1)
                                                                 //->text('href');
          if ($crawler->filter('.boxinline img[src]')->count() > 0 ) 
            {
              $imageLink = $crawler->filter('.boxinline img[src]')
                                    ->attr('src');
              $imgName = 'css/'.basename($imageLink);
            }else
            {
              $imageLink =0;

            }

        $location  = explode(":", $location); 

        $data      = array('name'   =>trim($fullname), 
                           'address' =>trim($location[1]),
                           'status'  =>0, 
                           'image_name' => trim($imageLink),
                         );

        $dublicateParent = tbl_parent_info::DublicateParentInfo($data);

          if(empty($dublicateParent))
          {
             $lastInsertedID = tbl_parent_info::parent_info($data);
            
              $this->ParentChildrenInfo($id,$lastInsertedID);
          }
      }

/*......................... Children informeation save...................*/


    public function ParentChildrenInfo($idd,$parentId)
      {
          $html          = file_get_contents("https://neurotree.org/neurotree/peopleinfo.php?pid=".$idd."");
          $pokemon_doc   = new \DOMDocument();
          libxml_use_internal_errors(TRUE); 
          $pokemon_doc->loadHTML($html);
          libxml_clear_errors(); 
          $pokemon_xpath = new \DOMXPath($pokemon_doc);
          $pokemon_row1  = $pokemon_xpath->query("//*[contains(@class, 'leftcol')]//div[2]//div[1]//tr/td/a/@href");
          foreach ($pokemon_row1 as $value) 
          {
              $datalink = $value->nodeValue;
              $id       = explode("=", $datalink);                 
              if(is_numeric($id['1']))
              {                
                  $clientChildren    = new\Goutte\Client();
                  $crawlerChildren   = $clientChildren->request('GET', 'https://neurotree.org/neurotree/peopleinfo.php?pid='.$id['1']);
                  $children          = $crawlerChildren->filter('.personinfo h1')->text();
                  $children_location = $crawlerChildren->filter('.personinfo tr')->text();
                  $children_location = explode(":", $children_location); 

              if ($crawlerChildren->filter('.boxinline img[src]')->count() > 0) 
                      {
                        $imageLink = $crawlerChildren->filter
                                           ('.boxinline img[src]')->attr('src');
                      }else
                      {
                        $imageLink =0;
                      }

                  $child_recourd     = array('people_id'=>trim($parentId), 
                    'children_name'=>trim($children), 'address' =>
                     trim($children_location[1]), 'image_name' => 
                       trim($imageLink));
                   
                    //print_r($child_recourd); exit;
                  $childreanid    =     tbl_children_releation::
                                        children_releation($child_recourd);

                  $this->ParentChildrenParentInfo($id['1'], $childreanid,
                    $parentId);                           
              }  
          }      
      }

  /*............  Parent to children informeation save ...................*/
      
    public function ParentChildrenParentInfo($iddd,$chlidrenid,$parentid)
    {
      $html         = file_get_contents("https://neurotree.org/neurotree/peopleinfo.php?pid=".$iddd."");
      $pokemon_doc  = new \DOMDocument();
      libxml_use_internal_errors(TRUE); 
      $pokemon_doc->loadHTML($html);
      libxml_clear_errors(); 
      $pokemon_xpath3 = new \DOMXPath($pokemon_doc);
      $pokemon_row3   = $pokemon_xpath3->query("//*[contains(@class, 'leftcol')]//div[1]//div[1]//tr/td/a/@href");
      foreach ($pokemon_row3 as $value) 
      {
        $datalink3 = $value->nodeValue;
        $id        = explode("=", $datalink3);
            if(is_numeric($id['1']))
            {
                      $clientParents        = new\Goutte\Client();
                      $crawlerParents       = $clientParents ->request('GET', 'https://neurotree.org/neurotree/peopleinfo.php?pid='.$id['1']);
                      $parents_releation    = $crawlerParents->filter('.personinfo h1')->text(); 

                      $parents_location     = $crawlerParents->filter('.personinfo tr')->text();
                      $parents_location     = explode(":", $parents_location); 
                      $quo  = "'";
                      $parents_address  = $parents_location[1];
                       //print_r($parents_location[1]); exit;

                       if ($crawlerParents->filter('.boxinline img[src]')
                                          ->count() > 0) 
                          {
                            $imageLink = $crawlerParents->filter
                                               ('.boxinline img[src]')->attr('src');
                          }else
                          {
                            $imageLink =0;
                          }

                        $parents = array('super_parent_id'=>trim($parentid),
                                          'children_id'=>trim($chlidrenid), 
                      'parents_name'=>trim('". $parents_releation."'), 
                      'address' => "'". $parents_address ."'",
                      'image_name' =>"'". $imageLink ."'");

                      //$dublicateParentChildrenParentInfo =
                      //tbl_parents_releation::dublicateParentChildrenParent($parents);

                if(empty($dublicateParentChildrenParentInfo))
                {
                 $lastInsertedID = tbl_parents_releation::parent_to_children_releation($parentid, $chlidrenid, 
                  $parents_releation, $parents_address, $imageLink);
                   
                  
                }
            }
      }   
    }
}
