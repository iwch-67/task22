<!-- File: /app/View/Blogs/view.ctp -->

<h1><?php echo h($post['Blog']['title']); ?></h1>
<p><small>Created: <?php echo $post['Blog']['created']; ?></small></p>
<p><?php echo h($post['Blog']['body']); ?></p>
