<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package auditif
 */

get_header();
?>

	<main id="primary" class="site-main">
	
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					
				</header>
				<?php
			endif;

			$headerImage = get_theme_mod( 'header_image', get_theme_support( 'custom-header', 'default-image' ) );

			if ( $headerImage ) {
				?>
				<!-- div with imgga in style background-image -->
				<div class="header-image" style="background-image: url('<?php echo esc_url( $headerImage ); ?>');">
					<div class="header-image-text">
						<h1><?php bloginfo( 'name' ); ?></h1>
						<p><?php bloginfo( 'description' ); ?></p>
					</div>
				</div>
				<?php
			}

			// Get page section-1  title content and feaatured image and display it
			$section1 = get_page_by_path( 'section-1' );
			$section1Title = $section1->post_title;
			$section1Content = $section1->post_content;
			$section1FeaturedImage = get_the_post_thumbnail_url( $section1->ID, 'full' );
			?>
			<div class="section image-left">
				<div class="image-container" style="background-image: url('<?php echo esc_url( $section1FeaturedImage ); ?>');"></div>
				<div class="content-container">
					<h2><?php echo esc_html( $section1Title ); ?></h2>
					<p><?php echo  $section1Content ?></p>
				</div>
			</div>
			<?php

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					// For each post with category event , get the title, content and featured image
					if ( has_category( 'events' ) ) {
						// use by alternance content h2 first or image first
						if ( $i % 2 ) {
							?>
							<div class="section image-left">
								<div class="image-container" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>');"></div>
								<div class="content-container">
									<h2><?php the_title(); ?></h2>
									<p><?php the_content(); ?></p>
								</div>
							</div>
							<?php
						} else {
							?>
							<div class="section image-left">
								<div class="content-container">
									<h2><?php the_title(); ?></h2>
									<p><?php the_content(); ?></p>
								</div>
								<div class="image-container" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url() ); ?>');"></div>
							</div>
							<?php
						}
						$i++;

						
					}
				endwhile;

				the_posts_navigation();


			$section2 = get_page_by_path( 'section-2' );
			$section2Title = $section2->post_title;
			$section2Content = $section2->post_content;
			$section2FeaturedImage = get_the_post_thumbnail_url( $section2->ID, 'full' );
			?>
			<div class="section image-left">
				<div class="content-container">
					<h2><?php echo esc_html( $section2Title ); ?></h2>
					<p><?php echo  $section2Content ?></p>
				</div>
				<div class="image-container" style="background-image: url('<?php echo esc_url( $section2FeaturedImage ); ?>');"></div>
			</div>

			<?php



		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
