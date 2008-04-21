<?php
$registerHash = array(
	'package_name' => 'modcomments',
	'package_path' => dirname( __FILE__ ).'/',
	'service' => LIBERTY_SERVICE_MODCOMMENTS,
);
$gBitSystem->registerPackage( $registerHash );

if( $gBitSystem->isPackageActive( 'modcomments' ) ) {
	require_once( MODCOMMENTS_PKG_PATH.'modcomments_lib.php' );

	$gLibertySystem->registerService( LIBERTY_SERVICE_MODCOMMENTS, MODCOMMENTS_PKG_NAME, array(
		'content_store_function'	=> 'modcomments_content_store',
		'content_list_sql_function' => 'modcomments_content_list_sql',
		'content_body_tpl'          => 'bitpackage:modcomments/service_content_body_inc.tpl',
	) );
}
?>
