<div class="users-form user-profile">

	<!-- Picture and Details -->
	<div class="pic-details">
		<!-- Picture -->
		<div class="picture">
			<?php echo $this->Html->image($user['User']['profile_pic'], array('height' => '250', 'width' => '250', 'fullBase' => true, 'plugin' => false)); ?>
		</div>

		<!-- Details -->
		<div class="details">
			<div class="full-name">
				<?php echo $user['User']['lastname'].', '.$user['User']['firstname'].' '.$user['User']['age']; ?>
			</div>
			<div class="user-info">
				<p class=""><span class=""> Gender: </span><?php echo $user['User']['gender'] ?></p>
				<p class=""><span class=""> Birthday: </span><?php echo $user['User']['birthday'] ?></p>
				<p class=""><span class=""> Joined: </span><?php echo $user['User']['created'] ?></p>
				<p class=""><span class=""> Last Login: </span><?php echo $user['User']['modified'] ?></p>
			</div>
		</div>
	</div>
	<!-- Hobby -->
	<div class="hubby">
		<?php echo $this->Html->tag('p', 'Hobby:', array('class' => 'user-hobby')); ?>
		<?php echo $this->Html->tag('p', $user['User']['hobby'], array('class' => 'user-hobby')); ?>
	</div>
</div>
