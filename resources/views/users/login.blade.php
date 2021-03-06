@extends('layouts.auth_user')
@section('content')
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          @if($errors->any())
            <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{$errors->first()}}</strong>
            </div>
          @endif
          <h5 class="card-title text-center">Đăng nhập</h5>
          <form class="form-signin" method="post" action="{{ url('signin') }}">
            @csrf
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
              <label for="inputEmail">Email address</label>
            </div>

            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
              <label for="inputPassword">Password</label>
            </div>

            <div class="custom-control custom-checkbox mb-3">
              <input type="checkbox" class="custom-control-input" id="customCheck1">
              <label class="custom-control-label" for="customCheck1">Nhớ mật khẩu</label>
            </div>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Đăng nhập</button>
            <hr class="my-4">
            <a href="{{ url('/users/create') }}" class="btn btn-info btn-block text-uppercase">Đăng ký</a>
            <hr class="my-4">
            <a href="{{ url('home') }}" class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fa fa-home"></i> Go Home Shopping</a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection