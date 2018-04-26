<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<META http-equiv="Content-Type" content="text/html; charset=utf-8">
		<!-- Biblioteca JQUERY via CDN -->
		<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
	</head>
	<body>
		<div>
			<div>
			  <div>
				<span>CPF NÃO ENCONTRADO</span>
				<span>CPF ENCONTRADO</span>
				<span>HASH DE ACESSO INVÁLIDA</span>
				<span>CPF INVÁLIDO (SÓ PODE SER NÚMERICO)</span>
				<button>Ok</button>
			  </div>
			</div>
			<div>
				<form action="testeAjaxResponse.php" method="POST" class='formAjax'>
					<input type="text" name="cpf" class="cpf" value="068.368.896-01" />	
					<div>
						<label>CERTIFICADO PARA:</label>
						<div>
						  <div>
							<label>
							  <span></span>
							  <input type="radio" name="radio">
							</label>
							
							<span>ADVOGADOS E ESTAGIÁRIOS</span>
						  </div>
						  <div>
							<label>
							  <span></span>
							  <input type="radio" name="radio">
							</label>
							<span>SOCIEDADE DE ADVOGADOS</span>
						  </div>
						</div>
					</div>
					<input type="button" class="validaCPF" value="QUERO MEU CERTIFICADO AGORA - CLIQUE" />
				</form>
				<div id="resultado">
					Resultado...
				</div>
			</div>
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
	</body>
</html>