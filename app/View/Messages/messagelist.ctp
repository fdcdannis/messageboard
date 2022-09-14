
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
		<p class="">Search Message:</p>
		<input type="" class="" id="message-search"></input>
	</div>
		
	<div id="result" class="">
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

	<div class="load-more-btn">
		<button id="" class="" type="button" value="2">Show More</button>
	</div>
</div>

<script type="text/javascript">

	// Delete Messages AJAX
	$(document).ready(function() {
		$(document).on('click','.delete-btn > button',function(){
			var result = confirm('Are you sure you want to delete this?');
			if(result) {
				$.ajax({
					url: "<?php echo Router::url( array("controller" => "messages", "action" => "deletemessage" )); ?>/" + $(this).val(),
					type: 'post',
					data: { name: "John" }
				}).done( function(data) {
					console.log(data);
					$( "#result" ).html( data );
				});
			}
		});
	});

	// Search Messages Ajax
	$(document).ready(function() {
		$('#message-search').keyup(function () {
			console.log($(this).val())
			$.ajax({
				url: "<?php echo Router::url( array("controller" => "messages", "action" => "search" )); ?>/" + $(this).val(),
				type: 'post',
				data: { name: "John" }
			}).success( function(data) {
				// console.log(data);
				$( "#result" ).html( data );
			});
		});
	});

	// Load More Messages Ajax
	$(document).ready(function() {
		$(document).on('click','.load-more-btn > button',function(){

			var loadmore_limit = 2 + Number($(this).val());

			$(this).attr('value', loadmore_limit); //versions older than 1.6

			console.log(loadmore_limit);

			// console.log("<?php echo Router::url( array("controller" => "messages", "action" => "loadmore" )); ?>/" + loadmore_limit);

			$.ajax({				
				url: "<?php echo Router::url( array("controller" => "messages", "action" => "loadmore" )); ?>/" + loadmore_limit,
				type: 'post',
				data: { name: "John" }
			}).done( function(data) {
				// console.log(data);
				$( "#result" ).html( data );
			});
		});
	});

</script>
