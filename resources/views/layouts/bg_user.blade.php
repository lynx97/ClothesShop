<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clothes Store</title>
    
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/modern-business.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/comment.css') }}" rel="stylesheet">
  
  </head>
    
  <body>
    <!-- Core plugin JavaScript-->
    <!-- <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script> -->

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @include('component.navbar_user')
    <div style="margin: 6px;"></div>
    @if(Request::is('home'))
      @include('component.slide_show')
    @endif
    
    <div class="row">
        @if(Request::is('home'))
            <div style="margin-top: 10px;" class="col-md-2 border border-dark rounded border-left-0">
                @include('component.sidebar_user')
            </div>
            <div class="col-md-10">
        @endif
            @yield('content')
        </div>
    </div>
    
    <!-- The Modal -->
    <div class="modal fade" id="cart">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Modal header -->
          <div class="modal-header">
            <h4 class="modal-title">Shopping Cart </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <div>
              <?php $cart = session('cart') ?>
              @if(session()->has('cart'))
               
                <table class="table">
                  <thead>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tên SP</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Hành động</th>
                  </thead>
                  <tbody>
                    @foreach ( $cart as $product )
                      
                      <tr>
                        <td><img src="{{asset('img/products/'. $product->product_image )}}" alt="product" height="30px" width="40px;"></td>
                        <td>{{ $product->product_name }}</td>
                        <?php 
                          $sub = substr($product->product_price,-3);
                          $pre = substr($product->product_price,0,-3);
                          $price = $pre . '.' .$sub;
                        ?>
                        <td>{{ $price }} đ</td>
                        <td><input class="form-control" min=1 value="{{ $product->quantity }}" readonly></td>
                        <td><button id="{{ $product->id }}" onclick="rmProduct(this)" class="btn btn-danger">x</button></td>
                      </tr>
                    @endforeach 
                    
                  </tbody>
                </table>
              @endif
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            @if(session()->has('cart'))
              <a href="{{ url('shopCarts') }}" class="btn btn-primary" >Mua</a>
            @endif
            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
    @include('component.footer_user')
  </body>
  <script>

    function rmProduct(el){
        var product_id = el.getAttribute('id');

        var cart = <?php echo json_encode($cart); ?>;
        
              
        
        var data = {
          _token: "{{ csrf_token() }}",
          product_id: product_id
        };
        $(document).ready(function(){
            $.ajax({
                url: "{{ url('rmProduct') }}",
                method: 'post',
                async: true,
                data: data,
                success: function(result) {
                    $(el).parent().parent().remove();
                },
                error: function() {
                    alert('Sorry have error , please load again this page');
                },
            });
            
        });
    }
  </script>
</html>




