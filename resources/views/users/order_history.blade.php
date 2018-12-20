@extends('layouts.bg_user')


@section('content')
	<link href="{{ asset('css/rate.css') }}" rel="stylesheet">
	

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
            <li class="list-group-item text-right"><span class="pull-left"><a href="{{ url('users/'. Auth::user()->id )}}">Thông tin cá nhân</a>
            <li class="list-group-item text-right"><span class="pull-left"><strong><a href="{{ url('order_history') }}">Đơn hàng của tôi</a></strong></span></li>
            
          </ul> 
               
          
        </div><!--/col-3-->

        <div class="col-sm-9">
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a href="#profile" class="nav-link active" data-toggle="tab"><i class="fa fa-shopping-basket"></i> Đơn hàng </a>
				</li>

				
				
			</ul>
			<div class="tab-content">
				<div id="profile" class="container tab-pane active"><br/>
              		
          			<table class="table table-hover">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col" class="w-25">Tên sản phẩm</th>
					      <th scope="col">Số lượng</th>
					      <th scope="col">Trạng thái đơn hàng</th>
					      <th scope="col">Đánh giá</th>
					    </tr>
					  </thead>
					  <tbody>
					    @foreach( Auth::user()->orders as $order)
						    
						    <tr>

						      <th scope="row"><img src="{{ asset('img/products/'.$order->product->product_image) }}" alt="product" width="55px;" height="55px;"></th>
						      <td>{{ $order->product->product_name}}</td>
						      <td>{{ $order->quantity }}</td>
						      <td scope="row">
								@if( $order->status == 1 )
									Đang xử lý
								@elseif( $order->status == 2 )
									Đang giao hàng
								@else
									Đã hoàn thành
								@endif
						      </td>
						      <td>
						      	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#rate_for{{ $order->id }}"><i class="fa fa-thumbs-up"></i> Đánh giá</button>
								<!-- The Modal -->
							    <div class="modal fade" id="rate_for{{ $order->id }}">
							      <div class="modal-dialog modal-lg">
							        <div class="modal-content">
							          <!-- Modal header -->
							          <div class="modal-header">
							            <h4 class="modal-title">Đánh giá</h4>
							            <button type="button" class="close" data-dismiss="modal">&times;</button>
							          </div>
							          <!-- Modal body -->
							          <div class="modal-body">
							          		<h4>Cám ơn quý khách đã hàng ngày {{ $order->created_at }} </h4>

											Nhận xét và đánh giá sản phẩm đã mua (5 sao: Rất Tốt - 1 sao: Rất Tệ)
							          		<form action="{{ url('rating') }}" method="post" id="_for{{ $order->id }}">
							          			@csrf
							          			<input type="hidden" name="order_id" value="{{ $order->id }}">
							          			<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
							          			
							          			<div class="rating">
										          <input type="radio" id="star5_for{{ $order->id }}" name="rating" value="5" 
										          @if($order->rate)
										          	@if( $order->rate->rate_mark == 5) 
										          		checked="checked" 
										          	@endif
										          @endif
										          /><label for="star5_for{{ $order->id }}" title="Excelent">5 stars</label>
										          <input type="radio" id="star4_for{{ $order->id }}" name="rating" value="4"  
													@if($order->rate)
											          	@if( $order->rate->rate_mark == 4) 
											          		checked="checked" 
											          	@endif
											          @endif
										          /><label for="star4_for{{ $order->id }}" title="Good">4 stars</label>
										          <input type="radio" id="star3_for{{ $order->id }}" name="rating" value="3"
													@if($order->rate)
											          	@if( $order->rate->rate_mark == 3) 
											          		checked="checked" 
											          	@endif
											          @endif
										          /><label for="star3_for{{ $order->id }}" title="Fair">3 stars</label>
										          <input type="radio" id="star2_for{{ $order->id }}" name="rating" value="2" 
													@if($order->rate)
											          	@if( $order->rate->rate_mark == 2) 
											          		checked="checked" 
											          	@endif
											          @endif
										          /><label for="star2_for{{ $order->id }}" title="Bad">2 stars</label>
										          <input type="radio" id="star1_for{{ $order->id }}" name="rating" value="1" 
													@if($order->rate)
											          	@if( $order->rate->rate_mark == 1) 
											          		checked="checked" 
											          	@endif
											          @endif
										          /><label for="star1_for{{ $order->id }}" title="Really Bad">1 star</label>
										        </div>
							          		</form>
							            	
							          </div>
							          <!-- Modal footer -->
							          <div class="modal-footer">
							          	<button class="btn btn-primary" type="submit" form="_for{{ $order->id }}"><i class="fa fa-paper-plane"></i> Gửi</button>
							            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							          </div>
							        </div>
							      </div>
							    </div>

						      </td>
						    </tr>
					    @endforeach
					  </tbody>

					</table>
						
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