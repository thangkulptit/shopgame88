@extends('backend.master')
@section('title', ' Lịch sử mua acc')
@section('name_page',' Lịch sử mua acc')
@section('main')
<div class="container-fluid">
    <!-- /.row-->
    <div class="row">
     <div class="col-lg-12">
       <div class="card">
         <div class="card-header">
           <i class="fa fa-align-justify"></i> Lịch sử mua acc</div>
           <div class="card-body">
            <table class="table table-responsive-sm table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>UID</th>
                  <th>Mã Acc</th>
                  <th>Giá</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody class="content-table">
                  @forelse ($list as $index => $rows)
                    <tr id="tr-id-{{$rows->id}}">
                        <td>{{ $index }}</td>
                        <td>{{ $rows->uid }}</td>
                        <td>{{ $rows->type_account}} #{{$rows->id_acc}}</td>
                        <td>{{ number_format($rows->price)}}<sup>đ</sup></td>
                        <td>Lúc: {{ $rows->created_at}}</td>
                    </tr>
                  @empty
                    <tr>
                        <td><p>Chưa có cuộc gd nào</p>  </td>
                    </tr>
                  @endforelse
              </tbody>
            </table>
             <nav>{{$list->links()}}</nav>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- /.row-->
  </div>    
   </div>
@stop