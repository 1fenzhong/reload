<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	<?php roots_post_before(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<?php roots_post_inside_before(); ?>
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<small>由 <a class="author" href="//jungle.1fenzhong.org/profile/<?php the_author(); ?>"><?php the_author(); ?></a> 发布于 <time pubdate datetime="<?php the_time('c'); ?>"><?php echo get_the_time('Y年n月j日') ?></time></small>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<footer>
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>' )); ?>
				<p><?php the_tags(); ?></p>
			</footer>
			<?php comments_template(); ?>
			<?php roots_post_inside_after(); ?>		
		</article>
	<?php roots_post_after(); ?>
<?php endwhile; // End the loop ?>