<div class="users form">
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<fieldset>
<legend>
<?php echo __('メールアドレスとパスワードを入力してください'); ?>
</legend>
<?php
	echo $this->Html->link(
		'新規登録',
		array(
			'controller' => 'users',
			'action' => 'add'
		)
	);
?>

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
echo $this->Form->input('email');
echo $this->Form->input('password');
?>
</fieldset>
<?php echo $this->Form->end(__('ログイン')); ?>
</div>
