$( document ).ready(function() {
    $("#btn").click(
		function(){
			var container = Document.getElementsByClassName("container");
			var url;
			if(container.name=="container-create"){
				url = '/post/create';
			}else if(container.name=="container-edit"){
				url = '/post/edit';
			}
			sendAjaxForm('result_form', 'ajax_form', url);
			return false; 
		}
	);
});
 
function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url:     url, 
        type:     "POST", 
        dataType: "html", 
		data: $("#"+ajax_form).serialize(),
        success: function() { 
			$('#result_form').html('OK');
    	},
    	error: function(jqXHR, exception) {
			$('#result_form').html('Ошибка. Данные не отправлены.');
			var msg = '';
			if (jqXHR.status === 0) {
				msg = 'Not connect.\n Verify Network.';
			} else if (jqXHR.status == 404) {
				msg = 'Requested page not found. [404]';
			} else if (jqXHR.status == 500) {
				msg = 'Internal Server Error [500].';
			} else if (exception === 'parsererror') {
				msg = 'Requested JSON parse failed.';
			} else if (exception === 'timeout') {
				msg = 'Time out error.';
			} else if (exception === 'abort') {
				msg = 'Ajax request aborted.';
			} else {
				msg = 'Uncaught Error.\n' + jqXHR.responseText;
			}
			$('#result_form').html(msg);
		}
 	});
}