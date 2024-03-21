<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bandung's LibCaffe</title>

  <link rel="stylesheet" href="<?= base_url('ASET/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('ASET/fonts/font-awesome.min.css') ?>">

  <style>
    body {
      margin: 0px;
      background-color: #f8faff;
    }

    a.navbar-brand.navbar-link {
      margin-top: 7px;
    }

    ul.nav.navbar-nav.navbar-right {
      margin-top: 12px;
      margin-right: 18px;
    }

    .navbar-default .navbar-nav>.active>a,
    .navbar-default .navbar-nav>.active>a:focus,
    .navbar-default .navbar-nav>.active>a:hover {
      color: #363535;
      background-color: #e7e7e7;
    }

    .navbar-default .navbar-nav>li>a:focus,
    .navbar-default .navbar-nav>li>a:hover {
      color: #622121;
      background-color: transparent;
    }

    .navbar-default .navbar-nav>li>a {
      color: #FFFFFF;
      font-family: Garamond;

    }

    .navbar-brand,
    .navbar-nav>li>a {
      text-shadow: 0 1px 0 #FFFFFF;
      font-size: larger;
    }

    .navbar-default .navbar-nav>.active>a,
    .navbar-default .navbar-nav>.open>a {
      background-repeat: repeat-x;
      background: rgba(255, 255, 255, 0.3);
    }

    .navbar-default .navbar-toggle:focus,
    .navbar-default .navbar-toggle:hover {
      background-color: #ddd;
      background: white;
    }

    button.navbar-toggle.collapsed {
      margin-top: 16px;
      margin-right: 52px;

    }

    nav.navbar.navbar-default {
      height: 100px;
      background: none;
      box-shadow: none;
      border: none;
      padding-top: 25px;
      padding-left: 30px;
      padding-right: 75px;
    }

    .navbar-nav>li>a {
      padding-top: 10px;
      padding-bottom: 10px;
    }

    i.glyphicon.glyphicon-search {
      font-size: 20px;
      color: rgb(184, 182, 182);
    }

    #background {
      margin-top: -120px;
      background: url(ASET/img/animeee.jpg) no-repeat;
      background-size: cover;
      padding-top: 111px;
      height: 670px;
      max-height: 1112px;
    }

    #background .jumbotron {
      background: none;
      margin-left: 137px;
      max-width: 1000px;
      margin-top: 75px;
    }

    #background .jumbotron h1 {
      font-family: Garamond;
      color: white;
      margin-bottom: -12px;
    }

    #background .jumbotron p {
      font-family: Garamond;
      color: white;
      margin-bottom: -12px;
      margin-top: 27px;
      padding-right: 307px;
    }

    #home {
      text-align: justify;
      margin-inline-start: auto;
    }

    #home .container h1 {
      margin: 30px;
      font-family: Cambria;
      text-align: center;
    }

    #home .container .row {
      margin: -3px;
      font-family: Garamond;
      text-align: justify;
    }

    #home .partsatu .container.satu {
      background-color: #f9f8f8;
      margin-top: -85px;
      padding-bottom: 37px;
    }


    .glyphicon {
      position: relative;
      font-size: 35px;
      color: #306400;
    }

    #about {
      background-color: #082432;
      margin-top: 79px;
      color: #ddd;
      text-align: justify;
      font-family: Garamond;
    }

    #about .container {
      width: 100%;
      padding: 75px;
    }

    #about .container.footer .col-lg-6.col-md-6.col-sm-12.col-xs-12 {
      font-family: Garamond;
      color: #ddd;
    }

    #about .container.footer .col-lg-6.col-md-6.col-sm-12.col-xs-11 {
      margin-top: 10px;
    }

    .input-group.input-group-lg {
      margin-top: 10px;
      color: #ffffff;
    }

    #COPYRIGHT {
      color: rgb(255, 255, 255);
      background-color: #10335b;
      font-family: Garamond;
    }
  </style>

</head>

<script src="<?= base_url('ASET/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('ASET/js/jquery.min.js') ?>"></script>


