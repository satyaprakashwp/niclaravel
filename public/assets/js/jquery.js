
setTimeout( function(){ $('#error-message').hide(); $("#error-message").remove(); } , 4000);


function input_search_affiliation()
 {
    var name     = $('#txt-Search2').val();
    var myLength =  jQuery("#txt-Search2").val().length;

    if(name){
     if(myLength >=2){
      $.ajax({ 
        type : "GET",
        url  : "search-signup-affiliation",
        data : { name: name},
        success: function(data){
              $("#suggest-alert2").show();
              $("#suggest-alert2").html(data);
              $("#txt-Search2").css("background","#FFF");
              }
           });
        }
    }
}

function selectNameHeader(val) {
$("#txtSearch").val(val);
$("#suggesstion-box").hide();
}
function selectName(val) {
$("#txtSearch").val(val);
$("#suggesstion-box").hide();

}

     /* Show University Section Start*/

      function check_univ_first(){
            var radio = $('input[name=optradio]:checked').val();
            var univ  = $('#university').val();
            var dep   = $('#department').val();
            var topa  = $('#topicArea').val();

           if(radio == 'Yes'){
              if(! univ && ! dep && ! topa){ 
                                 
                $('#univ').show();
                $('#dept').show();
                $('#topa').show();
             }else if(! univ){
                 $('#univ').show();
                 $('#topa').hide(); 
                 $('#dept').hide();
             }else if(! dep){
                 $('#dept').show();
                 $('#topa').hide();
                 $('#univ').hide();
             }else if(! topa){
                 $('#topa').show();
                 $('#univ').hide();
                 $('#dept').hide();
             }else{
                 $('#second-slide').show();
                 $('#first-slide').hide();
             }
            
          }else{
                 $('#second-slide').show();
                 $('#first-slide').hide();
                 
          }    
     }

           /* Show Company Section Start*/

      function check_comp_second(){
            var aiml         = $('input[name=aiml]:checked').val();
            var company      = $('#company').val();
            var department   = $('#com-department').val();
            var jobtitle     = $('#jobtitle').val();

           if(aiml == 'Yes'){
              if(! company && ! department && ! jobtitle){ 
                                 
                $('#jobt').show();
                $('#com-dept').show();
                $('#comp').show();
             }else if(! company){
                 $('#comp').show();
                 $('#com-dept').hide();
                 $('#jobt').hide();
             }else if(! department){
                 $('#com-dept').show();
                 $('#comp').hide();
                 $('#jobt').hide();
             }else if(! jobtitle){
                 $('#jobt').show();
                 $('#comp').hide();
                 $('#com-dept').hide();
             }else{
                 $('#third-slide').show();
                 $('#first-slide').hide();
                 $('#second-slide').hide();
             }
            
          }else{
                 $('#third-slide').show();
                 $('#first-slide').hide();
                 $('#second-slide').hide();
                
          }
     }
        
        /* Show City Section Start*/
      function check_city_third(){
            
            var univ  = $('#university').val();
            var dep   = $('#department').val();
            var topa  = $('#topicArea').val();

            var company   = $('#company').val();
            var com_dep   = $('#com-department').val();
            var jobtitle  = $('#jobtitle').val();

            var city     = $('#city').val();
            var country  = $('#country').val();
            var cnt_id   = country.split("&&");

            var state    = $('#state').val(); 
            var weburl   = $('#weburl').val();
            var giturl   = $('#giturl').val();

           
              if(! city && ! cnt_id[1]){            
                $('#city-error').show();
                $('#country-error').show();
                
             }else if(! city){
               $('#city-error').show();
               $('#country-error').hide();

             }else if(! cnt_id[1]){
               $('#country-error').show();
               $('#city-error').hide();

             }else{

               window.location = '/create-profile-sub?univ=' +univ + '&&dep=' + dep + '&&topa=' + topa + '&&company=' + 
               company + '&&com_dep=' + com_dep + '&&jobtitle=' + jobtitle  + '&&city=' + city + '&&state=' + state + '&&country=' 
               + cnt_id[1] + '&&weburl=' + weburl + '&&giturl=' + giturl;     
              }
          } /* End Create your Profile*/

         /* Fetch All State Name */
          function select_state_name(){

            var country_id  = $('#country').val();
            var cnt_id      = country_id.split("&&");
               //alert("Dddddd" + cnt_id[0]); exit;

               $.ajax({
                 type: "GET",
                 url: "fetch-state-name",
                 data: { country_id: cnt_id[0]},
                 success: function(data){
                  //alert(data);
                    $("#state").html(data);
                    
                   }
              });
          }    /* End All State Name */


    /*Publication Search */

  $(document).ready(function()
  {
      $("#txtSearchs").keyup(function(){
          publication_details();  
      });

      $("#txtSearchsBTns").click(function(){
       
          publication_details();
          
      });


  });

 function publication_details() {
        var name     = $('#txtSearchs').val(); 
        var pid      = $('#txtSearchs1').val();
        
        var myLength =  jQuery("#txtSearchs").val().length;
        //alert(name + pid);
        if(myLength >=2){ 
             $.ajax({
                    type: "GET",
                    url: "search-title",
                    data: { search_title: name, pid:pid },
                    success: function(data){ 
                      //alert(data);

                    if(data){
                      $("#second-pub").show();
                      $(".table").hide();
                      $("#second-pub").html(data);
                   }
                }
            });
          }
          if(myLength == 0){
            //alert(myLength);
             $("#second-pub").hide();
             $(".table").show();
          }
    } /* End Publication Search */


