<?php
	$conecta = mysqli_connect('localhost','root','','usuario');
	
	session_start();
	if(!isset($_SESSION["user_portal"])){
			header("location:index.html");
	} 
	if(isset($_SESSION["user_portal"])){
		$user = $_SESSION["user_portal"];
		if(isset($_POST['nivel'])){
			$nivel1 = $_POST['nivel'];
			$infocliente = $_POST['idcliente'];
			 echo $infocliente;
			 $nivel1;
			$alterar = "UPDATE clientes SET nivel = '{$nivel}' WHERE clienteID = {$infocliente} ";
			$op_alterar = mysqli_query($conecta, $alterar);
			
			if(!$op_alterar){
				die("Erro ao inserir no Banco de dados");
			}else{
				echo "<h5 class='sucesso'>Usuário atualizado com sucesso</h5>";
			}
		}	
		
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
		<form action="alterar_admin.php" method="post" class="form-alterar">
							
				<label for="nivel">Nome Completo:</label><input type="text" required="required" name="nivel" class="form-control" maxlength="50" placeholder="" value="<?php echo $nivel1; ?>" aria-describedby="basic-addon2">
						
				
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