<body>
  <!-- navbar -->
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container" id="navbar">
      <div class="navbar-header">
        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      </div>
      <div class="collapse navbar-collapse" id="navcol-1">
        <!-- <ul class="nav navbar-nav navbar-right">
          <li role="presentation"><a href="<?= base_url('libcaffe/inputt') ?>">INPUT</a></li>
          <li role="presentation"><a href="<?= base_url('libcaffe/tabell') ?>">TABEL</a></li>
          <li role="presentation"><a href="<?= base_url('libcaffe/petaa') ?>">PETA</a></li>
          <li role="presentation"><a href="<?= base_url('logout') ?>">LOGOUT</a></li>
        </ul> -->
      </div>
    </div>
  </nav>
  <!-- navbar -->

  <!-- <nav class="navbar bg-light">
    <div class="container-fluid">
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </nav> -->

  <!-- jumbotron -->
  <div id="background">
    <div class="jumbotron">
      <p>Underated to popular Library Cafe in Bandung</p>
      <h1>Bandung's LibCaffe</h1>
      <p><a href="<?= base_url('libcaffe/petaa') ?>" class="btn btn-default" role="button">EXPLORE WEBGIS</a></p>
    </div>
  </div>
  <!-- jumbotron -->

  <!-- home part 1 -->
  <div id="home">
    <div class="partsatu">
      <div class="container satu">
        <h1>ALASAN KE BANDUNG LAGI DAN SELALU MAU. 
          SELAIN LEMBANG DAN BRAGA. BUKAN JUGA KARENA SEBLAK.
          TAPI KARENA LIBRARY CAFE NYA DISETIAP SUDUT KOTA. 
        </h1>
        <hr>
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <i class="glyphicon glyphicon-book"></i>
            <h3>Kesenangan</h3>
            <p class="text-justify">alasan terbanyak kunjungan Library Cafe
              adalah kesenangan. Senang membaca, senang mendapati tempat umum
              yang tenang, senang menemukan wawasan baru, dan kesenangan lain 
              dari setiap yang orang yang tentu berbeda. Tapi setidaknya, selalu 
              ada alasan dibalik setiap kunjungan. 
            </p>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <i class="glyphicon glyphicon-camera"></i>
            <h3>Cantik</h3>
            <p class="text-justify">cantik, nyaman dan tenang merupakan 
              karakteristik yang bisa sesuai dengan Library Cafe. Setiap orang 
              dikota ini, mengunjunginya untuk membaca, mencari buku favoritnya, 
              atau sekadar membeli kopi dan memotret cantiknya sudut membaca di Kota Kembang
            </p>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <i class="glyphicon glyphicon-education"></i>
            <h3>Kota Pelajar</h3>
            <p class="text-justify">memiliki setidaknya 11 Perguruan tinggi Negeri
              ditambah dengan puluhan perguruan tinggi swasta lainnya, Bandung layak
              ditetapkan sebagai salah satu kota Pelajar di Indonesia. Dan karena 
              itulah, tidak heran jika library cafe banyak ditemukan dikota ini. 
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- home part 1 -->

  <!-- tentang -->
  <div id="about">
    <div class="container footer">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h2>About</h2>
        <hr>
        <p> Bandung's Library Cafe merupakan Web berbasis spasial yang tujuan dan harapannya menghimpun, memperbarui dan membagikan
          tempat ternyaman dan tercantik dikota ini, selain Lembang dan Bolu susunya. Biasanya disebut dengan Library Cafe. Kebanyakan juga
          menyebutnya Bookstore and Coffe. Apapun sebutannya, karakteristiknya sama. Cantik, tenang dan nyaman.</p>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-11">
        <h2>Click below to connect us </h2>
        <div class="input-group input-group-lg">
          <input type="text" class="form-control" value="Write Anything Here">
          <div class="input-group-btn">
            <button class="btn btn-default" type="button"><a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSBptJR
                WQpqfmfJBQMQmnkvQQKjWKDzGfmmrqQFsFjKNZxPjXBdVVfvNvXRMkcvGJjHTDsGX">Submit</a></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- about -->

  <!-- copyret -->
  <div id="COPYRIGHT">
    <div class="container">
      <h5 class="text-center">Underated to popular Library Cafe in Bandung : Bandung's Library Cafe © 2022</h5>
    </div>
  </div>
  <!-- copyret -->
</body>

</html>