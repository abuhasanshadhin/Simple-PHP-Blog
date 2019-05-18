<?php include "includes/header.php"; ?>

<div class="row mt-2">

    <?php
    if (isset($_GET['l'])) {
        $post->like($_GET['l']);
    }

    if (isset($_GET['pid'])) {
        $postDetails = DB::getSingleData('posts', 'id', $_GET['pid']);
        $post->postPopularIncrese($_GET['pid']);
        ?>

        <div class="col-md-8">
            <div class="card-body border">
                <h3><?php echo $postDetails['post_title']; ?></h3>

                <h6>&#128197; <?php echo $format->dateFormat($postDetails['post_date']); ?> .

                    &#128104; <?php echo $postDetails['post_author']; ?> .

                    &#128077; <?php echo $post->totalLikes($postDetails['id']) ?>
                    <?php if (Session::get('user_login') == true) { ?>
                        <a href="?l=<?php echo $postDetails['id']; ?>">Like</a>
                    <?php } else { ?>
                        <a href="#" onclick="alert('Please Login first !')">Like</a>
                    <?php } ?>.
                    
                    &#128172; <?php echo $post->getTotalCommentByPost($postDetails['id'])?>
                    <?php if (Session::get('user_login') == true) { ?>
                        <a href="#comments">Comment</a>
                    <?php } else { ?>
                        <a href="#" onclick="alert('Please Login first !')">Comment</a>
                    <?php } ?>

                </h6>

                <?php if ($postDetails['post_image'] != null){ ?>
                <img src="<?php echo $postDetails['post_image']; ?>" width="100%" height="300" class="mt-2 mb-3">
                <?php } ?>

                <p class='mt-3'><?php echo $postDetails['post_description']; ?></p>

                <div class="card mt-3" id="comments">
                    <div class="card-header"><h5>Comments</h5></div>
                    <?php
                    if (isset($_POST['btn-comment'])) {
                        $post->comment($_POST['comment'], $postDetails['id']);
                    }

                    if (isset($_POST['btn_reply'])) {
                        $post->comment_reply($_POST, $postDetails['id']);
                    }

                    if (Session::get('user_login') == true) {
                        ?>
                        <div class="card-body">
                            <form method="post">
                                <textarea name="comment" class="form-control" placeholder="Write your comment..."
                                          cols="30"
                                          rows="5"></textarea>
                                <input type="submit" name="btn-comment" class="float-right mt-2 btn btn-primary"
                                       value="Comment">
                            </form>
                        </div>
                    <?php } ?>
                    <div class="card-body">

                        <?php
                        $comments = $post->getComments($postDetails['id']);
                        foreach ($comments as $comment) {
                            ?>
                            <h6 class="text-secondary">
                                <?php echo $comment['commenter_name']; ?>
                                <span class="font-weight-normal">&#8226; <?php echo $format->relative_Time($comment['comment_date']) ?></span>
                            </h6>
                            <p>
                                <?php echo $comment['comment']; ?>
                            </p>

                            <?php
                            $replies = $post->getReply($comment['id']);
                                foreach ($replies as $reply) {
                                ?>
                                    <div class="ml-5">
                                        <h6 class="text-secondary">
                                            <?php echo $reply['replier_name']; ?>
                                            <span class="font-weight-normal">&#8226; <?php echo $format->relative_Time($reply['reply_date']) ?></span>
                                        </h6>
                                        <p>
                                            <?php echo $reply['reply']; ?>
                                        </p>
                                    </div>
                            <?php } ?>

                            <?php if (Session::get('user_login') == true) { ?>
                                <button class="btn" onclick="replyTextBox(<?php echo $comment['id']; ?>)"><i
                                            class="fa fa-reply"></i> Reply
                                </button>

                                <form method="post" class="card-body mb-5" id="reply<?php echo $comment['id']; ?>"
                                      style="display: none;">

                                    <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">

                                    <textarea name="reply" class="form-control" placeholder="Write your reply..."
                                              cols="30"
                                              rows="5"></textarea>
                                    <input type="submit" name="btn_reply" class="float-right mt-2 btn btn-info"
                                           value="Reply">

                                </form>
                            <?php } ?>
                            <hr>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="col-md-4">
        <?php include "includes/sidebar.php"; ?>
    </div>

</div>

<?php include "includes/footer.php"; ?>

<script>
    function replyTextBox(i) {
        $('#reply' + i).toggle();
    }
</script>
