{strip}
<div class="floaticon">{bithelp}</div>

<div class="admin modcomments">
	<div class="header">
		<h1>{tr}Comment Moderation Settings{/tr}</h1>
	</div>

	<div class="body">
	{form}
		{jstabs}
			{jstab title="Comment Moderation"}
			<p>This feature is new and still in development, you may find it buggy.</p>
			{legend legend="Moderation Settings"}
			{foreach from=$commentModerationSettings key=item item=output}
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
			<input type="submit" name="change_prefs" value="{tr}Change preferences{/tr}" />
		</div>
	{/form}
	</div><!-- end .body -->
</div><!-- end .liberty -->
{/strip}
