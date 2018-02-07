<div class="footer_logo_contact_info col-md-3 clearfix">
	{if isset($thnxlogo_img)}
	<div class="thnxblockfooterlogo block footer_logo">
		<div class="block_content">
			<div class="logo">
				<a href="{$urls.base_url}" title="{$shop.name}">
					<img class="img-responsive" {if isset($thnxlogo_height)} height="{$thnxlogo_height}" {/if} {if isset($thnxlogo_width)} width="{$thnxlogo_width}" {/if} src="{$thnxlogo_img|escape:'htmlall':'UTF-8'}" alt="" title=""/>
				</a>
			</div>
			{if ($thnxlogo_desc !='')}
				<div class="logo_desc">
					{$thnxlogo_desc}
				</div>
			{/if}
		</div>
	</div>
	{/if}
	{hook h="displayFooterLogoContact"}
</div>