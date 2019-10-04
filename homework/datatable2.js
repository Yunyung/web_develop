
var tbl;
$(function() {
   //查詢
   tbl = $('#example').DataTable({
      "scrollX": false,
      "scrollY": false,
      "scrollCollapse": false, //當筆數小於scrillY高度時,自動縮小
      "displayLength": 10,
      "paginate": true, //是否分頁
      "lengthChange": true,
      "ajax": {
            url: "datatable2_ajax.php",
            data: function(d) {
                  return $('#form1').serialize() + "&oper=query";
            },
            type: 'POST',
            dataType: 'json'
      },
      "dom": 'ftrip'
   });

   //修改
   $('tbody').on('click', '#btn_update', function() {
      var data = tbl.row($(this).closest('tr')).data();
      $('#stud_no').val(data[0]);
      $('#stud_name').val(data[1]);
      if (data[2] == "男")
            $('input[name="stud_sex"][value=M]').prop('checked', true);
      else
            $('input[name="stud_sex"][value=F]').prop('checked', true);

      $('#stud_addr').val(data[3]);
      $("#stud_no_old").val(data[0]);
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

      $("#stud_no_old").val(data[0]);
      $("#oper").val("delete"); //刪除
      CRUD();
   });

   //送出表單 (儲存)
   $("#form1").validate({
      submitHandler: function(form) {
            CRUD();
      },
      rules: {
            stud_no: {
                  required: true,
                  minlength: 3,
                  maxlength: 8
            },
            stud_name: {
                  required: true
            },
            stud_sex: {
                  required: true
            },
            stud_addr: {
                  required: true
            }
      }
   });
   function CRUD() { 
      $.ajax({
            url: "datatable2_ajax.php",
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