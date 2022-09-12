
<div class="container-messagelist">
	<!-- Edit Profile Button -->
	<div class="new-message">
		<?php
			echo $this->Html->link(
					$this->Html->tag('div', "New Message", array('class' => '')),
					array('action'=>'edit', $user['User']['id']),
					array('escape' => false)
			);
		?>
	</div>
	
	<a href="#">
	<div class="message-list">

			<!-- Picture -->
			<div class="message-pic">
				<?php echo $this->Html->image($user['User']['profile_pic'], array('height' => '200', 'width' => '200', 'fullBase' => true, 'plugin' => false)); ?>
			</div>

			<!-- Details -->
			<div class="message-details">
				<div class="message-user">
					<p class=""><span class="">My hobby is playing cricket. To play cricket I finish my homework early. I play it with my brother and friends. We play on the street in front of my house. Since it is a dead road, there is no traffic. My liking to cricket is new and I love the game. I feel so good holding the bat.</p>
				</div>
				<div class="message-date">
					<p class=""><span class=""> 2014/08/13 04:30</p>
				</div>
			</div>
	</div>

	</a>
</div>
