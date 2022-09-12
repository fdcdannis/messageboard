
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
		<a href="/messageboard/messages/reply/<?php echo $message['0']['id'] ?>/<?php echo $message['0']['message_to_userid'] ?>/<?php echo $message['0']['message_from_user_id'] ?>">
			<div class="message-list">

					<?php if($message['0']['message_from_user_id'] == AuthComponent::user('id')) { ?>
						<!-- Message Picture -->
						<div class="message-pic">
							<?php echo $this->Html->image($message['0']['profile_pic'], array('height' => '200', 'width' => '200', 'fullBase' => true, 'plugin' => false)); ?>
						</div>
					<?php } ?>

					<!-- Message Details -->
					<div class="message-details">
						<div class="message-user">
							<p class=""><span class=""><?php echo $message['0']['message_details'] ?></p>
						</div>
						<div class="message-date">
							<p class=""><span class=""> <?php echo $message['0']['message_created'] ?></p>
						</div>
					</div>

					<?php if($message['0']['message_from_user_id'] != AuthComponent::user('id')) { ?>
						<!-- Message Picture -->
						<div class="message-pic">
							<?php echo $this->Html->image($message['0']['profile_pic'], array('height' => '200', 'width' => '200', 'fullBase' => true, 'plugin' => false)); ?>
						</div>
					<?php } ?>
			</div>
		</a>
	<?php endforeach; ?>
	<?php unset($message); ?>
</div>
