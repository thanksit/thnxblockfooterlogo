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
{*
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}