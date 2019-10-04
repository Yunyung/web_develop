<?php
@session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title>留言板-彰師戲院</title>
    <link rel="icon" href="img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/business.css">
    <!--test-->
    <link href="datatable/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="datatable/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/message_board.css">
    <script src="datatable/jquery-3.3.1.js"></script>
    <script src="datatable/jquery.dataTables.min.js"></script>
    <script src="datatable/dataTables.bootstrap.min.js"></script>
    <script src="datatable/jquery.validate.min.js"></script>
    <script src="datatable/messages_zh_TW.js"></script>
    <script src="datatable/toastr.min.js"></script>
    <link rel="stylesheet" href="fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
    <script>
    $(function() {

        if (<?php if(!isset($_GET['page'])) echo "-1"; else echo $_GET['page']; ?> == -1 && <?php if(!isset($_GET['movie'])) echo "-1"; else echo $_GET['movie']; ?> == -1)
            location.href = location.href + "?page=1&movie=-1";
        $.ajax({ //load movie list
            url: "phpfunction/board_ajax.php",
            data: { oper: 'qry_movie' },
            type: 'POST',
            dataType: "json",
            success: function(JData) {
                $("#movie_n").empty();
                //$('#movie_n').append("<option value=''></option>");
                var row = "<option value=-1>ALL</option>";
                var movie = <?php if(!isset($_GET['movie'])) echo "-1"; else echo $_GET['movie']; ?>;
                $('#movie_n').append(row);
                for (var i = 0; i < JData.movie_name.length; i++) {
                    if (movie != JData.movie_id[i])
                        var row = "<option value=" + JData.movie_id[i] + ">" + JData.movie_name[i] + "</option>";
                    else
                        var row = "<option value=" + JData.movie_id[i] + " selected>" + JData.movie_name[i] + "</option>";
                    $('#movie_n').append(row);
                }
                $("#movie_sel").empty();

                for (var i = 0; i < JData.movie_name.length; i++) {
                    if (movie != JData.movie_id[i])
                        var row = "<option value=" + JData.movie_id[i] + ">" + JData.movie_name[i] + "</option>";
                    else
                        var row = "<option value=" + JData.movie_id[i] + " selected>" + JData.movie_name[i] + "</option>";
                    $('#movie_sel').append(row);
                }


            },
            /*error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.responseText);
                  alert(xhr.responseText);
            }*/
        });
        $.ajax({ //load mes
            url: "phpfunction/board_ajax.php",
            data: { oper: 'qry_department', movie_n_id: <?php if(!isset($_GET['movie'])) echo "-1"; else echo $_GET['movie']; ?> },
            type: 'POST',
            dataType: "json",
            success: function(JData) {
                $("#movie_mes").empty();
                var page;
                page = <?php if(!isset($_GET['page'])) echo "1"; else echo $_GET['page']; ?>;
                //alert(page);

                for (var i = (page - 1) * 5; i <= page * 5 - 1; i++) {
                    if (JData.user_nick_name[i] == undefined)
                        break;
                    var uid = <?php if(!isset($_SESSION['id'])) echo "-1"; else echo $_SESSION['id']; ?>;
                    if (uid != JData.user_id[i])
                        var row = "<div class=\"card bg-light  \"  style=\"width:100% \">          <div class=\"card-header\"><span style=\"font-size:20px;\">" + JData.user_nick_name[i] + "</span> <span style=\"font-size:12px;\">在 </span><span style=\"font-size:20px;\">" + JData.movie_chi[i] + "(" + JData.movie_eng[i] + ")</span> <span style=\"font-size:12px;\">中，說了</span> <div style=\"float:right\">" + JData.mes_date[i] + "</div></div>          <div class=\"card-body card-content\">            <h5 class=\"card-title\"></h5>            <p class=\"card-text\">" + JData.content[i] + "</p>          </div>        </div>";
                    else
                        var row = "<div class=\"card bg-light  \"  style=\"width:100% \">          <div class=\"card-header\"><span style=\"font-size:20px;\">" + JData.user_nick_name[i] + "</span> <span style=\"font-size:12px;\">在 </span><span style=\"font-size:20px;\">" + JData.movie_chi[i] + "(" + JData.movie_eng[i] + ")</span> <span style=\"font-size:12px;\">中，說了</span> <div style=\"float:right\">" + JData.mes_date[i] + "</div></div>          <div class=\"card-body card-content\">            <h5 class=\"card-title\"></h5>            <p class=\"card-text\" id=\"cont\">" + JData.content[i] + "</p><div style=\"float:right\"><button onclick=\"load_form(" + JData.mes_id[i] + ")\" type=\"button\" class=\"btn btn-primary movieBtn\" data-toggle=\"modal\" data-target=\"#exampleModal2\" id=\"modify\">修改</button><button onclick=\"del(" + JData.mes_id[i] + ")\" type=\"button\" class=\"btn btn-danger movieBtn\" id=\"del\">刪除</button></div>          </div>        </div>";
                    $('#movie_mes').append(row);
                    //alert("<?php if(!isset($_GET['page'])) echo "1"; else echo $_GET['page']; ?>");
                    var total_page = Math.ceil(JData.movie_eng.length / 5);
                    $("#mes_page").empty();
                    for (var j = 1; j <= total_page; j++) {
                        if (page == j)
                            var row = "<button type=\"button\" class=\"btn btn-info\">" + j + "</button>　　";
                        else
                            var row = "<a href='message_board.php?page=" + j + "&movie=" + $('#movie_n').val() + "'><button type=\"button\" class=\"btn btn-info movieBtn\">" + j + "</button></a>　　";
                        $('#mes_page').append(row);
                    }

                }
            },
            /*error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.responseText);
                  alert(xhr.responseText);
            }*/
        });
        $('#movie_n').on('change', function() {
            location.href = "message_board.php?page=1&movie=" + $('#movie_n').val();
        });
        $("#sub").on('click', function() {
            var user_id = <?php if(!isset($_SESSION['id'])) echo "-1"; else echo $_SESSION['id']; ?>;
            if (user_id == -1) {
                alert("請先登入");
                return;
            }
            $.ajax({ //load mes
                url: "phpfunction/board_ajax.php",
                data: { oper: 'add', user_id: user_id, movie_id: $("#movie_sel").val(), content: $("#content").val() },
                type: 'POST',
                dataType: "json",
                success: function() {

                }
                /*error: function(xhr, ajaxOptions, thrownError) {
                      console.log(xhr.responseText);
                      alert(xhr.responseText);
                }*/
            });
            alert("成功新增");
        });
        $("#update").on('click', function() {
            var user_id = <?php if(!isset($_SESSION['id'])) echo "-1"; else echo $_SESSION['id']; ?>;

            $.ajax({ //load mes
                url: "phpfunction/board_ajax.php",
                data: { oper: 'update', user_id: user_id, movie_id: $("#movie_sel_up").val(), content: $("#content_up").val(), mes_id: $("#mes_id").val() },
                type: 'POST',
                dataType: "json",
                success: function() {

                }
                /*error: function(xhr, ajaxOptions, thrownError) {
                      console.log(xhr.responseText);
                      alert(xhr.responseText);
                }*/
            });
            alert("成功修改");
        });

    });
    </script>
    <script src="js/board.js"></script>
