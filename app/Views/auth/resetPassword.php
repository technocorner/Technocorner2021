<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/login.css'); ?>">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
	<div class="container">
		<div class="logo">
			<img src="<?= base_url('/assets/images/LOGO.png'); ?>">
			<p>Technocorner</p>
			<div class="flash">
				<?= session()->getFlashdata('message'); ?>
			</div>


		</div>
		<div class="login-content">
			<form action="<?= base_url('auth/resetPassword'); ?>" method="POST">
				<h2 class="title">Reset Password</h2>
                <input type="text" class="input" name="email" value="<?= $email ?>" hidden/>
                <input type="text" class="input" name="token" value="<?= $token ?>" hidden/>
				<div class="form-item">
					<div class="input-div pass">
						<div class="i">
							<i class="fas fa-lock"></i>
						</div>
						<div class="div">
							<h5>Password</h5>
							<input type="password" class="input" name="password">
						</div>
					</div>
					<div class="validation">
						<?= $validation->getError('password') ?>
					</div>
				</div>

				<div class="form-item">
					<div class="input-div pass">
						<div class="i">
							<i class="fas fa-lock"></i>
						</div>
						<div class="div">
							<h5>Confirm Password</h5>
							<input type="password" class="input" name="confirmPassword">
						</div>
					</div>
					<div class="validation">
						<?= $validation->getError('confirmPassword') ?>
					</div>
				</div>

				<input type="submit" class="btn" value="Submit">
				<a href="<?= base_url('/auth'); ?>" class="forgot">Kembali ke laman login</a>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="<?= base_url('/assets/js/mainlogin.js'); ?>"></script>
</body>

</html>