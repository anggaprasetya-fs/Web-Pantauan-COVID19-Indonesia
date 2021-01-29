<?php

$indo = file_get_contents("https://api.kawalcorona.com/indonesia");
$json = json_decode($indo);
foreach ($json as $indo) {
	$nama = $indo->name;
	$positif = $indo->positif;
	$sembuh = $indo->sembuh;
	$meninggal = $indo->meninggal;
	$dirawat = $indo->dirawat;
}

$perkota = file_get_contents("https://api.kawalcorona.com/indonesia/provinsi");
$json2 = json_decode($perkota);

function visitor(){
	$ip = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ip = getenv('HTTP_CLIENT_IP');
	else if (getenv('HTTP_X_FORWARDED_FOR'))
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	else if (getenv('HTTP_X_FORWARDED'))
		$ip = getenv('HTTP_X_FORWARDED');
	else if (getenv('HTTP_FORWARDED_FOR'))
		$ip = getenv('HTTP_FORWARDED_FOR');
	else if (getenv('HTTP_FORWARDED'))
		$ip = getenv('HTTP_FORWARDED');
	else if (getenv('REMOTE_ADDR'))
		$ip = getenv('REMOTE_ADDR');
	else
		$ip = 'Ip visitor tidak ditemukan';
	return $ip;
}

$file = fopen('logs.txt', 'w');
fwrite($file, "\n IP : ".visitor()." User Agent : ".$_SERVER['HTTP_USER_AGENT']."\n");
fclose($file);

?>

<!DOCTYPE html>
<html>
<head>
	<title>COVID19 - BCA</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/8822a7672b.js" crossorigin="anonymous"></script>

	<!-- FONT -->
	<link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow&display=swap" rel="stylesheet">

	<!-- DATA TABLE -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/r-2.2.5/sp-1.1.1/datatables.min.css"/>
 	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/r-2.2.5/sp-1.1.1/datatables.min.js"></script>


	<style type="text/css">
		#all-font{
			font-family: 'Balsamiq Sans', cursive;
		}
		#font-main{
			font-family: 'PT Sans Narrow', sans-serif;
		}
	</style>
</head>
<body>
<div class="all-font">
	<br><br>
		<div class="row">
			<div class="col text-center">
			<pre style="font-size: 25px; font-family: 'Balsamiq Sans', cursive;"><b><i class="fas fa-bug"></i> LIVE DATA COVID19</pre>
			</div>
			<div class="col text-center">
			<pre style="font-size: 15px; color: red; font-family: 'Balsamiq Sans', cursive;"><i class="fas fa-calendar-day"></i> <?php echo date("l,  d - m - Y")?></b></pre>
			</div>
		</div><br><br>
		<div class="container">
		<div class="jumbotron">
			<div class="container"><br>
				<center><pre style="font-size: 20px; font-family: 'Balsamiq Sans', cursive;">- INDONESIA STAT -</pre></center>
				<div class="row text-center" style="font-family: 'PT Sans Narrow', sans-serif; size: 250px;">
					<div class="col">POSITIF</div>
					<br>
					<div class="col">SEMBUH</div>
					<br>
					<div class="col">MENINGGAL</div>
					<br>
					<div class="col">DIRAWAT</div>
				</div>
				<br>
				<div class="row text-center" style="font-family: 'PT Sans Narrow', sans-serif; size: 20px;">
					<div class="col"><?php echo $positif;?></div>
					<br>
					<div class="col"><?php echo $sembuh;?></div>
					<br>
					<div class="col"><?php echo $meninggal;?></div>
					<br>
					<div class="col"><?php echo $dirawat;?></div>
				</div>
			</div>
		</div>
		</div>
	<br><br>
	<div class="container">
		<div class="card">
			<div class="card-body table-responsive">
				<table class="table table-bordered table-striped table-sm" id="table-kota">
					<thead>
						<div class="text-center" style="font-size: 20px; font-family: 'Balsamiq Sans', cursive;">- LIST PROVINSI -</div>
						<tr>
							<th width="60px" class="text-center">#FID</th>
							<th width="200px" class="text-center">Provinsi</th>
							<th width="200px" class="text-center">Kasus Positif</th>
							<th width="200px" class="text-center">Kasus Meninggal</th>
							<th width="200px" class="text-center">Kasus Sembuh</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($json2 as $f): ?>
						<tr class="text-center">
							<td><?= htmlspecialchars($f->attributes->FID)?></td>
							<td><?= htmlspecialchars($f->attributes->Provinsi)?></td>
							<td><?= htmlspecialchars($f->attributes->Kasus_Posi)?></td>
							<td><?= htmlspecialchars($f->attributes->Kasus_Meni)?></td>
							<td><?= htmlspecialchars($f->attributes->Kasus_Semb)?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div><br><br>
	<footer class="page-footer font-small bg-light">
		<div class="footer-copyright text-center py-3">© <?= date('Y')?> Copyright<a href="https://blitarcyberarmy.org"> Blitar Cyber Army</a></div>
	</footer>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#table-kota').DataTable({
			"searching": true,
			"ordering" : true,
			"info" : true,
			"autoWidth" : true,
		})
	})
</script>

</body>
</html>
















