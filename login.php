<?php

//conexão com o bd
$conecta = mysqli_connect('localhost','root','','usuario');
	if( mysqli_connect_errno()){
		die("Conexao falhou: " .mysql_connect_errno());
	}
//fim da conexão

// Proteção das páginas
session_start();
	if(!isset($_SESSION["user_portal"])){
		header("location:login.php");
	} 
//fim da proteção de páginas

if(isset($_POST["usuario"])){
	$usuario = $_POST["usuario"];
	$senha = $_POST["senha"];

	$login = "SELECT * FROM clientes WHERE usuario = '{$usuario}' and senha = '{$senha}' ";
	$acesso = mysqli_query($conecta, $login);
	
if(isset($_SESSION["user_portal"])){
	$user = $_SESSION["user_portal"];
	$nivel = "SELECT nivel FROM clientes WHERE clienteID = {$user}";
	$nivel_con = mysqli_query($conecta, $nivel);
		
	if(!$nivel_con){
		die("Falhaaaaa");
	}
	$nivel_con = mysqli_fetch_assoc($nivel_con);
	$nivel = $nivel_con["nivel"];
}
			
	if(!$acesso){
		die("Falha na consulta");
		header("location: index.html");
		}
	$informacao = mysqli_fetch_assoc($acesso);
	if(empty($informacao)){
		echo "<h5 class='erro'>Usuário ou senha incorretos</h5>" ;
		header("location: index.html");
	}else {
		$_SESSION["user_portal"] = $informacao["clienteID"];
		if($nivel == 'admin'){
			header("location: admin.php");
		}else {
			header("location: projeto.php");
		}
	}
}

 


mysqli_close($conecta);

?>