<?php get_header(); ?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Blog Listing<span>Blog</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Listing</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">


                    <?php if (have_posts()) {
                        while (have_posts()) {
                            the_post(); ?>

                            <article class="entry entry-list">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <figure class="entry-media">
                                            <a href="<?php the_permalink() ?>">
                                                <img src="<?php echo esc_url(get_the_post_thumbnail_url()) ?>" alt="image desc">
                                            </a>
                                        </figure><!-- End .entry-media -->
                                    </div><!-- End .col-md-5 -->

                                    <div class="col-md-7">
                                        <div class="entry-body">
                                            <div class="entry-meta">
                                                <span class="entry-author">
                                                    by <a
                                                        href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))) ?>">
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
                                                        '1 Comment,',
                                                        '% Comments'
                                                    ); ?>
                                                </a>
                                            </div><!-- End .entry-meta -->

                                            <h2 class="entry-title">
                                                <a href="<?php the_permalink() ?>"><?php echo esc_html(the_title()) ?></a>
                                            </h2><!-- End .entry-title -->

                                            <div class="entry-cats">
                                                <?php
                                                $categories = get_the_category();

                                                if (!empty($categories)) {
                                                    echo 'in ';

                                                    $cats = array();

                                                    foreach ($categories as $cat) {
                                                        $cats[] = '<a href="' . esc_url(get_category_link($cat->term_id)) . '">'
                                                            . esc_html($cat->name) . '</a>';
                                                    }

                                                    echo implode(', ', $cats);
                                                }
                                                ?>
                                            </div><!-- End .entry-cats -->

                                            <div class="entry-content">
                                                <p><?php echo esc_html(the_excerpt()) ?></p>
                                                <a href="<?php the_permalink() ?>" class="read-more">Continue Reading</a>
                                            </div><!-- End .entry-content -->
                                        </div><!-- End .entry-body -->
                                    </div><!-- End .col-md-7 -->
                                </div><!-- End .row -->
                            </article><!-- End .entry -->
                        <?php }
                    } ?>


                    <nav aria-label="Page navigation">
                        <?php
                        global $wp_query;

                        $big = 999999999; // need an unlikely integer
                        
                        $pagination = paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $wp_query->max_num_pages,
                            'prev_text' => '<span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev',
                            'next_text' => 'Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>',
                            'type' => 'array', // 🔥 important
                        ));

                        if (!empty($pagination)):
                            ?>
                            <ul class="pagination">
                                <?php foreach ($pagination as $page): ?>
                                    <?php
                                    // Add classes manually
                                    $active = strpos($page, 'current') !== false ? ' active' : '';
                                    $disabled = strpos($page, 'dots') !== false ? ' disabled' : '';
                                    ?>
                                    <li class="page-item<?php echo $active . $disabled; ?>">
                                        <?php
                                        // Add page-link class to <a>
                                        echo str_replace('page-numbers', 'page-link', $page);
                                        ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </nav>
                </div><!-- End .col-lg-9 -->

                <aside class="col-lg-3">
                    <div class="sidebar">
                        <div class="widget widget-search">
                            <h3 class="widget-title">Search</h3><!-- End .widget-title -->

                            <form action="#">
                                <label for="ws" class="sr-only">Search in blog</label>
                                <input type="search" class="form-control" name="ws" id="ws" placeholder="Search in blog"
                                    required>
                                <button type="submit" class="btn"><i class="icon-search"></i><span
                                        class="sr-only">Search</span></button>
                            </form>
                        </div><!-- End .widget -->

                        <div class="widget widget-cats">
                            <h3 class="widget-title">Categories</h3><!-- End .widget-title -->

                            <ul>
                                <li><a href="#">Lifestyle<span>3</span></a></li>
                                <li><a href="#">Shopping<span>3</span></a></li>
                                <li><a href="#">Fashion<span>1</span></a></li>
                                <li><a href="#">Travel<span>3</span></a></li>
                                <li><a href="#">Hobbies<span>2</span></a></li>
                            </ul>
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">Popular Posts</h3><!-- End .widget-title -->

                            <ul class="posts-list">
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog/sidebar/post-1.jpg"
                                                alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 22, 2018</span>
                                        <h4><a href="#">Aliquam tincidunt mauris eurisus.</a></h4>
                                    </div>
                                </li>
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog/sidebar/post-2.jpg"
                                                alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 19, 2018</span>
                                        <h4><a href="#">Cras ornare tristique elit.</a></h4>
                                    </div>
                                </li>
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog/sidebar/post-3.jpg"
                                                alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 12, 2018</span>
                                        <h4><a href="#">Vivamus vestibulum ntulla nec ante.</a></h4>
                                    </div>
                                </li>
                                <li>
                                    <figure>
                                        <a href="#">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog/sidebar/post-4.jpg"
                                                alt="post">
                                        </a>
                                    </figure>

                                    <div>
                                        <span>Nov 25, 2018</span>
                                        <h4><a href="#">Donec quis dui at dolor tempor interdum.</a></h4>
                                    </div>
                                </li>
                            </ul><!-- End .posts-list -->
                        </div><!-- End .widget -->

                        <div class="widget widget-banner-sidebar">
                            <div class="banner-sidebar-title">ad box 280 x 280</div><!-- End .ad-title -->

                            <div class="banner-sidebar banner-overlay">
                                <a href="#">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog/sidebar/banner.jpg"
                                        alt="banner">
                                </a>
                            </div><!-- End .banner-ad -->
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">Browse Tags</h3><!-- End .widget-title -->

                            <div class="tagcloud">
                                <a href="#">fashion</a>
                                <a href="#">style</a>
                                <a href="#">women</a>
                                <a href="#">photography</a>
                                <a href="#">travel</a>
                                <a href="#">shopping</a>
                                <a href="#">hobbies</a>
                            </div><!-- End .tagcloud -->
                        </div><!-- End .widget -->

                        <div class="widget widget-text">
                            <h3 class="widget-title">About Blog</h3><!-- End .widget-title -->

                            <div class="widget-text-content">
                                <p>Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, pulvinar nunc
                                    sapien ornare nisl.</p>
                            </div><!-- End .widget-text-content -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

<?php get_footer(); ?>