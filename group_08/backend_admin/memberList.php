<?php
@session_start();
// 判斷是否是管理者 
if (!(isset($_SESSION['rank']) && $_SESSION['rank'] == "admin")){
    header("Location: ../memberLogin.php");
}
require_once "../DB_Setting/DB.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title>後台-會員管理-彰師戲院</title>
    <link rel="icon" href="../img/favicon.ico" />
    <!-- Bootstrap4 core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/business.css">
    <link rel="stylesheet" type="text/css" href="../css/movieDataTables.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="../fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
</head>

<body>
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php';?>
        <div id="contentBanner">
            <div class="container">
                <div class="row">
                    <!-- Title-->
                    <div class="col-sm-12">
                        <div class="my-4">
                            <h1 class="titleBg" style="color: #c33;">會員管理</h1>
                        </div>
                    </div>
                    <!-- /.Title-->
                    <div class="col-sm-12" id="currentPath">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">後台首頁</a></li>
                                <li class="breadcrumb-item active" aria-current="page">會員管理</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- add new movie -->
                    <div class="col-sm-12 mb-5">
                        <div class="col-sm-12 my-2 mb-3">
                            <button class="btn btn-success movieBtn" role="button" id="btn-insertMember">新增會員</button>
                        </div>
                        <table id="memberTable" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr class="table-warning">
                                    <th></th>
                                    <th>真實姓名</th>
                                    <th>使用者帳號</th>
                                    <th>暱稱</th>
                                    <th>權限</th>
                                    <th>註冊日期</th>
                                    <th>修改/刪除</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
                <div class="modal-dialog movieModal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="memberModal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modal-body">
                            <p id="modal-message" style="font-weight: bold;"></p>
                            <form id="memberForm" name="memberForm" method="POST">
                                <input type="hidden" name="oper" id="oper" value="">
                                <input type="hidden" name="user_id" id="user_id" value="">
                                <div id="form-container">
                                </div>
                                <div class="btnArea">
                                    <button type="button" class="btn btn-secondary movieBtn" data-dismiss="modal">取消</button>
                                    <button type="submit" class="btn btn-success movieBtn">提交</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary movieBtn" data-dismiss="modal">取消</button>
                            <button type="button" class="btn btn-success movieBtn" id="btn-ModalConfirm">確定</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal -->
        </div><!-- /.contentBanner -->

        <!-- Footer -->
        <?php include_once 'footer.php';?>
    </div>
    <!-- /.wrapper -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- toastr.js -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/commonUse.js"></script>
    <script src="../js/memberList_admin.js"></script>
</body>

</html>