@extends('layouts.bg_admin')

@section('content')
@if (session("admin_status") == 2)
    <div class="card mx-auto mt-10">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{$errors->first()}}</strong>
        </div>
      @endif
      <div class="card-header">Form create Product</div>
      <form action="{{ url('products') }}" method="post" enctype="multipart/form-data"> 
        @csrf
        <div class="card-body text-center">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_name" type="text" id="name" class="form-control" placeholder="Category name" required="required" autofocus="autofocus">
                  <label for="name">Product name</label>
                </div>
              </div>
              <div class="form-group">
                <label for="category">Category (select one):</label>
                <select class="form-control" id="category" name="category_id" >
                  <<option value="">Please choose category</option>}
                  option
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_url" type="text" id="url" class="form-control" placeholder="Product url" required="required" autofocus="autofocus">
                  <label for="url">Product url</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_price" type="number" min="0" id="price" class="form-control" placeholder="Product price" required="required" autofocus="autofocus">
                  <label for="price">Product Price</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_keyword" type="text" id="keyword" class="form-control" placeholder="Product keyword" required="required" autofocus="autofocus">
                  <label for="keyword">Product Keyword</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_quantity" type="number" min="0" id="quantity" class="form-control" placeholder="Product Quantity" required="required" autofocus="autofocus" min="0">
                  <label for="quantity">Product Quantity</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_condition" type="number" min="0" id="condition" class="form-control" placeholder="Product condition" required="required" autofocus="autofocus">
                  <label for="condition">Product Condition</label>
                </div>
              </div>          
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_content" type="text" id="content" class="form-control" placeholder="Product content" required="required" autofocus="autofocus" maxlength="100">
                  <label for="content">Product Content</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
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
              <div class="container">
                  <h3 class="text-center">Preview an image before it is uploaded</h3>
                  <hr />
                  <div>
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
            </div>
            <!-- end col-md-6 -->
          </div>
          <!-- end row -->
          
          <div class="form-group">  
            <div class="form-label-group">
              <textarea name="product_description" type="text" id="desc" class="form-control" placeholder="Product description" required="required" autofocus="autofocus" rows="5"></textarea>      
            </div>
          </div>
        
        </div>
        <div class="card-footer text-right">
          <button type="submit" class="btn btn-success" style="font-size: 30px">   <i class="fas fa-save"> save</i></button>
        </div>
          
      </form>
    </div>
@endif
  <hr>
  <!-- Icon Cards-->
  <div >
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        List Product</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                @if (session("admin_status") == 2)
                <th>Action</th>
                <th></th>
                @endif
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                @if (session("admin_status") == 2)
                <th>Action</th>
                <th></th>
                @endif
              </tr>
            </tfoot>
            <tbody>
              @foreach ($products as $product)
                <tr>
                    <td><img src="{{ asset('img/products/'.$product->product_image) }}" alt="product" width="55px;" height="55px;"></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td>{{ $product->product_price }}</td>
                    @if (session("admin_status") == 2)
                    <td>
                      <form action="products/{{ $product->id }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn text-white bg-danger clearfix small z-1" type="submit">Delete Product     
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <span class="">
                            <i class="fas fa-angle-right"></i>
                          </span>
                        </button>
                      </form>
                    </td>
                    <td>
                      <a class="btn text-white bg-success clearfix small z-1" href="{{ url('products/'.$product->id.'/edit') }}">
                        Update Product     
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="">
                          <i class="fas fa-angle-right"></i>
                        </span>
                      </a>
                    </td>
                    @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      
    </div>
  </div>

  
@endsection