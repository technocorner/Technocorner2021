<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?= base_url('/frontend/login/css/style.css'); ?>">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
	<div class="container">
		<div class="logo">
			<img src="assets/images/LOGO.png">
			<p>Technocorner</p>
			<div class="flash">
				<?= session()->getFlashdata('message'); ?>
			</div>


		</div>
		<div class="login-content">
			<form action="<?= base_url('auth'); ?>" method="POST">
				<h2 class="title">Login</h2>
				<div class="form-item">
					<div class="input-div one">
						<div class="i">
							<i class="fas fa-user"></i>
						</div>
						<div class="div">
							<h5>Email</h5>
							<input type="text" class="input" name="email" autocomplete="off" value="<?= old('email'); ?>">
						</div>
					</div>
					<div class="validation">
						<?= $validation->getError('email') ?>
					</div>
				</div>

				<div class="form-item">
					<div class="input-div pass">
						<div class="i">
							<i class="fas fa-lock"></i>
						</div>
						<div class="div">
							<h5>Password</h5>
							<input type="password" class="input" name="password" autocomplete="off">
						</div>
					</div>
					<div class="validation">
						<?= $validation->getError('password') ?>
					</div>
				</div>

				<a href="<?= base_url('/auth/reset'); ?>" class="forgot">Lupa kata sandi</a>

				<input type="submit" class="btn" value="Login">
				<span>Belum terdaftar?</span> <a href="<?= base_url('/auth/register'); ?>" class="regist"> Daftar disini</a>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="assets/js/mainlogin.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>