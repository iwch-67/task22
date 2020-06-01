<!-- File: /app/View/Users/view.ctp -->

<h1>ユーザー名：<?php echo $user['User']['username']; ?></h1>
<h1>メールアドレス：<?php echo $user['User']['email']; ?></h1>
<h1>ユーザー画像</h1>
<?php
if ($user['User']['image']) {
	echo $this->Html->image(
		$user['User']['image'],
		array('width' => '200', 'height' => '200')
	);
} else {
	echo '未登録';
}
?>
<p>【一言コメント】</p>
<?php if ($user['User']['comment']): ?>
<p><?php echo h($user['User']['comment']); ?></p>
<?php else: ?>
<p><?php echo 'なし'; ?></p>
<?php endif; ?>

<?php
//ログインユーザーとユーザーidが一致している時だけ編集P表示
if ($auth['id'] === $user['User']['id']) {
	echo $this->Html->link(
		'ユーザー情報編集',
		array(
			'controller' => 'users',
			'action' => 'edit', $user['User']['id']
		)
	);
	echo ' | ';
}
echo $this->Html->link(
	'投稿一覧へ戻る',
	array(
		'controller' => 'blogs',
		'action' => 'index'
	)
);
?>
