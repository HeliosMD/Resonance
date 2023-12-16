<body text="#666666" link="#777777" vlink="#777777"><font face="arial"><small><small>
<?php

//include "body.html";

$height = $_GET['height'];
$width = $_GET['width'];
$length = $_GET['length'];

echo "Altura: ".$height."cm<br/>";
echo "Anchura: ".$width."cm<br/>";
echo "Longitud: ".$length."cm<br/>";

$height = 34000/$height;
$width = 34000/$width;
$length = 34000/$length;

echo "<br/>";

//$height = 1/$heigth;
//$width = 1/$width;
//$length = 1/$length;

echo "Altura: ".norm($height)."Hz<br/>";
echo "Anchura: ".norm($width)."Hz<br/>";
echo "Longitud: ".norm($length)."Hz<br/>";

echo "<br/>";

echo norm($height/2)."Hz : 3.00dB<br/>";
echo norm($width/2)."Hz : 3.00dB<br/>";
echo norm($length/2)."Hz : 3.00dB<br/>";

for($i=1; $i<16; $i++){
	echo norm($height*$i)."Hz : ".norm(6/$i)."dB<br/>";
	echo norm($width*$i)."Hz : ".norm(6/$i)."dB<br/>";
	echo norm($length*$i)."Hz : ".norm(6/$i)."dB<br/>";
}

function norm($inpt){
	$oupt = explode(".",$inpt);
	if($oupt[1]==""){$oupt[1]="00";}
	if(strlen($oupt[1])==1){$oupt[1]=$oupt[1]."0";}
	return $oupt[0].".".substr($oupt[1], 0, 2);
}

?>
