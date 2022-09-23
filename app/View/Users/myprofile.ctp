<div class="users-form user-profile">
	<!-- Edit Profile Button -->
	<div class="edit-profile">
		<?php
			echo $this->Html->link(
				 $this->Html->tag('div', "Edit Profile", array('class' => '')),
				 array('action'=>'edit', $user['User']['id']),
				 array('escape' => false)
			);
		?>
	</div>

	<!-- Picture and Details -->
	<div class="pic-details">
		<!-- Picture -->
		<div class="picture">
			<?php echo $this->Html->image($user['User']['profile_pic'], array('height' => '250', 'width' => '250', 'fullBase' => true, 'plugin' => false)); ?>
		</div>

		<!-- Details -->
		<div class="details">
			<div class="full-name">
				<?php if($user['User']['lastname'] !== null) { ?>
					<?php echo $user['User']['lastname'].', '.$user['User']['firstname'].' '.$user['User']['age']; ?>
				<?php } else { ?>
					<p class="">Name: </p>
				<?php } ?>
			</div>

			<div class="user-info">
				<p class="">
					<?php if( $user['User']['gender'] == '0') { ?>
						<span class=""> Gender: </span> Male
					<?php } else { ?>
						<span class=""> Gender: </span> Female
					<?php } ?>
				</p>
				<p class=""><span class=""> Birthday: </span><?php echo $user['User']['birthday'] ?></p>
				<p class=""><span class=""> Joined: </span><?php echo $user['User']['created'] ?></p>
				<p class=""><span class=""> Last Login: </span><?php echo $user['User']['last_login'] ?></p>
			</div>
		</div>
	</div>
	<!-- Hobby -->
	<div class="hubby">
		<?php echo $this->Html->tag('p', 'Hobby:', array('class' => 'user-hobby')); ?>
		<?php echo $this->Html->tag('p', $user['User']['hobby'], array('class' => 'user-hobby')); ?>
	</div>
</div>
