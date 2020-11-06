(function($) {  "use strict"; 
	$(".megamenu input").on("click",function(){

		var mvalue = $(this).val();
		var part = $(this).closest(".custom-option").attr("id");

    var column = $("#"+part+" p.field-column");
		var cont = $("#"+part+" p.field-container");

		if(mvalue == 1){
        column.removeClass("display-none");
			cont.removeClass("display-none");
		}else{
        column.addClass("display-none");
			cont.addClass("display-none");
		}
	})
})(jQuery);
