<!-- Files: /app/View/Blogs/index.ctp -->
<h1>投稿一覧</h1>
<?php
echo $this->Html->link('新規投稿', array('controller' => 'blogs', 'action' => 'add'));
?>
<table>
<tr>
<th>Id</th>
<th>Title</th>
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
<td>
<?php
echo $this->Form->postLink(
				'Delete',
				array('action' => 'delete', $post['Blog']['id']),
				array('confirm' => '本当削除しますか?')
			);
?>

<?php
echo $this->Html->link(
				'Edit',
				array('action' => 'edit', $post['Blog']['id'])
			);
?>
</td>
<td><?php echo $post['Blog']['created']; ?></td>
</tr>
<?php endforeach; ?>
<?php unset($post); ?>
</table>
