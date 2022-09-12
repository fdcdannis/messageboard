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

        // $messages = $this->Message->find('all', array(
        //     'conditions' => array(
        //                         "OR" => array(
        //                             'Message.message_to_user_id' => $user_id,
        //                             'Message.message_from_user_id' => $user_id,
        //                         )
        //                     )
        // ));

        

        // $messages = $this->Message->query("
        //     SELECT *
        //     FROM messages
        //     INNER JOIN users ON messages.message_to_user_id = users.id || messages.message_from_user_id = $user_id;
        // ");

        $messages = $this->Message->find('all', array(
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        "OR" => array(
                            array('User.id = Message.message_to_user_id'),
                            array('User.id = Message.message_from_user_id')
                        )
                    )
                )
            ),
            'conditions' => array(
                "OR" => array(
                    // 'User.id = Message.message_to_user_id',
                    // 'Message.message_to_user_id' => $user_id
                )
            ),
            'fields' => array('User.*', 'Message.*'),   
            // 'order' => 'Message.datetime DESC'
        ));

        // pr($messages);
		$this->set(compact('messages'));
    }

	public function update_image(){

	}

    public function reply($id = null) {

        pr($id);

        if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}

		$message = $this->Message->findById($id);
		if (!$message) {
			$this->Session->setFlash('Invalid User ID Provided');
			$this->redirect(array('action'=>'index'));
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
