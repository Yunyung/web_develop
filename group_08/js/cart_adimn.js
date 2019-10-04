$(function() {
	// dataTable 樣式設定
	var tb;
    tb = $('#cartTable').DataTable({
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
            "infoFiltered":   "(從 _MAX_ 筆資料中篩選)",
            "processing": "處理中...",
            "lengthMenu": "單頁 _MENU_  資料", // 一頁幾筆資料
            "zeroRecords": "查無資料",
            "emptyTable":    "查無資料",
            "paginate": {
                "next": "下一頁",
                "previous": "上一頁"
            }
        },
        "ajax": {
            url: "../phpfunction/ajax_cart_admin.php",
            data: function(d) {
                return "&oper=query";
            },
            type: 'POST',
            dataType: 'json'
        },
        "columns": [
            { "data": "userAccount" },
            { "data": "movieID" },
            { "data": "chi_name" },
            { "data": "state" },
            { "data": "date" },
            {
                "data": "button",
                "searchable": false,
                "orderable": false
            }
        ],
        "dom": 'lftipr',
    });

    $("#cartAdminForm").hide();
    // DELETE one row
    $('tbody').on('click', '#btn_delete', function(){
        // 刪除按鈕被按 則跳出modal
        var tr_data = tb.row($(this).closest('tr')).data();
        $("form #oper").val("delete"); // delete operation
        $("form #userAccount").val(tr_data['userAccount']); // 要刪除的會員id
        $("form #movieID").val(tr_data['movieID']);
        $("p#modal-message").html("使用者帳號: " + tr_data['userAccount'] + ", 電影代號: " + tr_data['movieID'] + "<br>確定要刪除此資料嗎? 這將會造成這名使用者的購物、訂單狀態改變");
        // 顯示modal
        $("#movieModal").modal();
    });

    // (DELETE)若modal"確定刪除"按鈕被按，hide modal
    $('.modal-footer #btn-ModalConfirm').on('click', function(){
        $("#movieModal").modal('hide');
        CRUD();
    });

    function CRUD(){
        $.ajax({
            url: "../phpfunction/ajax_cart_admin.php",
            data: $("#cartAdminForm").serialize(),
            type: 'POST',
            dataType: "json",
            success: function(JData) {
                  if (JData.code == 0){
                    // 成功
                    toastr.success(JData.message + " 使用者帳號: " + $("form #userAccount").val() + ", 電影代號: " + $("form #movieID").val(), "刪除訂單資料");
                    setInterval( function () {
                        tb.clear();
                        tb.ajax.reload();
                    }, 500 );
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