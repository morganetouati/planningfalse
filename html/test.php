<?php
function chiffre($n, $i){
	$result = $n-$i;
	return $result;
}
?>
<p><?php 
$var = chiffre(2,1);
echo $var;?></p>
