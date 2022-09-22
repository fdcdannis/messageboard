<div id="result-reply" class="testest">
	<!-- New Message Button -->
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
                        <?php echo $this->Html->image($message['0']['profile_pic'], array('height' => '100', 'width' => '100', 'fullBase' => true, 'plugin' => false)); ?>
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
                        <?php echo $this->Html->image($message['0']['profile_pic'], array('height' => '100', 'width' => '100', 'fullBase' => true, 'plugin' => false)); ?>
                    </div>
                <?php } ?>
        </div>
	<?php endforeach; ?>
	<?php unset($messages); ?>
</div>