{if $gBitSystem->isPackageActive('moderation') &&
	( 
		( $gBitSystem->isFeatureActive( 'comments_allow_owner_moderation' ) && $gContent->hasUpdatePermission() ) || 
		( $gBitSystem->isFeatureActive( 'comments_allow_moderation' ) && ( $gBitUser->isAdmin() || $gContent->hasUserPermission('p_liberty_edit_comments') ) )
	)}
	{* comments_moderate_all we handle in comments_inc, no input value is required and its not an option *}
	<div class="form-group">
		{forminput label="checkbox"}
			<input type="checkbox" name="moderate_comments" id="moderate_comments" value="y" {if $gContent->getPreference( 'moderate_comments' )}checked="checked"{/if} />Moderate Comments
			{formhelp note="Comments will be hidden until you approve them."}
		{/forminput}
	</div>
{/if}
