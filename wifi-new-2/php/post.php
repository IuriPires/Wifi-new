<?php
include_once ('functions.php');
include_once ('conectar.php');
//include_once ('processa.php');


//var_dump($_POST['cpf']);
//var_dump($_POST['nome']);
//var_dump($_POST['data_nasc']);
//var_dump(isset($_GET['go']));
 
//if (@$_GET['go'] == 'cadastrar'){
	$cpf = $_POST['cpf'];
	$nome = $_POST['nome'];
	$data_nasc = $_POST['data_nasc'];
	$email = $_POST['email'];
	$celular = $_POST['celular'];
	$senha = $_POST['senha'];

	$senha_Crip = md5($senha);
	$attribute = 'md5-Password';
	$attribute1 = 'Mikrotik-Group';
	$attribute2 = 'Auth-type';
	//$value = 'Accept';
	//$value = 'Reject';
	$banda = '2048k';
	$op = ':=';

	$cpf2 = preg_replace("/[^0-9\s]/", "", $cpf);
	
	$test_cpf = validar_cpf($cpf2);
	$test_email = validar_email($email);
	
	
	if (empty($email)){
		echo "<script>alert('Preencha o campo E-mail!');window.location = '';</script>";
	}elseif ($test_email == false){
		echo "<script>alert('Preencha o campo E-mail!');window.location = '';</script>";
	}elseif (empty($celular)){
		echo "<script>alert('Preencha o campo Celular!');window.location = ''</script>";
    }elseif ($test_cpf == false){
		echo "<script>alert('CPF Invalido!');window.location = '';</script>";

	
	}else{
		$dupesql = mysql_query("SELECT * FROM pessoa WHERE (CPF = '$cpf')");
		
		$query = mysql_num_rows($dupesql);
				
		if ($query == 1){
		
			echo "<script>alert('Usuario ja Existente!');;window.location = 'http://10.5.50.1/login';</script>";
			exit;
		 
			
			
		}	else{
				mysql_query("insert into radius.pessoa (cpf, nome, datanasc, email, celular ) values('$cpf', '$nome', '$data_nasc', '$email', '$celular')");
				//mysql_query("insert into pessoa (cpf, nome, datanasc, email, celular ) values('$cpf', '$nome', '$data_nasc', '$email', '$celular')");
				//Cadastra Usuario
				mysql_query("insert into radcheck (username, attribute, op, value ) values('$cpf2','$attribute','$op','$senha_Crip')");
				// Libera ou bloqueia usuarios
				//mysql_query("insert into radcheck (username, attribute, op, value ) values('$cpf2','$attribute2','$op','$value')");
				//Velocidade de navegação
				mysql_query("insert into radreply (username, attribute, op, value ) values('$cpf2','$attribute1','$op','$banda')");
		  		echo "<script>alert('Usuario Cadastrado com Sucesso!');</script>";
				echo "<meta http-equiv='refresh'>";
				//echo "<meta http-equiv='refresh' content=1;url='http://www.casaruibarbosa.gov.br'>";
				echo "<meta http-equiv='refresh' content=1;url=''>";
							
				}
		}
	
	//}
?>