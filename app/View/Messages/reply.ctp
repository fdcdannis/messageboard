
<div class="container-messagelist">
	<!-- New Message Button -->

	<?php echo $this->Form->create('Message');?>
		<div class="reply-message">
			<?php echo $this->Form->textarea('message_details'); ?>
		</div>
		<div class="new-message">
			<?php
				echo $this->Form->button(_('Reply Message'), ['id' => 'replyBtn'])
			?>
		</div>
	<?php echo $this->Form->end(); ?>

	<?php foreach($messages as $message): ?>
	<div class="message-list">
			<!-- Message Picture -->
			<div class="message-pic">
				<?php echo $this->Html->image($message['User']['profile_pic'], array('height' => '200', 'width' => '200', 'fullBase' => true, 'plugin' => false)); ?>
			</div>

			<!-- Message Details -->
			<div class="message-details">
				<div class="message-user">
					<p class=""><span class=""><?php echo $message['Message']['message_details'] ?></p>
				</div>
				<div class="message-date">
					<p class=""><span class=""> <?php echo $message['Message']['message_created'] ?></p>
				</div>
			</div>
	</div>
	<?php endforeach; ?>
	<?php unset($messages); ?>
</div>

<!-- <script type="text/javascript">
	$function(){
		$('#replyBtn').click(function(){
			$.ajax({
				dataType: "html",
				type: "POST",
				evalScripts: true,
				url: '<?php echo Router::url(array('controller'=>'messages','action'=>'reply'));?>',
				data: ({type:'original'}),
				success: function (data, textStatus){

					console.log(data);
					// $("#div1").html(data);

				}
			});
		});
	}
</script> -->
