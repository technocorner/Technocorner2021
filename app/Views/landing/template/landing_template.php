<html>

<head>

    <head>
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z0990FFS9E"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Z0990FFS9E');
</script>

        <!--- basic page needs
    ================================================== -->
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <meta name="description" content="TECHNOCORNER UGM 2021">
        <meta name="author" content="DIVISI SOFTWEB Technocorner 2021">
        <meta name="keywords" content="TC TECHNOCORNER DTETI UGM TECHNOLOGY 2021">

        <!-- mobile specific metas
    ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS
    ================================================== -->
        <link rel="stylesheet" href="<?= base_url('/frontend'); ?>/css/base.css?ts=<?=time()?>">
        <link rel="stylesheet" href="<?= base_url('/frontend'); ?>/css/vendor.css?ts=<?=time()?>">
        <link rel="stylesheet" href="<?= base_url('/frontend'); ?>/css/main.css?ts=<?=time()?>">
        <link rel="stylesheet" href="<?= base_url('/frontend'); ?>/css/styles.css?ts=<?=time()?>">
        <link rel="stylesheet" href="<?= base_url('/frontend'); ?>/landing/libraries/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- script
    ================================================== -->
        <script src="<?= base_url('/frontend'); ?>/js/modernizr.js"></script>
        <script src="<?= base_url('/frontend'); ?>/js/pace.min.js"></script>

        <!-- favicons
    ================================================== -->
        <link rel="shortcut icon" href="<?= base_url('/frontend'); ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= base_url('/frontend'); ?>/favicon.ico" type="image/x-icon">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
        <link href="<?= base_url('/frontend'); ?>/css/bootstrap/bootstrap-grid.min.css">

    </head>

<body class="competition">
    <header>

        <nav class="navbar opaque fixed-top navbar-expand-lg  " style="padding: 0 30px">

            <a class="navbar-brand " href="<?= base_url(); ?>"><img style="max-width:50px; height: auto;" src="<?= base_url('/frontend'); ?>/images/LOGO.png" alt="" title=""> TECHNOCORNER</a>
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                 <ul class=" ml-auto navbar-nav" style="font-weight: bold">
                    <li class="nav-item ">
                        <a class="nav-link" href="<?= base_url(); ?>"">Home</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?= base_url('/page'); ?>/gallery">Gallery</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Events
                        </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" target="" href="<?= base_url('/page/competition'); ?>/transporter/">Transporter</a>
                                <a class="dropdown-item" target="" href="<?= base_url('/page/competition'); ?>/line/">Line Follower</a>
                                <a class="dropdown-item" target="" href="<?= base_url('/page/competition'); ?>/iot/">IoT Development</a>
                                <a class="dropdown-item" target="" href="<?= base_url('/page/competition'); ?>/eec/">EEC</a>
                                <a class="dropdown-item" target="" href="<?= base_url('/page'); ?>/webinar/">Webinar</a>
                                <a class="dropdown-item" target="" href="<?= base_url('/page'); ?>/workshop/">Workshop</a>

                            </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?= base_url('/auth'); ?>">Login</a>
                    </li>
                    <!-- <li class="nav-item ">
                        <a class="nav-link" target="_blank" href="#">Seminar</a>
                    </li> -->
                    <!-- <li class="nav-item " >
                        <a class="nav-link" target="_blank" style="border: 2px white solid; border-radius: 10px;" href="#">Login</a>
                    </li> -->
                </ul>
            </div>
        </nav>


    </header>
    <!-- end s-header -->

    <?= $this->renderSection('content'); ?>

