<?php

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','register');

		date_default_timezone_set('Asia/Manila');
    }

	public function thankyou() {
		//if already logged-in, redirect
		// if($this->Session->check('Auth.User')){
		// 	$this->redirect(array('controller' => 'users', 'action' => 'index'));
		// }
	}

	public function myprofile($id = null) {
		$user = $this->User->findById(AuthComponent::user('id'));
		// pr($user['User']);

		if(!$user['User']['birthday'] == null){
			$user['User']['birthday'] = date('F j\, Y', strtotime($user['User']['birthday']));
		}

		$user['User']['created'] = date('F j\, Y ha', strtotime($user['User']['created']));
		$user['User']['last_login'] = date('F j\, Y ha', strtotime($user['User']['last_login']));

		$this->set(compact('user'));
	}

	public function userprofile($id = null) {
		$user = $this->User->findById($id);
		$this->set(compact('user'));
	}

	public function myaccount() {
		$id = AuthComponent::user('id');

		// pr($id);

		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}

		// pr($this->User->findById($id));

		$user = $this->User->findById($id);
		if (!$user) {
			$this->Session->setFlash('Invalid User ID Provided');
			$this->redirect(array('action'=>'index'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->id = $id;
			pr($this->User->id);
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been updated'));
				$this->redirect(array('action' => 'myaccount', $id));
			}else{
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $user;
		}
	}

	public function login() {
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('controller' => 'messages', 'action' => 'messagelist'));
		}

		if($this->request->is('post')) {
			// pr($this->request);
			if($this->Auth->login()) {
				$id = AuthComponent::user('id');
				$this->request->data['User']['id'] = $id;
				$this->request->data['User']['last_login'] = date("Y-m-d H:i:s");
				$this->User->save($this->request->data);

				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid email or password, try again'));
			}
		}
	}

	public function logout() {

		$this->redirect($this->Auth->logout());
	}

    public function index() {
		$user = $this->User->findById(AuthComponent::user('id'));
		$this->set(compact('user'));
    }

    public function register() {
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('controller' => 'messages', 'action' => 'messagelist'));
		}
        if ($this->request->is('post')) {
			$this->User->create();

			$this->request->data['User']['last_login'] = date("Y-m-d H:i:s");
			$this->request->data['User']['profile_pic']  = 'avatar-no-pic.png';

			if ($this->User->save($this->request->data)) {
				if($this->Auth->login()) {
					$this->redirect(array('controller' => 'users', 'action' => 'thankyou'));
				}
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

		$birthday = date('m/d/Y', strtotime($user['User']['birthday']));
		$this->set(compact('birthday'));

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

			if(move_uploaded_file($tmp, $target)) {
				$this->request->data['User']['profile_pic'] = $image;
			}

			$birthday = date("y-m-d", strtotime($frmData['birthday']));

			$this->request->data['User']['birthday'] = $birthday;

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
