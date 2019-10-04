<?php
@session_start();
/*if (isset($_SESSION['is_Login']) && $_SESSION['is_Login']){
    header("Location: index.php");
    }*/
    if(!isset($_SESSION['rank']) || $_SESSION['rank']=="normal")
    {
        header("Location: ../message_board.php");
    }


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
        <meta name="author" content="Yunyung">
        <title>後台-留言板管理-彰師戲院</title>
        <link rel="icon" href="../img/favicon.ico" />
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <!-- Custom styles -->
        <link rel="stylesheet" href="../css/business.css">
        <link rel="stylesheet" href="../css/message_board.css">
        <!-- datatable -->
        <link href="../datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="../datatable/toastr.min.css" rel="stylesheet">
        <script src="../datatable/jquery-3.3.1.js"></script>
        <script src="../datatable/jquery.dataTables.min.js"></script>
        <script src="../datatable/dataTables.bootstrap4.min.js"></script>
        <script src="../datatable/jquery.validate.min.js"></script>
        <script src="../datatable/messages_zh_TW.js"></script>
        <script src="../datatable/toastr.min.js"></script>
        <script src="../js/board_admin.js"></script>
        <script type="text/javascript">
        $(function() {
            $.ajax({ //load movie list
                url: "../phpfunction/board_ajax.php",
                data: { oper: 'qry_movie' },
                type: 'POST',
                dataType: "json",
                success: function(JData) {

                    $("#movie_detail").empty();

                    for (var i = 0; i < JData.movie_name.length; i++) {

                        var row = "<tr><td>" + JData.movie_id[i] + "</td><td>" + JData.movie_name[i] + "</td></tr>";

                        $('#movie_detail').append(row);
                    }


                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.responseText);
                    alert(xhr.responseText);
                }
            });
        });
        </script>
    </head>

    <body>
        <div id="wrapper">
            <!-- include navbar -->
            <?php include_once 'pageHeader.php';?>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">電影代號對照表</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table id="movie_detail">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="contentBanner">
                <div class="container col-md-10">
                    <div class="row ">
                        <div class="col-sm-12">
                            <div class="my-4">
                                <h1 class="titleBg MovieListTitle" style="color: #c33;">留言板管理</h1>
                            </div>
                        </div>
                        <!-- CurrentPath  -->
                        <div class="col-sm-12" id="currentPath">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">後台首頁</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">討論區管理</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="FormPanel pb-2">
                            <div class="Panel-heading mb-3">
                                <div class="Panel-Title">
                                    <h4>管理者頁面</h4>
                                </div>
                                <div id="admin">
                                    <form class="form-horizontal form-inline" name="form1" id="form1" method="post">
                                        <input type="hidden" name="oper" id="oper" value="insert">
                                        <input type="hidden" name="mes_id_old" id="mes_id_old" value="">
                                        <table id="edit" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">留言代號</th>
                                                    <th class="text-center">留言姓名</th>
                                                    <th class="text-center">電影代號</th>
                                                    <th class="text-center">內容</th>
                                                    <th class="text-center">留言日期</th>
                                                    <th class="text-center">存檔/取消</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <input size="3" type="text" id="mes_id" name="mes_id" readonly="true">
                                                    </td>
                                                    <td class="text-center">
                                                        <input size="3" type="text" id="user_id" name="user_id">
                                                    </td>
                                                    <td class="text-center">
                                                        <input size="3" type="text" id="movie_id" name="movie_id">
                                                    </td>
                                                    <td class="text-center">
                                                        <textarea style="font-size:15px;" id="content" name="content"></textarea>
                                                    </td>
                                                    <td class="text-center">
                                                        <input size="4" type="text" id="mes_date" name="mes_date">
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-primary btn-xs movieBtn" id="btn-save"><i class="glyphicon glyphicon-save"></i>存檔</button>
                                                        <button type="reset" class="btn btn-danger btn-xs movieBtn" id="btn-cancel">取消</button>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                        <button type="button" class="btn btn-primary movieBtn" data-toggle="modal" data-target="#exampleModal">
                                            電影代號對照表
                                        </button>
                                        <!--edit end -->
                                </div>
                            </div>
                            <div>
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="table-danger">
                                            <th class="text-center">留言代號</th>
                                            <th class="text-center">留言姓名</th>
                                            <th class="text-center">電影代號</th>
                                            <th class="text-center">內容</th>
                                            <th class="text-center">留言日期</th>
                                            <th class="text-center">修改/刪除</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
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
        <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JS -->
        <script src="../js/commonUse.js"></script>
    </body>

    </html>