<?php
	//require_once("../../infra/valida_sessao.php");
?>

<html>
	<head>
		<title>Login</title>
		<script src="../../static/js/jquery-3.6.4.min.js"></script>
		<script type="text/javascript">
			$( document ).ready(function() {
			});

			function processa_atualizar(){
				var formDados = {
					id: $("#id").val(),
					nome: $("#nome").val(),
					sobrenome: $("#sobrenome").val(),
					email: $("#email").val(),
					login: $("#login").val(),
					senha: $("#senha").val(),
					confirmar_senha: $("#confirmar_senha").val(),
    			};
				
				$.ajax({
					type: "POST",
					url: "../../controller/usuario_controller.php?acao=atualizar",
					data: formDados,
					dataType: "json",
					}).done(function (dataRetorno) {
						if(dataRetorno.erro == 0){
							alert(dataRetorno.msg)
							window.location.href = dataRetorno.url;
						}
						else{
							alert(dataRetorno.msg)
						}
				});
			}
		</script>
	</head>	
	<body>
        <h2>Cadastro de Usuário</h2>
		<form action="#" method="POST">
			<input type="hidden" id="id" name="id" value="<?php echo $dados[0]["id"]?>"/> <br>
			Nome: <input type="text" id="nome" name="nome" value="<?php echo $dados[0]["nome"]?>"/> <br>
			Sobrenome: <input type="text" id="sobrenome" name="sobrenome" value="<?php echo $dados[0]["sobrenome"]?>"/> <br>
			Email: <input type="text" id="email" name="email" value="<?php echo $dados[0]["email"]?>"/> <br>
			Login: <input type="text" id="login" name="login" value="<?php echo $dados[0]["login"]?>"/> <br>
			Senha: <input type="password" id="senha" name="senha" value="<?php echo $dados[0]["senha"]?>"/> <br>
			Confirmar Senha: <input type="password" id="confirmar_senha" name="confirmar_senha" value="<?php echo $dados[0]["senha"]?>"/><br>
			<input type="button" value="Atualizar" onclick="processa_atualizar()"/> <br>
	    </form>
</body>
</html>