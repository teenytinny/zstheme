<?php
/*
Template Name: Page Widget
*/
?>
<?php get_header(); ?>
    <div id="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php if(function_exists('post_class')) : ?><?php post_class(); ?><?php else : ?>class="post post-<?php the_ID(); ?>"<?php endif; ?>>
			<h2><?php the_title(); ?></h2>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Widget-page') ) : ?>
				<?php endif; ?>
			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
	</div>
		<?php endwhile; endif; ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
<?php get_footer(); ?>