<?php
/**
 * Template for displaying search forms in Jobstride Resume
 *
 * @subpackage Jobstride Resume
 * @since 1.0
 * @version 0.1
 */
?>

<?php $luzuk_jobstride_resume_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e('Search for:','jobstride-resume'); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder','jobstride-resume' ); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
	</label>
	<button type="submit" class="search-submit"><?php echo esc_html_x( 'Search', 'submit button', 'jobstride-resume' ); ?></button>
</form>