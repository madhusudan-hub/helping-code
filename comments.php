<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package neha
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if( post_password_required() ){
	return;
}
?>

<div id="comments" class="comments-area">
	<div class="leave-comment">
		<?php if( have_comments() ):?>
			<h4 class="blog-dec-title">
				<?php
					printf(
						esc_html( _nx( 'One Comment on &ldquo;%2$s&rdquo;', '%1$s Comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'neha' ) ),
						number_format_i18n( get_comments_number() ),
						'<span>' . get_the_title() . '</span>'
					);
				?>
			</h4>
			<?php neha_get_post_navigation(); ?>
			
			<ol class="comment-list">
				<?php 

					wp_list_comments( 'type=pingback&callback=neha_pingback' );
					
					wp_list_comments( 'type=comment&callback=neha_comment' );
				?>
				
			</ol>
			
			<?php neha_get_post_navigation(); ?>
			
			<?php 
				if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
				 <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'neha' ); ?></p>
				 
			<?php
				endif;
			?>
			
		<?php	
			endif;
		?>
		<?php 
			
			$fields = array(
				'author' =>
					'<div class="col-md-6"><div class="leave-form"><input id="author" name="author" type="text" placeholder=" '. esc_attr__('Your Name *', 'neha') .' " value="' . esc_attr( $commenter['comment_author'] ) . '" required="required" /></div></div>',
					
				'email' =>
					'<div class="col-md-6"><div class="leave-form"><input id="email" name="email" placeholder=" '. esc_attr__( 'Your Email *', 'neha' ) .' " type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required="required" /></div></div>',
			);
			
			$args = array(
				'label_submit' => esc_html__( 'Submit Comment', 'neha' ),
				'fields' => apply_filters( 'comment_form_default_fields', $fields ),
				'comment_field' =>'<div class="col-md-12"><div class="text-leave"><textarea id="comment" name="comment" placeholder="'. esc_attr__( 'Your comment here.', 'neha' ) .'"  required="required"></textarea></div></div>',
				'title_reply' => esc_html__('Leave a comment','neha'),
				'title_reply_before' => '<h4 class="blog-dec-title">',
				'title_reply_after' => '</h4>',
				'submit_button' =>  '<div class="col-12"><div class="text-leave"><input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" /></div></div>',
				'class_submit' => 'submit btn-hover',
				'class_form' =>'row',
				'logged_in_as' =>'<div class="col-md-12"><p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','neha' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p></div>',
			);
			
			comment_form( $args ); 
			
		?>
	</div>
</div><!-- .comments-area -->