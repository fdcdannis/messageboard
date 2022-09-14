<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

	public $avatarUploadDir = 'img/avatars';

	public $validate = array(
	
		
	);
	// 	/**
	//  * Before isUniqueUsername
	//  * @param array $options
	//  * @return boolean
	//  */
	function isUniqueUsername($check) {

		$name = $this->find(
			'first',
			array(
				'fields' => array(
					'User.id',
					'User.name'
				),
				'conditions' => array(
					'User.name' => $check['name']
				)
			)
		);

		if(!empty($name)){
			if($this->data[$this->alias]['id'] == $username['User']['id']){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
    }

	/**
	 * Before isUniqueEmail
	 * @param array $options
	 * @return boolean
	 */
	function isUniqueEmail($check) {

		$email = $this->find(
			'first',
			array(
				'fields' => array(
					'User.id'
				),
				'conditions' => array(
					'User.email' => $check['email']
				)
			)
		);

		if(!empty($email)){
			if($this->data[$this->alias]['id'] == $email['User']['id']){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
    }

	public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }

	/**
	 * Before Save
	 * @param array $options
	 * @return boolean
	 */
	 public function beforeSave($options = array()) {
		// hash our password
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}

		// if we get a new password, hash it
		if (isset($this->data[$this->alias]['password_update'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
		}

		// fallback to our parent
		return parent::beforeSave($options);
	}

}

?>
