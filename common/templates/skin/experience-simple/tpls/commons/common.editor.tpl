 {* Тема оформления Experience v.1.0  для Alto CMS      *}
 {* @licence     CC Attribution-ShareAlike  http://site.creatime.org/experience/*}

{if !$sImgToLoad}
    {assign var="sImgToLoad" value="topic_text"}
{/if}

{include_once file='modals/modal.upload_img.tpl' sToLoad=$sImgToLoad}
{include_once file='modals/modal.insert_img.tpl'}
{if Config::Get('view.wysiwyg')}
    {include_once file="editors/editor.tinymce.tpl"}
{else}
    {include_once file="editors/editor.markitup.tpl"}
{/if}
