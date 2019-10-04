<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計作業">
    <title>網路報名系統</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/customCSS.css">
    <link rel="stylesheet" href="css/Responsive.css">

    <link rel="stylesheet" href="css/document_upload.css">
</head>

<body>
    <div class="wrapper">
        <!-- include Topbar file -->
        <?php include_once 'Topbar.php';?>
        <!-- content -->
        <div class="content_wrapper">
            <div class="container">
                <!-- Title -->
                <div class="row">
                    <h2 class="mx-auto mt-3">報名資料檔案上傳</h2>
                </div>
                <!-- form -->
                <div class="row">
                    <form class="upload-document-form" id="upload_document" method="POST" action="#" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col">
                                <legend class="col-12">1.個人基本資料表</legend>
                                <legend class="col-12">【包含入學申請表、身分證明文件、具結書、檢核表及切結書】</legend>
                            </div>
                            <div class="form-group col upload-file-div">
                                <input type="file" name="upload_file[]">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <legend class="col-12">1.個人基本資料表</legend>
                                <legend class="col-12">【包含入學申請表、身分證明文件、具結書、檢核表及切結書】</legend>
                            </div>
                            <div class="form-group col upload-file-div">
                                <input type="file" name="upload_file[]">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <legend class="col-12">2.學歷證明資料</legend>
                            </div>
                            <div class="form-group col upload-file-div">
                                <input type="file" name="upload_file[]">
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col">
                                <legend class="col-12">3.自傳（申請碩、博士班須含讀書計畫）  </legend>
                            </div>
                            <div class="form-group col upload-file-div">
                                <input type="file" name="upload_file[]">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <legend class="col-12">4.其他應繳資料</legend>
                                <legend class="col-12">【包含財力證明或獎學金證明、各招生系所規定之證明文件、申請就讀博士班者，另檢附碩士學位論文】</legend>
                            </div>
                            <div class="form-group col upload-file-div">
                                <input type="file" name="upload_file[]">
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div style="padding: 10px">
                                <p>※有關上述上傳相關說明，請詳閱招生簡章第 ○ ~ ○ 頁</p>
                                <p>上傳檔案類型限PDF檔(*.pdf)<br>
                                    檔案名稱請不要使用中文字，且長度不可超過20個字<br>
                                    單一檔案大小不得超過30M Kbytes

                                </p>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary agree-button">檔案上傳</button>
                                <button type="reset" class="btn btn-danger agree-button">清除</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- include foolter file -->
        <?php include_once 'footer.php';?>
    </div>
    <!-- /.wrapper -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/customJS.js"></script>

    <script>
        $(function(){
            $("#upload_document").submit(function(){
                alert("執行送出!");
            });

            $("button[type='reset']").click(function(){
                alert("執行清除!");
            });
        });
    </script>
</body>

</html>