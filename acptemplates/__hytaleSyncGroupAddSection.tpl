{if HYTALE_SYNC_ENABLED && HYTALE_SYNC_IDENTITY && $groupID|isset}
	<div class="section">
		<h2 class="sectionTitle">{lang}wcf.acp.group.hytaleSection.hytaleSync.sectionTitle{/lang}</h2>

		{if $hytales|isset && $hytales|count > 0}
			<div class="tabMenuContainer" data-active="hytale-sync-{$hytales|array_keys|min}" data-store="activeTabMenuItem">
				<nav class="tabMenu">
					<ul>
						{foreach from=$hytales item=hytale}
							<li>
								<a href="#hytale-sync-{$hytale->getObjectID()}">{$hytale->getTitle()}</a>
							</li>
						{/foreach}
					</ul>
				</nav>

				{foreach from=$hytales item=hytale}
					<div id="hytale-sync-{$hytale->getObjectID()}" class="tabMenuContent hidden"
						data-name="hytale-sync-{$hytale->getObjectID()}" data-object-id="{$hytale->getObjectID()}">
						<nav class="contentHeaderNavigation">
							<ul>
								<li>
									<a href="{link controller='HytaleGroupAdd' id=$groupID hytaleID=$hytale->getObjectID()}{/link}" class="button">
										{icon size=16 name='pencil' type='solid'} {lang}wcf.acp.form.hytaleGroupAdd.formTitle.add{/lang}
									</a>
								</li>
								{event name='contentHeaderNavigation'}
							</ul>
						</nav>
						{if $hytaleGroups[$hytale->getObjectID()]|count > 0}
							<div class="section tabularBox">
								<table class="table jsObjectActionContainer" data-object-action-class-name="wcf\data\user\group\hytale\HytaleGroupAction">
									<thead>
										<tr>
											<th></th>
											<th>{lang}wcf.global.objectID{/lang}</th>
											<th>{lang}wcf.acp.group.hytaleSection.hytaleSync.list.hytaleName{/lang}</th>
											<th>{lang}wcf.acp.group.hytaleSection.hytaleSync.list.shouldHave{/lang}</th>
										</tr>
									</thead>
									<tbody class="jsReloadPageWhenEmpty">
										{foreach from=$hytaleGroups[$hytale->hytaleID] item=hytaleGroup}
											<tr class="jsObjectActionObject" data-object-id="{@$hytaleGroup->getObjectID()}">
												<td class="columnIcon">
													<a href="{link controller='HytaleGroupEdit' id=$hytaleGroup->getObjectID()}{/link}"
														title="{lang}wcf.global.button.edit{/lang}" class="jsTooltip">
														{icon size=16 name='pencil' type='solid'}
													</a>
													{objectAction action="delete" objectTitle=$hytaleGroup->getGroupName()}
												</td>
												<td class="columnID">{#$hytaleGroup->getObjectID()}</td>
												<td class="columnText">{$hytaleGroup->getGroupName()}</td>
												<td class="columnStatus">
													{if $hytaleGroup->getShouldHave()}
														{lang}wcf.acp.option.type.boolean.yes{/lang}
													{else}
														{lang}wcf.acp.option.type.boolean.no{/lang}
													{/if}
												</td>
											</tr>
										{/foreach}
								</tbody>
							</table>
						</div>
						{else}
							<p class="info">{lang}wcf.global.noItems{/lang}</p>
						{/if}
					</div>
				{/foreach}
			</div>
		{else}
			<p class="info">{lang}wcf.global.noItems{/lang}</p>
		{/if}
	</div>
{/if}