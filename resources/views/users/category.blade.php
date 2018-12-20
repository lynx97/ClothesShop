
@extends('layouts.bg_user')

@section('content')

    <!-- Page Content -->
    <div class="container">
      <!-- /.row -->

      <!-- Portfolio Section -->
      <h4><a href="{{ url('home') }}">Trang chủ</a> <i class="text-info fa fa-angle-right"></i> {{ $category->category_name }}</h4>
      	<div class="row">
	        @foreach( $category->products as $product)
		        <div class="col-lg-4 col-sm-6 portfolio-item">
		            <div class="card h-100">
		              <a href="{{ url('product/' . $product->id) }}"><img class="card-img-top" src="{{ asset('img/products/' . $product->product_image) }}" alt="product" height="350">
		                <div class="card-body">
		                  <h4 class="card-title">
		                    {{ $product->product_name }}
		                  </h4>
		                  <?php 
		                    $sub = substr($product->product_price,-3);
		                    $pre = substr($product->product_price,0,-3);
		                    $price = $pre . '.' .$sub;
		                  ?>
		                
		                  <p class="card-text" style="color: red"><b>Giá: </b>{{ $price }} Đ</p>
		                  <p class="card-text"><b>Đánh giá: </b>{{ $product->product_rate}}</p>
		                </div>
		              </a>
		            </div>
		        </div>
	        @endforeach
	        
      	</div>
      

      <hr>

      

    </div>
    <!-- /.container -->
    
@endsection
