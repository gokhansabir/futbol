<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>public/css/style.css">
</head>
<body>
	<div class="header">
		<div class="wrapper">
			<ul class="nav">
				<li class="logo"><a href="<?php echo BASE_URL; ?>index.php">Futbol Simulasyonu</a></li>
				<li class="home <?php if ($section == "home") { echo "on"; } ?>"><a href="<?php echo BASE_URL; ?>index.php">Ana sayfa</a></li>
			</ul>
		</div>
	</div>