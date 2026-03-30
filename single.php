<?php get_header();
the_post();
?>

<main class="main">
    <div class="page-header text-center"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title"><?php esc_html(the_title()); ?></span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">

                <!-- Home -->
                <li class="breadcrumb-item">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php _e('Home', 'gebeyashoptheme'); ?>
                    </a>
                </li>

                <!-- Blog Page -->
                <li class="breadcrumb-item">
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                        <?php _e('Blog', 'gebeyashoptheme'); ?>
                    </a>
                </li>

                <!-- Category -->
                <?php
                $categories = get_the_category();
                if (!empty($categories)):
                    $cat = $categories[0]; // first category
                    ?>
                    <li class="breadcrumb-item">
                        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
                            <?php echo esc_html($cat->name); ?>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Current Post -->
                <li class="breadcrumb-item active" aria-current="page">
                    <?php the_title(); ?>
                </li>

            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <article class="entry single-entry">
                        <figure class="entry-media">
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url()) ?>" alt="image desc">
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                    by <a
                                        href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                        <?php echo esc_html(get_the_author()); ?>
                                    </a>
                                </span>
                                <span class="meta-separator">|</span>
                                <a href="<?php the_permalink() ?>">
                                    <?php echo esc_html(get_the_date()); ?>
                                </a>
                                <span class="meta-separator">|</span>
                                <a href="<?php comments_link() ?>">
                                    <?php comments_number(
                                        '0 Comments',
                                        '1 Comment',
                                        '% Comments'
                                    ); ?>
                                </a>
                            </div><!-- End .entry-meta -->

                            <!--- <h2 class="entry-title">
                                Cras ornare tristique elit.
                            </h2> End .entry-title

                            <div class="entry-cats">
                                in <a href="#">Lifestyle</a>,
                                <a href="#">Shopping</a>
                            </div> End .entry-cats  -->

                            <div class="entry-content editor-content">
                                <?php the_content(); ?>
                            </div><!-- End .entry-content -->

                            <div class="entry-footer row no-gutters flex-column flex-md-row">
                                <div class="col-md">
                                    <div class="entry-tags">
                                        <span>Tags:</span>
                                        <?php
                                        $tags = get_the_tags();
                                        if ($tags) {
                                            $tag_links = [];

                                            foreach ($tags as $tag) {
                                                $tag_links[] = '<a href=" ' . esc_url(get_tag_link($tag->term_id))
                                                    . '">' . esc_html($tag->name) . '</a>';
                                            }

                                            echo implode('', $tag_links);
                                        }
                                        ?>
                                    </div><!-- End .entry-tags -->
                                </div><!-- End .col -->

                                <div class="col-md-auto mt-2 mt-md-0">
                                    <?php
                                    $post_url = urlencode(get_permalink());
                                    $post_title = urlencode(get_the_title());
                                    ?>

                                    <div class="social-icons social-icons-color">
                                        <span
                                            class="social-label"><?php _e('Share this post:', 'gebeyashoptheme'); ?></span>

                                        <!-- Facebook -->
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>"
                                            class="social-icon social-facebook" title="Facebook" target="_blank">
                                            <i class="icon-facebook-f"></i>
                                        </a>

                                        <!-- Twitter -->
                                        <a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title; ?>"
                                            class="social-icon social-twitter" title="Twitter" target="_blank">
                                            <i class="icon-twitter"></i>
                                        </a>

                                        <!-- Pinterest -->
                                        <a href="https://pinterest.com/pin/create/button/?url=<?php echo $post_url; ?>&description=<?php echo $post_title; ?>"
                                            class="social-icon social-pinterest" title="Pinterest" target="_blank">
                                            <i class="icon-pinterest"></i>
                                        </a>

                                        <!-- LinkedIn -->
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $post_url; ?>"
                                            class="social-icon social-linkedin" title="LinkedIn" target="_blank">
                                            <i class="icon-linkedin"></i>
                                        </a>
                                    </div>
                                </div><!-- End .col-auto -->
                            </div><!-- End .entry-footer row no-gutters -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->

                    <nav class="pager-nav" aria-label="Page navigation">
                        <?php
                        $prev = get_previous_post();
                        if ($prev):
                            ?>
                            <a class="pager-link pager-link-prev" href="<?php echo esc_url(get_permalink($prev->ID)); ?>">
                                Previous Post
                                <span class="pager-link-title"><?php echo esc_html(get_the_title($prev->ID)); ?></span>
                            </a>
                        <?php endif; ?>

                        <?php
                        $next = get_next_post();
                        if ($next):
                            ?>
                            <a class="pager-link pager-link-next" href="<?php echo esc_url(get_permalink($next->ID)); ?>">
                                Next Post
                                <span class="pager-link-title"><?php echo esc_html(get_the_title($next->ID)); ?></span>
                            </a>
                        <?php endif; ?>
                    </nav><!-- End .pager-nav -->

                    <?php
                    // Get current post categories
                    $categories = get_the_category();

                    if (!empty($categories)):

                        $category_ids = array();

                        foreach ($categories as $cat) {
                            $category_ids[] = $cat->term_id;
                        }

                        $related_query = new WP_Query(array(
                            'category__in' => $category_ids,
                            'post__not_in' => array(get_the_ID()),
                            'posts_per_page' => 6,
                            'orderby' => 'rand'
                        ));

                        if ($related_query->have_posts()):
                            ?>

                            <div class="related-posts">
                                <h3 class="title"><?php _e('Related Posts', 'gebeyashoptheme'); ?></h3>

                                <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{
        "nav": false, 
        "dots": true,
        "margin": 20,
        "loop": false,
        "responsive": {
            "0": {"items":1},
            "480": {"items":2},
            "768": {"items":3}
        }
    }'>

                                    <?php while ($related_query->have_posts()):
                                        $related_query->the_post(); ?>

                                        <article class="entry entry-grid">

                                            <!-- Image -->
                                            <figure class="entry-media">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    if (has_post_thumbnail()) {
                                                        the_post_thumbnail('medium');
                                                    } else {
                                                        ?>
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog/default.jpg"
                                                            alt="image">
                                                        <?php
                                                    }
                                                    ?>
                                                </a>
                                            </figure>

                                            <div class="entry-body">

                                                <!-- Meta -->
                                                <div class="entry-meta">
                                                    <a href="#"><?php echo esc_html(get_the_date()); ?></a>
                                                    <span class="meta-separator">|</span>
                                                    <a href="<?php comments_link(); ?>">
                                                        <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
                                                    </a>
                                                </div>

                                                <!-- Title -->
                                                <h2 class="entry-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h2>

                                                <!-- Categories -->
                                                <div class="entry-cats">
                                                    <?php
                                                    $post_cats = get_the_category();

                                                    if (!empty($post_cats)) {
                                                        echo 'in ';
                                                        $cat_links = array();

                                                        foreach ($post_cats as $cat) {
                                                            $cat_links[] = '<a href="' . esc_url(get_category_link($cat->term_id)) . '">'
                                                                . esc_html($cat->name) . '</a>';
                                                        }

                                                        echo implode(', ', $cat_links);
                                                    }
                                                    ?>
                                                </div>

                                            </div>

                                        </article>

                                    <?php endwhile; ?>

                                </div>
                            </div>

                            <?php
                            wp_reset_postdata();
                        endif;

                    endif;
                    ?><!-- End .related-posts -->

                    <?php
                    // Exit if the post is password protected
                    if (post_password_required()) {
                        return;
                    }

                    // Get approved comments for this post
                    $comments = get_comments(array(
                        'post_id' => get_the_ID(),
                        'status' => 'approve',
                        'parent' => 0, // top-level comments
                    ));
                    ?>

                    <div class="comments">
                        <h3 class="title"><?php echo count($comments) . ' Comments'; ?></h3><!-- End .title -->

                        <ul>
                            <?php foreach ($comments as $comment): ?>
                                <li>
                                    <div class="comment">
                                        <figure class="comment-media">
                                            <a
                                                href="#"><?php echo get_avatar($comment, 70, '', 'User name', array('class' => 'img-fluid')); ?></a>
                                        </figure>

                                        <div class="comment-body">
                                            <?php comment_reply_link(array(
                                                'depth' => 1,
                                                'max_depth' => 3,
                                                'reply_text' => 'Reply',
                                                'add_below' => 'comment',
                                                'before' => '<a class="comment-reply" href="#">',
                                                'after' => '</a>',
                                                'echo' => true,
                                            ), $comment); ?>

                                            <div class="comment-user">
                                                <h4><a href="#"><?php echo get_comment_author($comment); ?></a></h4>
                                                <span
                                                    class="comment-date"><?php echo get_comment_date('F j, Y \a\t g:i a', $comment); ?></span>
                                            </div><!-- End .comment-user -->

                                            <div class="comment-content">
                                                <p><?php echo get_comment_text($comment); ?></p>
                                            </div><!-- End .comment-content -->
                                        </div><!-- End .comment-body -->
                                    </div><!-- End .comment -->

                                    <?php
                                    // Get replies (child comments)
                                    $replies = get_comments(array(
                                        'post_id' => get_the_ID(),
                                        'status' => 'approve',
                                        'parent' => $comment->comment_ID
                                    ));
                                    if ($replies): ?>
                                        <ul>
                                            <?php foreach ($replies as $reply): ?>
                                                <li>
                                                    <div class="comment">
                                                        <figure class="comment-media">
                                                            <a
                                                                href="#"><?php echo get_avatar($reply, 70, '', 'User name', array('class' => 'img-fluid')); ?></a>
                                                        </figure>

                                                        <div class="comment-body">
                                                            <?php comment_reply_link(array(
                                                                'depth' => 2,
                                                                'max_depth' => 3,
                                                                'reply_text' => 'Reply',
                                                                'add_below' => 'comment',
                                                                'before' => '<a class="comment-reply" href="#">',
                                                                'after' => '</a>',
                                                                'echo' => true,
                                                            ), $reply); ?>

                                                            <div class="comment-user">
                                                                <h4><a href="#"><?php echo get_comment_author($reply); ?></a></h4>
                                                                <span
                                                                    class="comment-date"><?php echo get_comment_date('F j, Y \a\t g:i a', $reply); ?></span>
                                                            </div><!-- End .comment-user -->

                                                            <div class="comment-content">
                                                                <p><?php echo get_comment_text($reply); ?></p>
                                                            </div><!-- End .comment-content -->
                                                        </div><!-- End .comment-body -->
                                                    </div><!-- End .comment -->
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- End .comments -->

                    <div class="reply">
                        <div class="heading">
                            <h3 class="title">Leave A Reply</h3><!-- End .title -->
                            <p class="title-desc">Your email address will not be published. Required fields are marked *
                            </p>
                        </div><!-- End .heading -->

                        <?php
                        // Display WordPress comment form with your HTML layout
                        comment_form(array(
                            'title_reply' => '',
                            'label_submit' => 'POST COMMENT',
                            'class_submit' => 'btn btn-outline-primary-2',
                            'comment_field' => '<label for="comment" class="sr-only">Comment</label>
                                <textarea id="comment" name="comment" cols="30" rows="4" class="form-control" required placeholder="Comment *"></textarea>',
                            'fields' => array(
                                'author' => '<div class="row"><div class="col-md-6">
                            <label for="author" class="sr-only">Name</label>
                            <input id="author" name="author" type="text" class="form-control" required placeholder="Name *">
                         </div>',
                                'email' => '<div class="col-md-6">
                            <label for="email" class="sr-only">Email</label>
                            <input id="email" name="email" type="email" class="form-control" required placeholder="Email *">
                         </div></div>',
                            ),
                            'comment_notes_after' => '', // remove default notes
                        ));
                        ?>
                    </div><!-- End .reply -->
                    <!-- End .comments -->
                    <!-- End .reply -->
                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    <div class="sidebar">
                        <?php if (is_active_sidebar('blog-sidebar')): ?>
                            <?php dynamic_sidebar('blog-sidebar'); ?>
                        <?php endif; ?>
                    </div><!-- End .sidebar -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<?php get_footer(); ?>