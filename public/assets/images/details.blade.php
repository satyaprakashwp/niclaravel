@extends ('layouts.app') 
@section ('content')

<?php
 /*echo "<pre>@@@@@";
 print_r($data); exit;*/
?>
<style type="text/css">
  .twPc-avatarLink1 {
    border-radius: 6px;
    display: inline-block !important;
    float: left;
    margin: -75px 5px 0 8px;
    max-width: 100%;
    padding: 1px;
    vertical-align: bottom;
}
/*#firstgrandChildren{
  display: block !important;
}*/
.f{
  background-color: yellow;
}
.b{
  border-bottom: 3px solid yellow;
  overflow: hidden;
}
</style>
<?php //echo "<pre>"; print_r($data); exit; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<section class="profile-detail">
  <div class="twPc-div">
    @if(!empty($data['personalRecourd']['record']->cover_image))
         @if($data['personalRecourd']['record']->cover_image == 'NULL')
           <img src="../public/assets/images/profile-bg.png" class="twPc-bg twPc-block">
         @else
           <img src="../public/assets/banner/{{ $data['personalRecourd']['record']->cover_image }}" class="twPc-bg twPc-block">
         @endif
       
    @else
       <img src="../public/assets/images/profile-bg.png" class="twPc-bg twPc-block">
    @endif
   <!--  <a class="twPc-bg twPc-block"></a> -->
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="profile-dp">
            <a title="abc" href="#" class="twPc-avatarLink">
              @if($data['personalRecourd']['record']->image_name)
              @if(strpos($data['personalRecourd']['record']->image_name, 
              "https://neurotree.org") !== false)

              <img alt="abc" 
              src="{!! $data['personalRecourd']['record']->image_name !!}" 
              class="twPc-avatarImg">
              @elseif(strpos($data['personalRecourd']['record']->image_name, 
              "http://www.cns.nyu.edu") !== false)
              <img alt="abc" 
              src="{!! $data['personalRecourd']['record']->image_name !!}" 
              class="twPc-avatarImg">
              @else
                @if($data['personalRecourd']['record']->image_name == 'NULL')
                 echo "@@@@@"; 
                @else
                 <img alt="abc" src="../public/assets/images/{!! $data['personalRecourd']['record']->image_name !!}" class="twPc-avatarImg">
                @endif
              
              @endif
              @else
              <img alt="abc" src="{!! URL::to('public/assets/images/Ellipse-36.png') !!}" class="twPc-avatarImg">

              @endif 
            </a>
          </div>
          <div class="twPc-divUser">
            <div class="twPc-divName">
            {!! $data['personalRecourd']['record']->name !!}
            </div>
            <div class="prifile-des-detail">
              <p>{!! $data['personalRecourd']['record']->address !!}
                @if($data['personalRecourd']['record']->city != 'NULL')
                   {!! $data['personalRecourd']['record']->city !!} ,
                   {!! $data['personalRecourd']['record']->state !!} , {!! $data['personalRecourd']['record']->country !!}</p>
               @endif
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="exploreBt pull-right">
                    <a href="{{ URL('/check_pin/') }}/<?php echo $data['personalRecourd']['record']->pid; ?>" class=""> 
                        Explore Data 
                   </a> 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-push-2">
        <div class="profile-des-detail">
          <p>

       @if(!empty($data['personalRecourd']['record']->introduction))
             @if($data['personalRecourd']['record']->introduction == 'NULL')
               Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
               Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 

             @else
              {{ $data['personalRecourd']['record']->introduction }}
             @endif
           
      @else
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
    @endif
       </p>
          <a href="#" class="readmorebt">Read More</a>
        </div>

      </div>
    </div>
  </div>
</section>

