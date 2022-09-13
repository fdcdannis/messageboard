
<div class="container-newmessage">
	<?php echo $this->Form->create('Message');?>
		<!-- Message Details -->
		<div class="new-message-details">

			<!-- Recipent -->
			<div class="recipient">
				<span class="">Recipient</span>
				<!-- <?php echo $this->Form->input('message_to_userid', array('type' => 'text')); ?> -->

				<?php 
					echo $this->Form->input('message_to_userid', array('type'=>'select', 'label'=>'Users', 'options'=>$result, 'default'=>'3'));
				?>
			</div>

			<!-- New-Message -->
			<div class="new-messages">
				<span class="">Subject</span>
				<?php echo $this->Form->textarea('message_details'); ?>
			</div>

			<!-- Send button -->
			<div class="submit send">
				<?php echo $this->Form->submit('Send', array('class' => 'form-submit',  'title' => 'Create New Message') ); ?>
			</div>
		</div>
	<?php echo $this->Form->end(); ?>
</div>
