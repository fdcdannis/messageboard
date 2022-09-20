
<div id="" class="container-messagelist">
	<!-- New Message Button -->
	
	<?php echo $this->Form->create('Message');?>
		<div class="reply-message">
			<textarea id="replyMessage" type="text" value="" placeholder="Reply a message"></textarea>
		</div>
		<div class="reply-message-btn">
			<button id="replyBtn" type="button" value="<?php echo $id ?>/<?php echo $to_user_id ?>/<?php echo $from_user_id ?>">Reply</button>
		</div>
	<?php echo $this->Form->end(); ?>

	<div id="result-reply" class="">
		<?php foreach($messages as $message): ?>
		<div class="delete-btn">
			<div class="">
				<p class=""><?php echo $message['0']['firstname'] ?> <?php echo $message['0']['lastname'] ?></p>
			</div>

			<?php if($message['0']['message_from_user_id'] == AuthComponent::user('id')) { ?>

				<button type="hidden" style="display: none" value="<?php echo $message['0']['id'] ?>">Delete</button>

			<?php } ?>

		</div>
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
		<?php endforeach; ?>
		<?php unset($messages); ?>
	</div>

	<div class="load-more-btn">
		<button id="" class="" type="button" value="2">Show More</button>
	</div>
</div>

<script type="text/javascript">
	// Reply Messages Ajax
	$(document).ready(function() {
		$(document).on('click','#replyBtn',function(){

			var message = $('#replyMessage').val();
			console.log(message);

			var sendMessageURL = '<?php echo Router::url( array("controller" => "messages", "action" => "replymessages_socket" )); ?>/' + $(this).val() + "/" + message;
			
			// console.log($(this).val());
			$.ajax({
				url: "<?php echo Router::url( array("controller" => "messages", "action" => "replymessages" )); ?>/" + $(this).val() + "/" + message,
				type: 'post',
				data: { name: "John" }
			}).done( function(data) {
				// console.log(data);
				$('#replyMessage').val('');
				$(this).attr('value', 2);	
				$( "#result-reply" ).html( data );

				socket.emit('message', sendMessageURL);
			});
		});
	});

	// Load More Messages Ajax
	$(document).ready(function() {
		$(document).on('click','.load-more-btn > button',function(){

			var reply_id = $('#replyBtn').val();
			var loadmore_limit = 2 + Number($(this).val());

			$(this).attr('value', loadmore_limit); //versions older than 1.6
			console.log(loadmore_limit);

			$.ajax({				
				url: "<?php echo Router::url( array("controller" => "messages", "action" => "loadmorereply" )); ?>/" + reply_id + "/" + loadmore_limit,
				type: 'post',
				data: { name: "John" }
			}).done( function(data) {
				// console.log(data);
				$( "#result-reply" ).html( data );
			});
		});
	});
</script>
