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

</head>

<body>
    <div class="wrapper">
        <!-- include Topbar file -->
        <?php include_once 'Topbar.php';?>

        <!-- content -->
        <div class="content_wrapper">
            <div class="container">
                <div class="row">
                    <!-- System Broadcast Table -->
                    <table class="table table-hover table-border System-Broadcast-Table">
                        <thead>
                            <th class="table-Title chn" colspan="2">••系統公告••</th>
                            <th class="table-Title eng" colspan="2">••System Announcements••</th>
                        </thead>
                        <tbody>
                            <tr>
                            	<td>◆</td>
                                <td class="font-highlight chn">
                                	本系統僅供報考『107學年度外國學生春季班申請入學招生考試』，欲報考其他招生考試者請勿使用。
                                </td>
                                <td class="font-highlight eng">
                                	This system is only for the Application for “Admission Examination for 2019 Spring Intake of International Students”; applicants applying for other Admission Examination please do not use this system.
                                </td>
                            </tr>
                            <tr>
                            	<td>◆</td>
                                <td class="font-highlight chn">
                                    申請學士班者，至多申請5個學系（組）；申請碩（博）士班者，至多申請3個系所班（組）。申請者若申請1個以上之系所班（組），僅須上傳1份審查資料。
                                </td>
                                <td class="font-highlight eng">
                                	An applicant for undergraduate programs may apply for admission to not more than 5 departments (groups); an applicant for master’s (doctoral) programs may apply for admission to not more than 3 graduate institutes (groups). Only one set of documents is required for the application for multiple departments/graduate institutes/programs (groups).
                                </td>
                            </tr>
                            <tr>
                            	<td>◆</td>
                                <td class="chn">
                                    本次招生考試簡章免費下載，歡迎多加運用；報名方式一律採<span class="font-red">網路報名及審查資料上傳</span>；本次招生考試<span class="font-red">不須繳交申請費用</span>。
                                </td>
                                <td class="eng">
                                	Applicants are welcome to download this Admission Examination Brochure for free. Only online application and online document submission is accepted. No application fee is required for this Admission Examination.
                                </td>
                            </tr>
                            <tr>
                            	<td>◆</td>
                                <td class="chn">
                                	電子簡章開放下載日期：【<span class="font-red">2018-08-01 09:00:00</span>】至【<span class="font-red">2018-10-30 23:59:59</span>】 止。
                                </td>
                                <td class="eng">
                                	The electronic brochure is available for download within the period from [<span class="font-red">Aug. 1, 2018 at 09:00:00</span>] to [<span class="font-red">Oct. 30, 2018 at 23:59:59</span>].
                                </td>
                            </tr>
                            <tr>
                            	<td>◆</td>
                                <td class="chn">
                                	春季班網路報名日期：【<span class="font-red">2018-08-01 09:00:00</span>】至【<span class="font-red">2018-10-30 17:00:00</span>】 止。
                                </td>
                                <td class="eng">
                                	Online application period for Spring Intake: from [<span class="font-red">Aug. 1, 2018 at 09:00:00</span>] to [<span class="font-red">Oct. 30, 2018 at 17:00:00</span>].
                                </td>
                            </tr>
                            <tr>
                            	<td>◆</td>
                                <td class="chn">
                                	春季班審查資料上傳日期：【<span class="font-red">2018-08-01</span>】至【<span class="font-red">2018-10-30 17:00:00</span>】 止。
                                </td>
                                <td class="eng">
                                	Online document submission for Spring Intake: from [<span class="font-red">Aug. 1, 2018</span>] to [<span class="font-red">Oct. 30, 2018 at 17:00:00</span>].
                                </td>
                            </tr>
                            <tr>
                            	<td>◆</td>
                                <td class="chn">
                                	放榜日期：【<span class="font-red">2018-12-05 17:00:00</span>】。錄取名單公告在<a class="link-underline" href="http://www.ncue.edu.tw/files/11-1000-203.php" target="_blank">本校首頁「招生資訊」</a>及<a class="link-underline" href="http://acadaff.ncue.edu.tw/bin/home.php" target="_blank">教務處</a>網頁。
                                </td>
                                <td class="eng">
                                	Date of admission result release: [<span class="font-red">Dec. 5, 2018 at 17:00:00</span>]. The admission result will be released on the “Admission Information” section of the University’s homepage and on the Office of Academic Affairs website.
                                </td>
                            </tr>
                            <tr>
                            	<td>◆</td>
                                <td class="chn">
                                	錄取結果通知單寄發：【<span class="font-red">2018-12-07</span>】
                                </td>
                                <td class="eng">
                                	The date of mailing admission notices: [<span class="font-red">Dec. 7, 2018</span>].
                                </td>
                            </tr>
                            <tr>
                            	<td>◆</td>
                                <td class="chn">
                                	E-mail、傳真或郵寄錄取生就讀意願申明書：【<span class="font-red">2018-12-07</span>】至【<span class="font-red">2019-01-15</span>】。
                                </td>
                                <td class="eng">
                                	The date of sending Declaration of Enrollment Intent for Admitted Students by E-mail, fax or post: [<span class="font-red">Dec. 7, 2018</span>] to [<span class="font-red">Jan. 15, 2019</span>].
                                </td>
                            </tr>
                            <tr>
                            	<td>◆</td>
                                <td class="chn">
                                	電子簡章為PDF檔案，請先 <a class="link-underline" href="https://get.adobe.com/tw/reader/" target="_blank">下載安裝Adobe Reader</a>。
                                </td>
                                <td class="eng">
                                	The electronic brochure is in PDF format; please download and install Adobe Reader first.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /.Table -->
                </div>
            </div>
        </div>
        <!-- /.content -->
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