	{if $ok!=2}
		<center><input type="submit" value="Save and Continue" class="formbutton"/></center><br/>
		</form>
		<center><b>Page {$section} of {$smax}</b></center>
	{else}
		{$lang.legend}
		<br/><br/>
		<a href=plugin.php?plugin={$plugin_name}&amp;spage={$section}>{$lang.editresp}</a>
		<br/>
	{/if}
	<br/>
</div>
	</td>
</tr>
</table>