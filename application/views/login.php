<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?=base_url("application/assets/css/bootstrap.min.css") ?>">
	<link rel="stylesheet" href="<?=base_url("application/assets/vendor/font-awesome/css/font-awesome.min.css") ?>">
	<link rel="stylesheet" href="<?=base_url("application/assets/vendor/linearicons/style.css") ?>">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?=base_url("application/assets/css/main.css") ?>">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?=base_url("application/assets/css/demo.css") ?>">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<p class="lead">Login to your account</p>
								<p class="lead"><?php echo validation_errors(); 
								if(isset($permissao)){ 
									echo $permissao;
								} ?></p>
							</div>
							<?php echo form_open('logar/login', array('method'=>'post')); ?>
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">Email</label>
									<input type="email" class="form-control" id="signin-email" name="email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Senha</label>
									<input type="password" class="form-control" id="signin-password" name="senha" placeholder="Senha">
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
								<div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Free Bootstrap dashboard template</h1>
							<p>by The Develovers</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
