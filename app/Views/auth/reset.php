<!DOCTYPE html>
<html>

<head>
	<title>Reset Password</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/login.css'); ?>">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<div class="container">
		<div class="logo">
			<img src="<?= base_url('/assets/images/LOGO.png'); ?>">
			<p>Technocorner</p>
		</div>
		<div class="login-content">
			<form action="<?php base_url('/auth/reset'); ?>" method="POST">
				<h2 class="title">RESET PASSWORD</h2>
				<p>Masukkan email untuk mendapatkan tautan perubahan kata sandi.</p>
				<div class="form-item">
					<div class="input-div one">
						<div class="i">
							<i class="fas fa-user"></i>
						</div>
						<div class="div">
							<h5>Email</h5>
							<input type="email" class="input" name="email" autocomplete="off">
						</div>
					</div>
					<div class="validation">
						<?= $validation->getError('email'); ?>
					</div>
				</div>
				<input type="submit" class="btn" value="Kirim">
				<a href="<?= base_url('/auth'); ?>" class="forgot">Kembali ke laman login</a>
			</form>

		</div>
	</div>
	<script type="text/javascript" src="<?= base_url('/assets/js/mainlogin.js'); ?>"></script>
</body>

</html>