<?php
get_header();
?>

<h1><?php the_title(); ?></h1>
<?php the_content(); ?>
<p><?php the_excerpt(); ?></p>
<img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php echo esc_attr__('No Image Found', 'tp-toolkit'); ?>">
<?php get_footer(); ?>