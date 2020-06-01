<!-- File: /app/View/Users/edit.ctp -->

<h1>編集ページ</h1>
<?php
	echo $this->Html->link(
		'投稿一覧へ',
		array(
			'controller' => 'blogs',
			'action' => 'index'
		)
	);
?>

<?php
	echo $this->Html->link(
		'ユーザー情報へ',
		array(
			'controller' => 'users',
			'action' => 'view', $this->request->params['pass'][0]
		)
	);
?>
<?php
echo $this->Form->create('User', array('type' => 'file', 'enctype' => 'multipart/form-data'));
echo $this->Form->input('comment', array('size' => '50'));
echo $this->Form->input('image', array('label' => false, 'type' => 'file'));
echo $this->Form->end(__('編集完了'));
?>

