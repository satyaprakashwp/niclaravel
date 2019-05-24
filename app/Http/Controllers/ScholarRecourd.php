<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_scholar;
use App\Models\tbl_coauthors;
use App\LogIn;
use Goutte\Client;
use Response;
use DB;


class ScholarRecourd extends Controller
{
  
      public function citations(Client $client)
      { 
        
           DB::table('tbl_scholar')->truncate();
           $crawler = $client->request('GET', 'https://scholar.google.com/citations?user=JicYPdAAAAAJ&hl=en');

            echo "<pre>"; 
            print_r($crawler); exit;
            
            $page = $crawler->filter('#gsc_art #gsc_lwp #gsc_a_nn')->text();
            //$authorImage = $crawler->filter('#gsc_prf_pu img[src]')
                                   //->attr('src');
            
            $sno  = explode("–", $page);

            $name = $crawler->filter('#gsc_a_tw tbody tr')->each(function
             ($node) {
             
            $link = $node->filter('a[data-href]')->first()->attr('data-href');
            //print_r($link); exit;
            $link = "https://scholar.google.com".$link;
            //print_r($link); exit;
            $author = $node->filter('td div')->text();
            $authorName = explode(',', $author);
        
            foreach ($authorName as $value) 
            {
                if(trim($value) == "GE Hinton")
                {
                     $title = $node->filter('td a')->text();
                     $citedBy = $node->filter('td a')->eq(1)->text();
                     $year = $node->filter('td')->eq(2)->text();
                    
    /* ......................PUBLICATION ............................*/
    
                    $client1      = new\Goutte\Client();
                    $crawler1     = $client1->request('GET', $link);
                    
                    $publication  = $crawler1->filter('#gsc_vcd_table 
                                                      .gs_scl .gsc_vcd_value')
                                             ->filter('div')
                                             ->eq(6)
                                             ->text();
                    echo "<pre>"; 
                    print_r($publication); exit;
    /* ..............................................................*/

                     $data = array('parent_id'=>"1446", 'links'=>trim($link), 
                           'citations'=>$citedBy, 'year'=>$year, 
                           'title' =>$title, 'publication' => $publication);

                     echo "<pre>";
                     echo json_encode($data);
                     

                     //$scholar = tbl_scholar::Add_tbl_scholar($data);
                  }
            }
        });
            exit;
         $allLink = $this->showmoreSecondRecourd($sno['1']);
         if($allLink)
         {
           echo "thank"; exit;
         }
    }

     public function showmoreSecondRecourd($id)
     {
        //echo $id; exit;
        $client   = new\Goutte\Client();
        $crawler  = $client->request('GET', 'https://scholar.google.com/citations?user=JicYPdAAAAAJ&amp;hl=en&cstart='.$id.'&pagesize=100');
        $page = $crawler->filter('#gsc_art #gsc_lwp #gsc_a_nn')->text();
        $sno1 = explode("–", $page);
        $name = $crawler->filter('#gsc_a_tw tbody tr')->each(function ($node) {
            
            $link = $node->filter('a[data-href]')->first()->attr('data-href');

            $link = "https://scholar.google.com".$link;

            $author = $node->filter('td div')->text();
            $authorName = explode(',', $author);
            foreach ($authorName as $value) 
            {
                if(trim($value) == "GE Hinton")
                {
                        $title = $node->filter('td a')->text();
                        $citedBy = $node->filter('td a')->eq(1)->text();
                        $year = $node->filter('td')->eq(2)->text();

/* ......................PUBLICATION ............................*/
    
                    $client1      = new\Goutte\Client();
                    $crawler1     = $client1->request('GET', $link);
                    $publication  = $crawler1->filter('#gsc_vcd_table 
                                                      .gs_scl .gsc_vcd_value')
                                             ->filter('div')
                                             ->eq(6)
                                             ->text();
                    /*echo "<pre>"; 
                    print_r($publication); exit;*/
    /* ..............................................................*/


                      $data = array('parent_id'=>"1446", 'links'=>trim($link), 
                              'citations'=>$citedBy, 'year'=>$year, 
                               'title' =>$title, 'publication' => $publication);

                       
                      $scholar = tbl_scholar::Add_tbl_scholar($data);

                }
            }
          
        });
          if($sno1['1'])
          {
            $this->showmoreSecondRecourd($sno1['1']);
          }
      }

  


   public function coauthors(Client $client)
      { 

        $html = file_get_contents('https://scholar.google.com/citations?user=JicYPdAAAAAJ&hl=en');

        $pokemon_doc = new \DOMDocument();
        libxml_use_internal_errors(TRUE); 

        if(!empty($html))
        { 
            $pokemon_doc->loadHTML($html);
            libxml_clear_errors();   
            $pokemon_xpath = new \DOMXPath($pokemon_doc);
            $emailFilter   = $pokemon_xpath->query("//*[contains(@id, 'gsc_prf')]//div[3]/a/@href");
            {
              foreach($emailFilter as $emailhref)
                {
                    $getUrl    = $emailhref->nodeValue;
                }
        // ................ Single Email id get ................

                  $Emailhtml = file_get_contents($getUrl);
                   
                  $pokemon_doc1 = new \DOMDocument();
                  libxml_use_internal_errors(TRUE); 

                  $pokemon_doc1->loadHTML($Emailhtml);
                  libxml_clear_errors();   
                  
                  $pokemon_obj = new \DOMXPath($pokemon_doc1);
                  $emailFilterId   = $pokemon_obj->query("//table");
                  {
                     foreach($emailFilterId as $getEmail)
                        {
                            $getEmailId    = $getEmail->nodeValue;
                        }
                        
                        $getEmailId = explode(":", $getEmailId);
                        $getEmailId1= explode("com", $getEmailId[1]);
                        $repDot =str_replace("[dot]",".",$getEmailId1[0]);
                        $repAt =str_replace("[at]", "@", $repDot);
                        $repSpace =str_replace(" ", "", $repAt);
                        $repEmail= trim($repSpace).'com';
                  }

            }

            // ................ End Single Email id get ................


              $pokemon_row   = $pokemon_xpath->query("//div/ul/li/div/span[2]/a");
              {
                $allData=array();
                foreach($pokemon_row as $row)
                {
                   $Coauthors    = $row->nodeValue;
                   $allData[]    = $Coauthors;

                  $data = array('parent_id'=>"1446", 
                        'coauthor_name'=>trim($Coauthors), 'status'=>'enable',
                         'email'=>$repEmail);

                   $DubCoauthors = tbl_coauthors::DubCoauthors($Coauthors);
                  
               if(empty($DubCoauthors))
                   {
                       tbl_coauthors::AddCoauthors($data);
                       /*DB::table('tbl_coauthors')->insert(['parent_id'=>
                       "1446",'coauthor_name'=>trim($Coauthors), 'status'=>
                       "enable", 'email'=>$repEmail]);*/
                   }
                }
               //print_r($allData); exit;
                //$arr = $this->CheckDublication($allData); 
            }
        }     
    }

 

    

    public function CheckDublication($allData)
    {
    /*  echo "<pre>"; 
      print_r($allData); exit;*/
        $data=DB::table('tbl_coauthors')->get();
  
        if($data['0'])
        {
          
           foreach ($data as $value) 
            {
              
               for($i=0; $i<count($allData); $i++)
               {
                 $sucess = 0;
                
                  if(trim($value->coauthor_name) !== trim($allData[$i]))
                    {
                      $sucess = $allData[$i]. ' '. $value->coauthor_name;
                      echo $sucess; exit;
                    }
               }

               if(isset($sucess))
                 {
                   echo $sucess; exit;
                  DB::table('tbl_coauthors')->where('id', $value->id)->delete();

                 }
            }
        }
    }
    
}