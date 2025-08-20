<head><title>Resonance</title></head>
<body text="#777777" link="#777777" vlink="#777777"><font face="arial"><small><small>
<?php

//include "body.html";

$he = $_GET['he'];
$wi = $_GET['wi'];
$le = $_GET['le'];

if(!$he){$he=0;}
if(!$wi){$wi=0;}
if(!$le){$le=0;}

$hch = $_GET['hch'];
$wch = $_GET['wch'];
$lch = $_GET['lch'];

$dbch = $_GET['dbch'];
if(!$dbch){$dbch=0;}

$hwch = $_GET['hwch'];
$wlch = $_GET['wlch'];
$lhch = $_GET['lhch'];

if(!$hwch){$hwch=0;}
if(!$wlch){$wlch=0;}
if(!$lhch){$lhch=0;}

$ach = $_GET['ach'];
if(!$ach){$ach=0;}

//$cch = $_GET['cch'];

//if(!$cch){$cch=0;}
if(!$hch){$hch=0;}
if(!$lch){$lch=0;}
if(!$wch){$wch=0;}

$wc = $_GET['wc'];
$hc = $_GET['hc'];
$xc = $_GET['xc'];
$yc = $_GET['yc'];

if(!$wc){$wc=0;};
if(!$xc){$xc=0;};
if(!$yc){$yc=0;};
if(!$hc){$hc=0;};

function norm($inpt){
	$oupt = explode(".",$inpt);
	if ($oupt[1]==""){$oupt[1]="00";}
	return $oupt[0].".".substr($oupt[1], 1, 2);
}

?>

<script>
	var sw = screen.width - 15;
	var sh = screen.height - 300;
	var cx = sw / 2;
	var cy = sh / 2;
	var xx = cx;
	var xy = cy;
	var dx = sw/6;

	var wc = <?php echo $wc; ?>;
	var xc = <?php echo $xc; ?>;
	var yc = <?php echo $yc; ?>;
	var hc = <?php echo $hc; ?>;

	var he = <?php echo $he; ?>;
	var wi = <?php echo $wi; ?>;
	var le = <?php echo $le; ?>;
	var i = 0;

//	var cch = <?php echo $cch; ?>;

	var ach = <?php echo $ach; ?>;

	var hch = <?php echo $hch; ?>;
	var wch = <?php echo $wch; ?>;
	var lch = <?php echo $lch; ?>;

	var hwch = <?php echo $hwch; ?>;
	var wlch = <?php echo $wlch; ?>;
	var lhch = <?php echo $lhch; ?>;

	var dbch = <?php echo $dbch; ?>;
	if (!dbch){dbch=1;}

</script>
<div class="content">
<form id="resonance" action="index.php" method="get">

<input type="text" value="<?php echo $he; ?>" name="he" size="3">cm</input>
<input type="text" value="<?php echo $wi; ?>" name="wi" size="3">cm</input>
<input type="text" value="<?php echo $le; ?>" name="le" size="3">cm</input>

<input type="checkbox" value="1" name="hch" <?php if($hch){echo "checked";} ?>>Altura</input>
<input type="checkbox" value="1" name="wch" <?php if($wch){echo "checked";} ?>>Anchura</input>
<input type="checkbox" value="1" name="lch" <?php if($lch){echo "checked";} ?>>Longitud</input>

<input type="checkbox" value="1" name="hwch" <?php if($hwch){echo "checked";} ?>>Axial Altura/Anchura</input>
<input type="checkbox" value="1" name="wlch" <?php if($wlch){echo "checked";} ?>>Axial Anchura/Longitud</input>
<input type="checkbox" value="1" name="lhch" <?php if($lhch){echo "checked";} ?>>Axial Longitud/Altura</input>

<input type="checkbox" value="1" name="ach" <?php if($ach){echo "checked";} ?>>Axial</input>

<!--input type="checkbox" value="1" name="cch" <?php if($cch){echo "checked";} ?>>Cursor</input-->

<input type="text" value="<?php echo $wc; ?>" name="wc" size="3">Hz</input>

<!--input type="text" value="<?php echo $xc; ?>" name="xc" size="5">Hz</input-->

<input type="checkbox" value="2" name="dbch" <?php if($dbch){echo "checked";} ?>>12dB</input>

<input type="hidden" value="<?php echo $hc; ?>" name="hc"></input>
<input type="hidden" value="<?php echo $xc; ?>" name="xc"></input>
<input type="hidden" value="<?php echo $yc; ?>" name="yc"></input>

<input type="submit" value="Actualizar"></input>

<a href="freq.php?height=<?php echo $he;?>&width=<?php echo $wi;?>&length=<?php echo $le;?>" target="_blank">Frecuencias</a>
</form>
<div class="graphic">
<script type="application/processing">

void setup() {
	size(sw, sh);

	hw = (he*he)+(wi*wi);
	wl = (wi*wi)+(le*le);
	lh = (le*le)+(he*he);

	hw = sqrt(hw);
	wl = sqrt(wl);
	lh = sqrt(lh);

	ax = sqrt((hw*hw)+(wl*wl));

	hw = 34000/hw;
	wl = 34000/wl;
	lh = 34000/lh;

	he = 34000/he;
	wi = 34000/wi;
	le = 34000/le;

	ax = 34000/ax;

}

