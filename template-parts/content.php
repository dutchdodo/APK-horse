
<!-- <article id="post-<?php //the_ID(); ?>" <?php //post_class(); ?>> -->
<article>

	<header>
		<?php if ( is_front_page() ) {
			the_title( sprintf( '<h1 id="title" class="sr-only">', esc_url( get_permalink() ) ), '</h1>' );
		 } else {
 		  the_title( sprintf( '<h1 id="title">', esc_url( get_permalink() ) ), '</h1>' );
		 } ?>
	</header>

	<?php if ( is_search() || is_archive() ) : ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

	<?php else : ?>

		<?php
		/* translators: %s: Name of current post */
		the_content(
			sprintf(
				__( 'Continue reading %s', 'apk' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			)
		);

		wp_link_pages(
			array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'apk' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'apk' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			)
		);
		?>

	<?php endif; ?>

</article>
