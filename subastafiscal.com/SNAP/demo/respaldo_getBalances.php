$doc_code = null;
$doc_tipo = null;
//var_dump($_SESSION['g_usuario']);
$nro_iden = $_SESSION['g_usuario']['nro_identificacion'];
if(!isset($_SESSION['Doc_Codigo'])) $doc_code = $_SESSION['Doc_Codigo'];
if(!isset($_SESSION['Doc_Tipo'])) $doc_tipo = $_SESSION['Doc_Tipo'];

if($doc_tipo)
{
  $personal = $doc_tipo == 1? getBalancePersonal($doc_code, $nro_iden, 1) : getBalancePersonal(null, $nro_iden, 1);
  $conyugal = $doc_tipo == 2? getBalanceConyugal($doc_code, $nro_iden, 1) : getBalanceConyugal(null, $nro_iden, 1);
  $certific = $doc_tipo == 3? getBalanceCertific($doc_code, $nro_iden, 1) : getBalanceCertific(null, $nro_iden, 1);
}else{

  $personal = getBalancePersonal(null, $nro_iden, 1);
  $conyugal = getBalanceConyugal(null, $nro_iden, 1);
  $certific = getBalanceCertific(null, $nro_iden, 1);
}

$bal1 = true;
$bal2 = true;
$bal3 = true;

if(!isset($personal['Per_CI'])) $bal1 = false;
if(!isset($conyugal['Cony1_CI'])) $bal2 = false;
if(!isset($certific['Per_CI'])) $bal3 = false;