<section>
  <div class="educational-tm">
    Educational lineage
  </div>
  <div class="educational-li-tm">
    <div class="container">
      @if(isset($data['educationalLineage']))
      <?php 
      if(isset($data['educationalLineage']['parent'])){
          $count_parent = count($data['educationalLineage']['parent']); 
      }else{
          $count_parent = 0;
      }

      if(isset($data['educationalLineage']['children'])){
            $count_children = count($data['educationalLineage']['children']);
      }else{
           $count_children = 0;
      }
      
      ?>
      <div class="row" id="maindiv-slider">
     
        <!--   ----------------------------- End  First Grand Parent ------------------------- -->
        <div class="col-md-3 slide-edu leftside-1" >
          <div class="influenced">
           <?php echo $count_parent; echo "&nbsp";?> PARENTS
          </div>
          
          <ul class="influenced-tree">
            <div class="view-more-tmp-new2" id="upper-icon_tmp" onclick='test_parent_row_up()' style="text-align:center;
                margin-bottom: 20px; display: none;">
                 <a href="javascript:void(0)" class="arrow-tm-bottom"> <i class="fa fa-chevron-up" aria-hidden="true"></i></a>   
           </div>
            <div class="test"> 
            @if(isset($data['educationalLineage']['parent'][0]))
             @foreach($data['educationalLineage']['parent'] as $key=>$parent)
               @if($key < 5)
               <div class="mail" id="topId{!! $key !!}">
                 <li> 
                   <a href="JavaScript:void(0)" class="arrow-tm-lock" id="locks{!! $parent->pid !!}" 
                          onclick='parent_lock({!! $parent->pid !!}, "leftside-1", {!! $key !!});'>
                        <span class="fa fa-unlock"></span>
                   </a>
                    <a href="JavaScript:void(0)" class="user_tm_name" id="lock{!! $parent->pid !!}" onclick='parent_details({!! $parent->pid !!}, "leftside-1");'>
                       <span>{!! $parent->name !!}</span> </a>
                    <a href="JavaScript:void(0)" class="arrow-tm-user">
                        <span class="glyphicon glyphicon-user"></span>
                    </a>
                </li>
                </div>
               @endif

                @if($key >5)
                <div class="mail" id="topId{!! $key !!}" style="display: none;">
                 <li>
                      <a href="JavaScript:void(0)" class="arrow-tm-lock" id="locks{!! $parent->pid !!}" 
                            onclick='parent_lock({!! $parent->pid !!}, "leftside-1", {!! $key !!});'>
                          <span class="fa fa-unlock"></span>
                     </a>
                    <a href="JavaScript:void(0)" class="user_tm_name" id="lock{!! $parent->pid !!}" onclick='parent_details({!! $parent->pid !!}, "leftside-1");'>
                       <span>{!! $parent->name !!}</span> </a>
                    <a href="JavaScript:void(0)" class="arrow-tm-user">
                        <span class="glyphicon glyphicon-user"></span>
                    </a>
                </li>
                </div>
               @endif
                
             @endforeach
            @endif
             @if($count_parent >=5)
              <div class="view-more-tmp-new1" style="text-align:center;">
                 <a href="javascript:void(0)" class="arrow-tm-bottom"> <i class="fa fa-chevron-down" aria-hidden="true"></i></a>   
              </div>
          @endif
        </div>
          </ul>
         
          </div>
          

          <div class="col-md-6 profile-tm slide-edu center" id="firstimage"  onclick='firstimagecenter();'>
            <div class="profile-img-tm  hidden-after">
              <a href="JavaScript:void(0)" class="twPc-avatarLink">
                @if($data['personalRecourd']['record']->image_name)
                  @if(strpos($data['personalRecourd']['record']->image_name, 
                    "https://neurotree.org") !== false)

                    <img alt="abc" src="{!! $data['personalRecourd']['record']->image_name !!}" class="twPc-avatarImg">
                    @elseif(strpos($data['personalRecourd']['record']->image_name, 
                     "http://www.cns.nyu.edu") !== false)
                    <img alt="abc" src="{!! $data['personalRecourd']['record']->image_name !!}" class="twPc-avatarImg">
                  @else
                      @if($data['personalRecourd']['record']->image_name == 'NULL')
                       <img alt="abc" src="{!! URL::to('public/assets/images/Ellipse-36.png') !!}" class="twPc-avatarImg">
                     @else
                       <img alt="abc" src="../public/assets/images/{!! $data['personalRecourd']['record']->image_name !!}" class="twPc-avatarImg">
                     @endif

                   @endif
                  @else
                   <img alt="abc" src="{!! URL::to('public/assets/images/Ellipse-36.png') !!}" class="twPc-avatarImg">
                @endif 
              </a>
               <a href="JavaScript:void(0)" class="user_tm_nameBt">
                <span>{!! $data['personalRecourd']['record']->name !!}</span> </a>
            </div>
          </div>

          <div class="col-md-3 slide-edu rightside-1" id="firstchild">
            <div class="influenced">
             <?php echo $count_children; echo "&nbsp";?> CHILDREN
            </div>
            <ul class="influenced-tree">
               <div class="view-more-tm-new2" id="upper-icon" onclick='test_child_row_up()' style="text-align:center; margin-bottom: 20px; display: none;">
                 <a href="javascript:void(0)" class="arrow-tm-bottom"> <i class="fa fa-chevron-up" aria-hidden="true"></i></a>   
               </div> 
              <div class="test"> 
              
              @if(isset($data['educationalLineage']['children'][0]))
               @foreach($data['educationalLineage']['children'] as $key=>$children)
                 @if($key < 5)
                 <div class="mail active" id="topId{!! $key !!}">
                     <li>
                    <!--  <div class="childrenlock"></div> -->
                     <a href="JavaScript:void(0)" class="arrow-tm-lock" id="locks{!! $children->pid !!}"
                      onclick='children_lock({!! $children->pid !!}, "rightside-1", {!! $key !!});'>
                            <span class="fa fa-unlock"></span>
                         </a>
                          <a href="JavaScript:void(0)" class="user_tm_name" id="lock{!! $children->pid !!}" 
                            onclick='children_details({!! $children->pid !!}, "rightside-1");'> 
                              <span>{!! $children->name !!}</span> 
                         </a>
                         <a href="JavaScript:void(0)" class="arrow-tm-user">
                              <span class="glyphicon glyphicon-user"></span>
                         </a>
                    </li>
                </div>
                 @endif

                  @if($key >5)
                 <div class="mail" id="topId{!! $key !!}" style="display: none;">
                     <li>
                         <a href="JavaScript:void(0)" class="arrow-tm-lock" id="locks{!! $children->pid !!}"
                                       onclick='children_lock({!! $children->pid !!}, "rightside-1", {!! $key !!});'>
                            <span class="fa fa-unlock"></span>
                         </a>
                          <a href="JavaScript:void(0)" class="user_tm_name" id="lock{!! $children->pid !!}" 
                               onclick='children_details({!! $children->pid !!}, "rightside-1");'> 
                              <span>{!! $children->name !!}</span> 
                         </a>
                         <a href="JavaScript:void(0)" class="arrow-tm-user">
                              <span class="glyphicon glyphicon-user"></span>
                         </a>
                    </li>
                </div>
                 @endif
           
                @endforeach 
               @endif
             </div>
               @if($count_children >=5)
              <div class="view-more-tm-new1" onclick='test_child_row_down()' style="text-align:center;">
                 <a href="javascript:void(0)" class="arrow-tm-bottom"> <i class="fa fa-chevron-down" aria-hidden="true"></i></a>   
              </div>
            @endif
            </ul>
             
         </div>
          </div>
        </div>
      </div>
       
        <script type="text/javascript"> 
          jQuery( document ).ready(function() {
                jQuery(".view-more-tm-new1").click(function(){//Down
                
             jQuery('#upper-icon').show();
             if($(".view-more-tm-new1").prev().children()[$(".view-more-tm-new1").prev().children().length-1].classList.length !=2){
               jQuery(this).prev().children("div.active").next().show();
               jQuery(this).prev().children("div.active").next().next().show();
               jQuery(this).prev().children("div.active").next().next().next().show();
               jQuery(this).prev().children("div.active").next().next().next().next().show();
               jQuery(this).prev().children("div.active").next().next().next().next().next().show();

               jQuery(this).prev().children("div.active").hide();
               jQuery(this).prev().children().removeClass("active");
               jQuery(this).prev().children(":visible").addClass("active");
             }
          });
             jQuery(".view-more-tm-new2").click(function(){

                if($(".view-more-tm-new2").next().children()[4].classList.length !=2){
                 jQuery(this).next().children("div.active").prev().show();
                 jQuery(this).next().children("div.active").prev().prev().show();
                 jQuery(this).next().children("div.active").prev().prev().prev().show();
                 jQuery(this).next().children("div.active").prev().prev().prev().prev().show();
                 jQuery(this).next().children("div.active").prev().prev().prev().prev().prev().show();

                 jQuery(this).next().children("div.active").hide();
                 jQuery(this).next().children().removeClass("active");
                 jQuery(this).next().children(":visible").addClass("active");
                }
             });
          });
          
           jQuery( document ).ready(function() {
                jQuery(".view-more-tmp-new1").click(function(){
                
             jQuery('#upper-icon_tmp').show();
             //if($(".view-more-tmp-new1").prev().children()[$(".view-more-tmp-new1").prev().children().length-1].classList.length !=2){
               jQuery(this).prev().children("div.active").next().show();
               jQuery(this).prev().children("div.active").next().next().show();
               jQuery(this).prev().children("div.active").next().next().next().show();
               jQuery(this).prev().children("div.active").next().next().next().next().show();
               jQuery(this).prev().children("div.active").next().next().next().next().next().show();

               jQuery(this).prev().children("div.active").hide();
               jQuery(this).prev().children().removeClass("active");
               jQuery(this).prev().children(":visible").addClass("active");
             //}
          });
             jQuery(".view-more-tmp-new2").click(function(){

                //if($(".view-more-tmp-new2").next().children()[4].classList.length !=2){
                 jQuery(this).next().children("div.active").prev().show();
                 jQuery(this).next().children("div.active").prev().prev().show();
                 jQuery(this).next().children("div.active").prev().prev().prev().show();
                 jQuery(this).next().children("div.active").prev().prev().prev().prev().show();
                 jQuery(this).next().children("div.active").prev().prev().prev().prev().prev().show();

                 jQuery(this).next().children("div.active").hide();
                 jQuery(this).next().children().removeClass("active");
                 jQuery(this).next().children(":visible").addClass("active");
                //}
             });
          });
        
         function parent_lock(parent_id, class_id, topId){

          jQuery("#topId"+topId).click(function() { 
                jQuery(this).parent().prepend(this);
           });
            var yy ="#locks"+parent_id+" span";
            
            $(yy).removeClass();
            $(yy).addClass("glyphicon glyphicon-lock");

            var cid = class_id;
            //alert(cid);
            var class_id        = class_id.split('-');
            var class_id_count  = (parseInt(class_id[1]) + parseInt(1));

            var classid         = class_id[0] ;
            var finalclass = classid+"-"+class_id_count;
            //alert($("."+cid).before().attr('class'));

            var nextclass=$("."+cid).prev().attr('class');
            var cclass= 'col-md-3 slide-edu ' +finalclass;
            //alert(cclass + "====="+nextclass);
            if (nextclass != cclass) {
              $("."+cid).before('<div class="col-md-3 slide-edu ' +finalclass+'"> </div>');
            }

            $('#maindiv-slider').find('.slide-edu:visible').css('display','none');
            $("."+cid).css('display','block');
            $("."+cid).next('.slide-edu:last').css('display','block');
            $("."+cid).prev('.slide-edu:last').css('display','block');
         }


          function parent_details(parent_id, class_id){

             var  id_class = $('#lock'+parent_id).prev().attr('id');
             var  lock_class = jQuery("#"+id_class+" "+"span").attr("class");
             //alert(lock_class); exit;
        if(lock_class != "fa fa-unlock"){

            var cid = class_id;
            var class_id        = class_id.split('-');
            var class_id_count  = (parseInt(class_id[1]) + parseInt(1));

            var classid         = class_id[0] ;
            var finalclass = classid+"-"+class_id_count;
            //alert($("."+cid).before().attr('class'));

            var nextclass=$("."+cid).prev().attr('class');
            var cclass= 'col-md-3 slide-edu ' +finalclass;
            //alert(cclass + "====="+nextclass);
            if (nextclass != cclass) {
              $("."+cid).before('<div class="col-md-3 slide-edu ' +finalclass+'"> </div>');
            }

            $('#maindiv-slider').find('.slide-edu:visible').css('display','none');
            $("."+cid).css('display','block');
            $("."+cid).next('.slide-edu:last').css('display','block');
            $("."+cid).prev('.slide-edu:last').css('display','block');
            //$("#firstgrandChildren").addClass("col-md-3 slide-edu " +finalclass );
     
             $.ajax({
                    type: "GET",
                    url:  "grand-parent",
                    data: { parent_id: parent_id, classid:finalclass},
                    success: function(data){
                        //alert(data);
                      $("."+finalclass).html(data);
                       

                     }
              });
           }
        }

            function firstimagecenter(){
           // $("#firstimage").click(function(){
            $('#maindiv-slider').find('.slide-edu:visible').css('display','none');
            $("#firstimage").css('display','block');
             $("#firstimage").next('.slide-edu:first').css('display','block');
             $("#firstimage").prev('.slide-edu:first').css('display','block');

            //});
           }
     

           function children_lock(child_id, class_id, topId){
            
             jQuery("#topId"+topId).click(function() { 
                jQuery(this).parent().prepend(this);
           });

            var yy ="#locks"+child_id+" span";
            
            $(yy).removeClass();
            $(yy).addClass("glyphicon glyphicon-lock");
         
            var cid = class_id;
            var class_id        = class_id.split('-');
            var class_id_count  = (parseInt(class_id[1]) + parseInt(1));

            var classid         = class_id[0] ;
            var finalclass = classid+"-"+class_id_count;
           
            var nextclass=$("."+cid).next().attr('class');
            var cclass= 'col-md-3 slide-edu ' +finalclass;
              //alert(nextclass+"@@"+cclass);
            
            if (nextclass != cclass) {
              $("."+cid).after('<div class="col-md-3 slide-edu ' +finalclass+'"> </div>');
            }

            $('#maindiv-slider').find('.slide-edu:visible').css('display','none');
            $("."+cid).css('display','block');
             $("."+cid).next('.slide-edu:first').css('display','block');
             $("."+cid).prev('.slide-edu:first').css('display','block');

           }


          function children_details(child_id, class_id){

            var  id_class = $('#lock'+child_id).prev().attr('id');
            var  lock_class = jQuery("#"+id_class+" "+"span").attr("class");
            
        if(lock_class != "fa fa-unlock"){
            
            var cid = class_id;
            var class_id        = class_id.split('-');
            var class_id_count  = (parseInt(class_id[1]) + parseInt(1));

            var classid         = class_id[0] ;
            var finalclass = classid+"-"+class_id_count;
            //alert($("."+cid).next().attr('class'));

            var nextclass=$("."+cid).next().attr('class');
            var cclass= 'col-md-3 slide-edu ' +finalclass;
                        
            if (nextclass != cclass) {
              $("."+cid).after('<div class="col-md-3 slide-edu ' +finalclass+'"> </div>');
            }

            $('#maindiv-slider').find('.slide-edu:visible').css('display','none');
            $("."+cid).css('display','block');
             $("."+cid).next('.slide-edu:first').css('display','block');
             $("."+cid).prev('.slide-edu:first').css('display','block');
                
             $.ajax({
                    type: "GET",
                    url:  "grand-children",
                    data: { child_id: child_id, classid:finalclass},
                    success: function(data){

                      //alert(data); exit;
                      $("."+finalclass).html(data);
                     }
              });
          }
        }
       </script>
      @else
             <center>
               <h3 style="color: red">Not Educational lineage Recourds Found</h3>
             </center>
           @endif
    </section>
   <section>
        <div class="educational-tm">
          Top Collabrators
        </div>
         <div class="educational-li-tm">
          <div class="container">
            
            <div class="row">
              <div id="carousel-example" class="carousel slide team team-web-view" data-ride="carousel">
                <div class="carousel-line">
                  <div class="controls pull-right">
                    <a class="left fa fa-chevron-left btn" href="#carousel-example" data-slide="prev"></a><a class="right fa fa fa-chevron-right btn " href="#carousel-example" data-slide="next"></a>
                  </div>
                </div> 
                <!-- Wrapper for slides -->
                 <div class="carousel-inner">
                 
                @if(isset($data['collaborators'][0]))
                   @foreach(array_chunk($data['collaborators'], 4) as $key =>$coll_record)
                  
                  
                   <div class="item <?php if($key == 0) { echo "active"; } ?>">
                    <div class="row">
                      @foreach($coll_record as $allcoll)
                      <div class="col-sm-3 lrPad">
                        <div class="col-item">
                          <div class="photo-shadow"></div>
                          <div class="photo circle">
                  <?php if($allcoll->image_name != "NULL") { 
                                                       
                         if((strpos($allcoll->image_name,"https://neurotree.org") !== false) || strpos($allcoll->image_name,"http://www.cns.nyu.edu") !== false) { ?>
                                  <img alt="" src="{!! $allcoll->image_name !!}" style="height: 150px; width: 150px;">
                       <?php }else { ?>
                             <img alt="" src="https://neurotree.org{!! $allcoll->image_name !!}" style="height: 150px; width: 150px;">
                         
                       <?php } } else { ?>
                          <img src="{!! URL::to('/public/assets/images/Jeremy Freeman.jpg') !!}"  style="height: 150px; width: 150px;">
                      <?php } ?>
                          </div>
                           <div class="info">
                             <div class="name">
                              {{ $allcoll->name }}
                             </div>
                             <p>{!! $allcoll->address !!}</p>
                              <a href="" class="educational-tm-bt">
                                <span>302</span> Citations
                             </a>
                            <div class="clearfix"></div>
                          </div>
                        </div>
                      </div> 
                      @endforeach              
                    </div>
                  </div>
                   
               @endforeach
             @else
                 <center>
                      <h3 style="color: red">No Collaborators Record Found</h3>
              </center>
           @endif
        </div>
      </div>
    </div>
    
  </div>
