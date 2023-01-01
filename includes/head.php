<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?> - Trang TTSV Ký túc xá</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/dist/css/bootstrap.min.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="assets/vendor/datatables/css/jquery.dataTables.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome JS -->
    <script src="assets/vendor/fortawesome/fontawesome-free/js/solid.min.js"></script>
    <script src="assets/vendor/fortawesome/fontawesome-free/js/fontawesome.min.js"></script>
    <!-- Sweet Alert JS -->
    <script src="assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <?php if (isset($err)): ?>
    <script>
        setTimeout(function () {
            Swal.fire('Lỗi', '<?= $err ?>', 'error');
        }, 100);
    </script>
    <?php endif ?>

    <?php if (isset($success)): ?>
    <script>
        setTimeout(function () {
            Swal.fire('Thành công', '<?= $success ?>', 'success');
        }, 100);
    </script>
    <?php endif ?>
</head>