<?php include 'app/views/_global/beforeContent.php'; ?>

	<header>
		<h3>Posts</h3>
	</header>
	<div class="float-right">
		<a href="<?php echo Configuration::BASE_URL . 'admin/post/add/' ?>" class="btn btn-lg btn-primary" role="button" aria-pressed="true">Add new post</a>
    </div>
    
    <?php foreach($DATA['posts'] as $post): ?>
        <div class="post-list">
            <div class="row">
                <div class="col-4">
                    <a href="<?php echo Configuration::BASE_PATH ?>admin/post/<?php echo  $post->post_id; ?>"><img src="<?php echo Configuration::BASE_PATH . $post->post_image ?>" class="img-fluid" alt="Responsive image"></a>
                </div>

                <div class="col-8">
                    <p><a href="<?php echo Configuration::BASE_PATH ?>admin/post/<?php echo  $post->post_id; ?>"><?php echo htmlspecialchars($post->title); ?></a></p>
                    <p><?php echo htmlspecialchars($DATA['users'][$post->post_id]); ?></p>
                    <p><?php echo $post->created_at; ?></p>
                    <p><?php echo htmlspecialchars(Format::textShorten($post->content)); ?></p>
                    <a href="<?php echo Configuration::BASE_URL . 'admin/post/edit/' . $post->post_id; ?>" class="btn btn-lg btn-warning" role="button" aria-pressed="true">Edit Post</a>
                    <a href="<?php echo Configuration::BASE_URL . 'admin/post/delete/' . $post->post_id; ?>" class="btn btn-lg btn-danger" role="button" aria-pressed="true">Delete Post</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php include 'app/views/_global/afterContent.php'; ?>