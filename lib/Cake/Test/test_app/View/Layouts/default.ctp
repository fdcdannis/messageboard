<?php

$this->loadHelper('Html');

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<div class="login">
				<?php
					if($this->Session->check('Auth.User')){
						echo $this->Html->tag('span', AuthComponent::user('username'), array('class' => 'user-name'));
						echo $this->Html->link( "Logout",   array('action'=>'logout') );
					}else{
						echo $this->Html->link( "Register",  array('action'=>'register') );
						echo $this->Html->link( "Login",   array('action'=>'login') );
					}
				?>
			</div>
		</div>
		<div id="content">

			<?php echo $this->fetch('content'); ?>

		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
