<?php $this->load->view('layout/layout_header'); ?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a><b>Multi</b>grafika</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <h3 class="text-center mb-3">Login</h3>
                <form>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" id="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary" id="btn-login">
                        Sign in
                    </button>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
        <div class="text-center mt-2">
            <p>
                Contact support:
                <a href="https://wa.me/6287745463873" class="text-decoration-none">0877-4546-3873</a>
                &nbsp;
                <img
                    src="<?= base_url(); ?>assets/images/whatsapp.png"
                    alt="WhatsApp Logo"
                    width="14"
                    class="brand-image"
                    style="opacity: 0.8;">
            </p>
        </div>

    </div>

    <?php $this->load->view('page_login/page_login_js'); ?>

</body>