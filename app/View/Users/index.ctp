

<div class="users-form user-profile">

	<!-- Picture and Details -->
	<div class="pic-details">
		<!-- Picture -->
		<div class="picture">
			<?php echo $this->Html->image(AuthComponent::user('profile_pic'), array('height' => '250', 'width' => '250', 'fullBase' => true, 'plugin' => false)); ?>
		</div>

		<!-- Details -->
		<div class="details">
			<div class="full-name">
				<?php echo $this->Html->tag('span', AuthComponent::user('firstname'), array('class' => 'user-firstname')); ?>,
				<?php echo $this->Html->tag('span', AuthComponent::user('lastname'), array('class' => 'user-lastname')); ?>
				<?php echo $this->Html->tag('span', AuthComponent::user('age'), array('class' => 'user-age')); ?>
			</div>
			<div class="">
				<?php echo $this->Html->tag('p', 'Gender: '. AuthComponent::user('gender'), array('class' => 'user-age')); ?>
				<?php echo $this->Html->tag('p', 'Birthday:'. AuthComponent::user('birthday'), array('class' => 'user-age')); ?>

				<?php echo $this->Html->tag('p', 'Joined:'. AuthComponent::user('created'), array('class' => 'user-age')); ?>
				<?php echo $this->Html->tag('p', 'Last Login:'. AuthComponent::user('modified'), array('class' => 'user-age')); ?>
			</div>
		</div>
	</div>
	<!-- Hobby -->
	<div class="hubby">
		<?php echo $this->Html->tag('p', 'Hobby:', array('class' => 'user-hobby')); ?>
		<?php echo $this->Html->tag('p', AuthComponent::user('hobby'), array('class' => 'user-hobby')); ?>
	</div>
</div>
