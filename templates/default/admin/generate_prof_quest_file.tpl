{strip}
{assign var="page_hdr01_text" value="{lang mkey='generate_prof_quest_file'}"}
{assign var="page_title" value=$page_hdr01_text}
{include file="admin/admin_page_hdr01.tpl"}
<div class="module_detail_inside" style="text-align:left; padding:6px; ">
Profile question have been added to this file: {$file}<br />
<p>Please copy this to /language/lang_english/ as profile_questions.php. Also copy this to other language directories as profile_questions.php which you want to use and modify the text for that language.
</div>
{/strip}
