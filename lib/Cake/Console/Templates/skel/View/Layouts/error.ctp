<?php
/**
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = __d('MB', 'Message Board');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header" class="menu">
			<div class="login">
				<?php
					if($this->Session->check('Auth.User')){
						echo $this->Html->tag('span', AuthComponent::user('username'), array('class' => 'user-name'));
						echo $this->Html->link( "Logout",   array('action'=>'logout') );
					}else{
						echo $this->Html->link( "Register",  array('action'=>'add') );
						echo $this->Html->link( "Login",   array('action'=>'login') );
					}
				?>
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
