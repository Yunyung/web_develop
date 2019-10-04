<?
    @session_start();
    require_once "DB_Setting/DB.php";
    if(!isset($_SESSION['userAccount'])){
        header("location:memberLogin.php");
    }
    if(!isset($_GET['type']))// 選擇  /待付款 /已付款 /取消訂單 /你他媽
    {
        $type = 0; //預設待付款
    }
    else
    {
        $type = $_GET['type'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title>購物車-彰師戲院</title>
    <link rel="icon" href="img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/business.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
</head>

<body>
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php'; ?>
        <!--  用來留出header及footer區塊的空間  -->
         <div id="contentBanner">
            <div class="container">
                <!-- purchase-list bar-->
                <div class="row shadow mt-5">
                    <?php 
                        $state = array("待付款", "已結帳", "最近取消的訂單");
                        for($i = 0; $i < 3 ; $i++)
                        {
                            if($i == $type){
                                echo " <div class='purchase_list col-lg-4 pl_selected'>".$state[$i]."</div>";
                            }
                            else{
                               echo " <div class='purchase_list col-lg-4'>".$state[$i]."</div>";
                            }
                        } 
                    ?>                    
                </div>
                <?php if($type == 0): ?>
                <div class='row shadow mt-4 bgc' style='font-size: 1.2em' align='center'>
                    <div class='col-lg-3'>
                        商品   
                    </div>
                    <div class='col-lg-3'>
                        價格
                    </div>
                     <div class='col-lg-3'>
                        商品 
                    </div>
                     <div class='col-lg-3'>
                        價格
                    </div>
                </div>
                <? endif; ?>

                <div class="row bgc shadow my-3">
                    <table>
                    <?php
                        switch ($type) {
                            case 0:
                                $sql = "SELECT * FROM cart ,movie WHERE id = movieID and  userAccount = '".@$_SESSION['userAccount']."' and state = '待付款'";
                                $result = mysqli_query($_SESSION['link'],$sql);

                                if($result&&mysqli_affected_rows($_SESSION['link']) > 0)
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo"<div class='col-lg-3 col-md-6 col-sm-6 my-3'>
                                                    <img src='".$row['cover_path']."' width=100% >                                             
                                             </div>
                                             <div class='col-lg-3 col-md-6 col-sm-6 my-4 ' align='center'>
                                                <div class='trash_can'>
                                                    <i class='fas fa-trash-alt fa-2x'></i>
                                                </div>
                                                <div class='movie_name_font col-lg-11'>
                                                    <h3>".$row['chi_name']."<h3>
                                                </div>
                                                <br>
                                                <div class='my-auto'>
                                                    <h1 class='mt-4 price'>$".$row['price']."</h1>
                                                </div>
                                                <br>
                                                <div class='loc_buttom'>                                                    
                                                    <a href='movieDetail.php?id=".$row['id']."'><button class='btn movieBtn btn-info btn-lg btn-size mx-2'>電影資訊</button></a>
                                                    <button class='btn movieBtn btn-danger btn-lg btn-size checkout' >結帳</button>
                                                    <input type='hidden' id ='movieID' value='".$row['id']."'>
                                                </div>
                                            </div>
                                            ";
                                    }
                                
                                else
                                    echo"<div style='width:100%;height:500px;' align='center'><br><br><br>尚未訂購商品<br><br>
                                            <a href='movieList.php'><button class='btn movieBtn btn-info'>點此前往購物</button></a>
                                         <div>";
                                break;
                            case 1:
                                $sql = "SELECT * FROM cart ,movie WHERE id = movieID and  userAccount = '".@$_SESSION['userAccount']."' and state = '已結帳'";
                                $result = mysqli_query($_SESSION['link'],$sql);
                                if($result&&mysqli_affected_rows($_SESSION['link']) > 0)
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo"<div class='col-lg-3 col-md-4 col-sm-6 mt-3 mb-1'>
                                                    <img src='".$row['cover_path']."' width=100%' height='350px' >  
                                                    <div class='mt-4 loc-buttom'>
                                                        <a href='movieDetail.php?id=".$row['id']."'>
                                                            <button class='btn movieBtn btn-info  btn-size'>電影資訊</button>
                                                        </a>  
                                                        <a href='play_movie.php?id=".$row['id']."'>
                                                            <button class='btn movieBtn btn-success  btn-size '>立即觀看</button>
                                                        </a>       
                                                    </div>                                    
                                             </div>
                                             
                                            ";
                                    }
                                
                                else
                                    echo"<div style='width:100%;height:500px;' align='center'><br><br><br>尚未訂購商品<br><br>
                                            <a href='movieList.php'><button class='btn movieBtn
                                             btn-info'>點此前往購物</button></a>
                                         <div>";
                                break;

                            case 2:
                                $sql = "SELECT * FROM cart ,movie WHERE id = movieID and  userAccount = '".@$_SESSION['userAccount']."' and state = '最近取消的訂單'";
                                $result = mysqli_query($_SESSION['link'],$sql);
                                if($result&&mysqli_affected_rows($_SESSION['link']) > 0)
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo"<div class='col-lg-3 col-md-4 col-sm-6 mt-3 mb-1'>
                                                    <img src='".$row['cover_path']."' width=100%' height='349px' >  
                                                    <div class='mt-2 CartbtnArea'>
                                                        <a href='javascript:void(0)'>
                                                            <button class='btn movieBtn btn-info  btn-cart del_rec'> 刪 除<br>紀 錄 </button>
                                                        </a>  
                                                        <a href='javascript:void(0)' class='ml-4'>
                                                            <button class='btn movieBtn btn-danger  btn-cart add_to_cart'>加 至<br>購 物 車 </button>
                                                        </a>
                                                        <input type='hidden' id ='movieID' value='".$row['id']."'>       
                                                    </div>                                    
                                             </div>
                                             
                                            ";
                                    }
                                
                                else
                                    echo"<div style='width:100%;height:500px;' align='center'><br><br><br>最近無取消商品<br><br>
                                            <a href='movieList.php'><button class='btn  movieBtn btn-info'>點此前往購物</button></a>
                                         <div>";
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                    ?>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include_once 'footer.php';?>
    </div> <!-- /.wrapper -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/commonUse.js"></script>
    <script src="js/cart.js"></script>
</body>

</html>