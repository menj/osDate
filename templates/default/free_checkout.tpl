{strip}
{assign var="page_hdr01_text" value="{lang mkey='confirmation'}"}
{include file="page_hdr01.tpl"}
<div class="module_detail" style="vertical-align:top; padding:6px;">
	<form action="checkout_process.php" method="post">
	<input type="hidden" name="item_name" value="{$item_name}" />
	<input type="hidden" name="item_number" value="{$item_no}" />
	<input type="hidden" name="level_name" value="{$item_name}"/>
	<input type="hidden" name="user_id" value="{$smarty.session.UserId}" />
	<input type="hidden" name="user_level" value="{$item_no}" />
	<input type="hidden" name="paid_thru" value="free" />
	<input type='hidden' name='pay_txn_id' value="{$pay_txn_id}" />
		<div class="line_outer">
			<div class="line_top_bottom_pad">
				{lang mkey='info_confirm'}<br />
			</div>
			<div class="line_top_bottom_pad">
				{lang mkey='name'}&nbsp;{$smarty.session.FullName|stripslashes}
			</div>
			<div class="line_top_bottom_pad">
				{lang mkey='change_mship_to'}&nbsp;<b>{$item_name}</b>.
			</div>
			<div class="line_top_bottom_pad">
				<input type="submit" class="formbutton" value="{lang mkey='confirm'}"/>
			</div>
		</div>
	</form>
</div>
{/strip}
