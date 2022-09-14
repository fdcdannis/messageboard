<!-- app/View/Users/add.ctp -->
<div class="users-form">
	<?php echo $this->Form->create('User');?>
		<fieldset>
			<legend><?php echo __('Account Settings'); ?></legend>
			<?php
				echo $this->Form->input('email');
				echo $this->Form->input('confirm_email', array('label' => 'Confirm Email *', 'maxLength' => 255, 'title' => 'Confirm Email', 'type'=>'email'));
				echo $this->Form->input('password');
				echo $this->Form->input('password_confirm', array('label' => 'Confirm Password *', 'maxLength' => 255, 'title' => 'Confirm password', 'type'=>'password'));
				// echo $this->Form->input('role', array(
				// 	'options' => array( 'king' => 'King', 'queen' => 'Queen', 'rook' => 'Rook', 'bishop' => 'Bishop', 'knight' => 'Knight', 'pawn' => 'Pawn')
				// ));
				echo $this->Form->submit('Submit', array('class' => 'form-submit',  'title' => 'Submit') );
			?>
		</fieldset>
	<?php echo $this->Form->end(); ?>
</div>


