<?php include 'app/views/_global/beforeContent.php'; ?>
    <div class="show-post">
        <div class="row">
            <div class="col-md-8">
                <h3><?php echo htmlspecialchars($DATA['post']->title); ?></h3>
                <p><?php echo $DATA['post']->created_at; ?></p>
                <p><?php echo htmlspecialchars($DATA['post']->introduction); ?></p>
                <img src="<?php echo Configuration::BASE_PATH . $DATA['post']->post_image ?>" class="img-fluid" alt="Responsive image">
                <p><?php echo htmlspecialchars($DATA['post']->content); ?></p>
                <?php if(Session::get('user_id') == null){ ?>
                    <a href="<?php echo Configuration::BASE_PATH ?>login" class="btn btn-primary btn-lg">Log in to comment</a>
                <?php }else{ ?>
                    <?php if(isset($DATA['message'])): ?>
                        <div class="alert alert-primary" role="alert" id="alert_message">
                            <?php echo htmlspecialchars($DATA['message']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" id="comment_form" >
                        <input type="hidden" id="postId" name="postId" value="<?php echo $DATA['post']->post_id?>">
                        <h5>
                        <i class="fas fa-user"></i>
                        <?php echo Session::get('username'); ?>
                        </h5>
                        <div class="form-group">
                            <textarea name="comment" id="comment" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="comment_id" id="comment_id" value="0" />
                            <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
                        </div>
                        <span id="comment_message"></span>
                        <br />
                        <div id="display_comment">
                        </div>
                    </form>
                    <script>
                    $(document).ready(function(){
                        
                        $('#comment_form').on('submit', function(event){
                            event.preventDefault();
                            var form_data = $(this).serialize();
                        
                            $.ajax({
                                url:"http://localhost/G7/aleksandar_kurta/Singidunum/Project/api/comment/add/",
                                method:"POST",
                                data:form_data,
                                dataType:"JSON",
                                success:function(data){
                                    if(data.error != ''){
                                        $('#comment_form')[0].reset();
                                        $('#comment_message').html(data.error);
                                        $('#comment_id').val('0');
                                        load_comment();
                                    }
                                }
                            })
                        });
                            
                        
                        load_comment();
                        
                        function load_comment(){
                            var myvar ='<?php echo Session::get("user_id");?>';
                            var postId = '<?php echo $DATA['post']->post_id?>';
                            $.ajax({
                                url:"http://localhost/G7/aleksandar_kurta/Singidunum/Project/api/comment/show/" + postId,
                                method:"POST",
                                success: function (data) {
                                    $('#display_comment').html(data.output);
                                    console.log(data);
                                }
                            })
                        }

                        function getLastCommentId(){
                            
                        }

                        $(document).on('click', '.delete', function(){
                            event.preventDefault();
                            var form_data = $(this).serialize();
                            var comment_id = $(this).attr("id");

                            $.ajax({
                                url:"http://localhost/G7/aleksandar_kurta/Singidunum/Project/api/comment/del/" + comment_id,
                                method:"POST",
                                data:form_data,
                                dataType:"JSON",
                                success:function(data){
                                    if(data.error != ''){
                                        $('#comment_form')[0].reset();
                                        $('#comment_message').html(data.error);
                                        $('#comment_id').val('0');
                                        load_comment();
                                    }
                                }
                            })
                        });

                        $(document).on('click', '.reply', function(){
                            var comment_id = $(this).attr("id");
                            $('#comment_id').val(comment_id);
                            $('#comment').focus();
                        });  
                    });
                    </script>


                <?php } ?>
            </div>   
            <div class="col-md-4">
                <div class="sidebar">
                    <h3>Vesti</h3>
                    <?php foreach($DATA['posts'] as $post): ?>
                        <p><a href="<?php echo Configuration::BASE_PATH ?>showPost/<?php echo  $post->post_id; ?>"><?php echo htmlspecialchars($post->title); ?></a></p>
                    <?php endforeach; ?>
                    <a href="<?php echo Configuration::BASE_PATH ?>posts/" class="btn btn-primary btn-sm float-right">More News</a>	
                    <img src="<?php echo Configuration::BASE_PATH?>/assets/img/sidebar.jpg" class="img-fluid" alt="Responsive image">
                </div>
            </div>
        </div>
    </div>
    
<?php include 'app/views/_global/afterContent.php'; ?>