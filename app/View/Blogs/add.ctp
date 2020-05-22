<!-- File: /app/View/Blogs/add.ctp -->

<h1>新規投稿</h1>
<?php
echo $this->Form->create('Blog');
echo $this->Form->input('title');
echo $this->Form->input('body', array('row' => '3'));
echo $this->Form->end('投稿');
?>
