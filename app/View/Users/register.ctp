<!-- app/View/Users/add.ctp -->
<div class="users-form register">
	<?php echo $this->Form->create('User');?>
		<fieldset>
			<legend><?php echo __('Register'); ?></legend>
			<?php 
				echo $this->Form->input('name');
				echo $this->Form->input('email');
				echo $this->Form->input('password');
				echo $this->Form->input('password_confirm', array('label' => 'Confirm Password *', 'maxLength' => 255, 'title' => 'Confirm password', 'type'=>'password'));
				// echo $this->Form->input('role', array(
				// 	'options' => array( 'king' => 'King', 'queen' => 'Queen', 'rook' => 'Rook', 'bishop' => 'Bishop', 'knight' => 'Knight', 'pawn' => 'Pawn')
				// ));
				echo $this->Form->submit('Register', array('class' => 'form-submit',  'title' => 'Click here to add the user') );
			?>
		</fieldset>
	<?php echo $this->Form->end(); ?>
</div>


