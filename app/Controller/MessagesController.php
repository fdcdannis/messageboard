<?php

class MessagesController extends AppController {


	public $components = array(
        'RequestHandler'
    );

	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('User.name' => 'asc' )
    );

    // public function beforeFilter() {
    //     parent::beforeFilter();
    //     $this->Auth->allow('login','register', 'thankyou');
    // }

    public function messagelist() {

		// if($this->Session->check('Auth.User')){
		// 	$this->redirect(array('action' => 'messagelist'));
		// }

        $user_id = AuthComponent::user('id');
		

		$this->loadmodel('User');
		$result = $this->User->find('list');

		$messages = $this->Message->query("
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_from_user_id = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				UNION ALL
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_to_userid = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				ORDER BY message_created desc
				LIMIT 5
		");

		$this->set(compact('result', 'messages'));
    }

	public function loadmore($limit = null) {
		
        $user_id = AuthComponent::user('id');
		$messages = $this->Message->query("
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_from_user_id = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				UNION ALL
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_to_userid = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				ORDER BY message_created desc
				LIMIT $limit
		");

		$this->set(compact('messages'));
    }

	public function search($search = null) {

        $user_id = AuthComponent::user('id');

		// pr($search);
		// pr($user_id);

		$messages = $this->Message->query("
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_from_user_id = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				WHERE Message.message_details LIKE '%$search%'
				UNION ALL
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_to_userid = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0				
				WHERE Message.message_details LIKE '%$search%'
				ORDER BY message_created desc
				LIMIT 5
		");

		$this->set(compact('messages'));
    }

	public function deletemessage($id = null) {

        $this->Message->deleteAll(array('Message.id'=>$id));

		$user_id = AuthComponent::user('id');
		$messages = $this->Message->query("
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_from_user_id = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				WHERE Message.message_details LIKE '%$search%'
				UNION ALL
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_to_userid = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				WHERE Message.message_details LIKE '%$search%'
				ORDER BY message_created desc
				LIMIT 5
		");

		$this->set(compact('messages'));
    }


    public function reply($id = null, $to_user_id = null, $from_user_id = null) {

		$this->set(compact('id'));
		$this->set(compact('to_user_id'));
		$this->set(compact('from_user_id'));

		$user_id = AuthComponent::user('id');
		$currDateTime = date("Y-m-d H:i:s");

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
				ORDER BY message_created desc
				LIMIT 5			
		");

		$this->set(compact('messages'));
    }

	public function loadmorereply($id = null, $to_user_id = null, $from_user_id = null, $limit = null) {

		$this->set(compact('id'));
		$this->set(compact('to_user_id'));
		$this->set(compact('from_user_id'));

		$user_id = AuthComponent::user('id');
		$currDateTime = date("Y-m-d H:i:s");

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
				ORDER BY message_created desc
				LIMIT $limit			
		");

		$this->set(compact('messages'));
    }

	public function replymessages($id = null, $to_user_id = null, $from_user_id = null, $reply_messages = null) {

		$user_id = AuthComponent::user('id');
		$currDateTime = date("Y-m-d H:i:s");

		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}

		$this->request->data['Message']['reply_flag'] = 1;
		$this->request->data['Message']['reply_id'] = $id;
		$this->request->data['Message']['message_id'] = $id;
		$this->request->data['Message']['message_details'] = $reply_messages;
		$this->request->data['Message']['message_from_user_id'] = $user_id;
		$this->request->data['Message']['message_created'] = $currDateTime;

		if($to_user_id == $user_id){
			$this->request->data['Message']['message_to_userid'] = $from_user_id;
		} else {
			$this->request->data['Message']['message_to_userid'] = $to_user_id;
		}

		$this->Message->save($this->request->data);

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
				ORDER BY message_created desc
				LIMIT 5
		");

		$this->set(compact('messages'));
    }

	public function replymessages_socket($id = null, $to_user_id = null, $from_user_id = null, $reply_messages = null) {

		$user_id = AuthComponent::user('id');

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
				ORDER BY message_created desc
				LIMIT 5
		");

		$this->set(compact('messages'));
    }

	public function newmessages($selectedRecepientID = null, $newMessages = null) {
		$user_id = AuthComponent::user('id');
		$currDateTime = date("Y-m-d H:i:s");


		$this->request->data['Message']['message_details'] = $newMessages;
		$this->request->data['Message']['message_from_user_id'] = $user_id;
		$this->request->data['Message']['reply_flag'] = 0;
		$this->request->data['Message']['message_id'] = $user_id;
		$this->request->data['Message']['reply_id'] = 0;
		$this->request->data['Message']['message_created'] = $currDateTime;
		$this->request->data['Message']['message_to_userid'] = $selectedRecepientID;

		$this->Message->save($this->request->data);

		$messages = $this->Message->query("
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_from_user_id = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				UNION ALL
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_to_userid = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				ORDER BY message_created desc
				LIMIT 5
		");

		$this->set(compact('messages'));
    }

	public function newmessages_socket() {
		$user_id = AuthComponent::user('id');

		$messages = $this->Message->query("
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_from_user_id = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				UNION ALL
				SELECT  *
				FROM    Users AS User
				JOIN    Messages AS Message
				ON Message.message_to_userid = $user_id AND User.id = Message.message_from_user_id AND Message.reply_flag = 0
				ORDER BY message_created desc
				LIMIT 5
		");

		$this->set(compact('messages'));
    }
}

?>
