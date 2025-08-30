@extends('backend.master')
@section('title', 'Thống kê nạp')
@section('name_page','Thống kê Nạp')
@section('main')
<div class="container-fluid">
    <!-- /.row-->
    <div class="row">
     <div class="col-lg-12">
       <div class="card">
         <div class="card-header">
           <i class="fa fa-align-justify"></i> Thông kê Card đã nạp</div>
           <div class="card-body">
            <table class="table table-responsive-sm table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>UID</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Seri</th>
                  <th>Pin</th>
                  <th>Status</th>
                  <th>Order Id</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody class="content-table">
                  @foreach ($card as $rows)
                  <tr id="tr-id-{{$rows->id}}">
                    <td>{{ $rows->id }}</td>
                    <td>{{ $rows->uid }}</td>
                    <td>{{ $rows->type_card }}</td>
                    <td>{{ $rows->amount_card }}</td>
                    <td>{{ $rows->seri_card }}</td>
                    <td>{{ $rows->code_card }}</td>
                    <td>
                        @if($rows->status == 1) 
                            <span style="background: #27ae60;" class="badge badge-success">Thành công</span>
                        @endif
                    </td>
                    <td>{{$rows->order_by}}</td>
                    <td>Lúc: {{$rows->created_at}}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
            <nav>{{$card->links()}}</nav>
            <strong>Tổng tháng {{$monthCurrent}} này: {{number_format($total)}}đ</strong>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- /.row-->
  </div>    
   </div>
@stop