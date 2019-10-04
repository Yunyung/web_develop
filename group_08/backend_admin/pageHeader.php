<!-- Navigation ================================================ -->
<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top dusk-navTop">
        <div class="container">
            <div class="navbar-logo">
                <a class="navbar-brand" href="../index.php"><img src="../img/icon.ico"></a>
            </div>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <!-- 管理者menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle li-active" href="#" id="backend_admin_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">管理後台</a>
                        <div class="dropdown-menu" aria-labelledby="backend_admin_dropdown">
                            <a class='dropdown-item' href='index.php'>後台首頁</a>
                            <a class='dropdown-item' href='memberList.php'>會員管理</a>
                            <a class='dropdown-item' href='message_board_admin.php'>留言板管理</a>
                            <a class='dropdown-item' href='cart.php'>會員訂單管理</a>
                            <a class='dropdown-item' href='movieList.php'>上映電影</a>
                            <a class='dropdown-item' href='movieListNoLaunched.php'>下架電影</a>
                        </div>
                    </li> <!-- /.管理者menu -->

                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../movieList.php">電影列表</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo ($page_index == 2) ? 'li-active' : ''; ?>" href="#" id="memberArea_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= "<i class='fas fa-user-circle mr-1'></i>" . $_SESSION['userAccount'] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="memberArea_dropdown">
                            <a class='dropdown-item' href='../memberLogOut.php'><i class='fas fa-sign-out-alt'></i> 登出</a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item' href='../memberAccount.php'><i class="fas fa-address-card"></i> 帳號管理</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../message_board.php">留言版</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link?>" href="../about_us.php">關於我們</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page_index == 5) ? 'li-active' : ''; ?>"" href='../cart.php'><i class='fas fa-cart-arrow-down'></i> &nbsp;購物車</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>