<?php
@session_start();
require_once "../DB_Setting/DB.php";
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
    <title>後台-新增電影-彰師戲院</title>
    <link rel="icon" href="../img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/business.css">
    <!-- Custom styles -->
    <style type="text/css">
    .cover-img {
        height: 306px;
        max-width: 50%;
        margin-top: 20px;
    }

    .still-img {
        display: inline-block;
        margin-right: 10px;
        height: 160px;
        width: 30%;
        margin-top: 20px;
    }

    .categorys>input {
        margin-right: 3px;
    }

    table#dynamic-field-directors td,
    table#dynamic-field-actors td {
        padding-left: 0;
    }
    </style>
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="..\fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
</head>

<body class="movieBg">
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php';?>
        <div id="contentBanner">
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-4" id="currentPath">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">後台首頁</a></li>
                                <li class="breadcrumb-item"><a href="index.php">上映電影</a></li>
                                <li class="breadcrumb-item active" aria-current="page">新增電影</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- /.path div -->
                    <div class="movieFormPanel mt-2" style="width: 95%;">
                        <div class="Panel-heading">
                            <div class="Panel-Title">
                                新增電影
                            </div>
                        </div>
                        <form method="POST" id="addNewMovieForm" class="movieForm" action="../phpfunction/addNewMovie_admin.php" enctype="multipart/form-data">
                            <div class="">
                                <p class="movieRedAlert movieAzureAlert"><i class="fas fa-bell"></i>非必填欄位，如無輸入，呈現將顯示為'無資料'或不顯示</p>
                            </div>
                            <div class="form-group">
                                <label for="chi_name">1.電影中文名稱 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
                                <input type="text" class="form-control" id="chi_name" name="chi_name" placeholder="中文名稱">
                            </div>
                            <div class="form-group">
                                <label for="eng_name">2.電影英文名稱 </label>
                                <input type="text" class="form-control" id="eng_name" name="eng_name" placeholder="英文名稱">
                            </div>
                            <div class="form-group">
                                <label for="cover_image">3.封面圖片 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
                                <input type="file" class="form-control-file" id="cover_image" name="cover_image" accept="image/png, image/jpeg">
                                <div id="cover-image-holder"></div>
                                <small class="form-text text-muted">※ 請上傳封面電影顯示圖片(png,jpg)上傳照片解析度請上傳'寬 <
                                長'的圖片,9:16佳</small>
                            </div>
                            <div class="form-group">
                                <label for="still_image">4.電影劇照</label>
                                <input type="file" class="form-control-file" id="still_image" name="still_image[]" multiple accept="image/png, image/jpeg">
                                <div id="still_image-holder"></div>
                                <small class="form-text text-muted">※ 請上傳電影劇照, 可已框拉方式選擇多張照片(png,jpg)，上傳照片解析度請上傳'寬>
                                長'的圖片,16:9佳</small>
                            </div>
                            <div class="form-group">
                                <label for="releaseDate">5.上映日期</label>
                                <input type="date" class="form-control col-sm-6" id="releaseDate" name="releaseDate">
                            </div>
                            <div class="form-group">
                                <label for="trailer_path">6.預告片路徑</label>
                                <input type="text" class="form-control" id="trailer_path" name="trailer_path" placeholder="網址路徑">
                                <small class="form-text text-muted">※ 請輸入iframe網址 例:  https://www.youtube.com/embed/k2gcXBnvQSk</small>
                            </div>
                            <div class="form-group">
                                <label for="introduce">7.電影內容介紹</label>
                                <textarea class="form-control" id="introduce" name="introduce" rows="6" placeholder="電影介紹"></textarea>
                            </div>
                            <div class="form-group categorys">
                                <label for="category">8.電影分類 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
                                <br>
                                <input type="checkbox" name="category[]" id="categoryfirst" value="劇情">劇情
                                <input type="checkbox" name="category[]" value="動畫">動畫
                                <input type="checkbox" name="category[]" value="奇幻">奇幻
                                <input type="checkbox" name="category[]" value="冒險">冒險
                                <input type="checkbox" name="category[]" value="動作">動作
                                <input type="checkbox" name="category[]" value="科幻">科幻
                                <input type="checkbox" name="category[]" value="懸疑">懸疑
                                <input type="checkbox" name="category[]" value="驚悚">驚悚
                                <input type="checkbox" name="category[]" value="愛情">愛情
                                <input type="checkbox" name="category[]" value="喜劇">喜劇
                                <input type="checkbox" name="category[]" value="犯罪">犯罪
                                <input type="checkbox" name="category[]" value="其他">其他
                                <small class="form-text text-muted">※ 電影類型，可複選</small>
                            </div>
                            <div class="form-group">
                                <label for="Length">9.電影長度</label>
                                <select class="custom-select col-3 col-sm-2 col-lg-1" name="hour">
                                    <option value="-1"></option>
                                    <?
                                    for ($i = 0;$i <= 24;$i++)
                                    {

                                        if ($i < 10)
                                            echo "<option value='0{$i}'>0{$i}</option>";
                                        else
                                            echo "<option value='{$i}'>{$i}</option>";
                                    }
                                    ?>
                                </select>小時
                                <select class="custom-select col-3 col-sm-2 col-lg-1" name="minute">
                                    <option value="-1"></option>
                                    <?
                                    for ($i = 0;$i <= 60;$i++)
                                    {
                                        if ($i < 10)
                                            echo "<option value='0{$i}'>0{$i}</option>";
                                        else
                                            echo "<option value='{$i}'>{$i}</option>";
                                    }
                                    ?>
                                </select>分
                                <small class="form-text text-muted">※ 若時間未定，將選項下為空白即可</small>
                            </div>
                            <div class="form-group">
                                <label for="directors">10.導演 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
                                <table class="table" id="dynamic-field-directors">
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="directors[]" placeholder="導演">
                                        </td>
                                        <td>
                                            <button type="button" name="addDirectors" id="addDirectors" class="btn btn-orange movieBtn">增加一列</button>
                                        </td>
                                    </tr>
                                </table>
                                <small class="form-text text-muted">※ 若導演有多位可透過'新增'增加一列，動態增加導演數量</small>
                            </div>
                            <div class="form-group">
                                <label for="actors">11.演員 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
                                <table class="table" id="dynamic-field-actors">
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="actors[]" placeholder="演員">
                                        </td>
                                        <td>
                                            <button type="button" name="addActor" id="addActor" class="btn btn-info movieBtn">增加一列</button>
                                        </td>
                                    </tr>
                                </table>
                                <small class="form-text text-muted">※ 若演員有多位，可透過'新增'增加一列，動態增加演員數量</small>
                            </div>
                            <div class="form-group">
                                <label for="price">12.售價 <span class="movieRedAlert"><i class="fas fa-bell" ></i>必填欄位</span></label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="電影售價">
                            </div>
                            <div class="form-group">
                                <label for="isLaunched">13.是否將電影上架 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
                                <br>
                                <input type="radio" name="isLaunched" value="1">上架
                                <input type="radio" name="isLaunched" value="0">不上架
                                <small class="form-text text-muted">※ 選擇後，可再自行更改編輯</small>
                            </div>
                            <div class="form-group">
                                <label for="isNewProduct">14.是否標記為新上映電影 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
                                <br>
                                <input type="radio" name="isNewProduct" value="1">是
                                <input type="radio" name="isNewProduct" value="0">否
                                <small class="form-text text-muted">※ 若選 '是' 呈現將有新上映電影Tag，之後可再自行更改編輯</small>
                            </div>
                            <div class="form-group">
                                <label for="rate">15.電影分級</label>
                                <br>
                                <select class="custom-select col-sm-6" name="rate">
                                    <option value="0">普遍級</option>
                                    <option value="1">保護級</option>
                                    <option value="2">輔導級</option>
                                    <option value="3">限制級</option>
                                </select>
                                <small class="form-text text-muted">※ 電影年齡限制分類，預設為普遍級</small>
                            </div>
                            <div class="form-group">
                                <?
                                $sql = "SELECT MAX(`listOrder`) AS 'listOrder' FROM `movie`";
                                $query = mysqli_query($_SESSION['link'], $sql);
                                $row = mysqli_fetch_assoc($query);
                                $max_listOrder = $row['listOrder'];
                                ?>
                                <label for="listOrder">16.電影於列表呈現的序列</label>
                                <small class="movieAzureAlert"><span class="movieRedAlert"><i class="fas fa-bell " ></i>若此電影無上架,則無此欄位</span> <i class="fas fa-bell " ></i>目前列表位置 0~<?= $max_listOrder ?>，位置'首位'的電影將放在'首頁的強檔推薦'</small><br>
                                <select class="custom-select col-sm-6" name="listOrder">
                                    <option value='0'>首位</option>
                                    <? 
                                    for ($i = 1;$i <= $max_listOrder;$i++){
                                       echo "<option value='$i'>{$i}</option>";
                                    }
                                    ?>
                                    <option value='<?= ($max_listOrder + 1) ?>'>最後</option>
                                </select>
                                <small class="form-text text-muted">※ 電影顯示在列表中的位置，若未輸入，預設新增後顯示再第一位, 可再自行更改編輯</small>
                            </div>
                            <div class="FormErrorMessageArea">
                                <div id="ErrorMessage"></div>
                            </div>
                            <div class="btnArea">
                                <button type="submit" class="btn btn-success movieBtn" id="btn-ModalConfirm">確定</button>
                            </div>
                        </form> <!-- /.form -->
                        <!-- 成功註冊後 轉跳倒數的div 初始為隱藏-->
                        <div class="SuccessBlock">
                            <div class="loading"></div>
                            <div class="redirectMessage"></div>
                        </div>
                    </div> <!-- /.formPanel -->
                </div> <!-- /.row -->
            </div> <!-- /.Container -->
        </div> <!-- /.contentBanner -->
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
    <!-- jQuery UI -->
    <link rel="stylesheet" href="../jquery/jquery-ui-1.12.1/jquery-ui.min.css">
    <script src="../jquery/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/commonUse.js"></script>
    <script src="../js/addNewMovie.js"></script>
</body>

</html>