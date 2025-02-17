<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multigrafika</title>
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/logo.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fonts/source-sans-pro.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
    <!-- Alertify js -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/alertify-js/alertify.min.css">
    <!-- Alertify js Theme -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/alertify-js/default.min.css">
    <!-- Datatable Original -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatable/css/datatables.min.css">


    <!-- jQuery -->
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- Alertify js -->
    <script src="<?= base_url(); ?>assets/plugins/alertify-js/alertify.min.js"></script>
    <!-- Datatable Original -->
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/datatables.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= base_url(); ?>assets/dist/js/pages/dashboard2.js"></script>

    <!-- Builtin function -->
    <script>
        function showAlert(type, message, position = 'top-right') {
            alertify.set('notifier', 'position', position);
            alertify[type](message);
        }

        window.baseURL = "<?php echo site_url(); ?>";

        history.pushState(null, null, window.location.href);
        window.addEventListener('popstate', function(event) {
            showAlert('warning', "The back button functionality in the browser is disabled. Please use the navigation buttons provided within the application.");
            history.pushState(null, null, window.location.href);
        });
    </script>
</head>