<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {
	public $validate = array(
		'username' => array(
			'empty' => array(
				'rule' => 'notBlank',
				'message' => '名前が未入力です'
			),
			'length' => array(
				'rule' => array('maxLength', 60),
				'message' => '名前が60文字以内で入力してください'
			)
		),
		'email' => array(
			'empty' => array(
				'rule' => 'notBlank',
				'message' => '必ず入力してください'
			),
			'email' => array(
				'rule' => 'email',
				'message' => '不適切なメールアドレスです'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => '他のユーザーに既に使われています'
			)
		),
		'password' => array(
			'empty' => array(
				'rule' => 'notBlank',
				'message' => 'パスワードは必ず入力してください'
			),
			'format' => array(
				'rule' => 'alphaNumeric',
				'message' => 'パスワードは英数字のみ使用できます'
			),
			'length' => array(
				'rule' => array('lengthBetween', 8, 20),
				'message' => '8文字以上20文字以下のパスワードを入力してください'
			),
			'compare' => array(
				'rule' => array('confirmPassword', 'password_confirm'),
				'message' => 'パスワードが一致しません'
			)
		),
		'password_confirm' => array(
			'empty' => array(
				'rule' => 'notBlank',
				'message' => '必ず入力してください'
			)
		)
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}

	public function confirmPassword($check) {
		if ($this->data['User']['password'] === $this->data['User']['password_confirm']) {
			return true;
		} else {
			return false;
		}
	}
}
?>
