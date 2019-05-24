@extends ('../admin.adminLayout.index') 
@section ('content')

<?php
  /*echo "<pre>@@@@";
  print_r($data->id);
  exit;*/

?>
<div class="content-wrapper">
    <section class="content-header">
     <h1>
       Update Profile
        <small>Control panel</small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="{!! URL::to('/dashboard') !!}">
           <i class="fa fa-dashboard"></i> Home</a></li>
       <li class="active">Dashboard</li>
     </ol>
    </section>
       <div class="col-md-5 col-md-offset-4" style="color:red; padding: 30px;">
            @if(session()->has('error'))
               {!! session()->get('error') !!}
            @endif
        </div>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <!-- general form elements -->

          <div class="box box-primary">

            <div class="box-header with-border">

              <h3 class="box-title">Update Profile</h3>

            </div>

            <!-- /.box-header --> 

            <!-- form start -->

            {!! Form::open(['url' => '/update-profile', 'enctype' => 'multipart/form-data']) !!}
              <div class="box-body">
                <div class="form-group">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Username</label>
                   {!! Form::text('username', $data->username, ['class' => 'form-control', 'placeholder' => 'Enter Username'])!!}

                   {!! Form::hidden('id', $data->id, ['class' => 'form-control']) !!}
          
                    <div class="error">  
                        @if($errors->has('username'))
                           <b> {{ $errors->first('username') }} </b>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Email Id</label>
                   {!! Form::email('email', $data->email, ['class' => 'form-control','placeholder' => 'Enter Email Id']) !!}
                 
                     <div class="error">  
                        @if($errors->has('email'))
                           <b> {{ $errors->first('email') }} </b>
                        @endif
                    </div>
                </div>

               <div class="form-group">
                  <label for="exampleInputFile">Password</label>
                  {!! Form::password('password', ['class' => 'form-control','placeholder' => 'Enter Password']) !!}

                 {!! Form::hidden('old_pass', $data->password, ['class' => 'form-control']) !!}

                  <!--  <div class="error">  
                        @if($errors->has('password'))
                           <b> {{ $errors->first('password') }} </b>
                        @endif
                    </div> -->
               </div>

                <div class="form-group">
                  <label for="exampleInputFile">Image</label>
                   {!! Form::file('image', ['class' => 'form-control']) !!}
                   {!! Form::hidden('profile_image', $data->image, ['class' => 'form-control']) !!}
                  <p class="help-block"></p> 
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                {!! Form::submit('Submit', ['class' =>'btn btn-primary']) !!}
              </div>
            {!! Form::close() !!}

             <center>

               <a href="{!! Url('/instagram') !!}" class="btn btn-info">Instagram account</a>
               
               <?php
        use Abraham\TwitterOAuth\TwitterOAuth;
   if (empty(session()->get('access_token'))) { 
          
         $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
        /*$_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];*/
        session()->put('oauth_token', $request_token['oauth_token']);
        session()->put('oauth_token_secret', $request_token['oauth_token_secret']);
        //echo "ffffffffffffff" . session()->get('oauth_token_secret'); exit;
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

        echo "<a href='$url' class='btn btn-info'>Twitter account</a>";

     }
               ?>
            </center>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

@endsection