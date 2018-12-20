@extends('layouts.bg_admin')

@section('content')
	<!-- SHOW USERS-->
	<div >
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        List of users</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                   <td>{{ $user->id }}</td>
                   <td>{{ $user->first_name.' '.$user->last_name }}</td>
                   <td>{{ $user->email }}</td>
                   <td>{{ $user->phone }}</td>
                   @if (session("admin_status") == 2)
                   <td>
                    @if($user->status == 1)
                    <a class="btn text-white bg-danger clearfix small z-1" href="{{ url('users/block/'.$user->id) }}">
                        Lock
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="">
                          <i class="fas fa-angle-right"></i>
                        </span>
                      </a>
                    @else
                    <a class="btn text-white bg-success clearfix small z-1" href="{{ url('users/unblock/'.$user->id) }}">
                        Unlock
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="">
                          <i class="fas fa-angle-right"></i>
                        </span>
                      </a>

                    @endif
                   </td>
                   <td>
                      <button class="btn text-white bg-info clearfix small z-1" onclick="get_user_detail(<?php echo $user->id; ?>)" >
                        View Details    
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="">
                          <i class="fas fa-angle-right"></i>
                        </span>
                      </button>
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

  



 	<!-- Show detail modal-->
 	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form>
          <div class="form-group">
            <label  class="col-form-label">ID</label>
            <input id="inp-id" type="text" class="form-control" disabled>
          </div>
          <div class="form-group">
            <label  class="col-form-label">Username</label>
            <input id="inp-username" type="text" class="form-control" disabled>
          </div>
          <div class="form-group">
            <label  class="col-form-label">Email</label>
            <input id="inp-email" type="text" class="form-control"  disabled>
          </div>
          <div class="form-group">
            <label  class="col-form-label">Name</label>
            <input id="inp-name" type="text" class="form-control"   disabled>
          </div>
          <div class="form-group">
            <label  class="col-form-label">Phone</label>
            <input id="inp-phone" type="text" class="form-control" disabled>
          </div>
          <div class="form-group">
            <label  class="col-form-label">Address</label>
            <input id="inp-address" type="text" class="form-control" disabled>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<script>
	function get_user_detail(id){

		$.ajax(
    {
    url: "users/details/"+id,
    type: "GET",

    data: { 'id': id},
    success: function (result) {
    	result = JSON.parse(result);
        $("#inp-id").val(result.id);
        $("#inp-username").val(result.username);
        $("#inp-email").val(result.email);
        $("#inp-name").val(result.first_name + ' '+ result.last_name);
        $("#inp-phone").val(result.user_phone);
        $("#inp-address").val(result.user_address);
        $('#exampleModal').modal('show');   
    }
});   
	}
</script>

@endsection


