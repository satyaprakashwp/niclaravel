@extends ('layouts.app') 
@section ('content')
<div class="alistgear_wrapper">
   <div class="container">
     <div class="alistgear_main_wrapper">
      <header>   
       <!--  <div class="header">
          <div class="logo">
            <a href="{!! Url('/') !!}"><img src="{!! URL::to('/public/assets/images/logo.png') !!}"></a>
          </div>  
        </div>   --> 
      </header>

      <div class="alistgear_main">

        <div class="alistgear_section_main">
          <div class="alistgear_section_signin1">
            <div class="col-md-4 col-md-push-4 alistgear_section-card-login">
              <div class="alistgear_section_card_signIn">
                <span>
                  <h1>                    
                    <small>Create Your</small>
                    Profile
                  </h1>
                  <div class="mainError" id="error-message">
                    @if(session()->has('success'))
                        <?php echo session()->get('success'); ?>       
                    @elseif(session()->has('error'))
                       <?php echo session()->get('error'); ?>            
                   @endif
                  </div>
                </span>
               <!--  <div class="line_border"></div>  -->              
                  <div class="card-body">

                   {!! Form::open(['url' =>'create-account-submit', 'autocomplete' =>'off', 
                   'enctype' => 'multipart/form-data']) !!}
                  
                      <div class="form-group row">                        
                        <div class="col-md-12">
                          <!--  <label class="label_text">Full Name</label> -->
                          {!! Form::text('username', '', ['class'=>'form-control', 'id' => 'username', 'placeholder' => 'Username']) !!}
                        </div>
                        <div class="error">  
                            @if($errors->has('username'))
                               <b> {{ $errors->first('username') }} </b>
                            @endif
                        </div>
                      </div>

                      <div class="form-group row">                        
                        <div class="col-md-12">
                           <!-- <label class="label_text">Email id</label> -->
                          {!! Form::email('email', '', ['class'=>'form-control', 'id' => 'email_address', 'placeholder' => 'Email Id']) !!}
                        </div>
                         <div class="error">  
                            @if($errors->has('email'))
                               <b> {{ $errors->first('email') }} </b>
                            @endif
                        </div>
                      </div>

                       <div class="form-group row">                       
                        <div class="col-md-12">
                          <!--  <label class="label_text">Password</label> -->
                          {!! Form::password('password', ['class'=>'form-control', 'id' => 'password', 'placeholder' => 'Password']) !!}
                        </div>                     
                        <div class="error">
                          @if($errors->has('password'))
                           <b> {{ $errors->first('password') }} </b>
                          @endif
                        </div>
                       </div>

                       <div class="form-group row">                       
                          <div class="col-md-12">
                            <!--  <label class="label_text">Confirm Password</label> -->
                             {!! Form::file('image', ['class'=>'form-control', 'id' => 'image']) !!}
                          </div>
                          <div class="error">
                              @if($errors->has('image'))
                               <b> {{ $errors->first('image') }} </b>
                              @endif
                         </div>
                      </div>
                       
                      <div class="login_card_footer">
                       <div class="alistgear_bt login_bt">
                         {!! Form::submit('Create Your Profile', ['class'=>'btn btn_get-strated']) !!}
                      </div>
                      <!-- <a href="#" class="forgot">
                        Forgot Your Password?
                      </a> -->
                    </div>
                  {!! Form::close() !!}
                </div>

              </div>
              <div class="sign-up mb-4 mt-4">Already have an account? <a href="{!! URL('/signin') !!}"> Sign In </a></div>
            </div>

          </div>
        </div>        
      </div>
    </div>
  </div>
</div>

@endsection
