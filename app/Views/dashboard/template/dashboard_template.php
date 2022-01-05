<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z0990FFS9E"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Z0990FFS9E');
</script>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Technocorner 2021 </title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('/frontend/akun/dashboard'); ?>/css/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- datatable -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url('/css'); ?>/table.css">

    <link rel="shortcut icon" href="<?= base_url('/frontend'); ?>/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= base_url('/frontend'); ?>/favicon.ico" type="image/x-icon">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('/frontend/akun/dashboard'); ?>/css/dashboard.min.css">

    <link rel="stylesheet" href="<?= base_url('/frontend/akun/dashboard'); ?>/css/dashboard.css">

    <!-- FORM -->
    <?php if (!empty($css)) : ?>
        <?php foreach ($css as $s) : ?>
            <link type="text/css" rel="stylesheet" href="<?= $s; ?>">
        <?php endforeach; ?>
    <?php endif; ?>

</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>

    <div class="wrapper">

        <?= $this->renderSection('content'); ?>


        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.1.0-rc
            </div>
            <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="<?= base_url('/frontend/akun/dashboard'); ?>/js/adminlte.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>

    <!-- script sidebar -->
    <script>
        <?php $uri = service('uri'); ?>
        if ('<?= $uri->getSegment(2); ?>' == 'competition') {
            console.log('sama');
            $('.nav-treeview').show();
        }
    </script>
</body>

</html>