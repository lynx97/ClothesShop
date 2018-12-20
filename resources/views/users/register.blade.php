@extends('layouts.auth_user')

@section('content')
    <!-- append rather overwriting -->
    @parent
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <style>
        .card{
            margin-top: 60px;
        }
      ul#stepForm, ul#stepForm li {
        margin: 0;
        padding: 0;
      }
      ul#stepForm li {
        list-style: none outside none;
      } 
      label{margin-top: 10px;}
      .help-inline-error{color:red;}
    </style>
    <div class="card">
        <div class="card-header">
          <h3 class="panel-title">Complete this form in quick 3 steps!  <a  href="{{ url('home') }}" class="btn btn-primary float-right"><i class="fa fa-home"></i> Home</a></h3>
        </div>
        <div class="card-body">
          <form name="basicform" id="basicform" enctype="multipart/form-data" method="post" action="{{ url('users') }}">
            @csrf
            @if($errors->any())
              <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{$errors->first()}}</strong>
              </div>
            @endif

            <div id="sf1" class="frm">
              <fieldset>
                <legend>Step 1 of 3</legend>

                <div class="form-group">
                  <label class="col-lg-2 control-label" for="uname">User Name: </label>
                  <div class="col-lg-6">
                    <input type="text" placeholder="User Name" id="uname" name="username" class="form-control" autocomplete="off" required value="{{ old('username') }}">
                  </div>
                </div>
                <div class="clearfix" style="height: 10px;clear: both;"></div>

                
                <div class="form-group">
                  <label class="col-lg-2 control-label" for="fname">First Name: </label>
                  <div class="col-lg-6">
                    <input type="text" placeholder="First Name" id="fname" name="first_name" class="form-control" autocomplete="off" value="{{ old('first_name') }}" required>
                  </div>
                </div>
                <div class="clearfix" style="height: 10px;clear: both;"></div>

                <div class="form-group">
                  <label class="col-lg-2 control-label" for="lname">Last Name: </label>
                  <div class="col-lg-6">
                    <input type="text" placeholder="Last Name" id="lname" name="last_name" class="form-control" autocomplete="off" value="{{ old('last_name') }}" required>
                  </div>
                </div>
                <div class="clearfix" style="height: 10px;clear: both;"></div>

                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button class="btn btn-primary open1" type="button">Next <span class="fa fa-arrow-right"></span></button> 
                  </div>
                </div>

              </fieldset>
            </div>

            <div id="sf2" class="frm" style="display: none;">
              <fieldset>
                <legend>Step 2 of 3</legend>


                <div class="form-group">
                  <label class="col-lg-2 control-label" for="uphone">User phone: </label>
                  <div class="col-lg-6">
                    <input type="number" min="0" placeholder="Your Phone" id="uphone" name="user_phone" class="form-control" autocomplete="off" value="{{ old('user_phone') }}" required>
                  </div>
                </div>
                <div class="clearfix" style="height: 10px;clear: both;"></div>
  
                <div class="form-group">
                  <label class="col-lg-2 control-label" for="uaddress">User address: </label>
                  <div class="col-lg-6">
                    <input type="text" placeholder="Your address" id="uaddress" name="user_address" class="form-control" autocomplete="off" value="{{ old('user_address') }}" required>
                  </div>
                </div>
                <div class="clearfix" style="height: 10px;clear: both;"></div>

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
                <div class="col-md-6">
                    <h3 class="">Xem trước</h3>
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
                                <span><i class="fa fa-upload"></i> Tải lên</span>
                                <input id="logo-id" name="logo" type="file" class="attachment_upload">
                              </div>
                              
                            </div>
                            
                      </div>
                    </div>
                </div>
                

                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button class="btn btn-warning back2" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                    <button class="btn btn-primary open2" type="button">Next <span class="fa fa-arrow-right"></span></button> 
                  </div>
                </div>

              </fieldset>
            </div>

            <div id="sf3" class="frm" style="display: none;">
              <fieldset>
                <legend>Step 3 of 3</legend>
                
                  <div class="form-group">
                    <label class="col-lg-2 control-label" for="uemail">Your email: </label>
                    <div class="col-lg-6">
                      <input type="email" placeholder="Your Email" id="uemail" name="email" class="form-control" autocomplete="off" value="{{ old('email') }}">
                    </div>
                  </div>
                  <div class="clearfix" style="height: 10px;clear: both;"></div>
                  

                  <div class="form-group">
                    <label class="col-lg-2 control-label" for="upass1">Password: </label>
                    <div class="col-lg-6">
                      <input type="password" placeholder="Your Password" id="upass1" name="password" class="form-control" autocomplete="off">
                    </div>
                  </div>
                  <div class="clearfix" style="height: 10px;clear: both;"></div>

                  <div class="form-group">
                    <label class="col-lg-2 control-label" for="upass2">Confirm Password: </label>
                    <div class="col-lg-6">
                      <input type="password" placeholder="Confirm Password" id="upass2" name="confirmed" class="form-control" autocomplete="off">
                    </div>
                  </div>
                  <div class="clearfix" style="height: 10px;clear: both;"></div>


                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                    <input class="btn btn-primary open3" type="submit" name="Submit"></input> 
                  </div>
                </div>
              </fieldset>
            </div>
          </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
    <script type="text/javascript">
      
      jQuery().ready(function() {

        // validate form on keyup and submit
        var v = jQuery("#basicform").validate({
          rules: {
            username: {
              required: true,
              minlength: 2,
              maxlength: 16
            },
            email: {
              required: true,
              minlength: 2,
              email: true,
              maxlength: 100,
            },
            password: {
              required: true,
              minlength: 6,
              maxlength: 15,
            },
            confirmed: {
              required: true,
              minlength: 6,
              equalTo: "#upass1",
            }

          },
          errorElement: "span",
          errorClass: "help-inline-error",
        });

        $(".open1").click(function() {
          if (v.form()) {
            $(".frm").hide("fast");
            $("#sf2").show("slow");
          }
        });

        $(".open2").click(function() {
          if (v.form()) {
            $(".frm").hide("fast");
            $("#sf3").show("slow");
          }
        });
        
        // $(".open3").click(function() {
        //   if (v.form()) {
        //     $("#basicform").html('<h2>Thanks , and back home to login.</h2>');
        //   }
        // });
        
        $(".back2").click(function() {
          $(".frm").hide("fast");
          $("#sf1").show("slow");
        });

        $(".back3").click(function() {
          $(".frm").hide("fast");
          $("#sf2").show("slow");
        });

      });
    </script>
@endsection



