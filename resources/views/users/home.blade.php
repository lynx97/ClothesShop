
@extends('layouts.bg_user')

@section('content')

    <!-- Page Content -->
    <div class="container">
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
      
      <!-- /.row -->

      <!-- Portfolio Section -->
      <div id="seachResult" class="row">
        
      </div>
      
      <h2 style="margin:7px;">Sản phẩm nổi bật</h2>

      <div class="row">
        @foreach( $products as $product)
          <div class="col-lg-3 col-sm-6 ">
            <div class="card h-100">
              <a href="{{ url('product/' . $product->id) }}"><img class="card-img-top" src="{{ asset('img/products/' . $product->product_image) }}" alt="product" height="250">
                <div class="card-body">
                  <h5 class="card-title">
                    {{ $product->product_name }}
                  </h5>
                  <?php 
                    $sub = substr($product->product_price,-3);
                    $pre = substr($product->product_price,0,-3);
                    $price = $pre . '.' .$sub;
                  ?>
                  <small class="text-muted">
                    <p class="card-text" style="color: red"><b>Price: </b>{{ $price }} Đ</p>
                    <p class="card-text"><b>SL đã đặt hàng: </b>{{ $product->orders->count() }}</p>  
                  </small>
                  
                </div>
              </a>
              
            </div>

          </div>
        @endforeach
        
      </div>
      <!-- /.row -->

      {{ $products->links() }}

      <hr>

      

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <script type="text/javascript">
      $('#search').keyup( function(){
        $value = $(this).val();
        $.ajax({
          type : 'get',
          url : '{{URL::to("search")}}',
          data:{'search': $value},
          success:function(data){
            $('#seachResult').html(data);
          }
        });
      });
    </script>
@endsection
