function load_form(mes_id) {
    var uid,mid,cont,date;
    $.ajax({            //load mes
  url: "phpfunction/board_ajax.php",
  data: { oper: 'load_form' ,mes_id:mes_id},
  type: 'POST',
  dataType: "json",
  success: function(JData) {
        uid=JData.user_id[0];
        mid=JData.movie_id[0];
        cont=JData.content[0];
        date=JData.mes_date[0];
        console.log(mid);
        $('#content_up').val(cont);
        $('#mes_id').val(mes_id);
        
      },
  error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
        alert(xhr.responseText);

  }
});
    setTimeout(function (){

  console.log(mid);
  $.ajax({        //load movie list
  url: "phpfunction/board_ajax.php",
  data: { oper: 'qry_movie' },
  type: 'POST',
  dataType: "json",
  success: function(JData) {
    
    $("#movie_sel_up").empty();

    for (var i = 0; i < JData.movie_name.length; i++) {
          if(mid!=JData.movie_id[i])
            var row = "<option value=" + JData.movie_id[i] + ">" + JData.movie_name[i] + "</option>";
          else
            var row = "<option value=" + JData.movie_id[i] + " selected>" + JData.movie_name[i] + "</option>";
          $('#movie_sel_up').append(row);
    }


  },
  /*error: function(xhr, ajaxOptions, thrownError) {
        console.log(xhr.responseText);
        alert(xhr.responseText);
  }*/
});

}, 100);
    
  
  
  
　
}
function del(mes_id) {
    if(!confirm("是否刪除"))
    {
        return;
    }
    $.ajax({            //load mes
  url: "phpfunction/board_ajax.php",
  data: { oper: 'del' ,mes_id:mes_id},
  type: 'POST',
  dataType: "json",
  
});
    alert("刪除成功");
    window.location.reload();
  
  
  
　
}