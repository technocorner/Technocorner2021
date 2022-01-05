<!DOCTYPE html>
<html>

<head>
	<title>Registrasi</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('/frontend/login/css/style.css'); ?>">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div class="container">
		<div class="logo header">
			<img src="<?= base_url('/assets/images/LOGO.png'); ?>">
			<p>Technocorner</p>
		</div>
		<div class="login-content">
			<form action="<?php base_url('/auth/register'); ?>" method="POST">
				<h2 class="title">Registrasi</h2>
				<div class="form-item">
					<div class="input-div one">
						<div class="i">
							<i class="fas fa-user"></i>
						</div>
						<div class="div">
							<h5>Nama Lengkap</h5>
							<input type="text" class="input" name="name" autocomplete="off" value="<?= old('name'); ?>">
						</div>
					</div>
					<div class="validation">
						<?= $validation->getError('name'); ?>
					</div>
				</div>
				<div class="form-item">
					<div class="input-div one">
						<div class="i">
							<i class="fas fa-user"></i>
						</div>
						<div class="div">
							<h5>Alamat Email</h5>
							<input type="text" class="input" name="email" autocomplete="off" value="<?= old('email'); ?>">
						</div>
					</div>
					<div class="validation">
						<?= $validation->getError('email'); ?>
					</div>
				</div>
				<div class="form-item">
					<div class="input-div pass">
						<div class="i">
							<i class="fas fa-lock"></i>
						</div>
						<div class="div">
							<h5>Kata Sandi</h5>
							<input type="password" class="input" name="password" autocomplete="off">
						</div>
					</div>
					<div class="validation">
						<?= $validation->getError('password'); ?>
					</div>
				</div>
				<input type="submit" class="btn">
				<span>Sudah terdaftar?</span> <a href="<?= base_url('/auth'); ?>" class="forgot">Login disini</a>

			</form>

		</div>
	</div>
	<script type="text/javascript" src="<?= base_url('/assets/js/mainlogin.js'); ?>"></script>

</body>

</html>