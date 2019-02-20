<?php 
/*
 Plugin Name: Katib Writers Pro Posttype
 lugin URI: https://www.themeseye.com/
 Description: Creating new post type for Katib Writers Pro Theme.
 Author: Themeseye
 Version: 1.0
 Author URI: https://www.themeseye.com/
*/

define( 'KATIB_WRITERS_PRO_POSTTYPE_VERSION', '1.0' );

add_action( 'init', 'katib_writers_pro_posttype_create_post_type' );

function katib_writers_pro_posttype_create_post_type() { 
  register_post_type( 'popular',
    array(
        'labels' => array(
            'name' => __( 'Popular','katib-writers-pro-posttype' ),
            'singular_name' => __( 'Popular','katib-writers-pro-posttype' )
        ),
        'capability_type' =>  'post',
        'menu_icon'  => 'dashicons-tag',
        'public' => true,
        'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'page-attributes',
        'comments'
        )
    )
  );
  register_post_type( 'events',
    array(
        'labels' => array(
            'name' => __( 'Events','katib-writers-pro-posttype' ),
            'singular_name' => __( 'Events','katib-writers-pro-posttype' )
        ),
        'capability_type' =>  'post',
        'menu_icon'  => 'dashicons-tag',
        'public' => true,
        'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'page-attributes',
        'comments'
        )
    )
  );
  register_post_type( 'testimonials',
    array(
  		'labels' => array(
  			'name' => __( 'Testimonials','katib-writers-pro-posttype' ),
  			'singular_name' => __( 'Testimonials','katib-writers-pro-posttype' )
  		),
  		'capability_type' => 'post',
  		'menu_icon'  => 'dashicons-businessman',
  		'public' => true,
  		'supports' => array(
  			'title',
  			'editor',
  			'thumbnail'
  		)
		)
	);
}

/*------------------ Testimonial section -------------------*/

