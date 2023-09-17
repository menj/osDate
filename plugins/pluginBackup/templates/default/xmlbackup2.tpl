<pics>
{foreach item=item key=key from=$data}
	<snap id="{$item.picno}">
		<picture>{$item.picture}</picture>
		<tnpicture>{$item.tnpicture}</tnpicture>
		<ins_time>{$item.ins_time}</ins_time>
		<picext>{$item.picext}</picext>
		<tnext>{$item.tnext}</tnext>
		<album_id>{$item.album_id}</album_id>
	</snap>
{/foreach}
</pics>