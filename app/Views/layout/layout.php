<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard'; ?></title>
    
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo/favicon.png" type="image/png">
    <link
      rel="stylesheet"
      href="<?= base_url(); ?>assets/extensions/sweetalert2/sweetalert2.min.css"
    />

    <link rel="stylesheet" href="<?= base_url(); ?>assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/pages/datatables.css">
    
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <?= $this->include('layout/sidebar'); ?>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
            <?= $this->renderSection('content'); ?>
                  
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/js/bootstrap.js"></script>
    <script src="<?= base_url(); ?>assets/js/app.js"></script>
    <script src="<?= base_url(); ?>assets/extensions/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <?= $this->renderSection('js'); ?>
</body>

</html>
