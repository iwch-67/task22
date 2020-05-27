<!-- Files: /app/View/Blogs/index.ctp -->
<h1>投稿一覧</h1>
<?php if (isset($user)): ?>
<p>ログイン中のユーザー: <?php echo $user['username'] ?></p>
<?php endif; ?>

<?php
if (isset($user)) {
	echo $this->Html->link(
		'ログアウト',
		array(
			'controller' => 'users',
			'action' => 'logout'
		)
	);
} else {
	echo $this->Html->link(
		'ログイン',
		array(
			'controller' => 'users',
			'action' => 'login'
		)
	);
}
?>

<?php
echo $this->Html->link(
	'新規投稿',
	array(
		'controller' => 'blogs',
		'action' => 'add'
	)
);
?>
<table>
<tr>
<th>Id</th>
<th>Title</th>
<th>Postedby</th>
<th>Actions</th>
<th>Created</th>
</tr>
<?php foreach ($posts as $post): ?>
<tr>
<td><?php echo $post['Blog']['id']; ?></td>
<td>
<?php
echo $this->Html->link(
	$post['Blog']['title'],
	array('controller' => 'blogs',
		'action' => 'view',
		$post['Blog']['id']
	)
);
?>
</td>
<td><?php echo $post['User']['username']; ?></td>
<td>
<?php
if ($user['id'] == $post['Blog']['user_id']) {
echo $this->Form->postLink(
	'Delete',
	array(
		'action' => 'delete',
		$post['Blog']['id']
	),
	array('confirm' => '本当削除しますか?')
);
?>

<?php
echo $this->Html->link(
	'Edit',
	array(
		'action' => 'edit',
		$post['Blog']['id']
	)
);
}
?>
</td>
<td><?php echo $post['Blog']['created']; ?></td>
</tr>
<?php endforeach; ?>
<?php unset($post); ?>
</table>
