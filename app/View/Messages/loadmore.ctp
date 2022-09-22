
<div id="result" class="sssss">
	<?php foreach($messages as $message): ?>

		<div class="message-list-contain-<?php echo $message['0']['id'] ?>">
			<!-- Delete Button -->

			<div class="delete-btn">
				<div class="">
					<?php if($message['0']['message_from_user_id'] == AuthComponent::user('id')) { ?>
						<a href="/messageboard/userprofile/<?php echo AuthComponent::user('id') ?>">
							<p class=""><?php echo $message['0']['firstname'] ?> <?php echo $message['0']['lastname'] ?></p>
						</a>
					<?php } else { ?>
						<a href="/messageboard/userprofile/<?php echo $message['0']['message_from_user_id'] ?>">
							<p class=""><?php echo $message['0']['firstname'] ?> <?php echo $message['0']['lastname'] ?></p>
						</a>
					<?php } ?>
				</div>


				<?php if($message['0']['message_from_user_id'] == AuthComponent::user('id')) { ?>

					<button type="button" value="<?php echo $message['0']['id'] ?>">Delete</button>

				<?php } ?>

			</div>

			<a href="/messageboard/messages/reply/<?php echo $message['0']['id'] ?>/<?php echo $message['0']['message_to_userid'] ?>/<?php echo $message['0']['message_from_user_id'] ?>">
				<div class="message-list">
						<?php if($message['0']['message_from_user_id'] == AuthComponent::user('id')) { ?>
							<!-- Message Picture -->
							<div class="message-pic">
								<?php echo $this->Html->image($message['0']['profile_pic'], array('height' => '100', 'width' => '100', 'fullBase' => true, 'plugin' => false)); ?>
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
								<?php echo $this->Html->image($message['0']['profile_pic'], array('height' => '100', 'width' => '100', 'fullBase' => true, 'plugin' => false)); ?>
							</div>
						<?php } ?>
				</div>
			</a>
		</div>
	<?php endforeach; ?>
	<?php unset($message); ?>
</div>
