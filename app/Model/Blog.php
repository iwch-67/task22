<?php
class Blog extends AppModel {
	public $belongsTo = array('User');

	public function isOwnedBy($post, $user) {
		return $this->field('id',
			array(
				'id' => $post,
				'user_id' => $user
			)
		) !== false;
	}
	public $validate = array(
		'title' => array(
			'rule' => 'notBlank'
		),
		'body' => array(
			'rule' => 'notBlank'
		)
	);
}
?>
