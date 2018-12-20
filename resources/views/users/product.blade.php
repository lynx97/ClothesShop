@extends('layouts.bg_user')

@section('content')
	<div class="container-fluid">
		<br>
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
		<h4>{{ $product->product_name}}</h4>
		<hr>
		<div class="row">
			<div class="col-md-4">
				<div class="container text-md-center">
					<img src="{{ asset('img/products/' . $product->product_image ) }}" height="500" width="100%" alt="image product">	
				</div>
			</div>
			<div class="col-md-6">
				<h4>
					<span class="text-danger">Trạng thái: </span>
					@if($product->product_condition == 0 )
						ngừng kinh doanh
					@elseif($product->product_condition == 1)
						đang kinh doanh  
					@elseif($product->product_condition == 2)
						đang hết hàng
					@endif
				</h4>	
				
				<!-- Search Widget -->
		        <div class="card mb-4">
		            <h5 class="card-header">Mô tả</h5>
		            <div class="card-body">
		              <div class="input-group">
		                <h4>{{ $product->product_content }}</h4>
		              </div>
		            </div>
		        </div>
				<input class="form-control" type="hidden" value="{{ $product->product_quantity }}" readonly>
				<br>
				<div class="row">
					<div class="col-md-6">
						<a class="btn btn-warning" style="width: 100%" href="{{ url('shopCarts') }}">Shopping cart</a>
					</div>
					<div class="col-md-6">
						<form action="{{ url('carts') }}" method="post">
							@csrf
							<input type="hidden" name="product_id" value="{{ $product->id }}">
							<button class="btn btn-danger" style="width: 100%" 
							@if($product->product_condition != 1)
								disabled
							@endif

							> Thêm vào giỏ</button>	
						</form>
						
					</div>
				</div>
				
			</div>		
			<div class="col-md-2">
				
			</div>
		</div>

		<hr><br>
		
		<div class="container align-items-md-center">
			<div class="card">
			  <div class="card-header">Thông tin chi tiết</div>
			  <div class="card-body">
			    
			    <p class="card-text" style="font-size: 20px;">{{ $product->product_description }}</p>
			  </div>
			</div>
		</div>
		
		
		
		<div class="comments">
			<div class="comment-wrap">
				<div class="photo">
					@auth
          				<div class="avatar" style="background-image: url('{{ asset('storage/' . Auth::user()->user_image) }}'); background-size: cover;"></div>
        			@endauth
					
				</div>
				<div class="comment-block">
					<form action="{{ url('comments') }}" method="post">
						@csrf
						
						<input type="hidden" name="product_id" value="{{ $product->id }}">
						<div class="form-group">
						  <textarea placeholder="Để lại bình luận của bạn tại đây" name="comment_content" class="form-control" rows="5" id="comment"></textarea>
						</div>
						@auth
							<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
							<button class="btn btn-primary" type="submit"><i class="fa fa-reply"></i> Comment</button> 
						@endauth
					</form>
				</div>
			</div>
			@foreach ($comments as $comment )

				<div class="comment-wrap">
					<div class="photo">
						<div class="avatar" style="background-image: url('{{asset('storage/' . $comment['image']) }}'); background-size: cover;" ></div>
					</div>
					<div class="comment-block">
						<p class="comment-text">{{ $comment['comment_content'] }}</p>
						<div class="bottom-comment">
							<div class="comment-date">{{ $comment['created_at'] }}</div>
								
						</div>
					</div>
				</div>
			@endforeach
			
			
			

		</div>
			  
		<br>
	</div>


@endsection