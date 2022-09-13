
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

	<div class="search-message">
		<input type="" class="" id=""></input>
		<button type="button" id="" class="">Search</button>
	</div>

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
		</div>
	<?php endforeach; ?>
	<?php unset($message); ?>
</div>

<script type="text/javascript">
	$(document).on('click','.delete-btn > button',function(){
		var id= $(this).val();

		var result = confirm('Are you sure you want to delete this?');
		// console.log(id);
		if(result) {
			$.ajax({
				type: "POST",
				url: '/messageboard/messages/messagelist/'+id, //generate cakephp url
				data: '{"id":"' + id+'"}',
				dataType: "json",
				success:function(resp){//reso is msg string returned from controller.
					alert(resp);
				}
			});
			$(".message-list-contain-"+id).remove();
		}
	});
</script>
