(function($){
	$("#frm_login").submit(function(ev){
		$("#alert").html("");
		$("#usuario > div").html("")
		$("#contrasena > div").html("")
		$.ajax({
			url:"validate",
			type: "POST",
			data: $(this).serialize(),
			success: function(err){
				//console.log(err)
			},
			statusCode: {
				400: function(xhr){
					$("#usuario > input").removeClass('is-invalid');
					$("#contrasena > input").removeClass('is-invalid');		
					var json = JSON.parse(xhr.responseText);

					if (json.usuario.length != 0) {
						$("#usuario > div").html(json.usuario);
						$("#usuario > input").addClass('is-invalid');
					}
					if (json.contrasena.length != 0) {
						$("#contrasena > div").html(json.contrasena);
						$("#contrasena > input").addClass('is-invalid');
					}
				},

				401: function(xhr){
					var json = JSON.parse(xhr.responseText);
					console.log(json);
					$("#alert").html('<div class="alert alert-danger" role="alert">'+ json.msg +'</div>')
				}
			},
		});
		ev.preventDefault();
	});
})(jQuery)