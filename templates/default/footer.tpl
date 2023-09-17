<div align='center' class="footer" style="line-height:25px;">
	{if $smarty.session.UserId <= 0}
		<a href='index.php?page=login' class='footerlink'>{lang mkey='site_links' skey='login'}</a> |&nbsp;
	{/if}
	{if $config.enable_mod_rewrite == 'Y'}
		<a href='privacy.html' class='footerlink'>{lang mkey='site_links' skey='privacy'}</a> |&nbsp;
		<a href='terms_of_use.html' class='footerlink'>{lang mkey='site_links' skey='terms_of_use'}</a> |&nbsp;
		<a href='services.html' class='footerlink'>{lang mkey='site_links' skey='services'}</a> |&nbsp;
		<a href='faq.html' class='footerlink'>{lang mkey='site_links' skey='faq'}</a> |&nbsp;
		<a href='articles.html' class='footerlink'>{lang mkey='site_links' skey='articles'}</a> |&nbsp;
	{else}
		<a href='index.php?page=privacy' class='footerlink'>{lang mkey='site_links' skey='privacy'}</a> |&nbsp;
		<a href='index.php?page=terms_of_use' class='footerlink'>{lang mkey='site_links' skey='terms_of_use'}</a> |&nbsp;
		<a href='index.php?page=services' class='footerlink'>{lang mkey='site_links' skey='services'}</a> |&nbsp;
		<a href='index.php?page=faq' class='footerlink'>{lang mkey='site_links' skey='faq'}</a> |&nbsp;
		<a href='index.php?page=articles' class='footerlink'>{lang mkey='site_links' skey='articles'}</a> |&nbsp;
	{/if}
	<a href='affindex.php' class='footerlink'>{lang mkey='site_links' skey='affliates'}</a> |&nbsp;
	<a href='tellafriend.php' class='footerlink'>{lang mkey='site_links' skey='invite_a_friend'}</a>
{* Feedback link depending on the option in global site settings *}
	{if ( $config.feedback_info == 'Y' && $smarty.session.UserId != '') or $config.feedback_info == 'N'}
		&nbsp;|&nbsp;
		<a href='feedback.php' class='footerlink'>{lang mkey='site_links' skey='feedback'}</a>
	{/if}
	{if $config.accept_supreq == 'Y' or $config.accept_supreq == '1'}
		&nbsp;|&nbsp;
		<a href='supreq.php' class='footerlink'>{lang mkey='site_links' skey='supreq'}</a>
	{/if}
</div>
<div align="center" style="margin-top: 6px;" class="footerlink">
	<a href="http://www.tufat.com/osdate.php" class='copyright' target="_blank">{$config.copyright}
				&copy;{php}echo date('Y'); {/php}
	</a>
	<br /><br />
</div>
