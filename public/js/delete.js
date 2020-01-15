$( document ).ready(function() {
    $("#btn-delete").click(
		function(){
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
			$.ajax({
                url:     "/post/delete/"+location.pathname.split("/").pop(), 
                type:     "DELETE", 
                dataType: "html", 
                data: $("#"+"ajax-delete").serialize(),
                success: function() { 
                    location.href = '/post';
                },
                error: function(jqXHR, exception) {
                    $('#result').html('Ошибка.');
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
                    $('#result').html(msg);
                }
             });
			return false; 
		}
	);
});
 