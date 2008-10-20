{if $gBitSystem->isFeatureActive( 'liberty_display_status' ) && $serviceHash.content_type_guid == "bitcomment" && !is_null($serviceHash.content_status_id) && $serviceHash.content_status_id != 50}
	<p class="liberty_status">{biticon iname=dialog-warning iexplain="Warning"} {tr}This comment is <strong>{$gContent->getContentStatusName($serviceHash.content_status_id)}</strong>{/tr}.
		{if $serviceHash.content_status_id == -1 && $gBitSystem->isPackageActive('moderation') &&
			( 
				( $gBitSystem->isFeatureActive( 'comments_allow_owner_moderation' ) && $gContent->hasUpdatePermission() ) || 
				( ($gBitSystem->isFeatureActive( 'comments_allow_moderation' ) || $gBitSystem->isFeatureActive( 'comments_moderate_all' )) && ( $gBitUser->isAdmin() || $gContent->hasUserPermission('p_liberty_edit_comments') ) )
			)}
		<a href="{$smarty.const.MODERATION_PKG_URL}index.php?moderation_id={$serviceHash.moderation_id}">Approve/Reject</a>
		{/if}
	</p>
{/if}
