@extends('layouts.bg_admin')

@section('content')
      <div class="card-header">Form update Product</div>
      <form action="{{ url('products/'.$product->id) }}" method="post" enctype="multipart/form-data"> 
        @method('PUT')
        @csrf
        <div class="card-body text-center">
          <div class="row">
            <div class="col-md-6">
            	<input name="product_id" type="hidden" id="id" value="{{$product->id}}">
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_name" type="text" id="name" class="form-control" placeholder="Category name" required="required" autofocus="autofocus" value="{{$product->product_name}}">
                  <label for="name">Product name</label>
                </div>
              </div>

              <div class="form-group">
                <label for="category">Category (select one):</label>
                <select class="form-control" id="category" name="category_id">
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}" <?php echo $category->id == $categoryId ? 'selected' : '' ?>>{{ $category->category_name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_url" type="text" id="url" class="form-control" placeholder="Product url" required="required" autofocus="autofocus" value="{{$product->product_url}}">
                  <label for="url">Product url</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_price" type="number" min="0" id="price" class="form-control" placeholder="Product price" required="required" autofocus="autofocus" value="{{$product->product_price}}">
                  <label for="price">Product Price</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_keyword" type="text" id="keyword" class="form-control" placeholder="Product keyword" required="required" autofocus="autofocus" value="{{$product->product_keyword}}">
                  <label for="keyword">Product Keyword</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_quantity" type="number" min="0" id="quantity" class="form-control" placeholder="Product Quantity" required="required" autofocus="autofocus" value="{{$product->product_quantity}}" min="0">
                  <label for="quantity">Product Quantity</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_condition" type="number" min="0" id="condition" class="form-control" placeholder="Product condition" required="required" autofocus="autofocus" value="{{$product->product_condition}}">
                  <label for="condition">Product Condition</label>
                </div>
              </div>          
              <div class="form-group">
                <div class="form-label-group">
                  <input name="product_content" type="text" id="content" class="form-control" placeholder="Product content" required="required" autofocus="autofocus" value="{{$product->product_content}}">
                  <label for="content">Product Content</label>
                </div>
              </div>

              <div class="form-group">  
	            <div class="form-label-group">
	              <textarea name="product_description" type="text" id="desc" class="form-control" placeholder="Product description" required="required" autofocus="autofocus" rows="5">{{$product->product_description}}</textarea>      
	            </div>
	          </div>

              <div class="card-footer text-right">
              		
  		   	
          		<button type="submit" class="btn btn-success" style="font-size: 30px">Update<i class="fas fa-save"></i></button>
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
                            <img class="rounded-circle img-preview" src="{{ asset('img/products/' . $product->product_image)}}" title="Preview Logo">
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
    	</div>
      </form>
    </div>
            
@endsection