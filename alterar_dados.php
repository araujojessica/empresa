<?php
	$conecta = mysqli_connect('localhost','root','','usuario');
	
	session_start();
	if(!isset($_SESSION["user_portal"])){
			header("location:index.html");
	} 
	if(isset($_SESSION["user_portal"])){
		$user = $_SESSION["user_portal"];
		if(isset($_POST['nomecompleto'])){
			$nome_novo = utf8_decode($_POST['nomecompleto']);
			$usuario_novo = utf8_decode($_POST['usuario']);
			$senha_nova = utf8_decode($_POST['senha']);
			$email_novo = utf8_decode($_POST['email']);
			$telefone_novo = utf8_decode($_POST['telefone']);
			$infocliente = $_POST['idcliente'];
			
			$alterar = "UPDATE clientes SET nomecompleto = '{$nome_novo}', usuario = '{$usuario_novo}', senha = '{$senha_nova}', email = '{$email_novo}', telefone = '{$telefone_novo}' WHERE clienteID = {$infocliente} ";
			$op_alterar = mysqli_query($conecta, $alterar);
			
			if(!$op_alterar){
				die("Erro ao inserir no Banco de dados");
			}else{
				echo "<h5 class='sucesso'>Usuário atualizado com sucesso</h5>";
			}
		}	
		
		$saudacao = "SELECT nomecompleto FROM clientes WHERE clienteID = {$user}";
		$saudacao_login = mysqli_query($conecta, $saudacao);
			if(!$saudacao_login){
				die("Falhaaaaa");
			}
		$saudacao_login = mysqli_fetch_assoc($saudacao_login);
		$nome = $saudacao_login["nomecompleto"];
		
		$con_usuario = "SELECT usuario FROM clientes WHERE clienteID = {$user}";
		$usuario_con = mysqli_query($conecta, $con_usuario);
			if(!$usuario_con){
				die("Falhaaaaa");
			}
		$usuario_con = mysqli_fetch_assoc($usuario_con);
		$usuario = $usuario_con["usuario"];
		
		$con_email = "SELECT email FROM clientes WHERE clienteID = {$user}";
		$email_con = mysqli_query($conecta, $con_email);
			if(!$email_con){
				die("Falhaaaaa");
			}
		$email_con = mysqli_fetch_assoc($email_con);
		$email = $email_con["email"];
				
		$con_telefone = "SELECT telefone FROM clientes WHERE clienteID = {$user}";
		$telefone_con = mysqli_query($conecta, $con_telefone);
			if(!$telefone_con){
				die("Falhaaaaa");
			}
		$telefone_con = mysqli_fetch_assoc($telefone_con);
		$telefone = $telefone_con["telefone"];
?>

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
	</head>

<body>
	<div class="container alterar">
		<h2>Alteração de dados</h2>
		<form action="alterar_dados.php" method="post" class="form-alterar">
							
				<label for="nomecompleto">Nome Completo:</label><input type="text" required="required" name="nomecompleto" class="form-control" maxlength="50" placeholder="" value="<?php echo $nome; ?>" aria-describedby="basic-addon2">
									
				<label for="usuario">Usuário:</label><input type="text" name="usuario"  required="required" class="form-control" maxlength="50" placeholder=""  value="<?php  echo $usuario; ?>" aria-describedby="basic-addon2">
					
				<label for="senha">Alterar Senha:</label><input type="password" name="senha" required="required" class="form-control" maxlength="50" placeholder=""  value="<?php  echo $senha; ?>" aria-describedby="basic-addon2">
				
				<label for="email">Email:</label><input type="email" name="email" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" maxlength="50" placeholder=""  value="<?php  echo $email; ?>" aria-describedby="basic-addon2">
					
				<label for="telefone">Telefone:</label><input type="text" name="telefone" required="required" pattern="[0-9]+$" class="form-control" maxlength="50" placeholder=""  value="<?php  echo $telefone;?>" aria-describedby="basic-addon2">
					
				
				<input type="hidden" name="idcliente" value="<?php  echo $user;?>" />
				<input type="submit" value="Alterar" class="btn-alterar" />
		</form> 
		<br><br><br><br>
	<a href="projeto.php" class="btn-inicial">Página Inicial</a>
	<a href="logout.php" class="btn-sair">SAIR</a>
	</div>
</body>
</html>
<?php 
	}	mysqli_close($conecta);
?>


