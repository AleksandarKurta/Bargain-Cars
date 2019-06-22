<?php include 'app/views/_global/beforeContent.php'; ?>

	<header>
		<h3>Posts</h3>
	</header>
    <?php foreach($DATA['posts'] as $post): ?>
        <div class="post-list">
            <div class="row">
                <div class="col-4">
                    <a href="<?php echo Configuration::BASE_PATH ?>showPost/<?php echo  $post->post_id; ?>"><img src="<?php echo Configuration::BASE_PATH . $post->post_image ?>" class="img-fluid" alt="Responsive image"></a>
                </div>

                <div class="col-8">
                    <h5><a href="<?php echo Configuration::BASE_PATH ?>showPost/<?php echo  $post->post_id; ?>"><?php echo htmlspecialchars($post->title); ?></a></h5>
                    <p><?php echo htmlspecialchars($DATA['users'][$post->post_id]); ?></p>
                    <p><?php echo $post->created_at; ?></p>
                    <p><?php echo htmlspecialchars(Format::textShorten($post->content)); ?></p>
                    <a href="<?php echo Configuration::BASE_URL . 'showPost/' . $post->post_id; ?>" class="btn btn-sm btn-primary" role="button" aria-pressed="true">Read more</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php include 'app/views/_global/afterContent.php'; ?>