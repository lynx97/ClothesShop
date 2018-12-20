@extends('layouts.bg_admin')

@section('content')
    <div class="card mx-auto mt-10">
      <div class="card-header"><i class="fas fa-edit"></i>  Update Category</div>
      <form action="{{ url('categories/'.$category->id) }}" method="post"> 
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="card-body text-center">
          <div class="form-group">
            <div class="form-label-group">
              <input name="category_name" type="text" id="name" class="form-control" placeholder="Category name" required="required" autofocus="autofocus" value="{{ $category->category_name }}">
              <label for="name">Category name</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <textarea name="category_description" type="text" id="desc" class="form-control" placeholder="Category description" required="required" autofocus="autofocus" rows="5" >{{ $category->category_description }}</textarea>      
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input name="category_url" type="text" id="url" class="form-control" placeholder="Category url" required="required" autofocus="autofocus" value="{{ $category->category_url }}">
              <label for="url">Category url</label>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <button type="submit" class="btn btn-success" style="font-size: 30px">   <i class="fas fa-save"></i></button>
        </div>
      </form>
    </div>
  <hr>
  
@endsection