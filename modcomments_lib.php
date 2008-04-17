<?php
/**
 * Load up our moderation handlers
 */
require_once( MODCOMMENTS_PKG_PATH.'comments_moderation_inc.php' );

function modcomments_content_store( &$pObject, &$pParamHash ){
	global $gBitSystem, $gBitUser, $gModerationSystem;
	if ( $pObject->mType['content_type_guid'] == 'bitcomment' ){
		// load up root content since we don't have one
		$rootContent = LibertyBase::getLibertyObject( $pParamHash['root_id'] );

		// hold comments for moderation - requires moderation package is installed
		if(	$gBitSystem->isPackageActive('moderation') &&
			empty( $_REQUEST['post_comment_id'] ) &&
			!( $rootContent->isOwner() || $gBitUser->isAdmin() ) && 
			( $gBitSystem->isFeatureActive( 'comments_moderate_all' ) ||
			  (( $gBitSystem->isFeatureActive( 'comments_allow_moderation' ) || $gBitSystem->isFeatureActive('comments_allow_owner_moderation')) && 
				 $rootContent->getPreference( 'moderate_comments' ))
			)){
			// if we are enforcing moderation on the comment then change the status_id
			$pObject->storeStatus( -1 );
			// prep info what we'll store in the moderation ticket
			$modMsg = tra( "A comment has been submitted to " ).$rootContent->mType['content_description']." ".$rootContent->getTitle();
			$modDataHash = array( 'display_url' => $pObject->getDisplayUrl() );
			if ( $gBitSystem->isFeatureActive('comments_allow_owner_moderation') ){
				$modUserId = $rootContent->mInfo['user_id'];
			}else{
				$modUserId = 2; //assign it to admin rather than the owner so as to prevent content owner from accessing if they should not be able to
			}
			// register it for moderation
			$pendingModeration = $gModerationSystem->requestModeration( 'liberty', 
																		'comment_post', 
																		$modUserId,
																		NULL, 
																		'p_liberty_edit_comments',
																		$pObject->mContentId, 
																		$modMsg, 
																		MODERATION_PENDING, 
																		$modDataHash
																	);
		}
	}
}

function modcomments_content_list_sql( &$pObject, $pParamHash ){
	global $gBitSystem, $gBitUser;
	$ret = array();
	if ( $pObject->mType['content_type_guid'] == 'bitcomment' ){
		// if comment moderation is enabled join onto the moderation table to get references
		if ( $gBitSystem->isFeatureActive('liberty_display_status') &&
			 $gBitSystem->isPackageActive('moderation')
			 /* would like to enforce access to the moderations along these terms
			  * the problem is we can't do a real check because we don't have a reference to the parent content object
			 && ( 
				( $gBitSystem->isFeatureActive( 'comments_allow_owner_moderation' ) && $gContent->hasEditPermission() ) ||
				( 
					( $gBitSystem->isFeatureActive( 'comments_moderate_all' ) || $gBitSystem->isFeatureActive( 'comments_allow_moderation' ) ) && 
					( $gBitUser->isAdmin() || $gContent->hasUserPermission('p_liberty_edit_comments') )
				)
			 )
			 */
		   ){
			// where we have a status_id of -1 join to moderation table
			$ret['select_sql'] = ", m.`moderation_id`";
			$ret['join_sql'] = " LEFT OUTER JOIN `".BIT_DB_PREFIX."moderation` m ON (m.`content_id` = lc.`content_id`) ";
		}
	}
	return $ret;
}
?>
