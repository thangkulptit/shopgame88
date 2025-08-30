<div class="modal fade" id="my-modal-login-register" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" id="modal-content-system">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">QUẢN LÝ ĐĂNG NHẬP</h4>
            </div>
            <div class="modal-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i
                                    class="fas fa-user-check"></i>Đăng nhập</a>
                        </li>
                        <li role="presentation" role="tablist">
                            <a href="#tab" aria-controls="tab" role="tab" data-toggle="tab"><i
                                    class="fas fa-user-friends"></i>Đăng ký</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <form role="form" id="form-system-login">
                                <legend style="text-align: center;">Đăng nhập</legend>

                                <div class="form-group">
                                    <label for=""><i class="fas fa-user"></i> Tên tài khoản</label>
                                    <input type="text" class="form-control" name="username_login" id="username_login"
                                        placeholder="Tên tài khoản..." required>
                                </div>
                                <div class="form-group">
                                    <label for=""><i class="fas fa-key"></i> Mật khẩu</label>
                                    <input type="password" class="form-control" name="password_login"
                                        id="password_login" placeholder="Mật khẩu..." required>
                                </div>
                                <button type="button" id="btnLogin" class="btn btn-primary">Đăng nhập</button>
                                {{-- <a href="{{ url('/front/redirect/google') }}"><button type="button"
                                        class="btn btn-primary">Đăng nhập bằng Google+ <i
                                            class="fab fa-facebook-square"></i></button></a> --}}
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab">
                            <form role="form">
                                <legend style="text-align: center;">Đăng ký</legend>
                                <div class="form-group">
                                    <label for=""> <i class="fas fa-user-tag"></i> Họ và tên (Từ 2 - 40 Ký tự)</label>
                                    <input type="text" name="fullname_register" class="form-control"
                                        id="fullname_register" placeholder="Họ và tên ..." required>
                                </div>
                                {{-- <div class="form-group">
                                    <label for=""><i class="fas fa-envelope"></i> Email (Đuôi phải có @gmail.com. VD: banaccuytin@gmail.com)</label>
                                    <input type="email" class="form-control" name="email_register" id="email_register"
                                        placeholder="Email ..." required>
                                </div> --}}
                                <div class="form-group">
                                    <label for=""><i class="fas fa-user"></i> Tài khoản (Phải Từ 5-40 Ký tự)</label>
                                    <input type="text" class="form-control" name="username_register"
                                        id="username_register" placeholder="Tài khoản ..." required>
                                </div>
                                <div class="form-group">
                                    <label for=""><i class="fas fa-key"></i> Mật khẩu (Phải Từ 5-40 Ký tự)</label>
                                    <input type="password" class="form-control" name="password_register"
                                        id="password_register" placeholder="Mật khẩu ..." required>
                                </div>
                                <button type="button" id="btnRegister" class="btn btn-primary">Đăng ký tài
                                    khoản</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script src="js/app/app.js"></script>