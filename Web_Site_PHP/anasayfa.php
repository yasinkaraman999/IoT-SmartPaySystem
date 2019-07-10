<?php
session_start();
include "mysqlconnect.php";
if($_SESSION["kartId"]!=""){ 

  $id = $_GET['id']; 
  $query = $db->query("SELECT * FROM kartlar WHERE kartID = '{$_SESSION["kartId"]}'")->fetch(PDO::FETCH_ASSOC);






  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMARTCARD- YASİN KARAMAN</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <style type="text/css">
      #table-wrapper {
        position:relative;

      }
      #table-scroll {
       height: 400px;
       overflow:auto;  
       margin-top:20px;
     }
     #table-scroll1 {
       height: 200px;
       overflow:auto;  
       margin-top:20px;
     }
     #table-scroll2 {
       height: 200px;
       overflow:auto;  
       margin-top:20px;
     }
     #table-wrapper table {
      width:100%;

    }


  </style>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">SMARTCARD</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="anasayfa.php">Anasayfa
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="yuklemeyap.php">Yukleme Yap</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cikis.php">Çıkış</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">SMARTCARD</h1>
        <div class="list-group">
          <a href="anasayfa.php" class="list-group-item">Anasayfa</a>
          <a href="yuklemeyap.php" class="list-group-item">Yukleme Yap</a>
          <a href="cikis.php" class="list-group-item">Çıkış</a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
      <br>
       <div class="alert alert-success" role="alert">
        Mevcut Bakiye <a href="#" class="alert-link"><?=$query["bakiye"];?></a>&nbsp;TL.  
      </div>
      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">

        <div class="row">
          <div class="col-md-6">
            <h1 class="form-control">Günlük Kullanım</h1>
            <div id="table-wrapper">
              <div id="table-scroll1">
                <table class="table" >
                  <thead>
                    <tr>
                      <th scope="col">Kart Id</th>
                      <th scope="col">Toplam Kullanım(TL)</th>
                      <th scope="col">Tarih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $hareket_gecmisi = $db->query("SELECT  kartID, CAST(tarih AS DATE) as tarih, SUM(bakiye) as bakiye_toplam FROM kartHareketleri where kartID='{$_SESSION["kartId"]}'  GROUP BY CAST(tarih AS DATE)", PDO::FETCH_ASSOC);
                    if ( $hareket_gecmisi->rowCount() ){
                     foreach( $hareket_gecmisi as $row ){
                      ?>
                      <tr>
                        <th scope="row"><?=$row['kartID']?></th>
                        <td><?=$row['bakiye_toplam']?>TL</td>
                        <td><?=$row['tarih']?></td>
                      </tr>
                      <?php
                    }
                  } 

                  ?>

                </tbody>
              </table>
            </div></div>
          </div>

          <div class="col-md-6">
            <h1 class="form-control">Aylık Kullanım</h1>
            <div id="table-wrapper">
              <div id="table-scroll1">
                <table class="table" >
                  <thead>
                    <tr>
                      <th scope="col">Kart Id</th>
                      <th scope="col">Toplam Kullanım(TL)</th>
                      <th scope="col">Tarih(AY)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $hareket_gecmisi = $db->query("SELECT  kartID, MONTH(tarih) as tarihx, year(tarih) as tarihc, SUM(bakiye) as bakiye_toplam FROM kartHareketleri where kartID='{$_SESSION["kartId"]}'  GROUP BY MONTH(tarih),year(tarih)", PDO::FETCH_ASSOC);
                    if ( $hareket_gecmisi->rowCount() ){
                     foreach( $hareket_gecmisi as $row ){
                      ?>
                      <tr>
                        <th scope="row"><?=$row['kartID']?></th>
                        <td><?=$row['bakiye_toplam']?>TL</td>
                        <td><?=$row['tarihc']; ?>.<?=$row['tarihx'];?></td>
                      </tr>
                      <?php
                    }
                  } 

                  ?>

                </tbody>
              </table>
            </div></div>
          </div>
        </div>


        <br><br>

        <h1 class="form-control">Son Hareketler</h1>
        <div id="table-wrapper">
          <div id="table-scroll">
            <table class="table" >
              <thead>
                <tr>
                  <th scope="col">Kart Id</th>
                  <th scope="col">Bakiye</th>
                  <th scope="col">Tarih</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $hareket_gecmisi = $db->query("SELECT * FROM kartHareketleri where kartID='{$_SESSION["kartId"]}'", PDO::FETCH_ASSOC);
                if ( $hareket_gecmisi->rowCount() ){
                 foreach( $hareket_gecmisi as $row ){
                  ?>
                  <tr>
                    <th scope="row"><?=$row['kartID']?></th>
                    <td><?=$row['bakiye']?>TL</td>
                    <td><?=$row['tarih']?></td>
                  </tr>
                  <?php
                }
              } 

              ?>

            </tbody>
          </table>
        </div></div>


        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
  <div class="container">
    <p class="m-0 text-center text-white">YASİN KARAMAN &copy; SMARTCARD 2019</p>
  </div>
  <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>




<?php }else{
  Header("Location:../index.php");

}

?>