</head>

<body>
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php';?>
        <div id="contentBanner">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">新增</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="mes_board" action="#" method="POST">
                                <label for="movie_name">電影名稱:</label>
                                <br>
                                <select size=1 name='movie_sel' id="movie_sel" required>
                                </select>
                                <div class="form-group">
                                    <label for="content">留言:</label>
                                    <textarea class="form-control" rows="5" id="content"></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary movieBtn" data-dismiss="modal">Close</button>
                            <button type="button " class="btn btn-success movieBtn" id="sub">提交</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <!-- Modal2 -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">修改</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="mes_board_up" action="#" method="POST">
                                <label for="movie_name">電影名稱:</label>
                                <br>
                                <select size=1 name='movie_sel_up' id="movie_sel_up" required>
                                </select>
                                <div class="form-group">
                                    <label for="content_up">留言:</label>
                                    <textarea class="form-control" rows="5" id="content_up"></textarea>
                                </div>
                                <input type="text" id="mes_id" hidden>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary movieBtn" data-dismiss="modal">Close</button>
                            <button type="button " class="btn btn-success movieBtn" id="update">提交</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal2 -->
            <div class="container col-md-10">
                <div class="row ">
                    <div class="FormPanel">
                        <div class="Panel-heading ">
                            <div class="Panel-Title">
                                <div style="float:right">
                                    <button type="button" class="btn btn-primary movieBtn" data-toggle="modal" data-target="#exampleModal">
                                        我要留言
                                    </button>
                                </div>
                                <h3>留言板</h3> 電影：
                                <select id="movie_n" name="movie_n"></select>
                            </div>
                        </div>
                        <div id="movie_mes" name="movie_mes">
                        </div>
                        <hr>
                        <div name="mes_page" id="mes_page">
                        </div>
                        <hr>
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
        <script src="jquery/jquery-3.3.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JS -->
        <script src="js/commonUse.js"></script>
</body>

</html>