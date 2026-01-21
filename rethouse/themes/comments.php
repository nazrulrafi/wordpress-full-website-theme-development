<!-- COMMENTS -->
<h6><?php echo get_comments_number(); ?> Comments:</h6>
<div class="single__detail-features-review">
    <?php
    // Get comments for the current post
    $comments = get_comments([
            'post_id' => get_the_ID(),
            'status'  => 'approve'
    ]);

    if ($comments) :
        foreach ($comments as $comment) :
            $comment_author = $comment->comment_author;
            $comment_date = get_comment_date('M d, Y', $comment);
            $comment_content = $comment->comment_content;
            $comment_avatar = get_avatar_url($comment->user_id, ['size' => 80]);
            ?>
            <div class="media mt-4">
                <img class="mr-3 img-fluid rounded-circle" src="<?= esc_url($comment_avatar) ?>" alt="">
                <div class="media-body">
                    <h6 class="mt-0"><?= esc_html($comment_author) ?></h6>
                    <span class="mb-3"><?= esc_html($comment_date) ?></span>
                    <p><?= esc_html($comment_content) ?></p>

                    <?php
                    // Show replies (1 level deep)
                    $replies = get_comments([
                            'parent' => $comment->comment_ID,
                            'status' => 'approve'
                    ]);
                    if ($replies) :
                        foreach ($replies as $reply) :
                            $reply_author = $reply->comment_author;
                            $reply_date = get_comment_date('M d, Y', $reply);
                            $reply_content = $reply->comment_content;
                            $reply_avatar = get_avatar_url($reply->user_id, ['size' => 80]);
                            ?>
                            <div class="media mt-4">
                                <a class="pr-3" href="#">
                                    <img src="<?= esc_url($reply_avatar) ?>" alt="" class="img-fluid rounded-circle">
                                </a>
                                <div class="media-body">
                                    <h6 class="mt-0"><?= esc_html($reply_author) ?></h6>
                                    <span class="mb-3"><?= esc_html($reply_date) ?></span>
                                    <p><?= esc_html($reply_content) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- COMMENT FORM -->
    <hr>
    <?php
    $args = [
            'title_reply' => 'Leave a Comment',
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            'label_submit' => 'Submit Comment',
            'class_submit' => 'btn btn-primary float-right',
            'comment_field' => '<div class="form-group"><label>Your message</label><textarea class="form-control" rows="4" name="comment" required></textarea></div>',
            'fields' => [
                    'author' => '<div class="form-group"><label>Your Name</label><input type="text" class="form-control" name="author" required></div>',
                    'email'  => '<div class="form-group"><label>Email</label><input type="email" class="form-control" name="email" required></div>',
                    'url'    => '<div class="form-group"><label>Website</label><input type="url" class="form-control" name="url"></div>'
            ]
    ];
    comment_form($args);
    ?>
    <!-- END COMMENT FORM -->

</div>
<!-- END COMMENTS -->
