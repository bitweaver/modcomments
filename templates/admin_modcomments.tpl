{strip}
	{form}
		<input type="hidden" name="page" value="{$page}" />

		{jstabs}
			{jstab title="Comment Moderation"}
			{if !$gBitSystem->isFeatureActive( 'liberty_display_status' )}
				<p>To use this feature you must also enabled display of content status. You can enable display of content status in the <a class="item" href="{$smarty.const.KERNEL_PKG_URL}admin/index.php?page=liberty" >{tr}Liberty Settings{/tr}</a></p>
			{/if}
			{legend legend="Moderation Settings"}
			{foreach from=$commentsModSettings key=item item=output}
				<div class="form-group">
					{formlabel label=$output.label for=$item}
					{forminput}
						{html_checkboxes name="$item" values="y" checked=$gBitSystem->getConfig($item) labels=false id=$item}
						{formhelp note=$output.note page=$output.page}
					{/forminput}
				</div>
			{/foreach}
			{/legend}
			{/jstab}
		{/jstabs}

		<div class="form-group submit">
			<input type="submit" class="btn btn-default" name="modcomments_prefs" value="{tr}Change preferences{/tr}" />
		</div>
	{/form}
{/strip}
