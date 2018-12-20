@extends('layouts.bg_user')


@section('content')
  <style>
    /* Global settings */
   
    .product-image {
      float: left;
      width: 20%;
    }
     
    .product-details {
      float: left;
      width: 37%;
    }
     
    .product-price {
      float: left;
      width: 12%;
    }
     
    .product-quantity {
      float: left;
      width: 10%;
    }
     
    .product-removal {
      float: left;
      width: 9%;
    }
     
    .product-line-price {
      float: left;
      width: 12%;
      text-align: right;
    }
     
    /* This is used as the traditional .clearfix class */
    .group:before, .shopping-cart:before, .column-labels:before, .product:before, .totals-item:before,
    .group:after,
    .shopping-cart:after,
    .column-labels:after,
    .product:after,
    .totals-item:after {
      content: '';
      display: table;
    }
     
    .group:after, .shopping-cart:after, .column-labels:after, .product:after, .totals-item:after {
      clear: both;
    }
     
    .group, .shopping-cart, .column-labels, .product, .totals-item {
      zoom: 1;
    }
     
    /* Apply clearfix in a few places */
    /* Apply dollar signs */
    .product .product-price:after, .product .product-line-price:after, .totals-value:after {
      content: ' đ';
    }
     
    /* Body/Header stuff */
    body {
      font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, sans-serif;
      font-weight: 100;
    }
     
    h1 {
      font-weight: 100;
    }
     
    label {
      color: #aaa;
    }
     
    .shopping-cart {
      margin-top: -25px;
    }
     
    /* Column headers */
    .column-labels label {
      padding-bottom: 15px;
      margin-bottom: 15px;
      border-bottom: 1px solid #eee;
    }
    .column-labels .product-image, .column-labels .product-details, .column-labels .product-removal {
      text-indent: -9999px;
    }
     
    /* Product entries */
    .product {
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
    }
    .product .product-image {
      text-align: center;
    }
    .product .product-image img {
      width: 100px;
    }
    .product .product-details .product-title {
      margin-right: 20px;
      font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
    }
    .product .product-details .product-description {
      margin: 5px 20px 5px 0;
      line-height: 1.4em;
    }
    .product .product-quantity input {
      width: 40px;
    }
    .product .remove-product {
      border: 0;
      padding: 4px 8px;
      background-color: #c66;
      color: #fff;
      font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
      font-size: 12px;
      border-radius: 3px;
    }
    .product .remove-product:hover {
      background-color: #a44;
    }
     
    /* Totals section */
    .totals .totals-item {
      float: right;
      clear: both;
      width: 100%;
      margin-bottom: 10px;
    }
    .totals .totals-item label {
      float: left;
      clear: both;
      width: 79%;
      text-align: right;
    }
    .totals .totals-item .totals-value {
      float: right;
      width: 21%;
      text-align: right;
    }
    .totals .totals-item-total {
      font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
    }
     
    .checkout {
      float: right;
      border: 0;
      margin-top: 20px;
      margin-bottom: 20px;
      padding: 6px 25px;
      background-color: #6b6;
      color: #fff;
      font-size: 25px;
      border-radius: 3px;
    }
     
    .checkout:hover {
      background-color: #494;
    }
     
    /* Make adjustments for tablet */
    @media screen and (max-width: 650px) {
      .shopping-cart {
        margin: 0;
        padding-top: 20px;
        border-top: 1px solid #eee;
      }
     
      .column-labels {
        display: none;
      }
     
      .product-image {
        float: right;
        width: auto;
      }
      .product-image img {
        margin: 0 0 10px 10px;
      }
     
      .product-details {
        float: none;
        margin-bottom: 10px;
        width: auto;
      }
     
      .product-price {
        clear: both;
        width: 70px;
      }
     
      .product-quantity {
        width: 100px;
      }
      .product-quantity input {
        margin-left: 20px;
      }
     
      .product-quantity:before {
        content: 'x';
      }
     
      .product-removal {
        width: auto;
      }
     
      .product-line-price {
        float: right;
        width: 70px;
      }
    }
    /* Make more adjustments for phone */
    @media screen and (max-width: 350px) {
      .product-removal {
        float: right;
      }
     
      .product-line-price {
        float: right;
        clear: left;
        width: auto;
        margin-top: 10px;
      }
     
      .product .product-line-price:before {
        content: 'Item Total: $';
      }
     
      .totals .totals-item label {
        width: 60%;
      }
      .totals .totals-item .totals-value {
        width: 40%;
      }
    }
  </style>

  <div class="container">
    <h1>Giỏ hàng</h1> 
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
  </div>
  <br><br><br>
  
  <br>
   
  <div class="shopping-cart">
   
    <div class="column-labels">
      <label class="product-image">Hình ảnh</label>
      <label class="product-details">Chi tiết</label>
      <label class="product-price">Giá</label>
      <label class="product-quantity">Số lượng</label>
      <label class="product-removal">gỡ</label>
      <label class="product-line-price">Tổng tiền</label>
    </div>
    <?php $cart = session('cart') ?>
      @if(session()->has('cart'))
        @foreach ( $cart as $product )
          
          <div class="product">
            <div class="product-image">
              <img src="{{asset('img/products/'. $product->product_image )}}">
            </div>
            <div class="product-details">
              <div class="product-title"><a href="{{ url('product/'.$product->id) }}">{{ $product->product_name }}</a></div>
              <?php 
                $desc = substr($product->product_description,0,100);
              ?>
              <p class="product-description"> {{ $desc }}... </p>
            </div>
            <?php 
              $sub = substr($product->product_price,-3);
              $pre = substr($product->product_price,0,-3);
              $price = $pre . '.' .$sub;
            ?>
            <div class="product-price">{{ $price }} </div>
            <div class="product-quantity">
              <input id="quantity" type="number" product_id="{{ $product->id }}" value="{{ $product->quantity }}" min="1">
            </div>
            <div class="product-removal">
              <button id="{{ $product->id }}" class="remove-product" onclick="rmProduct(this)">
                Remove
              </button>
            </div>
            <?php 
              $total = $product->product_price * $product->quantity;
              $sub = substr($total,-3);
              $pre = substr($total,0,-3);
              $price = $pre . '.' .$sub;
            ?>
            <div class="product-line-price">{{ $price }}</div>
          </div>
        @endforeach 
            
      @endif
    
 
   
    <div class="totals">
      <div class="totals-item totals-item-total">
        <label>Grand Total</label>
        <div class="totals-value" id="cart-total"></div>
      </div>
    </div>
    <form action="{{ url('checkout') }}" method="post">
      @csrf
      <button class="checkout">Checkout</button>  
    </form>
    
  </div>
  <script>
    

    $(document).ready(function() {
      
      $('input').on('focusin', function(){
        console.log("Saving value " + $(this).val());
        $(this).data('val', $(this).val());
      });

      // Event change input quantity
      $("input").change(function(){
        
        var cart = <?php echo json_encode($cart); ?>;
        var product_id = $(this).attr('product_id');
        var quantity = $(this).val();
        

        var data = {
          _token: "{{ csrf_token() }}",
          product_id: product_id,
          quantity: quantity
        };
        
        if(quantity < 1){
          alert('Bạn nhập đã số lượng âm, vui lòng xem lại giỏ hàng !');
          var prev = $(this).data('val');
          $(this).val(prev)
        }else{

          $.ajax({
            url: "{{ url('chageQuatyProduct') }}",
            method: 'post',
            async: true,
            data: data,
            success: function(result) {
                
            },
            error: function() {
                alert('Sorry have error , please load again this page');
            },
          });
          

          
        }


      });

      /* Set rates + misc */
      var taxRate = 0.05;
      var fadeTime = 300;
     
     
      /* Assign actions */
      $('.product-quantity input').change( function() {
        updateQuantity(this);
      });
       
      $('.product-removal button').click( function() {
        removeItem(this);
      });
       
       
      /* Recalculate cart */
      function recalculateCart(){
        var total = 0;
         
        /* Sum up row totals */
        $('.product').each(function () {
          total += parseFloat($(this).children('.product-line-price').text());
        });
         
         
        /* Update totals display */
        $('.totals-value').fadeOut(fadeTime, function() {
          $('#cart-total').html(total.toFixed(3));
          if(total == 0){
            $('.checkout').fadeOut(fadeTime);
          }else{
            $('.checkout').fadeIn(fadeTime);
          }
          $('.totals-value').fadeIn(fadeTime);
        });
      }
       
       
      /* Update quantity */
      function updateQuantity(quantityInput){
        /* Calculate line price */
        var productRow = $(quantityInput).parent().parent();
        var price = parseFloat(productRow.children('.product-price').text());
        var quantity = $(quantityInput).val();
        var linePrice = price * quantity;
         
        /* Update line price display and recalc cart totals */
        productRow.children('.product-line-price').each(function () {
          $(this).fadeOut(fadeTime, function() {
            $(this).text(linePrice.toFixed(3));
            recalculateCart();
            $(this).fadeIn(fadeTime);
          });
        });  
      }
       
       
      /* Remove item from cart */
      function removeItem(removeButton){
        /* Remove row from DOM and recalc cart total */
        var productRow = $(removeButton).parent().parent();
        productRow.slideUp(fadeTime, function() {
          productRow.remove();
          recalculateCart();
        });
      }
      recalculateCart() 
    });
    


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
                    
                },
                error: function() {
                    alert('Sorry have error , please load again this page');
                },
            });
            
        });
    }
  
  </script>
@endsection