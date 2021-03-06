 {* Тема оформления Experience v.1.0  для Alto CMS      *}
 {* @licence     CC Attribution-ShareAlike  http://site.creatime.org/experience/*}

<div class="panel panel-default panel-search flat">

    <div class="panel-body">
        <h2 class="panel-header">
            {$aLang.blog_admin}: <a class="link link-lead link-dark link-clear" href="{$oBlogEdit->getUrlFull()}">{$oBlogEdit->getTitle()|escape:'html'}</a>
        </h2>

    </div>

    <div class="panel-footer">
        <a class="small link link-light-gray link-clear link-lead {if $sMenuItemSelect=='profile'}active{/if}" href="{router page='blog'}edit/{$oBlogEdit->getId()}/">
            <i class="fa fa-pencil"></i>&nbsp;{$aLang.blog_admin_profile}
        </a>
        <a class="small link link-light-gray link-clear link-lead {if $sMenuItemSelect=='admin'}active{/if}" href="{router page='blog'}admin/{$oBlogEdit->getId()}/">
            <i class="fa fa-cogs"></i>&nbsp;{$aLang.blog_admin_users}
        </a>

        {hook run='menu_blog_edit_admin_item'}

    </div>

    {hook run='menu_blog_edit'}

</div>