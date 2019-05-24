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
        </div>  -->  
      </header>
       
      <div class="alistgear_main">

        <div class="alistgear_section_main">
          <div class="alistgear_section_signin1">
            <div class="col-md-4 col-md-push-4 alistgear_section-card-login">
              <div class="alistgear_section_card_signIn">
                <span>
                  <h1> Sign In</h1>
                    <div class="mainError" id="error-message">
                        @if(session()->has('success'))
                            <?php echo session()->get('success'); ?>       
                        @elseif(session()->has('error'))
                           <?php echo session()->get('error'); ?>            
                       @endif
                  </div>
                </span>
                <div class="line_border"></div>
                  <div class="card-body">
                    {!! Form::open(['url' =>'sign-sub', 'autocomplete' => 'off']) !!}
                      <div class="form-group row">                        
                        <div class="col-md-12">
                          {!! Form::text('email', '', ['class' => 'form-control', 'id' => 'email_address', 'placeholder' => 'Email']) !!} 
                        </div>
                         <div class="error">
                           @if($errors->has('email'))
                              <b> {{ $errors->first('email') }} </b>
                           @endif                          
                        </div>
                      </div>
                       
                      <div class="form-group row">                       
                        <div class="col-md-12">
                           {!! Form::password('password', ['class'=>'form-control', 'id' => 'password', 'placeholder' => 'Password']) !!}
                        </div>
                         <div class="error">
                           @if($errors->has('password'))
                              <b> {{ $errors->first('password') }} </b>
                           @endif                          
                        </div>
                      </div>
                      
                      <div class="login_card_footer">
                       <div class="alistgear_bt login_bt">
                         {!! Form::submit('Submit',['class'=>'btn btn_get-strated']) !!} 
                      </div>
                     <!--  <a href="#" class="forgot">
                        Forgot Your Password?
                      </a> -->
                    </div>
                  {!! Form::close() !!}
                </div>

              </div>
              <div class="sign-up mb-4 mt-4">Don’t have an account?
                <a href="{{ URL('/signup') }}">  Create a profile </a></div>
            </div>

          </div>
        </div>        
      </div>    
    </div>
  </div>
</div>
@endsection
