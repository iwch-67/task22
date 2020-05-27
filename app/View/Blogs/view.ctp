<!-- File: /app/View/Blogs/view.ctp -->

<h1><?php echo h($post['Blog']['title']); ?></h1>
<p>
<small>投稿日時: <?php echo $post['Blog']['created']; ?></small></p>
<small>投稿者: <?php echo $post['User']['username']; ?></small></p>
<p><?php echo h($post['Blog']['body']); ?></p>