</div>
</section>
  <section>
    <div class="educational-tm">
      Videos
    </div>
    <div class="educational-li-tm">
      <div class="container">

        <div class="row">
          <div id="educational-video" class="carousel slide team team-web-view" data-ride="carousel">
            <div class="carousel-line">
              <div class="controls pull-right">
                <a class="left fa fa-chevron-left btn" href="#educational-video" data-slide="prev"></a><a class="right fa fa fa-chevron-right btn " href="#educational-video" data-slide="next"></a>
              </div>
            </div>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
            <?php //echo "<pre>"; print_r($data['videos']); exit; ?>
      @if($data['videos'][0])
          @if($data['videos'][0] != 'NULL')

            @foreach(array_chunk($data['videos'], 3) as $key1 =>$allVideo)
              <div class="item <?php if($key1 == 0) { echo "active"; } ?>">
                <div class="row">
                 @foreach($allVideo as $allVideos1)
              <?php //echo "@@@"; print_r($allVideos1); exit; ?>
                  <div class="col-sm-4 lrPad">
                    <div class="col-item">
                      <div class="photo-shadow"></div>
                      <div class="photo">
                        <iframe id="cartoonVideo" style="width:100%;border:0;" height="200" 

                        src="{!! str_replace("watch?v=","embed/",$allVideos1)  !!}" allowfullscreen="">
                        </iframe>
                      </div>
                      <!-- <div class="info">
                       <p>Mazer | James Lee - IDGAF</p> 
                       <div class="clearfix"></div>
                     </div> -->
                   </div>
                 </div>
                 @endforeach
              </div>
            </div>
               @endforeach
            @else
               <center>
               <h3 style="color: red">No Videos Record Found</h3>
             </center>
            @endif
         @else
             <center>
               <h3 style="color: red">No Videos Record Found</h3>
             </center>
         @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="educational-tm">
    Publications
  </div>
           @if(!empty($data['publications'][0]))
  <div class="educational-li-tm">
    <div class="container">

      <div class="row">
        <div class="col-md-2 padr">
          <label class="publications-tm-title">Search Publications</label>
        </div>
        <div class="col-md-6 padl">
          <div id="imaginary_container" >
            <div class="input-group publicationsearch">
              <input type="text" class="form-control"  placeholder="Type one or more keywords" >
              <span class="input-group-addon">
                <button type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 padr padl">
          <label class="publications-tm-sort">Sort by</label>
          <div id="imaginary_container" >
            <div class="input-group publicationsearch">
              <input type="text" class="form-control"  placeholder="Most Cited" >
              <span class="input-group-addon">
                <button type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-1">
          <label class="publications-tm-sort"><a href="{{ Url('publication/') }}<?php echo '/'.$data['personalRecourd']['record']->pid; ?>">View All</a></label>
        </div>
      </div>
      <div class="row publications-books">
         <section class="education-box">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 profile-edu pad0">
                         <div class="table-responsive">          
                            <table class="table">
                               <thead>
                                        <tr class="f">
                                            <th>YEAR</th>
                                            <th>TITLE</th>
                                            <th>PUBLICATION</th>
                                           <th>CITED BY</th>
                                            <th>LINK</th>
                                        </tr>
                                    </thead>
                                   @if(!empty($data['publications'][0]))
                                    @foreach($data['publications'] as $publication)
                                      <tbody id="body">
                                        <tr class="even">
                                            <td>{{ $publication->year}}</td>
                                            <td>{{ $publication->title}}</td>
                                            <td>{{ $publication->title}}</td>
                                            <td>{{ $publication->cited_by}}</td>
                                            <td><a href="{{ $publication->links}}">
                                                  <img src="{!! URL::to('/public/assets/images/link-icon.png') !!}">
                                                </a>
                                            </td>
                                           
                                        </tr>
                                    </tbody> 
                                    @endforeach
                                    @endif   
                                  </table>
                                  </div>
                                  <!-- 
                        <div class="tm-top-box" style="">
                            <div class="tm-top-box-pub">
                                <table class="table">
                                    <thead>
                                        <tr class="f">
                                            <th>YEAR</th>
                                            <th>TITLE</th>
                                            <th>PUBLICATION</th>
                                           <th>CITED BY</th>
                                            <th>LINK</th>
                                        </tr>
                                    </thead>
                                   @if(!empty($data['publications'][0]))
                                    @foreach($data['publications'] as $publication)
                                      <tbody id="body">
                                        <tr class="even">
                                            <td>{{ $publication->year}}</td>
                                            <td>{{ $publication->title}}</td>
                                            <td>{{ $publication->title}}</td>
                                            <td>{{ $publication->cited_by}}</td>
                                            <td><a href="{{ $publication->links}}">
                                                  <img src="{!! URL::to('/public/assets/images/link-icon.png') !!}">
                                                </a>
                                            </td>
                                           
                                        </tr>
                                    </tbody> 
                                    @endforeach
                                    @endif                           
                                </table>
                            </div>                       
                        </div> -->
                    </div>
                </div>
                <div class="b"></div>
            </div>
        </section>
      </div>
    </div>
  </div>
  @else
    <center><h4 style="color:red;margin-top: 40px; margin-bottom: 40px;">No Publications Record Found!</h4></center> 
 @endif   

</div>
</section>
@endsection
