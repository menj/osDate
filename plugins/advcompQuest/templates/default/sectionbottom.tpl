	{if $ok!=2}
		<center><input type="submit" name="continue" value="Save and Continue" class="formbutton"/></center><br/>
		</form>
		{$lang.legend}
		<br/><br/>
	{else}
		<a href="plugin.php?plugin={$plugin_name}&amp;spage={$section}">{$lang.editresp}</a>
		<br/>
	{/if}
	<br/>
</div>
	</td>
</tr>
</table>