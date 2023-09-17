{strip}

{if $questionrow.control_type == "select"}
	<div >
		<select name={$questionrow.id}{$questionrow.mandatory} class=select style="WIDTH: 100px">
			{html_options options=$questionrow.options selected=$questionrow.userpref}
		</select>
	</div>
{elseif $questionrow.control_type == "radio"}
	<div>
		{foreach key=key item=curropt from=$questionrow.options}
			{if $key == $questionrow.userpref[0]}
				<input name={$questionrow.id}{$questionrow.mandatory} type=radio value="{$key}" checked>{$curropt} <br />
			{else}
				<input name={$questionrow.id}{$questionrow.mandatory} type=radio value="{$key}">{$curropt} <br />
			{/if}
		{/foreach}
	</div>
{elseif $questionrow.control_type == "checkbox"}
	<div>
		{html_checkboxes name=$questionrow.id|cat:$questionrow.mandatory options=$questionrow.options selected=$questionrow.userpref separator=<br/>}
	</div>
{elseif $questionrow.control_type == "textarea"}
	<div>
		<textarea name={$questionrow.id}{$questionrow.mandatory} rows=7 cols=100>{$questionrow.userpref[0]|stripslashes }</textarea>
	</div>
{/if}
{/strip}