<!-- File: /app/View/Blogs/edit.ctp -->

<h1>編集ページ</h1>
<?php
echo $this->Form->create('Blog');
echo $this->Form->input('title');
echo $this->Form->input('body', array('row' => '3'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('編集完了');
?>
