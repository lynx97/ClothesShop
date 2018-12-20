@extends('layouts.bg_user')


@section('content')
	
	<div class="container bootstrap snippet">
		@if($errors->any())
          <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{$errors->first()}}</strong>
          </div>
        @endif
        @if(session()->has('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ session('success') }}</strong>
          </div>
        @endif
    <div class="row">

  		<div class="col-md-3 text-md-center"><h1>{{ Auth::user()->username }}</h1></div>
    	
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              

      <div class="text-center">
        <img src="{{ asset('storage/' . Auth::user()->user_image) }}" class="avatar img-circle img-thumbnail" alt="avatar">
      </div></hr><br> 
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Quản lý <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong><a href="{{ url('users/'. Auth::user()->id )}}">Thông tin cá nhân</a></strong>
            <li class="list-group-item text-right"><span class="pull-left"><a href="{{ url('order_history') }}">Đơn hàng của tôi</a></span> {{ Auth::user()->orders->count() }}</li>
            
          </ul> 
               
          
        </div><!--/col-3-->

        <div class="col-sm-9">
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a href="#profile" class="nav-link active" data-toggle="tab"><i class="fa fa-address-book"></i> Profile </a>
				</li>

				<li class="nav-item">
					<a href="#update" class="nav-link" data-toggle="tab"><i class="fa fa-cog"></i> Update</a>
				</li>
				<li class="nav-item">
					<a href="#reset" class="nav-link" data-toggle="tab">Reset Password</a>
				</li>
				
			</ul>
			<div class="tab-content">
				<div id="profile" class="container tab-pane active"><br/>
              		<div class="form-group row">
					    <label for="email" class="col-sm-4 col-form-label"><h4>Email</h4></label>
					    <div class="col-sm-8">
					      <input type="text" readonly class="form-control-plaintext" id="email" value="{{ Auth::user()->email }}">
					    </div>
					</div>
					<div class="form-group row">
					    <label for="first_name" class="col-sm-4 col-form-label"><h4>Họ tên</h4></label>
					    <div class="col-sm-8">
					      <input type="text" readonly class="form-control-plaintext" id="first_name" value="{{Auth::user()->last_name .' '. Auth::user()->first_name }}">
					    </div>
					</div>
					<div class="form-group row">
					    <label for="user_phone" class="col-sm-4 col-form-label"><h4>SĐT</h4></label>
					    <div class="col-sm-8">
					      <input type="text" readonly class="form-control-plaintext" id="user_phone" value="{{ Auth::user()->user_phone }}">
					    </div>
					</div>
					<div class="form-group row">
					    <label for="user_address" class="col-sm-4 col-form-label"><h4>Địa chỉ</h4></label>
					    <div class="col-sm-8">
					      <input type="text" readonly class="form-control-plaintext" id="user_address" value="{{ Auth::user()->user_address }}">
					    </div>
					</div>					
					
				</div>
				<div id="update" class="container tab-pane fade"><br/>
					<form class="form" action="{{ url('users/'.Auth::user()->id ) }}" method="post" id="registrationForm" enctype="multipart/form-data">
						@method('PUT')
						@csrf
		                <script>
		                  $(document).ready(function() {
		                      var brand = document.getElementById('logo-id');
		                      brand.className = 'attachment_upload';
		                      brand.onchange = function() {
		                          document.getElementById('fakeUploadLogo').value = this.value.substring(12);
		                      };

		                      // Source: http://stackoverflow.com/a/4459419/6396981
		                      function readURL(input) {
		                          if (input.files && input.files[0]) {
		                              var reader = new FileReader();
		                              
		                              reader.onload = function(e) {
		                                  $('.img-preview').attr('src', e.target.result);
		                              };
		                              reader.readAsDataURL(input.files[0]);
		                          }
		                      }
		                      $("#logo-id").change(function() {
		                          readURL(this);
		                      });
		                  });
		                </script>
		                <style>
		                  
		                  .btn-danger {
		                      background-color: #B73333;
		                  }

		                  /* File Upload */
		                  .fake-shadow {
		                      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
		                  }
		                  .fileUpload {
		                      position: relative;
		                      overflow: hidden;
		                  }
		                  .fileUpload #logo-id {
		                      position: absolute;
		                      top: 0;
		                      right: 0;
		                      margin: 0;
		                      padding: 0;
		                      font-size: 33px;
		                      cursor: pointer;
		                      opacity: 0;
		                      filter: alpha(opacity=0);
		                  }
		                  .img-preview {
		                      width: 350px;
		                      height: 350px;
		                  }
		                </style>
		                <div>
		                    <h3 class="">Preview an image before it is uploaded</h3>
		                    <hr />
		                    <div class="text-center">
		                      <div class="form-group">
		                            <div class="align-items-md-center">
		                              <img class="rounded-circle img-preview" src="{{ asset('img\products\noimagefound.png')}}" title="Preview Logo">
		                            </div>
		                            <div>
		                              <input id="fakeUploadLogo" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled" name="product_image">
		                              <br>
		                              <div class="fileUpload btn btn-danger fake-shadow">
		                                <span><i class="fa fa-upload"></i> Upload load </span>
		                                <input id="logo-id" name="logo" type="file" class="attachment_upload">
		                              </div>
		                              
		                            </div>
		                            
		                      </div>
		                    </div>
		                </div>
	                  	<div class="form-group">  
	                      	<div class="col-xs-6">
	                          	<label for="email"><h4>Email</h4></label>
	                          	<input type="email" class="form-control" name="email" id="email" value="{{Auth::user()->email }}" name="email" title="enter your email.">
	                      	</div>
	                  	</div>
	                  	<div class="form-group">
	                      	<div class="col-xs-6">
	                          	<label for="username"><h4>User name</h4></label>
	                          	<input type="text" class="form-control" name="username" id="username" value="{{Auth::user()->username }}" name="username" title="enter your user name if any." required>
	                      	</div>
	                  	</div>
	                  	<div class="form-group">
	                      	<div class="col-xs-6">
	                          	<label for="first_name"><h4>First name</h4></label>
	                          	<input type="text" class="form-control" name="first_name" id="first_name" value="{{Auth::user()->first_name }}" name="first_name" title="enter your first name if any." required>
	                      	</div>
	                  	</div>
	                 	<div class="form-group">  
	                    	<div class="col-xs-6">
	                        	<label for="last_name"><h4>Last name</h4></label>
	                          	<input type="text" class="form-control" name="last_name" id="last_name" value="{{Auth::user()->last_name }}" name="last_name" title="enter your last name if any." required>
	                      	</div>
	                  	</div>
	      
	                  	<div class="form-group">
	                      	<div class="col-xs-6">
	                          	<label for="phone"><h4>Phone Number</h4></label>
	                          	<input type="number" class="form-control" name="user_phone" id="phone" value="{{Auth::user()->user_phone }}" name="user_phone" title="enter your phone number if any." required>
	                      	</div>
	                  	</div>
	                  	
	                  	
	                  	<div class="form-group">
	                      	<div class="col-xs-6">
	                          	<label for="location"><h4>Location</h4></label>
	                          	<input type="text" class="form-control" name="user_address" id="location" value="{{Auth::user()->user_address }}" name="user_address" title="enter a location" required>
	                      	</div>
	                  	</div>
	                  	
	                  	<div class="form-group">
	                       <div class="col-xs-12">
	                            <br>
	                          	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
	                           	<button class="btn btn-lg btn-secondary" type="reset" name="reset">Reset</button>	
	                        </div>
	                  	</div>
	          		</form>
				</div>
				<div id="reset" class="container tab-pane fade">
					<form action="{{ url('changePassword') }}" id="changePass" name="changePass">
						@csrf
						<input type="hidden" value="{{ Auth::user()->id }}" name="id" id="id">
	                  	<div class="form-group">
	                      	<div class="col-xs-6">
	                          	<label for="new_password"><h4>New Password</h4></label>
	                          	<input type="password" class="form-control" name="new_password" id="new_password"  required>
	                      	</div>
	                  	</div>
	                  	<div class="clearfix" style="height: 10px;clear: both;"></div>


	                  	<div class="form-group">
	                      	<div class="col-xs-6">
	                          	<label for="new_confirm"><h4>Retype new password</h4></label>
	                          	<input type="password" class="form-control" name="new_confirm" id="new_confirm" required>
	                      	</div>
	                  	</div>
						<div class="clearfix" style="height: 10px;clear: both;"></div>

	                  	<div class="form-group">
	                       <div class="col-xs-12">
	                            <br>
	                          	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Cập nhật</button>
	                        </div>
	                  	</div>
					</form>
						
				</div>	

				<!-- end id profile -->
			</div>
        </div><!--/col-9-->
    </div><!--/row-->
	<br>
	<br>
	<script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
    <script type="text/javascript">
      
      jQuery().ready(function() {

        // validate form on keyup and submit
        var v = jQuery("#changePass").validate({
          rules: {
            
            new_password: {
              required: true,
              minlength: 6,
              maxlength: 15,
            },
            new_confirm: {
              required: true,
              minlength: 6,
              equalTo: "#new_password",
            }

          },
          errorElement: "span",
          errorClass: "help-inline-error",
        });

       

      });
    </script>
@endsection