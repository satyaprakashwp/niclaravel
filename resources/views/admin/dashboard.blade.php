@extends ('../admin.adminLayout.index') 
@section ('content')

<?php
/*echo "<pre>";
print_r($allrecord['twitter']); exit;*/

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
     <h1>
        Dashboard
       <small>Control panel</small>
     </h1>
        <ol class="breadcrumb">
         <li><a href="{{ Url('dashboard') }}">
             <i class="fa fa-dashboard"></i> Home</a></li>
           <li class="active">Dashboard</li>
          </ol>
   </section>
        <div class="col-md-5 col-md-offset-4" style="color:green;">
            @if(session()->has('error'))
               {!! session()->get('error') !!}
            @endif
        </div>
    <!-- Main content -->
     <section class="content">
       <!-- Small boxes (Stat box) -->
      <div class="row">
       <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Show Profile User</h3>
            </div>
            <div class="col-md-5 col-md-offset-3">
               @if(session()->has('success'))
                 {!! session()->get('success') !!}
                 @else
                   {!! session()->get('error') !!}
               @endif
             </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
              <tr>
                  <th>Id</th>
                    <th>Username</th>
                     <th>Email Id</th>
                      <th>Image</th>
                    <!--  <th>Action</th> -->
                 </tr>
               </thead>
            <tbody>
                  @if($allrecord['user'][0]->id)
                     <?php $i=1; ?>
                    @foreach($allrecord['user'] as $dispute_recourd)
                    <tr>
                      <td>{!! $i!!}</td>
                       <td>{!! $dispute_recourd->username !!}</td>
                       <td>{!! $dispute_recourd->email !!}</td>
                       <!-- <td>{!! $dispute_recourd->image !!}
                        {!! URL::to('/public/assets/admin/dist/img/user2-160x160.jpg') !!}
                       </td> -->
                     <td> 
                      <img src="{{ './public/assets/profile_image/'.$dispute_recourd->image  }}" 
                      style="height: 100px; width: 100px;">
                     </td>
                        <!--  <td>
                            <a href="#">Edit Profile<a> 
                        </td> -->
                      </tr>
                          <?php $i++; ?>
                       @endforeach
                     @else
                         <center><h4 style="color: red;">Not Recourds Found!</h4></center>
                   @endif
                 </tbody>
               </table>
              </div>
            <!-- /.box-body -->
           </div>
          <!-- /.box -->
        </div>
        <!-- /.row -->
       </section>
      <!-- /.content -->
     <div class="col-sm-6">
          <center><h2> Instagram Records Details</h2></center>
      <table id="example1" class="table table-bordered table-striped dataTable no-footer" 
                 role="grid" aria-describedby="example1_info">
            <thead>
              <tr role="row">
                <th class="sorting_asc" >Id
               </th>
                <th class="sorting">User name
                </th>
                 <th class="sorting">Image</th>
               </tr>
          </thead>

              <tbody>  
                @if($allrecord['instagram'] != 'null')
                @if($allrecord['instagram']['data'][0]['user']['username'])
                <?php $i=1; ?>
                    @foreach($allrecord['instagram']['data'] as $instagram_recourd)  
                    
                    @if($i<=5)
                  <tr role="row" class="odd">
                      <td class="sorting_1">{!! $i!!}</td>
                       <td>{{ $instagram_recourd['user']['full_name'] }}</td>
                       <td> 
                        <img src="{{ $instagram_recourd['images']['thumbnail']['url']}}" style="height: 100px; width: 100px;">
                       </td>
                  </tr>
                  <?php $i++; ?>
                 @endif
                 @endforeach
                @endif
                @else
                      <center><h4 style="color: red;">Not Recourds Found!</h4></center>
              @endif
                </tbody>
         </table>
     </div>
      
       <div class="col-sm-6">
           <center><h2> Twitter Records Details</h2></center>
      <table id="example1" class="table table-bordered table-striped dataTable no-footer" 
                 role="grid" aria-describedby="example1_info">
            @if($allrecord['instagram'] != 'null')
                <tr role="row" class="odd">
                      <td class="sorting_1">1</td>
                      <td class="sorting_1">{!! $allrecord['twitter']->status->text !!} <br><i>
                        {!! $allrecord['twitter']->status->created_at !!}</i></td>  
                </tr>
            @else
            <center><h4 style="color: red;">Not Recourds Found!</h4></center> <br>
           @endif
        </table>
     </div>
   </div>
   <!-- /.content-wrapper -->
@endsection