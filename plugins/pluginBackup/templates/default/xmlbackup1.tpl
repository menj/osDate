<personal_details>
{foreach item=item key=key from=$data}
	<{$key}>{$item}</{$key}>
{/foreach}
</personal_details>
<user_preference>
{foreach item=item key=key from=$data2}
	<question id="{$item.questionid}" answerid="{$item.answer}" value="{$question[$item.questionid].question}">{$question[$item.questionid][$item.answer]}</question>
{/foreach}
</user_preference>
<user_choices>
{foreach item=item key=key from=$data3}
	<{$item.choice_name}>{$item.choice_value}</{$item.choice_name}>
{/foreach}
</user_choices>