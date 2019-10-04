<?php
@session_start();
// 判斷是否是管理者 
if (!(isset($_SESSION['rank']) && $_SESSION['rank'] == "admin")){
    header("Location: ../memberLogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title>後台-彰師戲院</title>
    <link rel="icon" href="../img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/business.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="..\fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
    <style>
        div.admin-link-block{
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 3% 3%;
            color: #fff;
            font-weight: bold;
            min-height: 200px;
            width: auto;
            
            font-size: 1.5rem;
            border-radius: 5px;
            box-shadow: 8px 5px 5px rgba(0,0,0,.5);
            cursor: pointer;
        }

        div#b1{
            background: #d0e4f7; /* Old browsers */
            background: -moz-linear-gradient(top, #d0e4f7 0%, #73b1e7 24%, #0a77d5 50%, #539fe1 79%, #87bcea 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top, #d0e4f7 0%,#73b1e7 24%,#0a77d5 50%,#539fe1 79%,#87bcea 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, #d0e4f7 0%,#73b1e7 24%,#0a77d5 50%,#539fe1 79%,#87bcea 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d0e4f7', endColorstr='#87bcea',GradientType=0 ); /* IE6-9 */
        }

        div#b2{
            background-image: linear-gradient(to right, #ff8177 0%, #ff867a 0%, #ff8c7f 21%, #f99185 52%, #cf556c 78%, #b12a5b 100%);
        }

        div#b3{
            background-image: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
        }

        div#b4{
            background-image: linear-gradient(to right, #b8cbb8 0%, #b8cbb8 0%, #b465da 0%, #cf6cc9 33%, #ee609c 66%, #ee609c 100%);
        }

        div#b5{
            background-image: linear-gradient(to top, #30cfd0 0%, #330867 100%);
        }


        div.admin-link-block a{
            position:absolute;
            top:0px;
            left:0px;
            width:100%;
            height:100%;
            display:inline;
        }



    </style>
</head>

<body class="movieBg">
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php';?>
        <div id="contentBanner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 mx-auto alert alert-warning mt-3" role="alert" style="font-size: 20px">
                        
                        歡迎 <span class="movieAzureAlert">管理者 <i class="fas fa-user"></i> <? echo $_SESSION['userAccount']; ?></span> 來到後台首頁！
                    </div>
                    <div class="col-2 col-md-3 admin-link-block" id="b1">
                        會員管理
                        <a href ='memberList.php'></a>
                    </div>
                    <div class="col-3 admin-link-block" id="b2">
                        留言版管理
                        <a href ='message_board_admin.php'></a>
                    </div>
                    <div class="col-3 admin-link-block" id="b3">
                        會員訂單管理
                        <a href ='cart.php'></a>
                    </div>
                    <div class="col-3 admin-link-block" id="b4">
                        上映電影管理
                        <a href ='movieList.php'></a>
                    </div>
                    <div class="col-3 admin-link-block" id="b5">
                        下架電影管理
                        <a href ='movieListNoLaunched.php'></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.contentBanner -->
        <!-- Footer -->
        <?php include_once 'footer.php';?>
    </div>
    <!-- /.wrapper -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/commonUse.js"></script>
</body>

</html>