$(function(){
    // 動態產生下拉式選單 for department
    $('input[name="degree_Pursued"]').change(function(){

        $("#Department").empty();
        $("#Department").append("<option value='0'>請選擇欲申請的系所班(組)別名稱</option>");

        if ($('input[name="degree_Pursued"]:checked').val() == 'degree_Pursued_Bachelor'){
            $("#Department").append("<option value='1'>1. 輔導與諮商學系學校輔導與諮商組</option>");
            $("#Department").append("<option value='2'>2. 輔導與諮商學系社區輔導與諮商組</option>");
            $("#Department").append("<option value='3'>3. 特殊教育學系</option>");
            $("#Department").append("<option value='4'>4. 數學系</option>");
            $("#Department").append("<option value='5'>5. 物理學系物理組</option>");
            $("#Department").append("<option value='6'>6. 物理學系光電組</option>");
            $("#Department").append("<option value='7'>7. 生物學系</option>");
            $("#Department").append("<option value='8'>8. 化學系</option>");
            $("#Department").append("<option value='9'>9. 工業教育與技術學系</option>");
            $("#Department").append("<option value='10'>10. 財務金融技術學系</option>");
            $("#Department").append("<option value='11'>11. 英語學系</option>");
            $("#Department").append("<option value='12'>12. 國文學系</option>");
            $("#Department").append("<option value='13'>13. 地理學系</option>");
            $("#Department").append("<option value='14'>14. 美術學系</option>");
            $("#Department").append("<option value='15'>15. 機電工程學系</option>");
            $("#Department").append("<option value='16'>16. 電機工程學系</option>");
            $("#Department").append("<option value='17'>17. 電子工程學系</option>");
            $("#Department").append("<option value='18'>18. 資訊工程學系</option>");
            $("#Department").append("<option value='19'>19. 企業管理學系</option>");
            $("#Department").append("<option value='20'>20. 會計學系</option>");
            $("#Department").append("<option value='21'>21. 資訊管理學系資訊管理組</option>");
            $("#Department").append("<option value='22'>22. 資訊管理學系數位內容科技與管理組</option>");
            $("#Department").append("<option value='23'>23. 運動學系</option>");
            $("#Department").append("<option value='24'>24. 公共事務與公民教育學系公共事務組</option>");
            $("#Department").append("<option value='25'>25. 公共事務與公民教育學系公民教育組</option>");
        }

        if ($('input[name="degree_Pursued"]:checked').val() == 'degree_Pursued_Master'){
            $("#Department").append("<option value='26'>26. 輔導與諮商學系</option>");
            $("#Department").append("<option value='27'>27. 輔導與諮商學系婚姻與家族治療碩士班</option>");
            $("#Department").append("<option value='28'>28. 特殊教育學系</option>");
            $("#Department").append("<option value='29'>29. 特殊教育學系資賦優異教育碩士班</option>");
            $("#Department").append("<option value='30'>30. 教育研究所</option>");
            $("#Department").append("<option value='31'>31. 復健諮商研究所</option>");
            $("#Department").append("<option value='32'>32. 科學教育研究所</option>");
            $("#Department").append("<option value='33'>33. 數學系</option>");
            $("#Department").append("<option value='34'>34. 物理學系</option>");
            $("#Department").append("<option value='35'>35. 生物學系</option>");
            $("#Department").append("<option value='36'>36. 生物學系生物技術碩士班</option>");
            $("#Department").append("<option value='37'>37. 化學系</option>");
            $("#Department").append("<option value='38'>38. 光電科技研究所</option>");
            $("#Department").append("<option value='39'>39. 統計資訊研究所</option>");
            $("#Department").append("<option value='40'>40. 工業教育與技術學系</option>");
            $("#Department").append("<option value='41'>41. 工業教育與技術學系數位學習碩士班</option>");
            $("#Department").append("<option value='42'>42. 財務金融技術學系</option>");
            $("#Department").append("<option value='43'>43. 人力資源管理研究所</option>");
            $("#Department").append("<option value='44'>44. 車輛科技研究所</option>");
            $("#Department").append("<option value='45'>45. 英語學系</option>");
            $("#Department").append("<option value='46'>46. 國文學系</option>");
            $("#Department").append("<option value='47'>47. 地理學系</option>");
            $("#Department").append("<option value='48'>48. 地理學系環境暨觀光遊憩碩士班</option>");
            $("#Department").append("<option value='49'>49. 美術學系</option>");
            $("#Department").append("<option value='50'>50. 美術學系藝術教育碩士班</option>");
            $("#Department").append("<option value='51'>51. 兒童英語研究所</option>");
            $("#Department").append("<option value='52'>52. 翻譯研究所</option>");
            $("#Department").append("<option value='53'>53. 台灣文學研究所</option>");
            $("#Department").append("<option value='54'>54. 歷史學研究所</option>");
            $("#Department").append("<option value='55'>55. 機電工程學系</option>");
            $("#Department").append("<option value='56'>56. 電機工程學系</option>");
            $("#Department").append("<option value='57'>57. 電子工程學系</option>");
            $("#Department").append("<option value='58'>58. 資訊工程學系</option>");
            $("#Department").append("<option value='59'>59. 資訊工程學系物聯網碩士班</option>");
            $("#Department").append("<option value='60'>60. 電信工程學研究所</option>");
            $("#Department").append("<option value='61'>61. 企業管理學系</option>");
            $("#Department").append("<option value='62'>62. 企業管理學系行銷與流通管理碩士班</option>");
            $("#Department").append("<option value='63'>63. 會計學系</option>");
            $("#Department").append("<option value='64'>64. 資訊管理學系</option>");
            $("#Department").append("<option value='65'>65. 資訊管理學系數位內容科技與管理碩士班</option>");
            $("#Department").append("<option value='66'>66. 運動學系應用運動科學碩士班</option>");
            $("#Department").append("<option value='67'>67. 運動健康研究所</option>");
            $("#Department").append("<option value='68'>68. 公共事務與公民教育學系</option>");
        }

        if ($('input[name="degree_Pursued"]:checked').val() == 'degree_Pursued_PhD'){
            $("#Department").append("<option value='69'>69. 輔導與諮商學系</option>");
            $("#Department").append("<option value='70'>70. 特殊教育學系</option>");
            $("#Department").append("<option value='71'>71. 教育研究所</option>");
            $("#Department").append("<option value='72'>72. 科學教育研究所</option>");
            $("#Department").append("<option value='73'>73. 數學系</option>");
            $("#Department").append("<option value='74'>74. 物理學系</option>");
            $("#Department").append("<option value='75'>75. 光電科技研究所</option>");
            $("#Department").append("<option value='76'>76. 工業教育與技術學系</option>");
            $("#Department").append("<option value='77'>77. 財務金融技術學系</option>");
            $("#Department").append("<option value='78'>78. 人力資源管理研究所</option>");
            $("#Department").append("<option value='79'>79. 英語學系</option>");
            $("#Department").append("<option value='80'>80. 國文學系</option>");
            $("#Department").append("<option value='81'>81. 地理學系地理暨環境資源博士班</option>");
            $("#Department").append("<option value='82'>82. 機電工程學系</option>");
            $("#Department").append("<option value='83'>83. 電機工程學系</option>");
        }
    });
    
    /* 清除按鈕 */
    $("button[type='reset']").click(function(){
        alert("執行清除!");
    });

    /* 表單驗證 */
    $("#ApplicationForm").submit(function(){
        /* 正規表示式 */
        var id_check = /[^a-zA-Z0-9]/g;
        var mail_check = /.+@.+\..+/;
        
        if (!$("input:radio[name=degree_Pursued]").is(":checked")){
            $("#error_message").html("＊請選擇欲攻讀之學!");
            alert("請選擇欲攻讀之學位");
            $("#degree_Pursued_Bachelor").focus();
            return false;
        }

        if ($("#Department").val() == 0){
            $("#error_message").html("＊請選擇欲申請的系所班(組)別名稱");
            alert("請選擇欲申請的系所班(組)別名稱");
            $("#Department").focus();
            return false;
        }

        if (!$("input:radio[name=Enrollment_Incentive]").is(":checked")){
            $("#error_message").html("✽是否申請本校外國學生入學獎勵金");
            alert("請選擇是否申請本校外國學生入學獎勵金!");
            $("#Enrollment_Incentive_yes").focus();
            return false;
        }
        
        if ($("#name_chn").val() == ""){
            $("#error_message").html("✽姓名(中文)不可為空");
            alert("姓名(中文)不可為空");
            $("#name_chn").focus();
            return false;
        }

        if ($("#name_eng").val() == ""){
            $("#error_message").html("✽姓名(英文)不可為空");
            alert("姓名(英文)不可為空!");
            $("#name_eng").focus();
            return false;
        }
        


        if (!$("input:radio[name=Gender]").is(":checked")){
            $("#error_message").html("✽請選擇性別");
            alert("請選擇性別");
            $("#Gender_male").focus();
            return false;
        }

        if ($("#Nationality").val() == ""){
            $("#error_message").html("✽請輸入國籍");
            alert("請輸入國籍!");
            $("#Nationality").focus();
            return false;
        }
        
        if ($("#birthday").val() == ""){
            $("#error_message").html("✽請輸入出生日期");
            alert("請輸入出生日期!");
            $("#birthday").focus();
            return false;
        }
        if ($("#Place_of_Birth").val() == ""){
            $("#error_message").html("✽請輸入出生地點");
            alert("請輸入出生地點!");
            $("#Place_of_Birth").focus();
            return false;
        }
        
        if ($("#Passport_Number").val() == ""){
            $("#error_message").html("✽請輸入護照號碼");
            alert("請輸入護照號碼!");
            $("#Passport_Number").focus();
            return false;
        }

        if ($("#Native_Language").val() == ""){
            $("#error_message").html("✽請輸入母語");
            alert("請輸入母語!");
            $("#Native_Language").focus();
            return false;
        }

        if ($("#Postal_Address").val() == ""){
            $("#error_message").html("✽請輸入通訊地址");
            alert("請輸入通訊地址!");
            $("#Postal_Address").focus();
            return false;
        }

        

        if ($("#Telephone").val() == ""){
            $("#error_message").html("✽請輸入電話");
            alert("請輸入電話!");
            $("#Telephone").focus();
            return false;
        }

        if ($("#E-Mail").val() == ""){
            $("#error_message").html("✽請輸入E-Mail");
            alert("請輸入E-Mail!");
            $("#E-Mail").focus();
            return false;
        }
    

        if ($("#Mobile_Number").val() == ""){
            $("#error_message").html("✽請輸入手機號碼");
            alert("請輸入手機號碼!");
            $("#Mobile_Number").focus();
            return false;
        }
        
        if ($("#father_Name").val() == ""){
            $("#father_Name").html("✽請輸入父親姓名");
            alert("請輸入父親姓名!");
            $("#father_Name").focus();
            return false;
        }

        if ($("#father_Postal_Address").val() == ""){
            $("#error_message").html("✽請輸入父親通訊地址");
            alert("請輸入父親通訊地址!");
            $("#father_Postal_Address").focus();
            return false;
        }

        if ($("#father_Contact_Number").val() == ""){
            $("#error_message").html("✽請輸入父親連絡電話");
            alert("請輸入父親連絡電話!");
            $("#father_Contact_Number").focus();
            return false;
        }
        if ($("#mother_Name").val() == ""){
            $("#mother_Name").html("✽請輸入母親姓名");
            alert("請輸入母親姓名!");
            $("#mother_Name").focus();
            return false;
        }

        if ($("#mother_Postal_Address").val() == ""){
            $("#error_message").html("✽請輸入母親通訊地址");
            alert("請輸入母親通訊地址!");
            $("#mother_Postal_Address").focus();
            return false;
        }

        if ($("#mother_Contact_Number").val() == ""){
            $("#error_message").html("✽請輸入母親連絡電話");
            alert("請輸入母親連絡電話!");
            $("#mother_Contact_Number").focus();
            return false;
        }
        
        if ($("#Name_of_School").val() == ""){
            $("#error_message").html("✽請輸入學校名稱");
            alert("請輸入學校名稱!");
            $("#Name_of_School").focus();
            return false;
        }

        if ($("#Location_of_School").val() == ""){
            $("#error_message").html("✽請輸入學校所在地");
            alert("請輸入學校所在地!");
            $("#Location_of_School").focus();
            return false;
        }

        if ($("#Degree").val() == ""){
            $("#error_message").html("✽請輸入學位");
            alert("請輸入學位!");
            $("#Degree").focus();
            return false;
        }

        if ($("#Month_and_Year_of_Graduation").val() == ""){
            $("#error_message").html("✽請輸入畢業年月");
            alert("請輸入畢業年月!");
            $("#Month_and_Year_of_Graduation").focus();
            return false;
        }

        if ($("#Major").val() == ""){
            $("#error_message").html("✽請輸入主修學門");
            alert("請輸入主修學門!");
            $("#Major").focus();
            return false;
        }

        if ($("#Minor").val() == ""){
            $("#error_message").html("✽請輸入副修學門");
            alert("請輸入副修學門!");
            $("#Minor").focus();
            return false;
        }
        

        if (!$("input:radio[name=Financial_resources_in_Taiwan]").is(":checked")){
            $("#error_message").html("＊請敘明在臺期間各項費用來源");
            alert("請敘明在臺期間各項費用來源!");
            $("#Personal_savings").focus();
            return false;
        }


        if (!$("input:radio[name=Health_Condition]").is(":checked")){
            $("#error_message").html("＊請選擇健康狀況");
            alert("請選擇健康狀況!");
            $("#Health_Condition_Good").focus();
            return false;
        }

        if (!$("input:radio[name=Proficiency_of_Chinese_Listening]").is(":checked")){
            $("#error_message").html("＊請選擇華語程度(聽)");
            alert("請選擇華語程度(聽)!");
            $("#Proficiency_of_Chinese_Listening_Excellent").focus();
            return false;
        }

        if (!$("input:radio[name=Proficiency_of_Chinese_Speaking]").is(":checked")){
            $("#error_message").html("＊請選擇華語程度(說)");
            alert("請選擇華語程度(說)!");
            $("#Proficiency_of_Chinese_Speaking_Excellent").focus();
            return false;
        }

        if (!$("input:radio[name=Proficiency_of_Chinese_Reading]").is(":checked")){
            $("#error_message").html("＊請選擇華語程度(讀)");
            alert("請選擇華語程度(讀)!");
            $("#Proficiency_of_Chinese_Reading_Excellent").focus();
            return false;
        }

        if (!$("input:radio[name=Proficiency_of_Chinese_Writing]").is(":checked")){
            $("#error_message").html("＊請選擇華語程度(寫)");
            alert("請選擇華語程度(寫)!");
            $("#Proficiency_of_Chinese_Writing_Excellent").focus();
            return false;
        }
        

        if ($("#Experience_Chinese").val() == ""){
            $("#error_message").html("✽請輸入曾學習（研究）華語文幾年");
            alert("請輸入曾學習（研究）華語文幾年!");
            $("#Experience_Chinese").focus();
            return false;
        }

        if ($("#learningEnviorment_And_instructor").val() == ""){
            $("#error_message").html("✽請輸入學習華語文環境（高中、大學或語文機構）及受何人指導（講授）");
            alert("請輸入學習華語文環境（高中、大學或語文機構）及受何人指導（講授）!");
            $("#learningEnviorment_And_instructor").focus();
            return false;
        }
        

    });
});