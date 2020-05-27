<!-- app/View/Users/add.ctp -->

<div class="users form">
<?php echo $this->Form->create('User'); ?>
<fieldset>
<legend><?php echo __('ユーザー登録'); ?></legend>
<?php
	echo $this->Html->link(
		'ログインへ',
		array(
			'controller' => 'users',
			'action' => 'login'
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
echo $this->Form->input('username');
echo $this->Form->input('email');
echo $this->Form->input('password');
echo $this->Form->input('password_confirm', array('type' => 'password'));
?>
</fieldset>
<?php echo $this->Form->end(__('登録')); ?>
</div>
