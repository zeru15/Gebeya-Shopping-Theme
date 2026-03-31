<?php get_header(); ?>

<main class="main">

    <!-- PAGE HEADER -->
    <div class="page-header text-center"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">
                <?php the_title(); ?>
            </h1>
        </div>
    </div>

    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo home_url(); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php the_title(); ?>
                </li>
            </ol>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <div class="page-content">
        <?php
        $is_elementor = class_exists('\Elementor\Plugin') &&
            \Elementor\Plugin::$instance->editor->is_edit_mode();
        ?>

        <?php if (!$is_elementor): ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                    <?php endif; ?>

                    <?php the_content(); ?>

                    <?php if (!$is_elementor): ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

</main>

<?php get_footer(); ?>