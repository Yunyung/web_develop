<?
    @session_start();
    require_once "DB_Setting/DB.php";
    if(!isset($_SESSION['is_Login'])){
        header("Location: memberLogin.php");
    }
    $movieID = $_GET['id'] ;
    $sql = "SELECT * FROM cart WHERE movieID='" . $movieID . "' AND userAccount='" . $_SESSION['userAccount'] . "' and state = '已結帳'";
    $query = mysqli_query($_SESSION['link'],$sql);
    if(mysqli_num_rows($query) == 0){
        header("Location: cart.php");
    }

    $sql = "SELECT * FROM movie WHERE id = '{$movieID}'";
    $query = mysqli_query($_SESSION['link'],$sql);
    $row = mysqli_fetch_assoc($query);
    $chi_name = $row['chi_name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title><?= $chi_name ?>-彰師戲院</title>
    <link rel="icon" href="img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/business.css">
    <link rel="stylesheet" href="css/movie.css">
    <!-- slick css-->
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">
    <link rel="stylesheet" href="fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
</head>

<body onload="resize();">
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php'; ?>
        <!--  用來留出header及footer區塊的空間  -->
        <div id="contentBanner">
            <div class="col-sm-12">
                <div class="my-4">
                    <h1 class="titleBg" style="color: #c33;">正在播放-<?= $chi_name ?></h1>
                </div>
            </div>
            <div class="col-lg-10 mt-5 mx-auto" >                    
                    <?php 
                        echo "<iframe src='".$row['trailer_path']."?autoplay=1' name='mainframe' width='100%' marginwidth='0' marginheight='0' scrolling='No' frameborder='0' id='mainframe' ></iframe> ";
                    ?>
            </div>               
        </div>
        <input type="hidden" id = "movieID" value="<?=$_GET['id']; ?>">
        <!-- /.contentBanner -->
        <!-- /.news -->
        <!-- Footer -->
        <?php include_once 'footer.php';?>
    </div>
    <!-- /.wrapper -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/commonUse.js"></script>
    <script src="slick/slick.js"></script>
    <script>
    $(document).ready(function(){
        var height=$(window).height();
       $('#mainframe').height(height*0.7);
    });

    $(window).resize(function(){
        var height=$(window).height();
       $('#mainframe').height(height*0.7);
    });
    </script> 
</body>

</html>

