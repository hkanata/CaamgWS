<!-- Biblioteca JQUERY via CDN -->
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  
 <!--
 Formulário para testar ajax
 -->
<form action="testeAjaxResponse.php" method="POST" class='formAjax'>
	<input type="text" name="cpf" class="cpf" value="068.368.896-01" />
	<br />
	<input type="button" class="validaCPF" value="Testar Ajax" />
</form>

<div id="resultado">
Resultado...
</div>

<script>
$(document).ready(function(){
	
	$("body").on("click", ".validaCPF", function(e){
		e.preventDefault();
		
		$("#resultado").html("");
		
		var url            = $(".formAjax").attr("action");
		var inputCPF = $(".cpf").val();
		
		$.ajax({
		  method: "POST",
		  url: url,
		  dataType: "json",
		  data: { cpf: inputCPF }
		}).done(function( response ) {
			console.log( response );
			$("#resultado").html( JSON.stringify(response) );
			if( response.success == true ){
				console.log( response.response.ValidaAdvogadoResult );
			}
		});
	});
});
</script>