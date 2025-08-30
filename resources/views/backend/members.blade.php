@extends('backend.master');
@section('main')
@section('name_page','Members')
@section('title', 'Danh sách Members')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="col-md-6">
                    <div style="display: flex">
                        <input type="search" placeholder="Search..." id="search-member" class="form-control"> 
                        <button type="button" id="btnSearch" class="btn btn-danger"><i class="fa fa-search-plus fa-lg mt-1"></i></button>
                    </div>
                </div>
            </div>
            <div id="table-paginate-member">
                @include('backend/paginations/pagination_member')
            </div>
        </div>
    </div>
</div>
{{-- Edit Modal --}}
<div class="modal fade" id="modal-update-money-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="title-modal-update">Cộng tiền cho User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
            <input class="form-control" id="money" name="money" type="number" placeholder="0">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" id="btn-update-money-user" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click','#btnSearch', function(){
        loading('show');
        const txtNameSearch = $('#search-member').val();
        if (!txtNameSearch) {
            alert('Không được để trống');
            loading('hide');
            return;
        }
        searchUser(txtNameSearch); 

    });


    var idGlobal;
    var method;
    $(document).on('click','#btnUpdateMoney', function(){
        idGlobal = $(this).attr('member-id');
        $('#modal-update-money-user').modal('show');
        $('#title-modal-update').text('Sửa tiền cho user');
        method = 'update';
    });

    $(document).on('click', '#btnPlusMoney', function(){
        idGlobal = $(this).attr('member-id');
        $('#modal-update-money-user').modal('show');
        $('#title-modal-update').text('Cộng tiền cho user');
        method = 'plus';
    })
    $('#btn-update-money-user').click(function(){
        const money = $('#money').val();
        updateMoneyUser(idGlobal, money, method);
    });

    function updateMoneyUser(id, money, flag) {
        if (flag === 'update') {
            $url = '/admin/members/update_money';
        } 
        else if(flag === 'plus') {
            $url = '/admin/members/plus_money';
        } else {
            return;
        }
        loading('show');
        if (!money.match('^([0-9]){1,}$')) {
            alert('Giá tiền không hợp lệ');
            loading('hide');
            return;
        }
        ajaxSetup();
        $.ajax({
            type: 'POST',
            url: $url,
            dataType: 'json',
            data: {
                'id' : id,
                'money' : money
            }, 
            success: function(responseData) {
               if (responseData.status) {
                   $('#modal-update-money-user').modal('hide');
                   $('#row-member-' + responseData.id).html(responseData.output);
               }
               loading('hide');
               
            },
            error: function(error) {
                loading('hide');
                console.log(error);
            }
        });
    }
    function searchUser(name) {
        ajaxSetup();
        $.ajax({
            type: 'POST',
            url: '/admin/members/search',
            dataType: 'json',
            data: {
                'name' : name
            }, 
            success: function(responseData) {
               $('.content-table').html(responseData.html);
               loading('hide');
            },
            error: function(error) {
                loading('hide');
                console.log(error);
            }
        });        
    }
</script>


@stop