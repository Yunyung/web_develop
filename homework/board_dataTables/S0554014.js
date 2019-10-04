var tbl;
$(function() {
    tbl = $('#example').DataTable({
        "scrollX": false,
        "scrollY": false,
        "scrollCollapse": false, //當筆數小於scrillY高度時,自動縮小
        "displayLength": 10,
        "paginate": true, //是否分頁
        "lengthChange": true,
        "ajax": {
            url: "S0554014_ajax.php",
            data: function(d) {
                return $('#form1').serialize() + "&oper=query";
            },
            type: 'POST',
            dataType: 'json'
        },
        "dom": 'ftrip'
    });

    $('tbody').on('click', '#btn_update', function() {
    	 var data = tbl.row($(this).closest('tr')).data();
    	 console.log("fq");
        $('#message_id').val(data[0]);
        $('#message_subject').val(data[1]);
        $('#message_author').val(data[2]);
        $('#message_content').val(data[3]);
        $('#message_publishTime').val(data[4]);

        $("#message_id_old").val(data[0]);
        $("#oper").val("update");
    });

    //取消
   $('tbody').on('click', '#btn_cancel', function() {
      $("#oper").val("insert");
   });

   //刪除
   $('tbody').on('click', '#btn_delete', function() {
      var data = tbl.row($(this).closest('tr')).data();
      if (!confirm('是否確定要刪除?'))
            return false;

      $("#message_id_old").val(data[0]);
      $("#oper").val("delete"); //刪除
      CRUD();
   });

   //送出表單 (儲存)
   $("#form1").validate({
      submitHandler: function(form) {
            CRUD();
      },
      rules: {
            message_subject: {
                  required: true
            },
            message_author: {
                  required: true
            },
            message_content: {
                  required: true
            }
      }
   });

   function CRUD() { 
      $.ajax({
            url: "S0554014_ajax.php",
            data: $("#form1").serialize(),
            type: 'POST',
            dataType: "json",
            success: function(JData) {
                  if (JData.code)
                        toastr["error"](JData.message);
                  else {
                        $("#oper").val("insert");
                        toastr["success"](JData.message);
                        tbl.ajax.reload();
                  }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                  console.log(xhr.responseText);
                  alert(xhr.responseText);
            }
      });
   }






});