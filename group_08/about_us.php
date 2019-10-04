<?
  @session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" conetent="網際網路資料庫程式設計專題(php Project)">
    <meta name="author" content="Yunyung">
    <title>關於我們-彰師戲院</title>
    <link rel="icon" href="img/favicon.ico" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/business.css">
    <link rel="stylesheet" href="css/about_us.css">
    <!-- font Awesome icon-->
    <link rel="stylesheet" href="fontawesome-free-5.0.13\web-fonts-with-css\css\fontawesome-all.min.css">
</head>

<body style="background-color: #FDF5E6;">
    <div id="wrapper">
        <!-- include navbar -->
        <?php include_once 'pageHeader.php';?>
        <div id="contentBanner">
            <!-- Page Content -->
            <div class="container">
                <!-- Content Row -->
                <div class="row">
                    <div class="col-12 my-4">
                        <h2 class="title">商家資訊</h2>
                    </div>
                    <!-- Map Column -->
                    <div class="col-lg-8 mb-4">
                        <!-- Embedded Google Map -->
                        <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14571.137861043091!2d120.54970550750393!3d24.073893499669303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346938e9c332a5dd%3A0x7fd08ddba6e6a0cc!2z5ZyL56uL5b2w5YyW5bir56-E5aSn5a246YCy5b635qCh5Y2A!5e0!3m2!1szh-TW!2stw!4v1521766264743"></iframe>
                    </div>
                    <!-- Contact Details Column -->
                    <div class="col-lg-4 mb-4">
                        <h3>聯絡資訊</h3>
                        <hr>
                        <p>地址: 500彰化縣彰化市進德路1號</p>
                        <p>
                            <abbr title="Phone">P</abbr>: (587) 0800-000-000</p>
                        <p>
                            <abbr title="Email">E</abbr>:
                            <a href="mailto:Yunyungder@gmail.com">Yunyungder@gmail.com
            </a>
                        </p>
                        <p>
                            <abbr title="Hours">H</abbr>: 全年無休 當7-11再開</p>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Contact Form -->
                <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <h3>聯絡我們</h3>
                        <form name="sentMessage" id="contactForm" action="">
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label for="name">姓名:</label>
                                    <input type="text" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label for="subject">主旨:</label>
                                    <input type="text" class="form-control" id="subject" required data-validation-required-message="Please enter your subject.">
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                                </div>
                            </div>
                            <div class="control-group form-group">
                                <div class="controls">
                                    <label for="message">內容:</label>
                                    <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                                </div>
                            </div>
                            <div id="success"></div>
                            <!-- For success/fail messages -->
                            <button type="submit" class="btn btn-primary movieBtn" id="sendMessageButton">傳送</button>
                            <button type="reset" class="btn btn-danger movieBtn" id="resetButton">重填</button>
                        </form>
                    </div>
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.contentBanner -->
        <!-- Footer -->
        <?php include_once 'footer.php';?>
    </div> <!-- /.wrapper -->
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/commonUse.js"></script>
</body>

</html>