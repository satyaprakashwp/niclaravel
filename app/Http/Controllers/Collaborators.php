<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\tbl_parent_info;
use App\Models\tbl_children_releation;
use App\Models\tbl_parents_releation;
use Response;
use DB;

class Collaborators extends Controller
{
    public function index(Client $client)
    {

      DB::table('tbl_collaborators')->truncate();
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

              $html = file_get_contents('https://neurotree.org/neurotree/peopleinfo.php?pid='.$id);

                $pokemon_doc = new \DOMDocument();
                libxml_use_internal_errors(TRUE); 

                if(!empty($html))
                { 
                    $pokemon_doc->loadHTML($html);
                    libxml_clear_errors();   
                    $pokemon_xpath = new \DOMXPath($pokemon_doc);
                    $pokemon_row = $pokemon_xpath->query("//*[contains(@class, 'leftcol')]//div[3]//div[1]//tr/td[1]");

                    if($pokemon_row->length > 0)
                    {
                        foreach($pokemon_row as $row)
                        {
                          $collaborators = $row->nodeValue;

                          DB::table('tbl_collaborators')->insert(
                              [ 'pid' =>$id,
                                'collaborators_name' =>trim($collaborators)
                              ]
                            );
                        }
                    }
                }
         
                
          $data     = array(
                            'pid'   => trim($id),
                            'name'   => trim($fullname), 
                            'address' => trim($location[1]),
                            'status'  => 0, 
                            'image_name' => trim($imageLink),
                         );

        $dublicateParent = tbl_parent_info::DublicateParentInfo($data);

          if(empty($dublicateParent))
          {
             $lastInsertedID = tbl_parent_info::parent_info($data);
            
          }
      }

}