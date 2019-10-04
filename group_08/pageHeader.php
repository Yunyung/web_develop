<?php
@session_start();
// 取得目前檔案的名稱，透過$_SERVER['PHP_SELF']先取得路徑
$current_file_path = $_SERVER['PHP_SELF'];
// 然後透過 basename 取得檔案名稱，加上第二個參數".php"，主要是將取得的檔案去掉.php的副檔名
$current_file_name = basename($current_file_path, ".php");
switch ($current_file_name) {
case 'index':
    $page_index = 0;
    break;
case 'movieList':
case 'movieDetail':
    $page_index = 1;
    break;
case 'memberLogin':
case 'memberRegister':
case 'memberAccount':
    $page_index = 2;
    break;
case 'message_board':
    $page_index = 3;
    break;
case 'about_us':
    $page_index = 4;
    break;
case 'cart':
    $page_index = 5;
    break;

default:
    // 預設是首頁，首頁用0代表
    $page_index = 0;
    break;
}

if (isset($_SESSION['is_Login']) && $_SESSION['is_Login']){
    $is_Login = true;
}
else{
    $is_Login = false;
}
?>

<!-- Navigation ================================================ -->
<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top dusk-navTop">
        <div class="container">
            <div class="navbar-logo">
                <a class="navbar-brand" href="index.php"><img src="img/icon.ico"></a>
            </div>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <!-- 管理者後台顯示 -->
                    <?php if (isset($_SESSION['rank']) && $_SESSION['rank'] == "admin"){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="backend_admin/index.php" id="backend">管理後台</a>
                    </li>
                    <?php } ?>
                    <!-- ./管理者後台 -->
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page_index == 0) ? 'li-active' : ''; ?>" href="index.php">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page_index == 1) ? 'li-active' : ''; ?>" href="movieList.php">電影列表</a>
                    </li>
                    <li class="nav-item dropdown" id="nav-item-memberArea">
                        <a class="nav-link dropdown-toggle <?php echo ($page_index == 2) ? 'li-active' : ''; ?>" href="#" id="memberArea_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= ($is_Login) ? "<i class='fas fa-user-circle mr-1'></i>" . $_SESSION['userAccount']: "會員專區" ?>
                        </a>
                        <div class="dropdown-menu" id="dropdown-menu-memberArea" aria-labelledby="memberArea_dropdown">
                            <?  if ($is_Login): ?>
                                    <!-- 會員顯示 -->
                                    <a class='dropdown-item' href='memberLogOut.php'><i class='fas fa-sign-out-alt'></i> 登出</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item' href='memberAccount.php'><i class="fas fa-address-card"></i> 帳號管理</a>
                            <?  else: ?>
                                    <!-- 非會員顯示 -->
                                    <a class='dropdown-item' href='memberLogin.php'><i class="fas fa-user"></i> 會員登入</a>
                                    <a class='dropdown-item' href='memberRegister.php'><i class="fas fa-registered"></i> 申請會員</a>
                            <?  endif;  ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page_index == 3) ? 'li-active' : ''; ?>" href="message_board.php">留言板</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page_index == 4) ? 'li-active' : ''; ?>" href="about_us.php">關於我們</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page_index == 5) ? 'li-active' : ''; ?>"" href='cart.php'><i class='fas fa-cart-arrow-down'></i> &nbsp;購物車</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>