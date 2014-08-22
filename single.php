<?php get_header(); ?>

<div id="content">

<div <?php if(function_exists('post_class')) : ?><?php post_class(); ?><?php else : ?>class="post post-<?php the_ID(); ?>"<?php endif; ?>>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h2><?php the_title(); ?></h2>
<p><?php echo gPPGetVideo($post->ID); ?></p>
<?php the_content(); ?>
</div>
<div class="clear"></div>

<div class="postmetadata alt">
	<?php //<small> ?>
		<?php { ?>
		<div class="icon"><span class="ui-icon ui-icon-clock"></span> <?php the_date() ?> at <?php the_time() ?></div> 
		<div class="icon"><span class="ui-icon ui-icon-folder-open"></span> <?php the_category(' | ') ?><?php if (get_the_tags()) the_tags(' | '); ?></div>
		<div class="icon"><span class="ui-icon ui-icon-signal-diag"></span>  <?php post_comments_feed_link('Feed'); ?></div> 
		<div id="dialog_link"><span class="ui-icon ui-icon-comment"></span><a href="#"> Comments</a></div>
		<div class="icon"><?php edit_post_link('Edit', '<span class="ui-icon ui-icon-pencil"></span>', ''); ?></div>
		<div id="post-nav">
		    <div class="post-nav-prev"><?php previous_post_link('%link', '<span class="ui-icon ui-icon-circle-triangle-w"></span> Previous', TRUE); ?></div>
		    <div class="post-nav-next"><?php next_post_link('%link', '<span class="ui-icon ui-icon-circle-triangle-e"></span> Next', TRUE); ?></div>
		</div>
		<?php } ?>
    <br class="clear" />
	<?php //</small> ?>
	<div class="clear"></div>
</div>

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