/*   search header   */

$(document).ready(function(){
    $("#author_search").keyup(function(){
        var name     = $('#author_search').val(); 
        var myLength =  jQuery("#author_search").val().length;
               
    if(myLength >=2){ 
        $.ajax({
                type: "GET",
                url: "search-header",
                data: { name: name},
        success: function(data){
          //alert(data);

            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#txtSearch").css("background","#FFF"); 
            $("#message-header").css("display", "none");
            $("#header-msg-one").css("display", "none");
           }
        });
      }
    });
});

 function select_affiliation_name(val) {
  
    $("#txt-Search2").val(val);
    $("#suggest-alert2").hide();
   }

function selectmyprofile(val) {
  
    $("#author_search").val(val);
    $("#suggesstion-box").hide();
   }









function countryName()
  {
   var id = $('#country').val();
   //alert(id);
   $.ajax({
          type  : "GET",
          url   :"selectCountry",
          data  : {id: id},
        success : function(data)
          {
            //alert(data);
             $('#state').html(data);
          }
   });
}


/*   search Profile  */
function input_search_profile()
{
  var name     = $('#txt-Search1').val();
  var myLength =  jQuery("#txt-Search1").val().length;
  if( myLength >=2){
   $.ajax({

      type: "GET",
      url : "search-home-profile",
      data: { name: name},
    success: function(data){
          $("#suggest-alert").show();
          $("#suggest-alert").html(data);
          $("#txt-Search1").css("background","#FFF");
          $("#profile_msg").css("display", "none");
          $("#suggest-alert2").css("display", "none");
          $("#suggesstion-box").css("display", "none");

         }
       });
  }
}

function selectNameprofile(val) {
    $("#txt-Search1").val(val);
    $("#suggest-alert").hide();
    //window.location.href = "search-profile-link?pid=" + val;
    }

     /*   search Network  */

  function input_search_network()
  {
     var name     = $('#txt-Search2').val();
     var myLength =  jQuery("#txt-Search2").val().length;
      
    if(name){
     if(myLength >=2){
      $.ajax({
        type : "GET",
        url  : "search-home-network",
        data : { name: name},
        success: function(data){

                  $("#suggest-alert2").show();
                  $("#suggest-alert2").html(data);
                  $("#txt-Search2").css("background","#FFF");
                  $("#message").css("display", "none");
                  $("#network-msg-one").css("display", "none");
                  $("#suggest-alert").css("display", "none");
                  $("#suggesstion-box").css("display", "none");
                }
           });
         }
      }
  }

  function selectNamenetwork(val) {
    $("#txt-Search2").val(val);
    $("#suggest-alert2").hide();
    //window.location.href = "search-network-link?pid=" + val;
   }

    function myProfile(){

       var name     = $('#fullname').val();
       var myLength =  jQuery("#fullname").val().length;

      if(name){
       if(myLength >=2){
        $.ajax({
          type : "GET",
          url  : "search-my-profile",
          data : { name: name},
          success: function(data){
                $("#suggest-alert3").show();
                $("#suggest-alert3").html(data);
                $("#fullname").css("background","#FFF");
                $("#message-one").css("display", "none");
                $("#message-two").css("display", "none");
                }
             });
           }
        }

   /*  var fname     = $('#fname').val();
     var lname     = $('#lname').val();
      if(fname == "")
      { 
         $("#firstname").html("Please enter first name.");
      }else if(lname == "")
      {
        $("#lastname").html("Please enter last name.");
      }else{

      $.ajax({
        type : "GET",
        url  : "my-profile",
        data : { fname: fname, lname: lname},
        success: function(data){

                 if(data){
                  $("#success-alert").css("display", "block");
                     $("#popup").html(data);
                  }else{
                    $("#success-alert").show();  
                  }
              }
           });
      }*/
    }








   
