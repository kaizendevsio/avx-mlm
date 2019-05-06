
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <?php include('assets/header.php'); ?>

        <style>
          canvas {
              display: block;
              vertical-align: bottom;
          }

          /* ---- particles.js container ---- */

        #particles-js { position: absolute; width: 100%; height: 100vh; background-image: url("assets/images/bkg1.jpg"); background-repeat: no-repeat; background-size: cover; background-position: 50% 50%; }
      </style>

</head>
<body style="overflow:hidden">
    <!--SCREEN GUARD-->
    <div id="screenguard" class="screenGuard animated fadeIn"></div>

    <!--PRELOADER-->
    <div id="view_loader" class="page animated fadeIn" style="z-index: 2500; background-color: rgba(0, 0, 0, 0.0); width:100%; background:none;">
        <div class="page_bkg  w3-display-container" style="background-color: rgba(0, 0, 0, 0.00); ">

            <div id="loaderWin" class="w3-center w3-display-middle" style="min-height: 100px; border-radius:50px; padding-top:25px; width: 100px; padding-left: 10px; padding-right: 10px; background-color: #ffffffc2; display:block; margin-left:auto; margin-right:auto">

                <img class="" style="width:50px" src="assets/images/preload_apple.svg" />

            </div>

        </div>
    </div>
    <?php include('overlays.php'); ?>
    <?php include('views.php'); ?>

</body>

<?php include('assets/footer.php');

    if (isset($_GET['link'])){
    echo '<script>setSponsor("' . $_GET['link'] . '")</script>';
    }
?>

</html>