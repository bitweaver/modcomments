<?php

global $gBitInstaller;

$gBitInstaller->registerPackageInfo( MODCOMMENTS_PKG_NAME, array(
	'description' => 'Allow admins or content creators to moderate comments.',
	'license' => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>',
) );

// ### Default Preferences
$gBitInstaller->registerPreferences( MODCOMMENTS_PKG_NAME, array(
//	array( NEXUS_PKG_NAME, 'nexus_menu_text', 'Menus' ),
) );

?>
