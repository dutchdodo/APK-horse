
	</main>
		
	<?php do_action( 'apk_content_end' ); ?>
	<?php do_action( 'apk_content_after' ); ?>


	<!-- <aside> -->
	<?php //if ( is_active_sidebar( 'home-bottom' ) ) { ?>
	<!-- <aside class="container mx-auto text-gray-500"> -->
		<?php //dynamic_sidebar( 'home-bottom' ); ?>
	<!-- </aside> -->
	<?php //} ?>
	<!-- </aside> -->


	<footer id="colophon">

		<nav id="footer-menu" aria-label="Sitemap navigatie" focusable="false" class="nav-links layout-grid-2 alignfull is-layout-constrained">
		<?php
		wp_nav_menu(
			array(
				'container'       => false,
				'menu_class'      => '',
				'submenu_class'	  => '',
				'theme_location'  => 'footer',
				'li_class'        => '',
				'a_class'        => '',
				'a_class_active'  => 'active',
				'fallback_cb'     => false,
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			)
		);
		?>
		</nav>

		<div id="companyinfo" class="wp-block-columns alignfull is-layout-flex">
			<section aria-labelledby="contact-heading" class="wp-block-column is-layout-flow">
				<h2 id="contact-heading">Contact</h2>

				<address>
					<p>Acupunctuurpraktijk Kan</p>
					<p>Zielhorsterweg 73</p>
					<p>3813 ZX Amersfoort</p>

					
					<p id="adres-information">
						<a href="tel:+31201234567">+31 20 123 4567</a><br />
						<a href="mailto:info@acupunctuurpraktijkkan.nl">info@acupunctuurpraktijkkan.nl</a>
					</p>
				</address>
			</section> 

			<!-- 3. Juridische bedrijfsgegevens -->
			<section aria-labelledby="footer-legal-title" class="wp-block-column is-layout-flow">
				<h2 id="footer-legal-title">Bedrijfsgegevens</h2>
				<dl>
					<dt>KvK-nummer</dt>
					<dd>12345678</dd>

					<dt>BTW-nummer</dt>
					<dd>NL123456789B01</dd>
				</dl>
			</section>
		</div>

		<!-- 5. Copyright -->
		<p id="copyright" class="wp-block-paragraph alignfull">&copy; 2026 Acupunctuurpraktijk Kan</p>

	

		<?php //if ( is_active_sidebar( 'footer' ) ) { ?>
		<!-- <div class="container mx-auto"> -->
			<?php //dynamic_sidebar( 'footer' ); ?>
		<!-- </div> -->
		<?php //} ?>

	</footer>


	<?php wp_footer(); ?>

</body>