<?php
    $degreePursued = array("degree_Pursued_Bachelor" => "學士",
                           "degree_Pursued_Master" => "碩士",
                           "degree_Pursued_PhD" => "博士");

    $Department = array(1 => "輔導與諮商學系學校輔導與諮商組", "輔導與諮商學系社區輔導與諮商組","特殊教育學系","數學系","物理學系物理組","物理學系光電組","生物學系","化學系","工業教育與技術學系","財務金融技術學系","英語學系","國文學系","地理學系","美術學系","機電工程學系","電機工程學系","電子工程學系","資訊工程學系","企業管理學系","會計學系","資訊管理學系資訊管理組","資訊管理學系數位內容科技與管理組","運動學系","公共事務與公民教育學系公共事務組","公共事務與公民教育學系公民教育組",
        "輔導與諮商學系","輔導與諮商學系婚姻與家族治療碩士班","特殊教育學系","特殊教育學系資賦優異教育碩士班","教育研究所","復健諮商研究所","科學教育研究所","數學系","物理學系","生物學系","生物學系生物技術碩士班","化學系","光電科技研究所","統計資訊研究所","工業教育與技術學系","工業教育與技術學系數位學習碩士班","財務金融技術學系","人力資源管理研究所","車輛科技研究所","英語學系","國文學系","地理學系","地理學系環境暨觀光遊憩碩士班","美術學系","美術學系藝術教育碩士班","兒童英語研究所","翻譯研究所","台灣文學研究所","歷史學研究所","機電工程學系","電機工程學系","電子工程學系","資訊工程學系","資訊工程學系物聯網碩士班","電信工程學研究所","企業管理學系","企業管理學系行銷與流通管理碩士班","會計學系","資訊管理學系","資訊管理學系數位內容科技與管理碩士班","運動學系應用運動科學碩士班","運動健康研究所","公共事務與公民教育學系","輔導與諮商學系","特殊教育學系","教育研究所","科學教育研究所","數學系","物理學系","光電科技研究所","工業教育與技術學系","財務金融技術學系","人力資源管理研究所","英語學系","國文學系","地理學系地理暨環境資源博士班","機電工程學系","電機工程學系"
        );
?>
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

    <link rel="stylesheet" href="css/FormDataReceiver.css">
</head>

