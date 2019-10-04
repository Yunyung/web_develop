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
    <link rel="stylesheet" href="css/ApplicationFormCSS.css">
</head>

<body>
    <div class="wrapper">
        <!-- include Topbar file -->
        <?php include_once 'Topbar.php';?>
        <!-- Conetent -->
        <div class="content_wrapper">
            <div class="container">
                <!-- Title -->
                <div class="row">
                    <h2 class="mx-auto mt-3">國立彰化師範大學外國學生來臺入學申請表</h2>
                </div>
                <!-- Application Form -->
                <div class="row">
                    <form class="FormDesign" id="ApplicationForm" method="POST" action="FormDataReceiver.php">
                        <div class="form-title">
                            <h3 class="mx-auto">資料填寫</h3>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <legend>✽擬攻讀之學位</legend>
                            </div>
                            <div class="form-group col-9">
                                <div class="form-check form-check-inline col-4">
                                    <input class="form-check-input" type="radio" name="degree_Pursued" id="degree_Pursued_Bachelor" value="degree_Pursued_Bachelor">
                                    <label class="form-check-label" for="degree_Pursued_Bachelor">學士</label>
                                </div>
                                <div class="form-check form-check-inline col-4">
                                    <input class="form-check-input" type="radio" name="degree_Pursued" id="degree_Pursued_Master" value="degree_Pursued_Master">
                                    <label class="form-check-label" for="degree_Pursued_Master">碩士</label>
                                </div>
                                <div class="form-check form-check-inline col-4">
                                    <input class="form-check-input" type="radio" name="degree_Pursued" id="degree_Pursued_PhD" value="degree_Pursued_PhD">
                                    <label class="form-check-label" for="degree_Pursued_PhD">博士</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="Department">✽擬申請就讀之系所班（組）別名稱</label>
                            </div>
                            <div class="form-group col-8">
                                <select class="form-control my-1" id="Department" name="Department">
                                    <option value="0">••請先選擇擬攻讀之學位••</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label for="Term_of_Enrollment">✽預計入學時間</label>
                            </div>
                            <div class="form-group col-8">
                                <textarea class="form-control my-1" id="Term_of_Enrollment" readonly>107學年度第2學期入學（2019年2月）Second Semester of Academic Year 2018 (February 2019)</textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-4">
                                <legend>✽是否申請本校外國學生入學獎勵金？</legend>
                            </div>
                            <div class="form-group col-8">
                                <div class="form-check form-check-inline col-6">
                                    <input class="form-check-input" type="radio" name="Enrollment_Incentive" id="Enrollment_Incentive_yes" value="yes">
                                    <label class="form-check-label" for="Enrollment_Incentive_yes">是</label>
                                </div>
                                <div class="form-check form-check-inline col-6">
                                    <input class="form-check-input" type="radio" name="Enrollment_Incentive" id="Enrollment_Incentive_no" value="no">
                                    <label class="form-check-label" for="Enrollment_Incentive_no">否</label>
                                </div>
                            </div>
                        </div>
                        <!-- 個人基本資料 -->
                        <div class="form-row">
                            <div class="form-group  col-12">
                                <input type="text" class="form-control-plaintext" value="個人基本資料" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>✽姓名<br> (••與護照一致••)</legend>
                            </div>
                            <div class="form-group col-3">
                                <div class="form-row pb-1">
                                    <label class="col-3 " for="name_chn">中文</label>
                                    <input class="form-control input-text-design col-9 my-1" type="text" name="name_chn" id="name_chn">
                                    <label class="col-3" for="name_eng">英文</label>
                                    <input class="form-control input-text-design col-9" type="text" name="name_eng" id="name_eng">
                                </div>
                            </div>
                            <div class="form-group col-2">
                                <legend>＊性別</legend>
                            </div>
                            <div class="form-group col-1">
                                <div class="form-row">
                                    <div class="form-check form-check-inline col-12" style="border: none;">
                                        <input class="form-check-input" type="radio" name="Gender" id="Gender_male" value="male">
                                        <label class="form-check-label" for="Gender_male">男</label>
                                    </div>
                                    <div class="form-check form-check-inline col-12" style="border: none;">
                                        <input class="form-check-input" type="radio" name="Gender" id="Gender_female" value="female">
                                        <label class="form-check-label" for="Gender_female">女</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-1">
                                <legend>＊國籍</legend>
                            </div>
                            <div class="form-group col-3">
                                <input class="form-control col12" type="text" name="Nationality" id="Nationality">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>＊出生日期</legend>
                            </div>
                            <div class="form-group col-3 py-1">
                                <input class="form-control" type="date" name="birthday" id="birthday">
                            </div>
                            <div class="form-group col-3">
                                <legend>＊出生地點</legend>
                            </div>
                            <div class="form-group col-4 py-1">
                                <input class="form-control col12" type="text" name="Place_of_Birth" id="Place_of_Birth">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>＊護照號碼</legend>
                            </div>
                            <div class="form-group col-3 py-1">
                                <input class="form-control" type="text" name="Passport_Number" id="Passport_Number">
                            </div>
                            <div class="form-group col-3">
                                <legend>＊母語</legend>
                            </div>
                            <div class="form-group col-4 py-1">
                                <input class="form-control" type="text" name="Native_Language" id="Native_Language">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>＊通訊地址</legend>
                            </div>
                            <div class="form-group col-3 py-1">
                                <input class="form-control" type="text" name="Postal_Address" id="Postal_Address">
                            </div>
                            <div class="form-group col-3">
                                <legend>✽電話</legend>
                            </div>
                            <div class="form-group col-4 py-1">
                                <input class="form-control digit" type="number" name="Telephone" id="Telephone" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>✽E-Mail</legend>
                            </div>
                            <div class="form-group col-3 py-1">
                                <input class="form-control" type="email" name="E-Mail" id="E-Mail" placeholder="輸入電子信箱">
                            </div>
                            <div class="form-group col-3">
                                <legend>✽手機號碼</legend>
                            </div>
                            <div class="form-group col-4 py-1">
                                <input class="form-control" type="number" name="Mobile_Number" id="Mobile_Number">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>監護人</legend>
                            </div>
                            <div class="form-group col-10">
                                <div class="form-row my-1">
                                    <label class="col-2 " for="Guardian_Name">姓名</label>
                                    <input class="form-control input-text-design col-4" type="text" name="Guardian_Name" id="Guardian_Name">
                                    <label class="col-2" for="Guardian_RelationShip_with_the_Applicant">與申請人關係</label>
                                    <input class="form-control input-text-design col-4" type="text" name="Guardian_RelationShip_with_the_Applicant" id="Guardian_RelationShip_with_the_Applicant">
                                    <label class="col-2 " for="Guardian_Postal_Address">通訊地址</label>
                                    <input class="form-control input-text-design col-4" type="text" name="Guardian_Postal_Address" id="Guardian_Postal_Address">
                                    <label class="col-2 " for="Guardian_Contact_Number">連絡電話</label>
                                    <input class="form-control input-text-design col-4" type="number" name="Guardian_Contact_Number" id="Guardian_Contact_Number">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>在臺聯絡人</legend>
                            </div>
                            <div class="form-group col-10">
                                <div class="form-row my-1">
                                    <label class="col-2 " for="TaiwanGuardian_Name">姓名</label>
                                    <input class="form-control input-text-design col-4" type="text" name="TaiwanGuardian_Name" id="TaiwanGuardian_Name">
                                    <label class="col-2" for="TaiwanGuardian_RelationShip_with_the_Applicant">與申請人關係</label>
                                    <input class="form-control input-text-design col-4" type="text" name="TaiwanGuardian_RelationShip_with_the_Applicant" id="TaiwanGuardian_RelationShip_with_the_Applicant">
                                    <label class="col-2 " for="TaiwanGuardian_Postal_Address">通訊地址</label>
                                    <input class="form-control input-text-design col-4" type="text" name="TaiwanGuardian_Postal_Address" id="TaiwanGuardian_Postal_Address">
                                    <label class="col-2 " for="TaiwanGuardian_Contact_Number">連絡電話</label>
                                    <input class="form-control input-text-design col-4" type="number" name="TaiwanGuardian_Contact_Number" id="TaiwanGuardian_Contact_Number">
                                </div>
                            </div>
                        </div>
                        <!-- 雙親資料 -->
                        <div class="form-row">
                            <div class="form-group  col-12">
                                <input type="text" readonly class="form-control-plaintext" value="雙親資料">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>✽父親</legend>
                            </div>
                            <div class="form-group col-10">
                                <div class="form-row my-1">
                                    <label class="col-2 " for="father_Name">姓名</label>
                                    <input class="form-control input-text-design col-4" type="text" name="father_Name" id="father_Name">
                                    <label class="col-2 " for="father_Postal_Address">通訊地址</label>
                                    <input class="form-control input-text-design col-4" type="text" name="father_Postal_Address" id="father_Postal_Address">
                                    <label class="col-2 " for="father_Contact_Number">連絡電話</label>
                                    <input class="form-control input-text-design col-4" type="number" name="father_Contact_Number" id="father_Contact_Number">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>✽母親</legend>
                            </div>
                            <div class="form-group col-10">
                                <div class="form-row my-1">
                                    <label class="col-2 " for="mother_Name">姓名</label>
                                    <input class="form-control input-text-design col-4" type="text" name="mother_Name" id="mother_Name">
                                    <label class="col-2 " for="mother_Postal_Address">通訊地址</label>
                                    <input class="form-control input-text-design col-4" type="text" name="mother_Postal_Address" id="mother_Postal_Address">
                                    <label class="col-2 " for="mother_Contact_Number">連絡電話</label>
                                    <input class="form-control input-text-design col-4" type="number" name="mother_Contact_Number" id="mother_Contact_Number">
                                </div>
                            </div>
                        </div>
                        <!-- 教育背景 -->
                        <div class="form-row">
                            <div class="form-group  col-12">
                                <input type="text" readonly class="form-control-plaintext" value="教育背景">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>✽最高學歷</legend>
                            </div>
                            <div class="form-group col-10">
                                <div class="form-row my-1">
                                    <label class="col-2 " for="Name_of_School">學校名稱</label>
                                    <input class="form-control input-text-design col-2" type="text" name="Name_of_School" id="Name_of_School">
                                    <label class="col-2 " for="Location_of_School">學校所在地</label>
                                    <input class="form-control input-text-design col-2" type="text" name="Location_of_School" id="Location_of_School">
                                    <label class="col-2 " for="Degree">學位</label>
                                    <input class="form-control input-text-design col-2" type="text" name="Degree" id="Degree">
                                    <label class="col-2 " for="Month_and_Year_of_Graduation">畢業年月</label>
                                    <input class="form-control input-text-design col-2" type="text" name="Month_and_Year_of_Graduation" id="Month_and_Year_of_Graduation">
                                    <label class="col-2 " for="Major">主修學門</label>
                                    <input class="form-control input-text-design col-2" type="text" name="Major" id="Major">
                                    <label class="col-2 " for="Minor">副修學門</label>
                                    <input class="form-control input-text-design col-2" type="text" name="Minor" id="Minor">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>✽敘明在臺期間各項費用來源</legend>
                            </div>
                            <div class="form-group col-10">
                                <div class="form-check col-2">
                                    <input class="form-check-input" type="radio" name="Financial_resources_in_Taiwan" id="Personal_savings" value="Personal_savings">
                                    <label class="form-check-label" for="Personal_savings">個人儲蓄</label>
                                </div>
                                <div class="form-check col-2">
                                    <input class="form-check-input" type="radio" name="Financial_resources_in_Taiwan" id="Parental_supports" value="Parental_supports">
                                    <label class="form-check-label" for="Parental_supports">父母供給</label>
                                </div>
                                <div class="form-check col-2">
                                    <input class="form-check-input" type="radio" name="Financial_resources_in_Taiwan" id="Incentives" value="Incentives">
                                    <label class="form-check-label" for="Incentives">獎助金</label>
                                </div>
                                <div class="form-check col-2">
                                    <input class="form-check-input" type="radio" name="Financial_resources_in_Taiwan" id="Taiwanese_Scholarships" value="Taiwanese_Scholarships">
                                    <label class="form-check-label" for="Taiwanese_Scholarships">臺灣獎學金</label>
                                </div>
                                <div class="form-check col-2">
                                    <input class="form-check-input" type="radio" name="Financial_resources_in_Taiwan" id="Others" value="Others">
                                    <label class="form-check-label" for="Others">其他</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <legend>✽健康狀況</legend>
                            </div>
                            <div class="form-group col-9">
                                <div class="form-row my-1">
                                    <div class="form-check form-check-inline col-3" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Health_Condition" id="Health_Condition_Good" value="Health_Condition_Good">
                                        <label class="form-check-label" for="Health_Condition_Good">佳</label>
                                    </div>
                                    <div class="form-check form-check-inline col-3" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Health_Condition" id="Health_Condition_Average" value="Health_Condition_Average">
                                        <label class="form-check-label" for="Health_Condition_Average">尚可</label>
                                    </div>
                                    <div class="form-check form-check-inline col-3" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Health_Condition" id="Health_Condition_Poor" value="Health_Condition_Poor">
                                        <label class="form-check-label" for="Health_Condition_Poor">差</label>
                                    </div>
                                    <div class="col-12" style="border: none;">
                                        <label for="Health_Condition_disease" class="col-3 col-form-label">如有疾病請敘明之：</label>
                                        <input class="form-control input-text-design col-9" type="text" name="Health_Condition_disease" id="Health_Condition_disease">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <legend>著作（出版日期）</legend>
                            </div>
                            <div class="form-group col-9 py-1">
                                <input class="form-control" type="text" name="Publications" id="Publications">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <legend>經歷</legend>
                            </div>
                            <div class="form-group col-9 py-1">
                                <input class="form-control" type="text" name="Experience" id="Experience">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <legend>✽華語文程度</legend>
                            </div>
                            <div class="form-group col-10" style="padding: 0;">
                                <div class="form-row">
                                    <div class="col-2" style="border:none;">
                                        <legend class="col-form-label">聽</legend>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Listening" id="Proficiency_of_Chinese_Listening_Excellent" value="Excellent">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Listening_Excellent">優</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Listening" id="Proficiency_of_Chinese_Listening_Good" value="Good">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Listening_Good">佳</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Listening" id="Proficiency_of_Chinese_Listening_Fair" value="Fair">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Listening_Fair">尚可</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Listening" id="Proficiency_of_Chinese_Listening_Poor" value="Poor">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Listening_Poor">差</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Listening" id="Proficiency_of_Chinese_Listening_Incompetent" value="Incompetent">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Listening_Incompetent">不會</label>
                                    </div>

                                    <div class="col-2" style="border:none;">
                                        <legend class="col-form-label">說</legend>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Speaking" id="Proficiency_of_Chinese_Speaking_Excellent" value="Excellent">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Speaking_Excellent">優</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Speaking" id="Proficiency_of_Chinese_Speaking_Good" value="Good">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Speaking_Good">佳</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Speaking" id="Proficiency_of_Chinese_Speaking_Fair" value="Fair">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Speaking_Fair">尚可</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Speaking" id="Proficiency_of_Chinese_Speaking_Poor" value="Poor">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Speaking_Poor">差</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Speaking" id="Proficiency_of_Chinese_Speaking_Incompetent" value="Incompetent">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Speaking_Incompetent">不會</label>
                                    </div>

                                    <div class="col-2" style="border:none;">
                                        <legend class="col-form-label">讀</legend>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Reading" id="Proficiency_of_Chinese_Reading_Excellent" value="Excellent">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Reading_Excellent">優</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Reading" id="Proficiency_of_Chinese_Reading_Good" value="Good">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Reading_Good">佳</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Reading" id="Proficiency_of_Chinese_Reading_Fair" value="Fair">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Reading_Fair">尚可</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Reading" id="Proficiency_of_Chinese_Reading_Poor" value="Poor">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Reading_Poor">差</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Reading" id="Proficiency_of_Chinese_Reading_Incompetent" value="Incompetent">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Reading_Incompetent">不會</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <legend class="col-form-label">寫</legend>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Writing" id="Proficiency_of_Chinese_Writing_Excellent" value="Excellent">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Writing_Excellent">優</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Writing" id="Proficiency_of_Chinese_Writing_Good" value="Good">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Writing_Good">佳</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Writing" id="Proficiency_of_Chinese_Writing_Fair" value="Fair">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Writing_Fair">尚可</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Writing" id="Proficiency_of_Chinese_Writing_Poor" value="Poor">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Writing_Poor">差</label>
                                    </div>
                                    <div class="col-2" style="border:none;">
                                        <input class="form-check-input" type="radio" name="Proficiency_of_Chinese_Writing" id="Proficiency_of_Chinese_Writing_Incompetent" value="Incompetent">
                                        <label class="form-check-label" for="Proficiency_of_Chinese_Writing_Incompetent">不會</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <legend>✽曾學習（研究）華語文幾年？</legend>
                            </div>
                            <div class="form-group col-9 py-1">
                                <input class="form-control" type="text" name="Experience_Chinese" id="Experience_Chinese">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <legend>✽學習華語文環境（高中、大學或語文機構）及受何人指導（講授）？</legend>
                            </div>
                            <div class="form-group col-9 py-1">
                                <input class="form-control" type="text" name="learningEnviorment_And_instructor" id="learningEnviorment_And_instructor">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <legend>課外活動</legend>
                            </div>
                            <div class="form-group col-9 py-1">
                                <input class="form-control" type="text" name="Extracurricular_Activities" id="Extracurricular_Activities">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <legend>審查資料上傳</legend>
                            </div>
                            <div class="form-group col-9 py-1">
                                <a href="document_upload.php" style="text-decoration: underline;" target="_blank">開啟檔案上傳頁面</a>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <legend>備註</legend>
                            </div>
                            <div class="form-group col-9 py-1">
                                <div class="form-row">
                                    <p class="col-12">1. 入學申請表內各項資料請據實填寫，所填通訊地址及E-mail應清楚完整，以利本校寄發入學通知</p>
                                    <p class="col-12" style="color:red">2. 審查資料上傳部分，無須於填寫基本資料時一併上傳，可於基本資料填妥後，再至「網路報名」→「修改報名資料」上傳審查資料。</p>
                                    <p class="col-12">3. 請申請人詳閱招生簡章各項規定。</p>
                                    <p class="col-12">
                                        4. 國立彰化師範大學為辦理外國學生申請入學報名審查之目的，本表所蒐集之個人資訊，將僅存放於校內，作為外國學生申請入學報名審查管理與聯繫之用， 學校將保留本表一年，滿後即依規定銷毀。您得以本表之聯絡方式行使查閱、更正等個人資料保護法第3條的當事人權利。如您提供的資料不完整或不確實，將無法通過本次外國學生申請入學報名審查。聯絡方式：彰化市進德路1號，電話：＋886-4-7232105，分機5632~5636，E-mail：admiss@cc2.ncue.edu.tw。
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- error message -->
                        <div class="row mt-5">
                            <div class="mx-auto" id="error_message"></div>
                        </div>
                        <!-- button -->
                        <div class="row mt-5">
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary agree-button">送出</button>
                                <button type="reset" class="btn btn-danger agree-button">重填</button>
                            </div>
                        </div>
                    </form>
                </div>
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
    <!-- 表單JS(動態下拉式選單、表單驗證操作等) -->
    <script src="js/ApplicationForm.js"></script>
</body>

</html>