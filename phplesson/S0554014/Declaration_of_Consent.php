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
    <link rel="stylesheet" href="css/Declaration_of_Consent_CSS.css">
</head>

<body>
    <div class="wrapper">
        <!-- include Topbar file -->
        <?php include_once 'Topbar.php';?>

        <!-- Content -->
        <div class="content_wrapper">
            <div class="container">
                <div class="row">
                    <h2 class="mx-auto mt-3">填寫入學申請表同意書</h2>
                </div>
                <div class="row">
                    <table class="table table-hover table-border Declaration-of-Consent-Table">
                        <thead>
                            <th class="table-Title" colspan="2">••個人資料提供同意書••</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>一、</td>
                                <td>
                                    國立彰化師範大學（以下簡稱本校）取得您的個人資料，目的在於進行招生等教務相關工作，蒐集、處理及使用您的個人資料是受到個人資料保護法及相關法令之規範。
                                </td>
                            </tr>
                            <tr>
                                <td>二、</td>
                                <td>本次蒐集與使用您的個人資料，包含中、英文姓名、出生日期、護照號碼、住址、電話、電子信箱、雙親個人資料、教育背景等，但仍以本校入學申請表實際蒐集之個人資料為準。</td>
                            </tr>
                            <tr>
                                <td>三、</td>
                                <td>您同意本校因教務所需，以您所提供的個人資料確認您的身分、與您進行聯絡及同意本校於您報名錄取後繼續使用您的個人資料並永久保存。</td>
                            </tr>
                            <tr>
                                <td>四、</td>
                                <td>依據個人資料保護法，您可就您的個人資料向本校：(1)請求查詢或閱覽；(2)請求製給複製本；(3)請求補充或更正；(4)請求停止蒐集、處理及利用；(5)請求刪除。但因本校執行職務或業務所必需者及受其他法律所規範者，本校得拒絕之。</td>
                            </tr>
                            <tr>
                                <td>五、</td>
                                <td>您可以自由選擇是否提供相關個人資料，若您所提供之個人資料，經檢舉或本校發現不足以確認您的身分真實性，或發生其他個人資料冒用、盜用、資料不實等情形，本校有權停止您的報名資格、錄取資格等相關權利，若有不便之處敬請見諒。</td>
                            </tr>
                            <tr>
                                <td>六、</td>
                                <td>本同意書如有未盡事宜，依個人資料保護法或其他相關法規之規定辦理。</td>
                            </tr>
                            <tr>
                                <td>七、</td>
                                <td>您已瞭解此一同意書符合個人資料保護法及相關法規之要求，同意本校蒐集、處理及使用您的個人資料之效果。</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /.Table -->
                </div>

                <!-- Declaration of Consent -->
                <div class="row">
                    <form class="mx-auto" id="Form-Declaration-Consent" action="fill_in_ApplicationForm.php">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="chkbox-Agreement">
                            <label class="form-check-label" for="exampleCheck1">我已詳閱本同意書，瞭解並同意（請打勾）</label>
                        </div>
                        <button type="submit" class="btn btn-primary agree-button mx-auto">下一步</button>
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
</body>

</html>