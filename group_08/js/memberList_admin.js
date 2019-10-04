$(function() {
    // dataTable 樣式設定
    var tb;
    tb = $('#memberTable').DataTable({
        "responsive": true,
        "scrollX": false,
        "scrollY": false,
        "scrollCollapse": false, //當筆數小於scrillY高度時,自動縮小
        "displayLength": 10,
        "paginate": true, //是否分頁
        "lengthChange": true,
        "language": { // 設定Table顯示的文字
            "search": "搜尋:",
            "searchPlaceholder": "Search...",
            "info": "資料第 _START_ 筆到第 _END_ 筆，共 _TOTAL_ 筆資料",
            "lengthMenu": "單頁 _MENU_  資料", // 一頁幾筆資料
            "infoFiltered":   "(從 _MAX_ 筆資料中篩選)",
            "processing": "處理中...",
            "zeroRecords": "查無資料",
            "paginate": {
                "next": "下一頁",
                "previous": "上一頁"
            }
        },
        "ajax": {
            url: "../phpfunction/ajax_memberList_admin.php",
            data: function(d) {
                return "&oper=query";
            },
            type: 'POST',
            dataType: 'json'
        },
        "columns": [{
                "className": 'details-control',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            { "data": "name" },
            { "data": "userAccount" },
            { "data": "userNickname" },
            { "data": "rank" },
            { "data": "signUpDate" },
            {
                "data": "button",
                "searchable": false,
                "orderable": false
            }
        ],
        "order": [
            [5, 'asc']
        ],
        "dom": 'lftipr',
    });
/*
 * child row js控制
 */
    /* Formatting function for row details - modify as you need */
    function format(d) {
        // `d` is the original data object for the row
        return '<table class="info-detail" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<td>id:</td>' +
            '<td>' + d.id + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>性別:</td>' +
            '<td>' + d.sex + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>信箱:</td>' +
            '<td>' + d.Email + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>出生日期:</td>' +
            '<td>' + d.dateOfBirth + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>電話:</td>' +
            '<td>' + d.mobile + '</td>' +
            '</tr>' +

            '</table>';
    }

    // Add event listener for opening and closing details
    $('#memberTable tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = tb.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

/*
 * CRUD控制
 */
    // DELETE
    $('tbody').on('click', '#btn_delete', function(){
        // 刪除按鈕被按 則跳出modal
        var tr_data = tb.row($(this).closest('tr')).data();
        $("form #oper").val("delete"); // delete operation
        $("form #user_id").val(tr_data['id']); // 要刪除的會員id
        // form 設定
        $("#memberForm").hide();
        
        // modal設定
        $("#memberModal-title").html("刪除會員");
        $("#modal-body #modal-message").show(); // show message
        $("#modal-body #modal-message").html("確定要刪除會員\"" + tr_data['name'] + "\"嗎?，刪除後將無法再次復原會員資料!!");
        $(".modal-footer").show(); // show footer button
        // 顯示modal
        $("#memberModal").modal();
    });

    // UPDATE
    $('tbody').on('click', '#btn_update', function(){
        var tr_data = tb.row($(this).closest('tr')).data();
        $("form #oper").val("update"); // update  operation
        $("form #user_id").val(tr_data['id']); // 要update的會員id
        // modal 中 form 設定
        $("#memberForm").show();
        // modal設定
        $("#memberModal-title").html("修改會員資料");
        $(".modal-footer").hide();
        // 動態將需要的欄位載入 (asyn)
        $.get('../movie_txt_load/updateMemberForm.html', function(data){
            $("#modal-body #form-container").html(data);
            // 將要update的起始值放入各欄位
            $("#name").val(tr_data['name']);
            $("#userAccount").val(tr_data['userAccount']);

            $("#Email").val(tr_data['Email']);
            $("#dateOfBirth").val(tr_data['dateOfBirth']);
            if (tr_data['sex'] == "男"){
                $('input:radio[name="sex"][value="M"]').prop("checked", true);
            }
            else{
                $('input:radio[name="sex"][value="F"]').prop("checked", true);
            }
            $("#mobile").val(tr_data['mobile']);
            $("#userNickname").val(tr_data['userNickname']);
            if (tr_data['rank'] == "一般會員"){
                $('select[name="rank"] option[value="normal"]').prop('selected', true);
            }
            else if (tr_data['rank'] == "管理者"){
                $('select[name="rank"] option[value="admin"]').prop('selected', true);
            }
            $("#member_id").html("#" + tr_data['id']);
            $("#signUpDate").html(tr_data['signUpDate']);
            // 顯示modal
            $("#modal-body #modal-message").show();
            $("#modal-body #modal-message").html("＊起始值為目前用戶的當前資料，若需變更，請謹慎調整");
            $("#memberModal").modal();
        });
    });
    // 若要update 密碼的checkbox被按
    $('#memberModal').on('change', '#changeUserPassword', function(){
        if ($('#changeUserPassword').prop('checked')){
            $('#passwordArea').show();
        }
        else{
            $('#passwordArea').hide();
        }
    });

    // 若要update 密碼的button被按
    $('#memberModal').on('click', '#btn-changeUserPassword', function(){

        if ($("#userPassword").val() == "") {
            // 檢查密碼是否為空字串
            $("#userPassword").addClass("is-invalid");
            $("#userPassword-invalid-feedback").html("<i class='far fa-times-circle'></i>請輸入密碼!!");                
            $("#userPassword").focus();
            return false;
        }
        else if ($("#userPassword").val().length > 20){
            // 檢查密碼是否為長度大於20
            $("#userPassword").addClass("is-invalid");
            $("#userPassword-invalid-feedback").html("<i class='far fa-times-circle'></i>密碼長度不可大於20!!");
            $("#userPassword").focus();
        }
        else{
            // ajax更新密碼
            $.post('../phpfunction/ajax_updatePassword_admin.php', {id : $('#user_id').val() ,userPassword : $('#userPassword').val()}, function(data){
                if (data['isSuccess'] == true){
                    toastr.success("成功重新設定密碼!!", "重設密碼");
                    $("input:checkbox[id='changeUserPassword']").prop("checked", false);
                    $("#userPassword").val("");
                    $("#userPassword").removeClass("is-invalid");
                    $('#passwordArea').hide();
                }
                else{
                    toastr.error("有錯誤發生，請查看錯誤訊息", "重設密碼");
                }
                console.log(data);
            }, "json");

        }
    });
    

    // CREATE
    $('#btn-insertMember').on('click', function(){
        var tr_data = tb.row($(this).closest('tr')).data();
        $("form #oper").val("insert"); // insert operation
        // modal 中 form 設定
        $("#memberForm").show();
        // modal設定
        $("#memberModal-title").html("新增會員");
        $(".modal-footer").hide();
        // 動態將需要的欄位載入 (asyn)
        $.get('../movie_txt_load/addMemberForm.html', function(data){
            $("#modal-body #form-container").html(data);
            // 顯示modal
            $("#modal-body #modal-message").hide();
            $("#memberModal").modal();
        }); 

    });


    // (DELETE)若modal"確定刪除"按鈕被按，hide modal
    $('.modal-footer #btn-ModalConfirm').on('click', function(){
        $("#memberModal").modal('hide');
        CRUD();
    });

    // 表單"提交"時檢查(update or insert)
    $("#memberForm").submit(function() {
        var message = "";
        var id_check = /[^a-zA-Z0-9]/g;
        var number_check = /^09[0-9]{8}$/;
        var mail_check = /.+@.+\..+/;
        var userAccount = $("#userAccount").val();

        if ($("#name").val() == "") {
                $("#ErrorMessage").html("請輸入姓名!!");
                $("#name").focus();
                return false;
            }

        if (userAccount == "")
            message = "＊請輸入帳號!!"
        else if (userAccount.indexOf(' ') >= 0)
            message = "＊帳號不可有空格!!";
        else if (userAccount.length < 4 || userAccount.lenth > 20)
            message = "＊帳號長度限制為4-20!!";
        else if (userAccount.match(id_check))
            message = "＊帳號僅限英數字!!";
        else if ($("#userAccount").hasClass("is-invalid")) // 若上述皆合格，卻有此class(ajax內動態新增) 則帳號重複
            message = "＊帳號重複!!"; 

        if (message) {
            $("#ErrorMessage").html(message);
            $("#userAccount").focus();
            return false;
        }

        if (!$("input:radio[name=sex]").is(":checked")) {
                $("#ErrorMessage").html("＊請選擇性別!!");
                $("#sexM").focus();
                return false;
            }

        if ($("#dateOfBirth").val() == "") {
            $("#ErrorMessage").html("＊請輸入出生年月!!");
            $("#dateOfBirth").focus();
            return false;
        }

        if (!$("#Email").val().match(mail_check)) {
            $("#ErrorMessage").html("＊E-mail格式錯誤!");
            $("#Email").focus();
            return false;
        }

        if (!$("#mobile").val().match(number_check)) {
            $("#ErrorMessage").html("＊行動電話格式錯誤!");
            $("#mobile").focus();
            return false;
        }

        if ($("#userNickname").val() == "") {
            $("#ErrorMessage").html("＊請輸入帳號顯示之稱謂!");
            $("#userNickname").focus();
            return false;
        }

        var oper = $("#oper").val(); // 取得是 修改 or 新增 檢查項目、操作不同
        if (oper == "insert"){
            if ($("#userPassword").val() == "") {
                $("#ErrorMessage").html("＊請輸入密碼!!");
                $("#userPassword").focus();
                return false;
            }

            if ($("#userPassword").val().length > 16) {
                $("#ErrorMessage").html("＊密碼長度不可大於16!!");
                $("#userPassword").focus();
                return false;
            }

            if ($("#userPassword").val() != $("#userPassword2").val()) {
                $("#ErrorMessage").html("＊2次密碼輸入不相同!!");
                $("#userPassword2").focus();
                return false;
            }

            if (!$("#agreement").is(":checked")) {
                $("#ErrorMessage").html("＊請了解並同意我們的個資保護聲明。");
                $("#agreement").focus();
                return false;
            }
            // 檢查皆成功 
            CRUD();
            
        }
        else if (oper == "update"){
            // do somthing
            CRUD();
        }
        $("#memberModal").modal('hide');
        return false;
    });



    // ajax帳號檢查是否有重複
    var id_check = /[^a-zA-Z0-9]/g;
    $("#memberModal").on('keyup', '#userAccount', function() {
        var userAccount = $(this).val();
        if (userAccount == "") {
            $("#userAccount").removeClass("is-valid");
            $("#userAccount").addClass("is-invalid");
            $("#userAccount-invalid-feedback").html("<i class='far fa-times-circle'></i>請輸入帳號!!");
        } else if (userAccount.indexOf(' ') >= 0) {
            $("#userAccount").removeClass("is-valid");
            $("#userAccount").addClass("is-invalid");
            $("#userAccount-invalid-feedback").html("<i class='far fa-times-circle'></i>帳號不可有空格!!");
        } else if (userAccount.length < 4 || userAccount.length > 20) {
            // 長度非5-20
            $("#userAccount").removeClass("is-valid");
            $("#userAccount").addClass("is-invalid");
            $("#userAccount-invalid-feedback").html("<i class='far fa-times-circle'></i>長度限制為4-20!!");
        } else if (userAccount.match(/[^a-zA-Z0-9]/g)) {
            $("#userAccount").removeClass("is-valid");
            $("#userAccount").addClass("is-invalid");
            $("#userAccount-invalid-feedback").html("<i class='far fa-times-circle'></i>帳號僅限英數字!!");
        } else {
            $.ajax({
                    method: "POST", // 傳遞表單的方式
                    url: "../phpfunction/ajax_userAccountCheck.php", // 目標給哪個檔案
                    data: { // 傳送的資料 ，使用物件的方式傳送，
                        userAccount: $(this).val()
                    },
                    dataType: 'json' // 設定該網站回應的格式
                })
                .done(function(data) {
                    // 檢查是否與資料庫資料存在
                    if (data['isExist'] == true) {
                        $("#userAccount").removeClass("is-valid");  
                        $("#userAccount").addClass("is-invalid");
                        $("#userAccount-invalid-feedback").html("<i class='far fa-times-circle'></i>此帳號已存在");
                    } else {
                        $("#userAccount").removeClass("is-invalid");
                        $("#userAccount").addClass("is-valid");
                        $("#userAccount-valid-feedback").html("<i class='far fa-check-circle'></i>您可以使用此帳號");
                    }

                    console.log(data);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    // 失敗的時候 ex: 404, ...
                    alert("有錯誤發生，請查看錯誤訊息")
                    console.log(jqXHR.responseText);
                });
        }
    });

    function CRUD(){
        $.ajax({
            url: "../phpfunction/ajax_memberList_admin.php",
            data: $("#memberForm").serialize(),
            type: 'POST',
            dataType: "json",
            success: function(JData) {
                  if (JData.code == 0){
                    // 成功
                    toastr.success(JData.message);
                    setInterval( function () {
                        tb.ajax.reload();
                    }, 500 ); // 重新載入Table
                  }  
                  else { // 失敗 show error
                    toastr.error(JData.message);
                  }
                  console.log(JData);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.responseText);
                  alert(xhr.responseText);
            }
      });
    }


});