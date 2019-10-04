
/* 購物車專用 */

$(function(){
	$(".purchase_list").hover(
		function(){
		$(this).css({"color":"#ff5722","cursor":"pointer"});
	},function(){
		$(this).css("color","black");
	});

	$(".purchase_list").select(
		function(){
			$(this).css({"color":"#ff5722","border-bottom":"2px solid #ff5722"});
		});
	$(".purchase_list").click(function(){
		var index = $(".purchase_list").index(this);
		
    	window.location.href="cart.php?type="+index;
	});

	$('.checkout').click(function(){

		var index = $(".checkout").index(this);
		// alert($('input:hidden').eq(index).val());
	
        $.ajax({
                method: "POST", // 傳遞表單的方式
                url: "phpfunction/ajax_cart_change_state.php", // 目標給哪個檔案
                data: { // 傳送的資料 ，使用物件的方式傳送，
                    movieID: $('input:hidden').eq(index).val(),
                    state: 1
                },
                dataType: 'json' // 設定該網站回應的格式
            })
            .done(function(data) {
                // 檢查是否與資料庫資料存在
                if (data['isSuccess'] == true) {
                    alert("結帳成功!!");
                    window.location.href="cart.php";
                    console.log(data);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                // 失敗的時候 ex: 404, ...
                alert("結帳失敗");
                console.log(jqXHR.responseText);
            });
        return false;
    });

    $('.fa-trash-alt').hover(function(){
    	$(this).css("color","red");
    	$(this).css("cursor","Pointer");
    },function(){
    	$(this).css("color","black");
    });

    $('.fa-trash-alt').click(function(){

    	var index = $(".fa-trash-alt").index(this);
		// alert($('input:hidden').eq(index).val());

    	if(confirm("確定要移除?")){
    		 $.ajax({
                method: "POST", // 傳遞表單的方式
                url: "phpfunction/ajax_cart_change_state.php", // 目標給哪個檔案
                data: { // 傳送的資料 ，使用物件的方式傳送，
                    movieID: $('input:hidden').eq(index).val(),
                    state: 2
                },
                dataType: 'json' // 設定該網站回應的格式
            })
            .done(function(data) {
                // 檢查是否與資料庫資料存在
                if (data['isSuccess'] == true) {
                    alert("移除成功!!");
                    window.location.href="cart.php";
                    console.log(data);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                // 失敗的時候 ex: 404, ...
                alert("移除失敗");
                console.log(jqXHR.responseText);
            });
        return false;
    	}
    });

    $('.del_rec').click(function(){
    	var index = $(".del_rec").index(this);
		// alert($('input:hidden').eq(index).val());
		if(confirm("確定要刪除此電影紀錄?") == true){
    		 $.ajax({
                method: "POST", // 傳遞表單的方式
                url: "phpfunction/ajax_cart_delete.php", // 目標給哪個檔案
                data: { // 傳送的資料 ，使用物件的方式傳送，
                    movieID: $('input:hidden').eq(index).val(),
                },
                dataType: 'json' // 設定該網站回應的格式
            })
            .done(function(data) {
                // 檢查是否與資料庫資料存在
                if (data['isSuccess'] == true) {
                    alert("刪除成功!!");
                    window.location.href="cart.php?type=2";
                    console.log(data);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                // 失敗的時候 ex: 404, ...
                alert("刪除失敗");
                console.log(jqXHR.responseText);
            });

        return false;
    	}
    });

    $('.add_to_cart').click(function(){
    	var index = $(".add_to_cart").index(this);
		// alert($('input:hidden').eq(index).val());
    	$.ajax({
                method: "POST", // 傳遞表單的方式
                url: "phpfunction/ajax_cart_change_state.php", // 目標給哪個檔案
                data: { // 傳送的資料 ，使用物件的方式傳送，
                    movieID: $('input:hidden').eq(index).val(),
                    state: 0
                },
                dataType: 'json' // 設定該網站回應的格式
            })
            .done(function(data) {
                // 檢查是否與資料庫資料存在
                if (data['isSuccess'] == true) {
                    alert("成功加入購物車!!");
                    console.log(data);
                    window.location.href="cart.php?type=2";
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                // 失敗的時候 ex: 404, ...
                alert("加入購物車失敗")
                console.log(jqXHR.responseText);
            });
    });
});