<!-- clients
    ================================================== -->
    <div id="clients" class="s-clients ">

        <div class="row-gl-tc section-header-gl-tc has-bottom-sep" data-aos="fade-up" data-aos-duration="400">
            <div class="col-full">
                <!-- <h3 class="subhead">Our Clients</h3> -->
                <h1 class="display-2">partnership</h1>
            </div>
        </div>
        <!-- end section-header-gl-tc -->

        <div id="partner" class="row-gl-tc" data-aos="fade-up" data-aos-duration="400">
            <div class="col-full">
                <h3 style="color: #555555;">sponsor: </h3>
            </div>
            <div class="col-full line">
                <a target="_blank" href="https://daiserver.com/"><img class="sponsor-xs " src="<?= base_url('/frontend'); ?>/images/partnership/daiserver.png"></a> &nbsp;&nbsp;&nbsp;&nbsp;
                 <a target="_blank" href="https://indobot.co.id/"><img class="sponsor-xs " src="<?= base_url('/frontend'); ?>/images/partnership/INDOBOT_BIRU.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                  <a target="_blank" href="https://block71.co/"><img class="sponsor-xs " src="<?= base_url('/frontend'); ?>/images/partnership/BLOCK71.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                  <a target="_blank" href="https://www.paragon-innovation.com/"><img class="sponsor-xs " src="<?= base_url('/frontend'); ?>/images/partnership/paragon.png"></a>
                   <a target="_blank"><img class="sponsor-xs " src="<?= base_url('/frontend'); ?>/images/partnership/mmugm.jpg"></a>
            </div>
            


            <div class="col-full">
                <h3 style="color: #555555;">media partner: </h3>
            </div>
            <div id="medpart" class="d-inline-block">
                <a target="_blank" href="https://www.haievent.com/"><img class="sponsor-xs" src="<?= base_url('/frontend'); ?>/images/partnership/Haievent.png"></a>
            </div>
            <div id="medpart" class="d-inline-block">
                <a target="_blank" ><img class="sponsor-xs" src="<?= base_url('/frontend'); ?>/images/partnership/aditv.jpg"></a>
            </div>
            <div id="medpart" class="d-inline-block">
                <a target="_blank" ><img class="sponsor-xs" src="<?= base_url('/frontend'); ?>/images/partnership/harjo.jpg"></a>
            </div>
            <div id="medpart" class="d-inline-block">
                <a target="_blank" ><img class="sponsor-xs" src="<?= base_url('/frontend'); ?>/images/partnership/mmtc.png"></a>
            </div>
            <div id="medpart" class="d-inline-block">
                <a target="_blank" ><img class="sponsor-xs" src="<?= base_url('/frontend'); ?>/images/partnership/Clapeyron.png"></a>
            </div>
             <div id="medpart" class="d-inline-block">
                <a target="_blank" ><img class="sponsor-xs" src="<?= base_url('/frontend'); ?>/images/partnership/crastfm.png"></a>
            </div>
        </div>

        <div class="text-center" style="margin-top: 50px; margin-bottom: -50px; padding: 0 3rem;" data-aos="fade-up" data-aos-duration="400">
            <h3>
                interested to be our partnership?
            </h3>
            <h3>Contact Us!</h3>
           <div class="row-gl-tc text-left cp block-1-2 block-tab-full" style="margin-top: 30px; margin-bottom: 30px">

                <div class="col-block line-2" style="height: 200px">
                    <h3 class="text-center mb-0">sponsorship:</h3>
                    <h4 class="text-center mb-4" style="color: #555555"><u>Muhammad Ihsan Ardiansyah</u></h4>
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=6287887160704&text=Halo%2C%20saya%20mau%20bertanya%20tentang%20sponsorship%20Technocorner%202021%0A"><i
                            class="fab fa-whatsapp" aria-hidden="true" style="margin-right: 12px"></i>
                        087887160704</a><br>
                    <a href="mailto:ardiansyah0206@mail.ugm.ac.id"><i class="fa fa-envelope" aria-hidden="true" style="margin-right: 10px"></i>
                        ardiansyah0206@mail.ugm.ac.id</a>
                </div>

                <div class="col-block" style="height: 200px;">
                    <h3 class="text-center mb-0">media partner:</h3>
                    <h4 class="text-center mb-4" style="color: #555555"><u>Bernardino Swastaka Efi</u></h4>
                    <a href="https://api.whatsapp.com/send?phone=6289674555560&text=Halo%2C%20saya%20mau%20bertanya%20tentang%20media%20partner%20Technocorner%202021%0A" target="_blank"><i 
                        class="fab fa-whatsapp" aria-hidden="true" style="margin-right: 12px"></i>
                        089674555560</a><br>
                    <a href="mailto:bernardinoefi@mail.ugm.ac.id"><i class="fa fa-envelope" aria-hidden="true" style="margin-right: 10px"></i>
                        bernardinoefi@mail.ugm.ac.id</a>
                </div>
            </div>
        </div>

    </div>
    <!-- end s-clients -->

    <!-- footer
    ================================================== -->
    <footer>

        <div class="row-gl-tc footer-main">

            <div class="col-six tab-full left footer-desc">

                <h3 class="display-2" style="font-size: 4vh; margin-top: 0vh; margin-bottom: 2vh;">
                </h3>

                <!-- <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 300px;
                            width: 300px;
                        }

                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 300px;
                            width: 300px;
                        }
                    </style> -->
            </div>

        </div>

        <div class="col-six tab-full right footer-subscribe">

            <h4 class="display-2" style="font-size: 4vh;">Get Notified!</h4>
            <ul class="header-nav__social">
                <li style="margin-right: 3vh;">
                    <h1 style="font-size: 8vh;">
                        <a href="https://www.facebook.com/TechnocornerUGM/" target="_blank"><i
                                    class="fab fa-facebook" aria-hidden="true"></i></a>
                    </h1>
                </li>
                <li style="margin-right: 3vh;">
                    <h1 style="font-size: 8vh;">
                        <a href="https://twitter.com/technocornerugm?lang=en" target="_blank"><i
                                    class="fab fa-twitter" aria-hidden="true"></i></a>
                    </h1>
                </li>
                <li style="margin-right: 3vh;">
                    <h1 style="font-size: 8vh;">
                        <a href="https://www.linkedin.com/company/technocorner-ugm-2021/" target="_blank"><i
                                    class="fab fa-linkedin" aria-hidden="true"></i></a>
                    </h1>
                </li>
                <li style="margin-right: 3vh;">
                    <h1 style="font-size: 8vh;">
                        <a href="https://www.tiktok.com/@technocornerugm" target="_blank"><i
                                    class="fab fa-tiktok" aria-hidden="true"></i></a>
                    </h1>
                </li>
                <li style="margin-right: 3vh;">
                    <h1 style="font-size: 8vh;">
                        <a href="https://www.youtube.com/channel/UC0T3ca79_Db-q9sHXTYeXIg" target="_blank"><i
                                    class="fab fa-youtube" aria-hidden="true"></i></a>
                    </h1>
                </li>
                <li style="margin-right: 3vh;">
                    <h1 style="font-size: 8vh;">
                        <a href="https://instagram.com/technocornerugm/" target="_blank"><i
                                    class="fab fa-instagram" aria-hidden="true"></i></a>
                    </h1>
                </li>
                <li style="margin-right: 3vh;">
                    <h1 style="font-size: 8vh;">
                        <a href="http://line.me/ti/p/@kdo2899c" target="_blank"><i
                                    class="fab fa-line" aria-hidden="true"></i></a>
                    </h1>
                </li>
            </ul>
        </div>
        <hr>

        </div>
        <!-- end footer-main -->

        <div class="row-gl-tc footer-bottom">

            <div class="col-twelve">
                <div class="copyright" style="color: #fff; margin-top: 10px">
                    <span>©Divisi Softweb Technocorner 2021</span>
                </div>

                <div class="go-top" style="background: 'black'">
                    <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon-arrow-up"
                            aria-hidden="true"></i></a>
                </div>
            </div>

        </div>
        <!-- end footer-bottom -->

    </footer>
    <!-- end footer -->

    </div>
    <!-- end of div -->

    <!-- Java Script
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="<?= base_url('/frontend'); ?>/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url('/frontend'); ?>/js/plugins.js"></script>
    <script src="<?= base_url('/frontend'); ?>/js/main.js"></script>
</body>

</html>