void draw() {
	int dy = 0;
	int y2 = 0;
	background(64);

	for (int w=0; w<sw; w=w+10){
		stroke(80);
		line(w,0,w,sh);
	}

	for (int w=0; w<sw; w=w+100){
		stroke(128);
		line(w,0,w,sh);
		text(w+"Hz", w+5, 15);
	}

	if (mousePressed && (mouseButton == LEFT)) {
		xc=mouseX;
		yc=mouseY;
		hc=sh-mouseY;
	}

	fill(192);
	stroke(192);
	rect(xc-wc/2,yc,wc,hc);
//	if (cch=1){rect(xc-wc/2,yc,wc,hc);}

	fill(255);
	stroke(255);
	line(xc,0,xc,sh);
	line(0,yc,sw,yc);

	/*
	fill(255,255,0);
	stroke(255,255,0);
	rect(he/2-wc/2,sh,wc,-1*sh/8*hch);

	fill(0,0,255);
	stroke(0,0,255);
	rect(wi/2-wc/2,sh,wc,-1*sh/8*wch);

	fill(255,0,0);
	stroke(255,0,0);
	rect(le/2-wc/2,sh,wc,-1*sh/8*lch);
	*/

	for(i=1; i<64; i++){

		fill(255,255,0);
		stroke(255,255,0);
		rect(he*i-wc/2,sh,wc,-1*sh/i/4*hch*dbch);

		fill(0,0,255);
		stroke(0,0,255);
		rect(wi*i-wc/2,sh,wc,-1*sh/i/4*wch*dbch);

		fill(255,0,0);
		stroke(255,0,0);
		rect(le*i-wc/2,sh,wc,-1*sh/i/4*lch*dbch);

		fill(0,128,0);
		stroke(0,128,0);
		rect(hw*i-wc/2,sh,wc,-1*sh/i/8*hwch*dbch);

		fill(128,0,128);
		stroke(128,0,128);
		rect(wl*i-wc/2,sh,wc,-1*sh/i/8*wlch*dbch);

		fill(255,128,0);
		stroke(255,128,0);
		rect(lh*i-wc/2,sh,wc,-1*sh/i/8*lhch*dbch);

		fill(128);
		stroke(128);
		rect(ax*i-wc/2,sh,wc,-1*sh/i/8*ach*dbch);
	
	}

	stroke(255);
	fill(255);

	stroke(192);
	line(0,cy,sw,cy);
	text(12/dbch+"dB", 5, cy-5);
	line(0,cy+cy/2,sw,cy+cy/2);
	text(6/dbch+"dB", 5, cy+cy/2-5);
        line(0,cy+cy/2+cy/4,sw,cy+cy/2+cy/4);
	text(3/dbch+"dB", 5, cy+cy/2+cy/4-5);
        line(0,cy+cy/2+cy/4+cy/8,sw,cy+cy/2+cy/4+cy/8);
	text(1.5/dbch+"dB", 5, cy+cy/2+cy/4+cy/8-5);
	line(0,cy+cy/2+cy/4+cy/8+cy/16,sw,cy+cy/2+cy/4+cy/8+cy/16);
	text(0.75/dbch+"dB", 5, cy+cy/2+cy/4+cy/8+cy/16-2);


	if (yc>30){text(xc+"Hz, "+((hc)/sh*24)/dbch+"dB", xc+5, yc-5);}
	if (yc<30){text(xc+"Hz, "+((hc)/sh*24)/dbch+"dB", xc+5, yc+30);}

}

</script>
<canvas style="image-rendering: -moz-crisp-edges ! important;" id="__processing0" tabindex="0" width=sw height=sh ></canvas>
<small><small><br/><br/></small></small>

<svg width="10" height="10"><rect width="10" height="10" style="fill:rgb(255,255,0);stroke-width:1;stroke:rgb(255,255,0)"/>
</svg> Altura
<svg width="10" height="10"><rect width="10" height="10" style="fill:rgb(0,0,255);stroke-width:1;stroke:rgb(0,0,255)" />
</svg> Anchura
<svg width="10" height="10"><rect width="10" height="10" style="fill:rgb(255,0,0);stroke-width:1;stroke:rgb(255,0,0)" />
</svg> Longitud

<svg width="10" height="10"><rect width="10" height="10" style="fill:rgb(0,128,0);stroke-width:1;stroke:rgb(0,128,0)"/>
</svg> Anchura/Altura
<svg width="10" height="10"><rect width="10" height="10" style="fill:rgb(128,0,128);stroke-width:1;stroke:rgb(128,0,128)" />
</svg> Anchura/Longitud
<svg width="10" height="10"><rect width="10" height="10" style="fill:rgb(255,128,0);stroke-width:1;stroke:rgb(255,128,0)" />
</svg> Longitud/Altura

<svg width="10" height="10"><rect width="10" height="10" style="fill:rgb(128,128,128);stroke-width:1;stroke:rgb(128,128,128)" />
</svg> Axial

<br/><br/>
<b>Resonance</b> <small>Web Application (Version 0.0.3-web)<br/>
By: Helios Martinez Dominguez. For: Estudio Siddhi.<br/></small>

</div>
</div>
<script src="processing.js" type="text/javascript"></script>
