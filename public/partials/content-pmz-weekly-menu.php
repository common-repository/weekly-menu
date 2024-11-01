<?php
/**
 * A template to display pmz-weekly-menu content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );


		$days = [
			'monday',
			'tuesday',
			'wednesday',
			'thursday',
			'friday',
			'saturday',
			'sunday'
		];

		$meals = [
			'breakfast',
			'lunch',
			'snack',
			'dinner'
		];

		$html = '<div class="pmz-weekly-menu-content">';

		foreach ( $days as $day ) {

			$dayValues = '';
			foreach ( $meals as $meal ) {
				$k = '_' . esc_attr( $day . '_' . $meal );
				$dayValues .= trim( esc_attr( get_post_meta( $post->ID, $k, true ) ) );
			}

			if($dayValues) {

				$html .= '<div class="panel panel-default day day-' . $day . '">';

				$html .= '<div class="panel-heading">' . __( ucfirst($day), 'pmz-weekly-menu' ) . '</div>';

				$html .= '<ul class="list-group">';

				foreach ( $meals as $meal ) {
					$k = '_' . esc_attr( $day . '_' . $meal );
					$value = esc_attr( get_post_meta( $post->ID, $k, true ) );

					if($value) {
						$html .= '
				<li class="list-group-item meal-' . $meal . '">
					<p><label>' . __( ucfirst($meal), 'pmz-weekly-menu' ) . '</label></p>
					<p>' . nl2br(esc_attr( $value )) . '</p>
				</li>';
					}

				}

				$html .= '</ul></div>';
			}
		}
		$html .= '<p class="clearfix"></p>';
		$html .= '</div>';
		echo $html;

		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->

