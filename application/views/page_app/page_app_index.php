<?php $this->load->view('layout/layout_header'); ?>
<?php $this->load->view('layout/layout_navbar'); ?>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link" id="page-title">Home</a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a class="brand-link text-center" id="brand-navbar">
                <img src="<?= base_url(); ?>assets/images/logo.png" alt="Store Logo" class="brand-image" style="opacity: .8">
                <span class="brand-text font-weight-light"><b>M u l t i g r a f i k a</b></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- <li class="nav-header">MENU</li> -->
                        <?php
                        $menu = array(
                            ['id' => 'dashboard', 'name' => 'Dashboard', 'link' => '/dashboard', 'icon' => 'fas fa-th'],
                            ['id' => 'cashier', 'name' => 'Cashier', 'link' => '/cashier', 'icon' => 'fas fa-cash-register'],
                            ['id' => 'transaction', 'name' => 'Transaction', 'link' => '/transaction', 'icon' => 'fas fa-receipt'],
                            ['id' => 'setting', 'name' => 'Setting', 'link' => '/setting', 'icon' => 'fas fa-cog'],
                            ['id' => 'logout', 'name' => 'Logout', 'link' => '/auth/logout', 'icon' => 'fas fa-sign-out-alt']
                        );
                        ?>

                        <?php foreach ($menu as $item): ?>
                            <li class="nav-item">
                                <a href="<?= $item['link']; ?>" class="nav-link menu" id="<?= $item['id']; ?>">
                                    <i class="nav-icon <?= $item['icon']; ?>"></i>
                                    <p><?= $item['name']; ?></p>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- header -->
        <div class="content-wrapper">
            <!-- <div class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="m-0" id="page-title"></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item">Dashboard v2</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Main content -->
            <section class="content pt-2">
                <div class="container-fluid">

                    <div id="container-module"></div>

                </div>
            </section>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2025 <a href="https://github.com/aryapn200605">aryapn200605</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.0.0
            </div>
        </footer>
    </div>
</body>

<?php $this->load->view('page_app/page_app_js'); ?>