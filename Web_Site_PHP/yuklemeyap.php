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

    <title>TL YÜKLE - SMARTCARD- YASİN KARAMAN</title>

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
          <li class="nav-item ">
            <a class="nav-link" href="anasayfa.php">Anasayfa
             
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="yuklemeyap.php">Yukleme Yap</a>
             <span class="sr-only">(current)</span>
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
       <div class="row">
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">TL YÜKLEME </h4>
          <form class="needs-validation" action="ode.php" method="POST">
          

            
            <hr class="mb-4">

            <h4 class="mb-3">Ödeme</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">KREDİ KARTI</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Kart Sahibi</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Kart Üzerindeki İsim</small>
         
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Kredi Kartı Numarası</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
  
              </div>
            </div>
            <div class="row">
              <div class="col-md-1 mb-3">
                <label for="cc-expiration">Ay</label>
                <input type="text" class="form-control" id="ay" placeholder="Ay" required>
              </div>
               <div class="col-md-1 mb-3">
                <label for="cc-expiration">Yıl</label>
                <input type="text" class="form-control" id="ay" placeholder="Yıl" required>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="number" class="form-control" id="cc-cvv" placeholder="" required>
       
              </div>
              <div class="col-md-3 mb-3">
               
              </div>
              <div class="col-md-4 pull-rigth">
                <label for="cc-expiration">TUTAR</label>
                <input type="number" class="form-control" id="tutar" name="tutar" placeholder="" required>
       
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Öde</button><br>
          </form>
        </div>
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



