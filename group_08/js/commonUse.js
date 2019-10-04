/*
 * 所有檔案可套用的JS方法
 */


$(function(){
	// 滑動至當前網頁最上方
	$("a.link-Top").on("click", function() {
    $("body, html").animate({
        scrollTop: 0
    }, 600);
    return false;
	});
	
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": true,
	  "positionClass": "toast-top-center",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "2500",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
});