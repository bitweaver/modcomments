{strip}
	{form}
		<input type="hidden" name="page" value="{$page}" />

		{jstabs}
			{jstab title="Comment Moderation"}
			<p>This feature is new and still in development, you may find it buggy.</p>
			{legend legend="Moderation Settings"}
			{foreach from=$commentsModSettings key=item item=output}
				<div class="row">
					{formlabel label=`$output.label` for=$item}
					{forminput}
						{html_checkboxes name="$item" values="y" checked=$gBitSystem->getConfig($item) labels=false id=$item}
						{formhelp note=`$output.note` page=`$output.page`}
					{/forminput}
				</div>
			{/foreach}
			{/legend}
			{/jstab}
		{/jstabs}

		<div class="row submit">
			<input type="submit" name="modcomments_prefs" value="{tr}Change preferences{/tr}" />
		</div>
	{/form}
{/strip}
