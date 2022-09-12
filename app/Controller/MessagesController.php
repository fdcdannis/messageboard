<?php

class MessagesController extends AppController {

	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('User.name' => 'asc' )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','register', 'thankyou');
    }

    public function messagelist() {

        $user_id = AuthComponent::user('id');

		// pr($user_id);

		// $messages = $this->Message->query("
		// 		SELECT  *
		// 		FROM    Messages AS Message
		// 		JOIN    Users AS User
		// 		ON Message.message_from_user_id = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
		// 		UNION
		// 		SELECT  *
		// 		FROM    Messages AS Message
		// 		JOIN    Users AS User
		// 		ON Message.message_to_userid = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
		// ");

		$messages = $this->Message->query("
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_from_user_id = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				UNION
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_to_userid = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
		");

        // pr($messages);
		$this->set(compact('messages'));
    }


    public function reply($id = null, $to_user_id = null, $from_user_id = null) {

		$user_id = AuthComponent::user('id');

		// pr($id);
		// pr($to_user_id);
		// pr($from_user_id);

		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}

		$messages = $this->Message->query("
				SELECT  *
				FROM    Messages AS Message
				JOIN    Users AS User
				ON Message.message_from_user_id = $user_id AND User.id = Message.message_from_user_id AND (Message.id = $id OR Message.reply_id = $id)
				UNION
				SELECT  *
				FROM    Messages AS Message
				JOIN    Users AS User
				ON Message.message_to_userid = $user_id AND User.id = Message.message_from_user_id AND (Message.id = $id OR Message.reply_id = $id)
		");

        // pr($messages);

		if ($this->request->is('post')) {
			$this->Message->create();

			$this->request->data['Message']['reply_flag'] = 1;
			$this->request->data['Message']['reply_id'] = $id;
			$this->request->data['Message']['message_id'] = $id;

			$this->request->data['Message']['message_from_user_id'] = $user_id;

			if($to_user_id == $user_id){
				$this->request->data['Message']['message_to_userid'] = $from_user_id;
			} else {
				$this->request->data['Message']['message_to_userid'] = $to_user_id;
			}

			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been created'));
			} else {
				$this->Session->setFlash(__('The user could not be created. Please, try again.'));
			}
        }

		$this->set(compact('messages'));
    }

	public function newmessage() {
		$user_id = $this->Auth->user('id');;
		if ($this->request->is('post')) {
			$this->Message->create();

			// $this->request->data['Message']['message_id'] = $user_id;
			$this->request->data['Message']['message_from_user_id'] = $user_id;

			pr($this->request->data);

			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been created'));
			} else {
				$this->Session->setFlash(__('The user could not be created. Please, try again.'));
			}
        }
    }

    public function edit($id = null) {
		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}

		$user = $this->User->findById($id);
		if (!$user) {
			$this->Session->setFlash('Invalid User ID Provided');
			$this->redirect(array('action'=>'index'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$frmData = $this->request->data['User'];
			$tmp = $frmData['Upload']['tmp_name'];

			//Get the data from form
			$hash = rand();
			$date = date("Ymd");
			$image = $date.$hash."-".$frmData['Upload']['name'];

			//Path to store upload image
			$target = WWW_ROOT.'img'.DS;
        	$target = $target.basename($image);

			if (move_uploaded_file($tmp, $target)) { } else { }

			$this->request->data['User']['profile_pic'] = $image;

			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been updated'));
				$this->redirect(array('action' => 'myprofile'));
			}else{
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $user;
		}
    }

    public function delete($id = null) {

		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
			$this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}

?>
