<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Check if post is password-protected
if (post_password_required()) {
    echo '<p class="nocomments">This post is password protected. Enter the password to view comments.</p>';
    return;
}
?>

<div class="comments-wrap">
    <div id="comments" class="row">
        <div class="col-full">
            <?php if (have_comments()) : ?>
                <h3 class="h2">
                    <?php
                        $comments_number = get_comments_number();
                        if ($comments_number <=1) {
                            echo $comments_number.__(' Comment', 'philosophy');
                        }else{
                            echo $comments_number.__(' Comments', 'philosophy');
                        }
                    ?>
                </h3>

                <!-- Comment List -->
                <ol class="commentlist">
                    <?php
                    wp_list_comments(array(
                            'style' => 'ol',
                            'callback' => 'custom_comment_callback',
                            'avatar_size' => 50,
                    ));
                    ?>
                </ol>
                <!-- End Comment List -->

                <?php
                // Pagination for comments
                if (get_comment_pages_count() > 1 && get_option('page_comments')) :
                    ?>
                    <nav class="pagination">
                        <?php paginate_comments_links(array(
                                'prev_text' => '&laquo; Older Comments',
                                'next_text' => 'Newer Comments &raquo;',
                        )); ?>
                    </nav>
                <?php endif; ?>
            <?php else : ?>
                <?php if (!comments_open()) : ?>
                    <p class="no-comments">Comments are closed.</p>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Comment Form -->
            <div class="respond">
                <h3 class="h2"><?php comment_form_title('Add Comment', 'Add a Reply to %s'); ?></h3>
                <?php
                comment_form(array(
                        'fields' => array(
                                'author' => '<div class="form-field"><input name="author" type="text" id="cName" class="full-width" placeholder="Your Name" value="' . esc_attr($commenter['comment_author']) . '" autocomplete="off"></div>',
                                'email' => '<div class="form-field"><input name="email" type="text" id="cEmail" class="full-width" placeholder="Your Email" value="' . esc_attr($commenter['comment_author_email']) . '"></div>',
                                'url' => '<div class="form-field"><input name="url" type="text" id="cWebsite" class="full-width" placeholder="Website" value="' . esc_attr($commenter['comment_author_url']) . '"></div>',
                        ),
                        'comment_field' => '<div class="message form-field"><textarea name="comment" id="cMessage" class="full-width" placeholder="Your Message"></textarea></div>',
                        'submit_button' => '<button type="submit" class="submit btn--primary btn--large full-width">Submit</button>',
                        'class_form' => 'contactForm',
                        'comment_notes_before' => '',
                        'title_reply' => '',
                        'title_reply_to' => '',
                ));
                ?>
            </div>
            <!-- End Comment Form -->
        </div>
        <!-- End col-full -->
    </div>
    <!-- End row comments -->
</div>
<!-- End comments-wrap -->