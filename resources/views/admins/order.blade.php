@extends('layouts.bg_admin')

@section('content')
  <!-- Icon Cards-->
  <div >
    <div class="card mb-3">
      <div class="card-header">
        <table class="table">
          <tr>
            <td>Số đơn hàng: </td>
            <td>{{$transaction->id}}</td>
          </tr>
          <tr>
            <td>Tổng tiền: </td>
            <td>{{$transaction->total_money}}</td>
          </tr>
          <tr>
            <td>Trạng thái: </td>
            <td>
             @if($transaction->status == 1)
                Chờ xử lý
              @elseif ($transaction->status == 2)
                Đang giao hàng
              @elseif ($transaction->status == 3)
                Đã hoàn thành
              @endif
            </td>
          </tr>
        </table>
        <i class="fas fa-table"></i>
        Chi tiết đơn hàng
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
              <th>Tên sản phẩm</th>
              <th>Số lượng</th>
              <th>Giá tiền/1đv</th>
            </tr>
          </thead>
            <tbody>
              @foreach ($orders as $key => $order)
                <tr>
                   <td>{{$products[$key]->product_name}}</td>
                   <td>{{$order->quantity}}</td>
                   <td>{{$order->price}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @if (session("admin_status") == 1)
          <div style="float:right;">
            <button class="btn text-white bg-info clearfix small z-1" data-toggle="modal" data-target="#myModal" >
              Cập nhật trạng thái
              &nbsp;
              <span class="">
                <i class="fas fa-pen"></i>
              </span>
            </button>
          </div>
          @endif
        </div>
      </div>
      <div>
        <a class="btn text-white bg-info clearfix small z-1" href="{{url('transactions')}}">
          <span class="">
            <i class="fas fa-angle-left"></i>
          </span>
        </a>
      </div>
    </div>
  </div>

    <!-- Show modal to select trang thai don hang-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thay đổi trạng thái đơn hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form>
          <div class="form-group">
            <label  class="col-form-label">Trạng thái</label>
            <select id="select_status" class="form-control">
              <option value="1">Chờ xử lý</option>
              <option value="2">Đang giao hàng</option>
              <option value="3">Đã hoàn thành</option>
            </select>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="updateStatus(<?php echo $orders[0]->transaction_id; ?>)" >Lưu</button>
      </div>
    </div>
  </div>
</div>

<script>

  function updateStatus(id){  
    var stt = $("#select_status option").filter(":selected").val();
    console.log(stt);
    var data = {
      _token: "{{ csrf_token() }}",
      id: id,
      status: stt
    };

    $(document).ready(function(){
        $.ajax({
            url: "{{ url('transactions/updateStatus') }}",
            method: 'post',
            async: true,
            data: data,
            success: function(result) {
                //$orders = result;
                alert("thay đổi trạng thái đơn hàng thành công!");
                 window.location.href=window.location.href;
            },
            error: function() {
                alert('đã xảy ra lỗi, hãy thử lại');
                window.location.href=window.location.href;
            },
        });
        
    });
  }
</script>

@endsection
