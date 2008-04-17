<?php
require_once( '../../bit_setup_inc.php' );
include_once( KERNEL_PKG_PATH.'simple_form_functions_lib.php' );

$gBitSystem->verifyPermission( 'p_admin' );

$commentsModSettings = array();

if ( $gBitSystem->isPackageActive('moderation') ){
	$commentsModSettings = array(
		"comments_allow_moderation" => array(
			'label' => 'Allow admins to moderate comments',
			'note' => 'Checking this allows users with the permission to edit comments the ability to force moderation on comment posts. When comments are moderated they are automatically hidden until approved by a moderator. This is opt in, meaning you can limit the moderation requirement on a content by content basis.',
			'page' => '',
		),
		"comments_allow_owner_moderation" => array(
			'label' => 'Allow content creators to moderate comments on their content',
			'note' => 'This is similar to allowing admins to moderate comments, but this lets the creator of a content item to require and moderate the comments on the things they create. Administrators will also be able to admin those comments.',
			'page' => '',
		),
		"comments_moderate_all" => array(
			'label' => 'Require moderation of all comments',
			'note' => 'This forces all comments to be held for moderation before being published. We recommend this only if you are have extensive problems with spam or malicious comments; on high traffic sites this features requires a lot of hands on work to read all comments',
			'page' => '',
		),
	);

	$gBitSmarty->assign( 'commentsModSettings', $commentsModSettings );
}

$processForm = set_tab(); 

if( !empty( $_REQUEST['modcomments_prefs'] ) ) {
	foreach( array_keys( $commentsModSettings ) as $item ) {
		simple_set_toggle( $item, MODCOMMENTS_PKG_NAME );
	}

	$formValues = array('comments_per_page', 'comments_default_ordering', 'comments_default_display_mode' , 'comments_default_post_lines');
	foreach( $formValues as $item ) {
		simple_set_value( $item, MODCOMMENTS_PKG_NAME );
	}
}
?>
