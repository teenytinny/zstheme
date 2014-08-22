<?php get_header(); ?>

<div id="content" class="zs-single">
<div <?php if(function_exists('post_class')) : ?><?php post_class(); ?><?php else : ?>class="post post-<?php the_ID(); ?>"<?php endif; ?>>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h2><?php the_title(); ?></h2>
<?php if ( has_post_thumbnail() ) :  // check if the post has a Post Thumbnail assigned to it. ?>
<div class="thumbnail"><?php the_post_thumbnail(); ?></div>
<?php endif; ?>
<?php the_content(); ?>

</div>
<div class="clear"></div>


<div id="dialog" title="Comments">
<?php comments_template('', true); ?>
</div>

<div class="clear"></div>
			<?php endwhile; else : ?>

				<h2 class="center">Not Found</h2>
				<p class="center">Sorry, but you are looking for something that isn't here.</p>
				<?php get_search_form(); ?>

			<?php endif; ?>    

</div>

<!-- Begin Footer -->
<?php get_footer(); ?>