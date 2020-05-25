<?php
class User extends AppModel {
	public $validate = array(
		'username' => array(
			'rule' => 'notBlank'
			'message' => '名前が未入力です';
		),
		'email' => array(
			'empty' => array(
				'rule' => 'notBlank',
				'message' => '必ず入力してください'
			)
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
			)
		),
		'password_confirm' => array(
			'compare' => array(
				'rule' => array('password_match', 'password'),
				'message' => 'パスワードが一致しません'
			),
			'length' => array(
				'rule' => array('between', 8, 20),
				'message' => '8文字以上20文字以下のパスワードを入力してください'
			),
			'empty' => array(
				'rule' => 'notBlank',
				'message' => '必ず入力してください'
			)
		)
	)
}
?>
