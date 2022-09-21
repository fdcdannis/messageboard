
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
			

			<div class="reply-message-btn">
				<button id="replyBtn" type="button" value="">Reply</button>
			</div>
		</div>
	<?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
	// Reply Messages Ajax
	$(document).ready(function() {

		$(document).on('click','#replyBtn',function(){

		// 	// var message = $('#replyMessage').val();

		// 	// var sendMessageURL = '<?php echo Router::url( array("controller" => "messages", "action" => "replymessages_socket" )); ?>/' + $(this).val() + "/" + message;
		    var test = '<?php echo Router::url( array("controller" => "messages", "action" => "messagelist" )); ?>/';
		console.log(test);
			$.ajax({
				url: test,
				type: 'post',
				data: { name: "test" }
			}).done( function(data) {
				// $('#replyMessage').val('');
				// $(this).attr('value', 2);	
				// $( "#result-reply" ).html( data );

				// socket.emit('message', $('#replyBtn').val(), sendMessageURL);
			});
		});
	});
</script>
