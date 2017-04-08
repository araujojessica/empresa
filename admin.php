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
	
		
	</head>
<?php
/* QUANTIDADE DE USUÁRIOS CADASTRADOS*/

	if(isset($_SESSION["user_portal"])){
		$user = $_SESSION["user_portal"];
		
		//quantidade de usuarios
		$sql  = 'SELECT count(*) as qtde FROM clientes WHERE `clienteID`';
		$conect = mysqli_query($conecta, $sql);
		if(!$conect){
			die("Falhaaaaa");
		}
		$conect = mysqli_fetch_assoc($conect);
		$qtde1 = $conect["qtde"];
	
		// quantidade de usuarios = admin
		$sql  = 'SELECT count(*) as qtde FROM clientes WHERE `nivel` = "admin"';
		$conect = mysqli_query($conecta, $sql);
		if(!$conect){
			die("Falhaaaaa");
		}
		$conect = mysqli_fetch_assoc($conect);
		$qtde2 = $conect["qtde"];
	
		
		// quantidade de usuarios = user
		$sql  = 'SELECT count(*) as qtde FROM clientes WHERE `nivel` = "user"';
		$conect = mysqli_query($conecta, $sql);
		if(!$conect){
			die("Falhaaaaa");
		}
		$conect = mysqli_fetch_assoc($conect);
		$qtde3 = $conect["qtde"];
		
		// quantidade de usuarios = foreign
		
		$sql  = 'SELECT count(*) as qtde FROM clientes WHERE `nivel` = "foreign"';
		$conect = mysqli_query($conecta, $sql);
		if(!$conect){
			die("Falhaaaaa");
		}
		$conect = mysqli_fetch_assoc($conect);
		$qtde4 = $conect["qtde"];	
		
		
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
<!-- Preparar a geracao do grafico -->
<script type="text/javascript">

      // Carregar a API de visualizacao e os pacotes necessarios.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Especificar um callback para ser executado quando a API for carregada.
      google.setOnLoadCallback(desenharGrafico);

      /**
       * Funcao que preenche os dados do grafico
       */
      function desenharGrafico() {
        // Montar os dados usados pelo grafico
        var dados = new google.visualization.DataTable();
        dados.addColumn('string', 'clienteID');
        dados.addColumn('number', 'nivel');
        dados.addRows([
          ['admin', <?php echo $qtde2?>],
          ['user', <?php echo $qtde3?>],
		  ['foreign',<?php echo $qtde4?>]
        ]);

        // Configuracoes do grafico
        var config = {
            'title':'Número de usuários / permissão',
            'width':600,
            'height':500
        };

        // Instanciar o objeto de geracao de graficos de pizza,
        // informando o elemento HTML onde o grafico sera desenhado.
        var chart = new google.visualization.PieChart(document.getElementById('area_grafico'));

        // Desenhar o grafico (usando os dados e as configuracoes criadas)
        chart.draw(dados, config);
      }
</script>
	
<body>
	<div class="container">
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
		?>
			<div><h3>BEM VINDO, <?php echo $nome ?></h3></div>
		<?php	} ?>
	
	<div><h4>>> Você tem permissão de administrador !! <<</h4></div>
	
	<div id="area_grafico"></div>
	
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

	<a href="alterar_dados.php" class="btn-alterar-adm">ALTERAÇÃO DE DADOS PESSOAIS</a>
	<br><br><br><br>




	<h3>Altere a permissão de usuário: </h3>
	<form action="admin.php" method="post" class="form-alterar">
		<label for="usuario">Nome do usuário que deseja alterar:</label><input type="text" name="usuario" class="form-control" maxlength="50" placeholder="Digite o ID do usuário" value="" aria-describedby="basic-addon2">
		<input type="submit" value="Alterar" class="btn-alterar-adm" />
	</form> 
<?php
	
if(isset($_POST["usuario"])){
	$usuario = $_POST["usuario"];
	$sql  = "SELECT * FROM `clientes` WHERE `usuario`='{$usuario}'";
	$usuario_con = mysqli_query($conecta, $sql);
	if(!$usuario_con){
		die("Falhaaaaa");
	}
	
	$usuario_con = mysqli_fetch_assoc($usuario_con);
	$usuario1 = $usuario_con["usuario"];
	$nome1 = $usuario_con["nomecompleto"];
	$email1 = $usuario_con["email"];
	$telefone1 = $usuario_con["telefone"];
	$nivel = $usuario_con["nivel"];
	$usuarioid = $usuario_con["clienteID"];
	


?>	
			
	<table class="table table-striped" >
		<tr>
			<th>Nome Completo</th>
			<th>Usuário</th> 
			<th>Email</th>
			<th>Telefone</th>
			<th>Nível</th>
		</tr>
		<tr>
			<td><?php echo $nome1 ?></td>
			<td><?php echo $usuario1 ?></td>
			<td><?php echo $email1 ?></td>
			<td><?php echo $telefone1 ?></td>
			<td><?php echo $nivel ?></td>
			
		<tr>
	</table>
	<div class="container alterar">
		<h2>Alteração de dados</h2>
		<form action="admin.php" method="post" class="form-alterar">
							
				<label for="nivel">Permissão do usuário: (admin, user ou foreign)</label><input type="text" required="required" name="nivel" class="form-control" maxlength="50" placeholder="" value="<?php echo $nivel; ?>" aria-describedby="basic-addon2">
						
				
				<input type="hidden" name="idcliente" value="<?php  echo $usuario;?>" />
				<input type="submit" value="Alterar" class="btn-alterar" />
		</form> 
		<br><br><br><br>
	<a href="projeto.php" class="btn-inicial">Página Inicial</a>
	<a href="logout.php" class="btn-sair">SAIR</a>
	</div>
		
	<?php } ?>	

</body>
</html>
<?php } ?>
<?php
if(isset($_POST["nivel"])){		
	$nivel1 = $_POST["nivel"];
	$idCliente= $_POST["idcliente"];
	
	$upd_nivel = "UPDATE clientes SET nivel = '{$nivel1}' WHERE clienteID = '{$idCliente}' ";
	$altera_nivel = mysqli_query($conecta, $upd_nivel);
	if(!$altera_nivel){
		die("<h5 class='erro'>Erro ao inserir no Banco de dados</h5>");
	}else{
		echo "<h5 class='sucesso'>Usuário atualizado com sucesso</h5>";
	}
}


?>
<?php
	mysqli_close($conecta);
?>


