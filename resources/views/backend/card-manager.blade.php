@extends('backend.master');
@section('main')
@section('name_page','Account')
@section('title', 'Quản lý Card')
<div class="container-fluid">
 <!-- /.row-->
 <div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <i class="fa fa-align-justify"></i> Card Manager </div>
          <div id="table-paginate">
              @include('backend/paginations/pagination_card-manager')
          </div>       
</div>
@stop