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
    <title>後台-編輯電影細節-彰師戲院</title>
    <link rel="icon" href="../img/favicon.ico" />
    <!-- Bootstrap4 core CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/business.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="../fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
    <style type="text/css">
        table#dynamic-field-directors td,
        table#dynamic-field-actors td {
            padding-left: 0;
        }
        .categorys>input {
            margin-right: 3px;
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
                    <!-- Title-->
                    <div class="col-sm-12">
                        <div class="my-4">
                            <h1 class="titleBg" style="color: #c33;">電影編輯</h1>
                        </div>
                    </div>
                    <!-- /.path-->
                    <div class="col-sm-12" id="currentPath" style="padding: 0;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">後台首頁</a></li>
                                <li class="breadcrumb-item"><a href="movieList.php">電影管理</a></li>
                                <li class="breadcrumb-item"><a href="updateMovie_selectOption.php">編輯項目選擇</a></li>
                                <li class="breadcrumb-item active" aria-current="page">編輯電影</li>
                            </ol>
                        </nav>
                    </div><!-- /.path -->
                    <div class="movieFormPanel mt-2" style="width: 100%">
                        <div class="Panel-heading">
                            <div class="Panel-Title">
                            </div>
                        </div>
                        <form method="POST" id="updateMovieForm" class="movieForm" enctype="multipart/form-data">
                            <input type="hidden" id="movie_id" name="movie_id" value="<?= $_GET['id'] ?>">
                            <input type="hidden" id="origin_listOrder" name="origin_listOrder" value="">
                            <div class="">
                                <p class="movieRedAlert"><i class="fas fa-bell"></i>欄位內的初值為當前電影的資料,若該欄位目前無資料則為空白, 請謹慎調整後再送出!</p>
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
                                <label for="releaseDate">3.上映日期</label>
                                <input type="date" class="form-control col-sm-6" id="releaseDate" name="releaseDate">
                            </div>
                            <div class="form-group">
                                <label for="trailer_path">4.預告片路徑</label>
                                <input type="text" class="form-control" id="trailer_path" name="trailer_path" placeholder="網址路徑">
                                <small class="form-text text-muted">※ 請輸入iframe網址 例:  https://www.youtube.com/embed/k2gcXBnvQSk</small>
                            </div>
                            <div class="form-group">
                                <label for="introduce">5.電影內容介紹</label>
                                <textarea class="form-control" id="introduce" name="introduce" rows="6" placeholder="電影介紹"></textarea>
                            </div>
                            <div class="form-group categorys">
                                <label for="category">6.電影分類 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
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
                                <label for="Length">7.電影長度</label>
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
                                <label for="directors">8.導演 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
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
                                <label for="actors">9.演員 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
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
                                <label for="price">10.售價 <span class="movieRedAlert"><i class="fas fa-bell" ></i>必填欄位</span></label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="電影售價">
                            </div>
                            <div class="form-group">
                                <label for="isLaunched">11.是否將電影上架 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
                                <br>
                                <input type="radio" name="isLaunched" value="1">上架
                                <input type="radio" name="isLaunched" value="0">不上架
                                <small class="form-text text-muted">※ 選擇後，可再自行更改編輯</small>
                            </div>
                            <div class="form-group">
                                <label for="isNewProduct">12.是否標記為新上映電影 <span class="movieRedAlert"><i class="fas fa-bell " ></i>必填欄位</span></label>
                                <br>
                                <input type="radio" name="isNewProduct" value="1">是
                                <input type="radio" name="isNewProduct" value="0">否
                                <small class="form-text text-muted">※ 若選 '是' 呈現將有新上映電影Tag，之後可再自行更改編輯</small>
                            </div>
                            <div class="form-group">
                                <label for="rate">13.電影分級</label>
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
                                <label for="listOrder">14.電影於列表呈現的序列</label>
                                <small class="movieAzureAlert"><span class="movieRedAlert"><i class="fas fa-bell " ></i>若此電影無上架,則無此欄位</span> <i class="fas fa-bell " ></i>目前列表位置 0~<?= $max_listOrder ?>，位置'首位'的電影將放在'首頁的強檔推薦'</small><br>
                                <select class="custom-select col-sm-6" name="listOrder" data-max-listOrder="<?= $max_listOrder ?>">
                                    <option value='0'>首位</option>
                                    <? 
                                    for ($i = 1;$i <= $max_listOrder;$i++){
                                       echo "<option value='$i'>{$i}</option>";
                                    }
                                    ?>
                                                                    </select>
                                <small class="form-text text-muted">※ 電影顯示在列表中的位置</small>
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
            </div> <!-- container -->
            
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
    <!-- Custom JS -->
    <script src="../js/commonUse.js"></script>
    <script src="../js/updateMovie_admin.js"></script>
</body>

</html>