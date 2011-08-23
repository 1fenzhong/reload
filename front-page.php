<?php get_header(); ?>
	<?php roots_content_before(); ?>
		<div id="content" class="<?php echo $roots_options['container_class']; ?>">	
		<?php roots_sidebar_before(); ?>
			<section id="sidebar" role="complementary">
			<?php roots_sidebar_inside_before(); ?>
				<div class="container">
				    <ul class="clearfix">
					<?php dynamic_sidebar("Home"); ?>
				    </ul>
				</div>
			<?php roots_sidebar_inside_after(); ?>
			</section><!-- /#sidebar -->
		<?php roots_sidebar_after(); ?>
		<?php roots_main_before(); ?>
			<section id="main" class="<?php echo $roots_options['main_class']; ?>" role="main">
				<div class="grid_16 container">
				    <div id="dream" class="grid_5 alpha">
					<?php $dream = new WP_Query("post_type=dream&showposts=6"); $counter=0; while($dream->have_posts()) : $dream->the_post(); $counter++;
					  $GLOBALS['more'] = false;
					  $content = get_the_content('载入全文 &raquo;');
					  $content = apply_filters('the_content', $content);
					?>
					<?php if ($counter == 1) :?>
					<div class="highlight container">
					    <article class="article">
						<header>
						    <h3><a class="hl-title" href="<?php the_permalink() ?>" title="<?php shorted_excerpt(400) ?>"><?php the_title() ?></a></h3>
						    <small class="meta">
							<?php human_readable_time() ?>
							<?php echo get_the_term_list($post->ID, 'dream_tag'); ?>
						    </small>
						</header>
						<div class="entry">
						    <?php 
						      $content = preg_replace('/<img(?:[^>]+?)>/', '', $content); // remove img tags
						      $content = preg_replace('/<a([^>]+?)><\/a>/', '', $content); // remove empty a tags
						      $content = preg_replace('/<p([^>]*?)><\/p>/', '', $content); // remove empty p tags
						      $content = preg_replace('/<object(.+?)<\/object>/', '', $content); // remove object tags
						      $content = preg_replace('/<video(.+?)<\/video>/s', '', $content); // remove video tags
						      echo $content; 
						    ?>
						</div>
					    </article>
					</div>

					<div class="middleware clearfix">
					    <h3>更多新鲜飞屋梦想</h3>
					    <div class="beauty"><img src="<?php echo get_template_directory_uri(); ?>/img/dream.png" alt="飞屋梦想号"></div>
					</div>

					<ul>
					    <?php else :?>
					    <li class="post">
						<h4><a class="title" href="<?php the_permalink() ?>" title="<?php shorted_excerpt(400) ?>"><?php the_title() ?></a></h4>
						<small class="meta">
						    <?php human_readable_time() ?>
						    <?php echo get_the_term_list($post->ID, 'dream_tag'); ?>
						</small>
					    </li>
					    <?php endif; ?>
					    <?php endwhile; ?>
					</ul>
				    </div>

				    <div id="lesson" class="grid_5">
					<?php $lesson = new WP_Query("category_name=lesson&showposts=6"); $counter=0; while($lesson->have_posts()) : $lesson->the_post(); $counter++;
					  $GLOBALS['more'] = false;
					  $content = get_the_content('载入全文 &raquo;');
					  $content = apply_filters('the_content', $content);
					?>
					<?php if ($counter == 1) :?>
					<div class="highlight container">
					    <article class="article">
						<header>
						    <h3><a class="hl-title" href="<?php the_permalink() ?>" title="<?php shorted_excerpt(400) ?>"><?php the_title() ?></a></h3>
						    <small class="meta">
							<time datetime="<?php echo date(DATE_W3C); ?>" pubdate><?php human_readable_time() ?></time>
							<?php the_tags('', ''); ?>
						    </small>
						</header>
						<div class="entry">
						    <?php if ( has_post_thumbnail() ) {
									      the_post_thumbnail('240');
									    } else {
						    ?>
						    <img src="<?php bloginfo('template_directory'); ?>/img/logo.gif" width="240" height="240" alt="<?php bloginfo('name'); ?>" />
						    <?php } ?>
						    <?php 
						      $content = preg_replace('/<img(?:[^>]+?)>/', '', $content); // remove img tags
						      $content = preg_replace('/<a([^>]+?)><\/a>/', '', $content); // remove empty a tags
						      $content = preg_replace('/<p([^>]*?)><\/p>/', '', $content); // remove empty p tags
						      $content = preg_replace('/<object(.+?)<\/object>/', '', $content); // remove object tags
						      $content = preg_replace('/<video(.+?)<\/video>/s', '', $content); // remove video tags
						      echo $content; 
						    ?>
						</div>
					    </article>
					</div>

					<div class="middleware clearfix">
					    <h3>最新出炉微课程</h3>
					    <div class="beauty"><img src="<?php echo get_template_directory_uri(); ?>/img/lesson.png"></div>
					</div>

					<ul>
					    <?php else :?>
					    <li class="post">
						<h4><a class="title" href="<?php the_permalink() ?>" title="<?php shorted_excerpt(400) ?>"><?php the_title() ?></a></h4>
						<small class="meta">
						    <time datetime="<?php echo date(DATE_W3C); ?>" pubdate><?php human_readable_time() ?></time>
						    <?php the_tags('', ''); ?>
						</small>
					    </li>
					    <?php endif; ?>
					    <?php endwhile; ?>
					</ul>
				    </div>

				    <div id="fly" class="grid_6 omega">
					<div class="fly">
					    <a href="http://jungle.1fenzhong.org/categories/苍蝇计划" title="苍蝇计划"><img src="<?php echo get_template_directory_uri(); ?>/img/project.png" alt="苍蝇计划" /></a>
					</div>

					<div class="highlight">
					    <div class="article">
						<?php
						  include_once(ABSPATH . WPINC . '/feed.php');

						  $rss = fetch_feed('http://jungle.1fenzhong.org/categories/苍蝇计划/feed.rss');
						  if (!is_wp_error( $rss ) ) :

						  $maxitems = $rss->get_item_quantity(5);

						  $rss_items = $rss->get_items(0, $maxitems);
						  endif;
						?>

						<ul>
						    <?php if ($maxitems == 0) echo '<li>No items.</li>';
						      else
						    foreach ( $rss_items as $item ) : $author = $item->get_author() ?>
						    <li class="post">
							<h4><a class="title" href="<?php echo esc_url( $item->get_permalink() ); ?>" title="<?php echo esc_html( $item->get_title() ); ?>"><?php echo esc_html( $item->get_title() ); ?></a></h4>
							<small class="meta"><?php echo human_time_diff($item->get_date('U'), current_time('timestamp'))." 前"; ?> by <a class="author" href="http://jungle.1fenzhong.org/profile/<?php echo $author->get_name(); ?>" title="<?php echo $author->get_name(); ?>在 jungle 的个人页面"><?php echo $author->get_name(); ?></a></small>
						    </li>
						    <?php endforeach; ?>
						</ul>
					    </div>
					</div>

					<div class="comments">
					    <ul>
						<?php
						  $args = array('status' => 'approve', 'number' => '5');
						  $comments = get_comments($args);
						foreach($comments as $comment) : { ?>
						<li>
						    <?php $url = 'http://jungle.1fenzhong.org/profile/'.$comment->comment_author;
						      $handle = curl_init($url);
						      curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
						      $response = curl_exec($handle);
						      $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
						      if($httpCode != 404) {
						    ?>
						    <a class="author" href="http://jungle.1fenzhong.org/profile/<?php echo $comment->comment_author; ?>" title="<?php echo $comment->comment_author; ?>在 jungle 的个人页面"><?php echo $comment->comment_author; ?></a>
						    <?php } else { ?>
						    <a rel="nofollow" href="<?php echo $comment->comment_author_url; ?>" title="<?php echo $comment->comment_author; ?>"><?php echo $comment->comment_author; ?></a>
						    <?php } ?> 吐嘈了 <a class="title" href="<?php echo get_permalink($comment->comment_post_ID); ?>" title=""><?php echo get_the_title($comment->comment_post_ID); ?></a>
						</li>
						<?php } endforeach;?>
					    </ul>
					</div>
				    </div>
				</div>
			</section><!-- /#main -->
		<?php roots_main_after(); ?>
		</div><!-- /#content -->
	<?php roots_content_after(); ?>
<?php get_footer(); ?>