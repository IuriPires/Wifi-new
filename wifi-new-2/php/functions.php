<?php //validar CPF
function validar_cpf($cpf)
{
	$cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
	
	// recusar seguencial
	$invalidos = array('00000000000','11111111111','22222222222','33333333333','44444444444','55555555555','66666666666','77777777777','88888888888','99999999999');
		if (in_array($cpf, $invalidos))
			return false;	


	// Valida tamanho
	
	if (strlen($cpf) != 11)
		return false;
	
	// Calcula e confere primeiro dígito verificador
	for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
		$soma += $cpf{$i} * $j;
	$resto = $soma % 11;
	
	if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
		return false;
	
	// Calcula e confere segundo dígito verificador
	for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
		$soma += $cpf{$i} * $j;
	$resto = $soma % 11;
	
	return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
}
?>



<?php

function valida_email($email){
    $er = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
    if (preg_match($er, $email)){
	return true;
    } else {
	return false;
    }
}

?>


<?php

function validar_email($email) {

$email = filter_var($email, FILTER_SANITIZE_EMAIL);

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return true;
} else {
    return false;
}
}
?>

<?php
function comboEstados($marcado = false){
	$montarArray = array("AC", "AL", "AM", "AP",  "BA", "CE", "DF", "ES", "GO", "MA", "MG", "MS", "MT", "PA", "PB", "PE", "PI", "PR", "RJ", "RN", "RO", "RR", "RS", "SC", "SE", "SP", "TO");

	if ($marcado == ""){
		foreach ($montarArray as $i){
			$resultArray .= "<option value=\"{$i}\">{$i}</option>";
		}
		return $resultArray;
	}
	else {
		foreach ($montarArray as $i){
			if ($marcado == $i){
				$resultArray .= "<option value=\"{$i}\" selected=\"selected\">{$i}</option>";
			}
			else {
				$resultArray .= "<option value=\"{$i}\">{$i}</option>";
			}
		}
		return $resultArray;
	}
}
?>