/* Adds a meta box to the Testimonial editing screen */
function katib_writers_pro_posttype_bn_testimonial_meta_box() {
	add_meta_box( 'katib-writers-pro-posttype-testimonial-meta', __( 'Enter Details', 'katib-writers-pro-posttype' ), 'katib_writers_pro_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'katib_writers_pro_posttype_bn_testimonial_meta_box');
}

/* Adds a meta box for custom post */
function katib_writers_pro_posttype_bn_testimonial_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'katib_writers_pro_posttype_posttype_testimonial_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
	$desigstory = get_post_meta( $post->ID, 'katib_writers_pro_posttype_testimonial_desigstory', true );
	?>
	<div id="testimonials_custom_stuff">
		<table id="list">
			<tbody id="the-list" data-wp-lists="list:meta">
				<tr id="meta-1">
					<td class="left">
						<?php _e( 'Designation', 'katib-writers-pro-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="katib_writers_pro_posttype_testimonial_desigstory" id="katib_writers_pro_posttype_testimonial_desigstory" value="<?php echo esc_attr( $desigstory ); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
}

/* Saves the custom meta input */
function katib_writers_pro_posttype_bn_metadesig_save( $post_id ) {
	if (!isset($_POST['katib_writers_pro_posttype_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['katib_writers_pro_posttype_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Save desig.
	if( isset( $_POST[ 'katib_writers_pro_posttype_testimonial_desigstory' ] ) ) {
		update_post_meta( $post_id, 'katib_writers_pro_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'katib_writers_pro_posttype_testimonial_desigstory']) );
	}

}

add_action( 'save_post', 'katib_writers_pro_posttype_bn_metadesig_save' );

/*------------------ Most Popular section -------------------*/

/* Adds a meta box to the Popular editing screen */
function katib_writers_pro_posttype_bn_popular_meta_box() {
  add_meta_box( 'katib-writers-pro-posttype-popular-meta', __( 'Enter Details', 'katib-writers-pro-posttype' ), 'katib_writers_pro_posttype_bn_popular_meta_callback', 'popular', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'katib_writers_pro_posttype_bn_popular_meta_box');
}

/* Adds a meta box for custom post */
function katib_writers_pro_posttype_bn_popular_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'katib_writers_pro_posttype_posttype_popular_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
  $desigstory = get_post_meta( $post->ID, 'katib_writers_pro_posttype_popular_desigstory', true );
  $date = get_post_meta( $post->ID, 'katib_writers_pro_posttype_popular_date', true );
  $comment = get_post_meta( $post->ID, 'katib_writers_pro_posttype_popular_comment', true );
  ?>
  <div id="testimonials_custom_stuff">
    <table id="list">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
            <?php _e( 'Designation', 'katib-writers-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="katib_writers_pro_posttype_popular_desigstory" id="katib_writers_pro_posttype_popular_desigstory" value="<?php echo esc_attr( $desigstory ); ?>" />
          </td>
        </tr>
        <tr id="meta-1">
          <td class="left">
            <?php _e( 'Date', 'katib-writers-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="katib_writers_pro_posttype_popular_date" id="katib_writers_pro_posttype_popular_date" value="<?php echo esc_attr( $date ); ?>" />
          </td>
        </tr>
        <tr id="meta-1">
          <td class="left">
            <?php _e( 'Comment', 'katib-writers-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="katib_writers_pro_posttype_popular_comment" id="katib_writers_pro_posttype_popular_comment" value="<?php echo esc_attr( $comment ); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

/* Saves the custom meta input */
function katib_writers_pro_posttype_bn_metadesigs_save( $post_id ) {
  if (!isset($_POST['katib_writers_pro_posttype_posttype_popular_meta_nonce']) || !wp_verify_nonce($_POST['katib_writers_pro_posttype_posttype_popular_meta_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Save desig.
  if( isset( $_POST[ 'katib_writers_pro_posttype_popular_desigstory' ] ) ) {
    update_post_meta( $post_id, 'katib_writers_pro_posttype_popular_desigstory', sanitize_text_field($_POST[ 'katib_writers_pro_posttype_popular_desigstory']) );
  }
  if( isset( $_POST[ 'katib_writers_pro_posttype_popular_date' ] ) ) {
    update_post_meta( $post_id, 'katib_writers_pro_posttype_popular_date', sanitize_text_field($_POST[ 'katib_writers_pro_posttype_popular_date']) );
  }
  if( isset( $_POST[ 'katib_writers_pro_posttype_popular_comment' ] ) ) {
    update_post_meta( $post_id, 'katib_writers_pro_posttype_popular_comment', sanitize_text_field($_POST[ 'katib_writers_pro_posttype_popular_comment']) );
  }
}

add_action( 'save_post', 'katib_writers_pro_posttype_bn_metadesigs_save' );

/*------------------ Events section -------------------*/

/* Adds a meta box to the Popular editing screen */
function katib_writers_pro_posttype_bn_events_meta_box() {
  add_meta_box( 'katib-writers-pro-posttype-popular-meta', __( 'Enter Details', 'katib-writers-pro-posttype' ), 'katib_writers_pro_posttype_bn_events_meta_callback', 'events', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'katib_writers_pro_posttype_bn_events_meta_box');
}

/* Adds a meta box for custom post */
function katib_writers_pro_posttype_bn_events_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'katib_writers_pro_posttype_posttype_events_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
  $desigstory_events = get_post_meta( $post->ID, 'katib_writers_pro_posttype_events_desgination', true );
  $date_events = get_post_meta( $post->ID, 'katib_writers_pro_posttype_events_date', true );
  $comment_event = get_post_meta( $post->ID, 'katib_writers_pro_posttype_events_time', true );
  ?>
  <div id="events_custom_stuff">
    <table id="list">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
            <?php _e( 'Location', 'katib-writers-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="katib_writers_pro_posttype_events_desgination" id="katib_writers_pro_posttype_events_desgination" value="<?php echo esc_attr( $desigstory_events ); ?>" />
          </td>
        </tr>
        <tr id="meta-1">
          <td class="left">
            <?php _e( 'Date', 'katib-writers-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="katib_writers_pro_posttype_popular_date" id="katib_writers_pro_posttype_popular_date" value="<?php echo esc_attr( $date_events ); ?>" />
          </td>
        </tr>
        <tr id="meta-1">
          <td class="left">
            <?php _e( 'Time', 'katib-writers-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="katib_writers_pro_posttype_events_time" id="katib_writers_pro_posttype_events_time" value="<?php echo esc_attr( $comment_event ); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

/* Saves the custom meta input */
function katib_writers_pro_posttype_bn_metadesiges_save( $post_id ) {
  if (!isset($_POST['katib_writers_pro_posttype_posttype_events_meta_nonce']) || !wp_verify_nonce($_POST['katib_writers_pro_posttype_posttype_events_meta_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  // Save desig.
  if( isset( $_POST[ 'katib_writers_pro_posttype_events_desgination' ] ) ) {
    update_post_meta( $post_id, 'katib_writers_pro_posttype_events_desgination', sanitize_text_field($_POST[ 'katib_writers_pro_posttype_events_desgination']) );
  }
  if( isset( $_POST[ 'katib_writers_pro_posttype_popular_date' ] ) ) {
    update_post_meta( $post_id, 'katib_writers_pro_posttype_popular_date', sanitize_text_field($_POST[ 'katib_writers_pro_posttype_popular_date']) );
  }
  if( isset( $_POST[ 'katib_writers_pro_posttype_events_time' ] ) ) {
    update_post_meta( $post_id, 'katib_writers_pro_posttype_events_time', sanitize_text_field($_POST[ 'katib_writers_pro_posttype_events_time']) );
  }
}

add_action( 'save_post', 'katib_writers_pro_posttype_bn_metadesiges_save' );

/*------------ SHORTCODES ----------------*/

/*------------Testimonial Shorthcode -----------*/
function katib_writers_pro_posttype_testimonials_func( $atts ) {
    $testimonial = ''; 
    $testimonial = '<div id="testimonials" class="test_shortcode_bg"><div class="inner-test-bg row">';
      $new = new WP_Query( array( 'post_type' => 'testimonials') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = katib_writers_pro_string_limit_words(get_the_excerpt(),40);
          $designation = get_post_meta($post_id,'katib_writers_pro_posttype_testimonial_desigstory',true);

          $testimonial .= '<div class="col-md-6 w-100 float-left mb-4"> 
                <div class="testimonial_sbox w-100 mb-3">
                  
                  <div class="content_box w-100">
                    <div class="short_text pb-3">'.$excerpt.'</div>
                  </div>
                  <div class="textimonial-img">';
                  if (has_post_thumbnail()){
                    $testimonial.= '<img src="'.esc_url($url).'">';
                  }
                   $testimonial.= '</div>
                  <div class="testimonial-box">
                    <h4 class="testimonial_name"><a href="'.get_the_permalink().'">'.get_the_title().'</a> </h4>
                    <p class="test_para"><cite>'.esc_html($designation).'</cite></p>
                  </div>
                </div>
                
              </div><div class="clearfix"></div>';
          
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $testimonial.= '</div>';
      else :
        $testimonial = '<div id="testimonial" class="testimonial_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','katib-writers-pro-posttype').'</h2></div></div></div>';
      endif;
    return $testimonial;
}
add_shortcode( 'katib-writers-pro-testimonials', 'katib_writers_pro_posttype_testimonials_func' );

/*------------Events Shorthcode -----------*/
function katib_writers_pro_posttype_events_func( $atts ) {
    $events = ''; 
    $events = '<div id="events" class="test_shortcode"><div class="inner-tests-bg row">';
      $new = new WP_Query( array( 'post_type' => 'events') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = katib_writers_pro_string_limit_words(get_the_excerpt(),40);
          $date_events = get_post_meta($post_id,'katib_writers_pro_posttype_events_time',true);
          $desigstory_events = get_post_meta($post_id,'katib_writers_pro_posttype_events_desgination',true);
          $comment_event = get_post_meta($post_id,'katib_writers_pro_posttype_events_date',true);
          $events .= '<div class="col-md-6 col-lg-4 col-sm-6 w-100 float-left mb-4"> 
                <div class="box w-100 mb-3">
                  <div class="events-img box1"><div class="box-content1"></div>';
                  if (has_post_thumbnail()){
                    $events.= '<img src="'.esc_url($url).'">';
                  }
                   $events.= '</div>
                   <div class="box-content">
                     <h5><a href="'.get_the_permalink().'">'.get_the_title().'</a> </h5>
                      <div class="box-content-events">
                        <i class="fas fa-map-marker-alt"></i><span class="meta-eventss">'.esc_html($comment_event).'</span>
                        <i class="fas fa-clock"></i><span class="meta-eventss">'.esc_html($date_events).'</span>
                        <i class="fas fa-calendar"></i><span class="meta-eventss">'.esc_html($desigstory_events).'</span>
                      </div>
                   </div>
                </div>
              </div><div class="clearfix"></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $events.= '</div>';
      else :
        $events = '<div id="events" class="testimonial_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','katib-writers-pro-posttype').'</h2></div></div></div>';
      endif;
    return $events;
}
add_shortcode( 'katib-writers-pro-events', 'katib_writers_pro_posttype_events_func' );

/*------------Popular Shorthcode -----------*/
function katib_writers_pro_posttype_popular_func( $atts ) {
    $popular = ''; 
    $popular = '<div id="most-popular" class="test_shortcode"><div class="inner-tests-bg row">';
      $new = new WP_Query( array( 'post_type' => 'popular') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = katib_writers_pro_string_limit_words(get_the_excerpt(),40);
          $date = get_post_meta($post_id,'katib_writers_pro_posttype_popular_date',true);
          $desigstory = get_post_meta($post_id,'katib_writers_pro_posttype_popular_desigstory',true);
          $comment = get_post_meta($post_id,'katib_writers_pro_posttype_popular_comment',true);
          $popular .= '<div class="col-md-6 col-lg-4 w-100 float-left mb-4"> 
                <div class="box w-100 mb-3 featured-courses-contents">
                  <div class="popular-img box2">
                  <div class="box-content2"></div>';
                  if (has_post_thumbnail()){
                    $popular.= '<img src="'.esc_url($url).'">';
                  }
                   $popular.= '</div>
                   <div class="popular_titles">
                   <h5 class="popular-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a> </h5></div>
                  <div class="box-content-popular">
                    <span class="meta-popular">'.esc_html($comment).'</span>
                    <span class="meta-popular">'.esc_html($date).'</span>
                    <span class="meta-popular">'.esc_html($desigstory).'</span>
                  </div>
                </div>
              </div><div class="clearfix"></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $popular.= '</div>';
      else :
        $popular = '<div id="populars" class="popular_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','katib-writers-pro-posttype').'</h2></div></div></div>';
      endif;
    return $popular;
}
add_shortcode( 'katib-writers-pro-popular', 'katib_writers_pro_posttype_popular_func' );
