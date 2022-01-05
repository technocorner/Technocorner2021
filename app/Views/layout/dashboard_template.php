<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/table.css">

    <!-- sss -->
    <!--  -->
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('frontend/dashboard/css/fontawesome-free/css/all.min.css'); ?>">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <!-- FORM -->

    <link rel="stylesheet" href="<?= base_url('frontend/akun/dashboard/css/dashboard.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('frontend/akun/dashboard/css/dashboard.min.css'); ?>">
    <?php foreach ($css as $s) : ?>
        <link type="text/css" rel="stylesheet" href="<?= base_url('/frontend/' . $s); ?>">
        akun/dashboard/events/Regist/css/form.css
    <?php endforeach; ?>


    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
    <title>Document</title>
</head>

<body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>


    <?= $this->renderSection('content'); ?>



</body>

</html>