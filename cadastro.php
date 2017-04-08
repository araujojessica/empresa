<?php
$conecta = mysqli_connect('localhost','root','','usuario');
	if( mysqli_connect_errno()){
		die("Conexao falhou: " .mysql_connect_errno());
	}
     
if(isset($_POST["usuario"])){
    //formulário pelo método POST
    $usuario = $_POST["usuario"]; 
    $senha = $_POST["senha"];
	$nomecompleto = $_POST["nomecompleto"];
	$telefone = $_POST["telefone"];
	$email = $_POST["email"];
        
    $inserir = "INSERT INTO clientes(`nomecompleto`, `endereco`, `complemento`, `numero`, `cidade`, `estadoID`, `cep`, `ddd`, `telefone`, `email`, `usuario`, `senha`, `nivel`) VALUES ('$nomecompleto','eeeee','pp','56','lavras','6','375200','35','$telefone','$email','$usuario','$senha','user')"; 
     
    $op_inserir = mysqli_query($conecta,$inserir);    
	if(!$op_inserir){
		die( "<h5 class='erro'>Erro ao inserir no banco</h5> ");
	}else {
		header("location: index.html");
	}
}

mysqli_close($conecta); //fecha conexão com banco de dados 
?>

<!doctype html>
<html>
		<head>
		<link href="style.css" rel="stylesheet">
		<!-- Bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap/js/bootstrap.min.js"></script>
        <meta charset="UTF-8">
		<!-- Incluindo API do Google para gerar gráfico-->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<title>Usuário</title>
	<head>
<body>
	<div class="container"/>
		
		<form action="cadastro.php" method="post" class="cadastro">
			<h2>Cadastrar</h2>
			
			<input type="text" name="nomecompleto" required="required" class="form-control" maxlength="50" placeholder="Qual seu nome ?" aria-describedby="basic-addon2">
			
			<input type="text" name="usuario" required="required" class="form-control" maxlength="50" placeholder="Escolha o nome do seu Usuário" aria-describedby="basic-addon2">
						
			<input type="password" name="senha" required="required" class="form-control" maxlength="50" placeholder="Escolha uma Senha" aria-describedby="basic-addon2">
			
			<input type="email" name="email" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" maxlength="50" placeholder="Digite seu email : exemplo@exemplo.com.br" aria-describedby="basic-addon2">
				
			<input type="text" name="telefone" required="required"  pattern="[0-9]+$" class="form-control" maxlength="50" placeholder="Digite seu telefone (somente números)" aria-describedby="basic-addon2">
					
			<input type="submit" value="Cadastrar" />
				
		</form> 
	</div>
     
</body>
</html>


