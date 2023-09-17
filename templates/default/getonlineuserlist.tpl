{literal}
<script type="text/javascript">
function getOnlineUserList() {
    document.getElementById('onlineUserList').innerHTML="&nbsp;&nbsp;Loading...";
    osDatehttp.open('POST', 'getonlineuserlist.php',false);
    osDatehttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    osDatehttp.send("a=ping");
    osDatehandleResponse();
    setTimeout("getOnlineUserList()",(60 * 1000));
}
</script>
{/literal}
{strip}
<div class="leftside_detail">
	{assign var="leftcolumn_item_hdr_text" value="{lang mkey='online_users_txt'}"}
	{include file="leftcolumn_item_hdr.tpl"}
	<div id="onlineUserList" class="leftside_detail" style="overflow:auto; width:98%;  height:80px; padding-left: 2px;" align="left">
	test
	</div>
</div>
{/strip}
<script type="text/javascript">
	getOnlineUserList();
</script>