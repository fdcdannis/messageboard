
<div class="container-messagelist">
	<!-- New Message Button -->
	<div class="new-message">
		<?php
			echo $this->Html->link(
					$this->Html->tag('div', "New Message", array('class' => '')),
					array('controller' => 'messages', 'action' => 'newmessage'),
					array('escape' => false)
			);
		?>
	</div>

	<?php foreach($messages as $message): ?>
	<a href="/messageboard/messages/reply/<?php echo $message['Message']['id'] ?>">
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
	</a>
	<?php endforeach; ?>
	<?php unset($message); ?>
</div>
