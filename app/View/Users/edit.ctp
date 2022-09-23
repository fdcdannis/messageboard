<div class="users-form edit-profile">

	<?php echo $this->Form->create('User',['type' => 'file']); ?>
		<!-- TEST -->
		<!-- hidden userID -->
		<?php echo $this->Form->hidden('id', array('value' => $this->data['User']['id'])); ?>
		<!-- Picture and Details -->
		<div class="pic-details">
			<!-- Picture -->
			<div class="picture">
				<?php echo $this->Html->image($this->data['User']['profile_pic'], array('class' => 'profile-pic', 'height' => '250', 'width' => '250', 'fullBase' => true, 'plugin' => false)); ?>
			</div>

			<!-- Details -->
			<div class="edit-user-info">
				<div class="upload-photo">
					<?php echo $this->Form->input('Upload',['type'=>'file', 'class' => 'file-upload']);?>
				</div>
				<div class="first-name">
					<?php echo $this->Form->input('firstname'); ?>
				</div>
				<div class="last-name">
					<?php echo $this->Form->input('lastname'); ?>
				</div>
				<div class="gender">
					<?php echo $this->Form->input('gender', array( 
						'options' => array('Male', 'Female'),
						'type' => 'radio'
					)); ?>
				</div>
				<div class="birthday">
					<?php echo $this->Form->input('birthday', array('type' => 'text', 'id' => 'datepicker', 'value' => $birthday, readonly )); ?>
					<img src="/messageboard/app/webroot/calendar.png" class="pick-date">
				</div>

				<!-- <div class="birthday">
					<div class="input text"><label for="datepicker">Birthday</label><input name="data[User][birthday]" id="datepicker" type="text" value="2022-09-14" class="hasDatepicker"></div>				
				</div>			 -->
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
	<?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var readURL = function(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('.profile-pic').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$(".file-upload").on('change', function(){
			readURL(this);
		});
	});


	$(document).ready(function() {
		$( "#datepicker" ).datepicker();
	});

</script>
