@extends('backend.master');
@section('main')
@section('title', 'Add Account')
@section('name_page', 'Account')
@include('errors.error')
<div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          <strong>Add Account</strong>
          <small>Form</small>
        </div>
        <div class="card-body">
            <form method="POST" action="/admin/account/add">
          <!-- /.row-->
          <div class="row">
            <div class="form-group col-sm-4">
              <label for="ccmonth">Type Account</label>
              <select class="form-control" id="sel1" name="type_account">
                @foreach ($type_account as $rows)
                  <option value="{{$rows->ta_id}}">{{$rows->name}}</option>
                @endforeach
              </select>
            </div>
                      <!-- /.row-->
            <div class="col-sm-4">
              <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" id="username" type="text" name="username" placeholder="Username" required>
              </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                  <label for="username">Password</label>
                  <input class="form-control" id="password" name="password" type="text" placeholder="Password" required>
                </div>
              </div>
        </div>
        <!-- /.row-->
        <div class="row">
            <div class="form-group col-sm-4">
              <label for="ccmonth">Content</label>
              <input class="form-control" id="content" type="text" name="content" placeholder="Trắng Thông Tin">
            </div>
                      <!-- /.row-->
            <div class="col-sm-4">
              <div class="form-group">
                <label for="url_image">Url Ảnh</label>
                <input class="form-control" id="url_image" type="text" name="url_image" placeholder="Ảnh 1 | Ảnh 2 | ..." required>
              </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                  <label for="price">Price</label>
                  <input class="form-control" id="password" type="number" placeholder="Giá" name="price" required>
                </div>
              </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group"></div>
            </div>
            <div class="col-sm-6">
                
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Submit">
                <input class="btn btn-primary" type="reset" value="Reset">
            </div>
            </div>
        </div>
         </div>
      </div>
      @csrf
    </form>
    </div>
    <!-- /.col-->
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          <strong>Add Type Account</strong>
          <small>Form</small>
        </div>
        <div class="card-body">
            <form method="POST" action="/admin/account/type_add">
            <div class="form-group">
              <label for="company">Type Account</label>
              <input class="form-control" id="type_account" name="name" type="text" placeholder="Type account" required>
            </div>
          <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Thêm">
          </div>
          @csrf
        </form>
        </div>
      </div>
    </div>
    <!-- /.col-->
  </div>

@stop