<body>
    <div class="wrapper">
        <!-- include Topbar file -->
        <?php include_once 'Topbar.php';?>

        <!-- Content -->
        <div class="content_wrapper">
            <div class="container">
                <div class="row">
                    <h2 class="mx-auto mt-3">申請表同意書-資料接收</h2>
                </div>
                <div class="row">
                    <table class="table table-sm table-hover table-border FormDataReciver">
                        <tbody>
                            <thead>
                                <tr>
                                    <th>欄位</th>
                                    <th>輸入</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>✽擬攻讀之學位</td>
                                <td><?php echo $degreePursued[$_POST["degree_Pursued"]] ?></td>
                            </tr>
                            <tr>
                                <td>✽擬申請就讀之系所班（組）別名稱</td>
                                <td><?php echo $Department[$_POST["Department"]]; ?></td>
                            </tr>
                            <tr>
                                <td>✽是否申請本校外國學生入學獎勵金？</td>
                                <td><?php echo $_POST["Enrollment_Incentive"] ?></td>
                            </tr>
                            <tr>
                                <td>✽姓名</td>
                                <td>中文:<?php echo $_POST["name_chn"] ?> 英文:<?php echo $_POST["name_eng"] ?></td>
                            </tr>
                            <tr>
                                <td>✽性別</td>
                                <td><?php echo $_POST["Gender"] ?></td>
                            </tr>
                            <tr>
                                <td>✽國籍</td>
                                <td><?php echo $_POST["Nationality"] ?></td>
                            </tr>
                            <tr>
                                <td>✽出生日期</td>
                                <td><?php echo $_POST["birthday"] ?></td>
                            </tr>
                            <tr>
                                <td>✽出生地點</td>
                                <td><?php echo $_POST["Place_of_Birth"] ?></td>
                            </tr>
                            <tr>
                                <td>✽護照號碼</td>
                                <td><?php echo $_POST["Passport_Number"] ?></td>
                            </tr>
                            <tr>
                                <td>✽母語</td>
                                <td><?php echo $_POST["Native_Language"] ?></td>
                            </tr>
                            <tr>
                                <td>✽通訊地址</td>
                                <td><?php echo $_POST["Postal_Address"] ?></td>
                            </tr>
                            <tr>
                                <td>✽電話</td>
                                <td><?php echo $_POST["Telephone"] ?></td>
                            </tr>
                            <tr>
                                <td>✽E-Mail</td>
                                <td><?php echo $_POST["E-Mail"] ?></td>
                            </tr>
                            <tr>
                                <td>✽手機號碼</td>
                                <td><?php echo $_POST["Mobile_Number"] ?></td>
                            </tr>
                            <tr>
                                <td>監護人</td>
                                <td>姓名:<?php echo (empty($_POST["Guardian_Name"])) ? "未填寫" : $_POST["Guardian_Name"]; ?> <br>
                                    與申請人關係:<?php echo (empty($_POST["Guardian_RelationShip_with_the_Applicant"])) ? "未填寫" : $_POST["Guardian_RelationShip_with_the_Applicant"]; ?><br>
                                    通訊地址:<?php echo (empty($_POST["Guardian_Postal_Address"])) ? "未填寫" : $_POST["Guardian_Postal_Address"];  ?><br>
                                    聯絡電話:<?php echo (empty($_POST["Guardian_Contact_Number"])) ? "未填寫" : $_POST["Guardian_Contact_Number"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>在臺聯絡人</td>
                                <td>姓名:<?php echo (empty($_POST["TaiwanGuardian_Name"])) ? "未填寫" : $_POST["TaiwanGuardian_Name"];  ?><br>
                                    與申請人關係:<?php echo (empty($_POST["TaiwanGuardian_RelationShip_with_the_Applicant"])) ? "未填寫" : $_POST["TaiwanGuardian_RelationShip_with_the_Applicant"]; ?><br>
                                    通訊地址:<?php echo (empty($_POST["TaiwanGuardian_Postal_Address"])) ? "未填寫" : $_POST["TaiwanGuardian_Postal_Address"]; ?><br>
                                    聯絡電話:<?php echo (empty($_POST["TaiwanGuardian_Contact_Number"])) ? "未填寫" : $_POST["TaiwanGuardian_Contact_Number"]; ?></td>
                            </tr>
                            <tr>
                                <td>✽父親</td>
                                <td>姓名:<?php echo $_POST["father_Name"] ?><br>
                                    通訊地址:<?php echo $_POST["father_Postal_Address"] ?><br>
                                    聯絡電話:<?php echo $_POST["father_Contact_Number"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>✽母親</td>
                                <td>姓名:<?php echo $_POST["mother_Name"] ?><br>
                                    通訊地址:<?php echo $_POST["mother_Postal_Address"] ?><br>
                                    聯絡電話:<?php echo $_POST["mother_Contact_Number"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>✽最高學歷</td>
                                <td>學校名稱:<?php echo $_POST["Name_of_School"] ?><br>
                                    學校所在地:<?php echo $_POST["Location_of_School"] ?><br>
                                    學位:<?php echo $_POST["Degree"] ?><br>
                                    畢業年月:<?php echo $_POST["Month_and_Year_of_Graduation"] ?><br>
                                    主修學門:<?php echo $_POST["Major"] ?><br>
                                    副修學門:<?php echo $_POST["Minor"] ?><br>
                                </td>
                            </tr>
                            <tr>
                                <td>✽敘明在臺期間各項費用來源</td>
                                <td><?php echo $_POST["Financial_resources_in_Taiwan"] ?></td>
                            </tr>
                            <tr>
                                <td>✽健康狀況</td>
                                <td><?php echo $_POST["Health_Condition"] ?><br>
                                    疾病敘明:<?php echo (empty($_POST["Health_Condition_disease"])) ? "未填寫" : $_POST["Health_Condition_disease"]; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>著作（出版日期）</td>
                                <td><?php echo (empty($_POST["Publications"])) ? "未填寫" : $_POST["Publications"]; ?></td>
                            </tr>
                            <tr>
                                <td>經歷</td>
                                <td><?php echo (empty($_POST["Experience"])) ? "未填寫" : $_POST["Experience"]; ?></td>
                            </tr>
                            <tr>
                                <td>✽華語文程度</td>
                                <td>聽 <?php echo $_POST["Proficiency_of_Chinese_Listening"] ?><br>
                                    說 <?php echo $_POST["Proficiency_of_Chinese_Speaking"] ?><br>
                                    讀 <?php echo $_POST["Proficiency_of_Chinese_Reading"] ?><br>
                                    寫 <?php echo $_POST["Proficiency_of_Chinese_Writing"] ?><br>
                                </td>
                            </tr>
                            <tr>
                                <td>✽曾學習（研究）華語文幾年？</td>
                                <td><?php echo $_POST["Experience_Chinese"] ?></td>
                            </tr>
                            <tr>
                                <td>✽學習華語文環境（高中、大學或語文機構）<br>及受何人指導（講授）？</td>
                                <td><?php echo $_POST["learningEnviorment_And_instructor"] ?></td>
                            </tr>
                            <tr>
                                <td>課外活動</td>
                                <td><?php echo (empty($_POST["Extracurricular_Activities"])) ? "未填寫" : $_POST["Extracurricular_Activities"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
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
</body>

</html>