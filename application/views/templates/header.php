<!doctype html>
<html lang="en">
<head>
	<title>Área Adminstrativa</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?=base_url("application/assets/vendor/bootstrap/css/bootstrap.min.css") ?>">
	<link rel="stylesheet" href="<?=base_url("application/assets/vendor/font-awesome/css/font-awesome.min.css") ?>">
	<link rel="stylesheet" href="<?=base_url("application/assets/vendor/linearicons/style.css") ?>">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?=base_url("application/assets/css/main.css") ?>">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">


	
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right" >
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><?php echo $_SESSION['logado']; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a><i class="lnr lnr-user"></i> <span><?php echo $_SESSION['email']; ?></span></a></li>
								<li><a><?php echo form_open('logar/deslogar') ?><i class="lnr lnr-exit"></i> <span><input type="submit" style="background-color: white; border: none;"  value="Logout"/></span></form></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->