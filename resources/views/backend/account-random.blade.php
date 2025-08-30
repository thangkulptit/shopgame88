@extends('backend.master');
@section('main')
@section('name_page','Account Random')
@section('title', 'Danh sách Account Random')
<div class="container-fluid">
 <!-- /.row-->
 <div class="row">
    <div class="col-lg-3">

    
      <a href="{{url('/admin/account/add')}}"><button class="btn btn-primary" id="btn-add"><i class="cui-user-follow"></i></button></a> 
    </div>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <i class="fa fa-align-justify"></i> Danh Sách Account Random</div>
          <div id="table-paginate">
              @include('backend/paginations/pagination_account-random')
          </div>       
</div>
{{-- Edit Modal --}}
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Thêm Account</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="POST" id="form-add-edit">
                  <div class="row">
                      <div class="col-md-6">
                            <div class="form-group">
                            <label for="sel1">Type Account</label>
                            
                            <select class="form-control" id="type_account" name="type_account">
                                @foreach ($type_account as $item)
                                  <option value="{{$item->ta_id}}">{{$item->name}}</option>
                                @endforeach
                           </select>
                            </div>
                      </div>
                      <div class="col-md-6">
                            <div class="form-group">
                            <label for="sel1">Content</label>
                            <input type="text" class="form-control" placeholder="Trắng thông tin" name="content" id="content" required>
                            </div>
                      </div>
                  </div>
                  <div class="row">
                        <div class="col-md-6">
                              <div class="form-group">
                              <label for="sel1">Username</label>
                              <input type="text" placeholder="Username" name="username" class="form-control" id="username" required>
                              </div>
                        </div>
                        <div class="col-md-6">
                              <div class="form-group">
                              <label for="sel1">Password</label>
                              <input type="text" class="form-control" placeholder="Password" name="password" id="password" required>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6">
                                  <div class="form-group">
                                  <label for="sel1">Url Ảnh</label>
                                  <input type="text" placeholder="Url 1 | Url 2 | Url 3 ..." name="url_image" class="form-control" id="url_image" required>
                                  </div>
                            </div>
                            <div class="col-md-6">
                                  <div class="form-group">
                                  <label for="sel1">Price</label>
                                  <input type="number" class="form-control" placeholder="Giá" name="price" id="price" required>
                                  </div>
                            </div>
                           <div class="col-md-6">
                             <div class="form-group">
                                <div class="checkbox">
                                    <label> Active</label>
                                    <input type="checkbox" name="status" id="status" class="form-group" checked="true" value="1">
                                  </div>
                             </div>
                           </div>
                        </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" id="cancel-add" type="button" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" id="submit-update" type="submit">Update</button>

            </div>
        </form>
          </div>
          <!-- /.modal-content-->
        </div>
        <!-- /.modal-dialog-->
      </div>
<script>
var idGlobal;    
    $(document).ready(function(){

      //Check checkbox checked
      $('#status').click(function(){
            if($(this).prop("checked") == true){
              $('#status').val(1);
            }
            else if($(this).prop("checked") == false){
              $('#status').val(0);
            }
        });
      //end-check

      //btn delete
      $(document).on('click', '#btn-delete', function(){
        idGlobal = $(this).attr('id-data');
        ajaxSetup();
        $.ajax({
          type : "POST",
          url  : "/admin/account/delete/" + idGlobal,
          dataType : "json",
          success: function(responseData){
            if (responseData.message === 'success') {
                $('.content-table').html(responseData.data);
              }
          },
          error: function(error) {
            alert(error);
          }
        })
      })
      //end-btn-delete

        $(document).on('click','#btn-update', function(){
          idGlobal = $(this).attr('id-data');
          ajaxSetup();
          $.ajax({
              type: 'POST',
              url: '/admin/account/fetch/' + idGlobal,
              dataType: 'json',
              success: function(responseData) {
                
                $('#largeModal').modal('show');
                $('#type_account').val(responseData.data[0].type_account);
                $('#username').val(responseData.data[0].username);
                $('#password').val(responseData.data[0].password);
                $('#url_image').val(responseData.data[0].url_image);
                $('#content').val(responseData.data[0].content);
                $('#price').val(responseData.data[0].price);
                $('#status').val(responseData.data[0].status);
                if (responseData.data[0].status === 1) {
                  $('#status').prop('checked', true);
                } else {
                  $('#status').prop('checked', false);
                }
                
              },
              error: function(data) {
              alert(data);
              }
          });

        $('#form-add-edit').submit(function(e) {
          e.preventDefault();
          var data = {
            type_account :  $('#type_account').val(),
            username     :  $('#username').val(),
            password     :  $('#password').val(),
            url_image    :  $('#username').val(),
            content      :  $('#content').val(),
            price        :  $('#price').val(),
            status       :  $('#status').val(),
          }

          ajaxSetup();

          $.ajax({
            type: 'POST',
            url: '/admin/account/update/' + idGlobal,
            dataType: 'json',
            data : data,
            success: function(responseData) {
              if (responseData.message === 'success') {
                $('.content-table').html(responseData.data);
                $('#largeModal').modal('hide');
                $.toast("Let's test some HTML stuff... <a href='#'>github</a>")
              }  
            },
            error: function(data) {
             alert(data);
            }
        });
        })
        })
    })  
</script>


@stop