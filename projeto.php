<?php
	$conecta = mysqli_connect('localhost','root','','usuario');
	//teste de segurança
	session_start();
	
	
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

		<div id="container" style="headeer" >
			<?php 
					if(isset($_SESSION["user_portal"])){
						$user = $_SESSION["user_portal"];
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
			
			
		</div>
	</head>


<body>
	<div class="container">
		<div><h3>BEM VINDO, <?php echo $nome ?></h3></div>
		<br>
		<h4>>>  Seus dados cadastrais são:  <<</h4>
		
		<br><br>
			
		
		<table class="table table-striped" >
			<tr>
				<th>Nome Completo</th>
				<th>Usuário</th> 
				<th>Email</th>
				<th>Telefone</th>
			</tr>
			<tr>
				<td><?php echo $nome ?></td>
				<td><?php echo $usuario ?></td>
				<td><?php echo $email ?></td>
				<td><?php echo $telefone ?></td>
			<tr>
		</table>
	

	
<?php	} ?>	

		<a href="alterar_dados.php" class="btn-alterar">ALTERAÇÃO DE DADOS</a>
		<a href="logout.php" class="btn-sair">SAIR</a>
	</div>
</body>

</html>

<?php
	mysqli_close($conecta);
?>


