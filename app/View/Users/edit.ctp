<div class="users-form edit-profile">
<?php echo $this->Form->create('User',['type' => 'file']); ?>

	<!-- hidden userID -->
	<?php echo $this->Form->hidden('id', array('value' => $this->data['User']['id'])); ?>
	<!-- Picture and Details -->
	<div class="pic-details">
		<!-- Picture -->
		<div class="picture">
			<!-- <?php echo $this->Form->file('profile_pic',['type'=>'file']) ?> -->
			<?php echo $this->Html->image($this->data['User']['profile_pic'], array('height' => '250', 'width' => '250', 'fullBase' => true, 'plugin' => false)); ?>
		</div>

		<!-- Details -->
		<div class="details">
			<div class="user-info">
				<span class="upload-photo">
					<?php echo $this->Form->input('Upload',['type'=>'file']);?>
				</span>
				<?php
					// echo $this->Form->input('email');
					echo $this->Form->input('firstname');
					echo $this->Form->input('lastname');
					echo $this->Form->input('gender');
					echo $this->Form->input('birthday');
				?>
			</div>
		</div>
	</div>
	<!-- Hobby -->
	<div class="hubby">
		<?php echo $this->Html->tag('p', 'Hobby:', array('class' => 'user-hobby')); ?>
		<?php
			echo $this->Form->textarea('hobby');
		?>
	</div>

	<!-- Edit Profile Button -->
	<div class="submit-profile">
		<?php
			echo $this->Form->submit('Update', array('class' => 'form-submit',  'title' => 'Click here to add the user') );
		?>
	</div>
</div>
<?php echo $this->Form->end(); ?>
