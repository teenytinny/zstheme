<?php get_header(); rewind_posts(); ?>

<div id="content" class="zs-archive">

<?php 

//アーティスト一覧リスト


function zsinc_catalogartistindex() {
$args = array( 'taxonomy' => 'catalog-artist' );

$terms = get_terms('catalog-artist', $args);

$count = count($terms); $i=0;
if ($count > 0) {
    //$cape_list = '<p class="catalog-artist-archive">';
    foreach ($terms as $term) {
        $i++;
    	$term_list .= '<li><a href="#' . $term->slug . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a></li>';
    	//if ($count != $i) $term_list .= ' &middot; '; 
	//else $term_list .= '</p>';
    }
    echo '<ul class="zs-artist-list">'.$term_list.'</ul>';
}
};
zsinc_catalogartistindex();


//アーティスト別アルバムリスト

$terms = get_terms("catalog-artist");
$count = count($terms);
if($count > 0){
     foreach ($terms as $term) {
	$artistname = $term->name;
	echo '<h2 class="artist-name" id="'.$term->slug.'">'.$term->name.'</h2>';
	echo '<div class="heightLineParent">';
	query_posts("catalog-artist=$artistname&posts_per_page=24&orderby=title&order=ASC");
	if (have_posts()) : 
	while (have_posts()) : the_post();
?>
<div <?php if(function_exists('post_class')) : ?><?php post_class(); ?><?php else : ?>class="post post-<?php the_ID(); ?>"<?php endif; ?>>
<h3><?php the_title() ?></h3>
<?php
	if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  		the_post_thumbnail();
	}
?>
<?php the_content(); ?>
<div class="clear"></div>
</div><!-- /catalog -->
<?php endwhile; ?>
</div><!-- /heightLineParent -->
<p class="zs_gototop"><a href="#">Page Top</a></p>
	<?php endif; ?>
<?php 
     }
 }
?>
<div class="clear"></div>
<?php zsinc_catalogartistindex(); //アーティスト一覧リスト ?>
<div class="nav-interior">
			<div class="prev"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="next"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
</div>
<div class="clear"></div>
</div>

<!-- Begin Footer -->
<?php get_footer(); ?>