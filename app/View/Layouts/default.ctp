<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('MB', 'Message Board');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
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
		echo $this->Html->css('cake.modal');
		echo $this->Html->script('cake.modal');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>
<body>
	<div id="container">
		<div id="header" class="menu">
			<div class="logo">
				<?php echo $this->Html->link( "Message Board", array('controller' => 'messages', 'action'=>'messagelist') ); ?>
			</div>
			<div class="dashboard">
				<?php
					if($this->Session->check('Auth.User')){
						echo $this->Html->link( "Messagelist", array('controller' => 'messages', 'action'=>'messagelist') );
					}
				?>
			</div>
			<div class="login">
				<?php
					if($this->Session->check('Auth.User')){
						echo $this->Html->link( "My Account",   array('controller' => 'users', 'action'=>'myaccount') );
						echo $this->Html->link( AuthComponent::user('name'),   array('controller' => 'users', 'action'=>'myprofile') );
						echo $this->Html->link( "Logout",   array('controller' => 'users', 'action'=>'logout') );
					}else{
						echo $this->Html->link( "Register",  array('controller' => 'users', 'action'=>'register') );
						echo $this->Html->link( "Login",   array('controller' => 'users', 'action'=>'login'), array('class' => 'login-user') );
					}
				?>
			</div>
		</div>
		</div>
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<script src="http://localhost:3000/socket.io/socket.io.js"></script>
	<script>
		var socket = io.connect('http://localhost:3000');	

		socket.on('new-message', (msg) => {
			console.log(msg);
			$(document).ready(function() {
				$.ajax({
					url: msg,
					type: 'post',
					data: { name: "test" }
				}).done( function(data) {
					$('#replyMessage').val('');
					$(this).attr('value', 2);	
					$( "#result" ).html( data );
				});
			});
		});

		socket.on('receive-message', (msg) => {
			$(document).ready(function() {
				$.ajax({
					url: msg,
					type: 'post',
					data: { name: "test" }
				}).done( function(data) {
					$('#replyMessage').val('');
					$(this).attr('value', 2);	
					$( "#result-reply" ).html( data );
				});
			});
		});
	</script>
</body>
</html>
