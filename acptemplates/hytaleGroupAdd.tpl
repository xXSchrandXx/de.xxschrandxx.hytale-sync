{include file='header' pageTitle='wcf.acp.form.hytaleGroupAdd.formTitle.'|concat:$action}

<header class="contentHeader">
    <div class="contentHeaderTitle">
        <h1 class="contentTitle">{lang}wcf.acp.form.hytaleGroupAdd.formTitle.{$action}{/lang}</h1>
    </div>

    <nav class="contentHeaderNavigation">
        <ul>
            <li>
				<a href="{link controller='UserGroupEdit' id=$groupID}#hytale-sync-{$hytaleID}{/link}" class="button">
                	{lang}wcf.global.button.back{/lang}
				</a>
			</li>
            {event name='contentHeaderNavigation'}
        </ul>
    </nav>
</header>

{@$form->getHtml()}

{include file='footer'}