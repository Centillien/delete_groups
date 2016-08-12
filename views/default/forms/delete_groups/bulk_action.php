<?php
/**
 * Admin area to view and delete groups
 *
 */
ini_set('max_execution_time', 120); //120 seconds

$delete_groups_input = elgg_get_plugin_setting("delete_groups_input","delete_groups");

if(!$delete_groups_input) {
        $delete_groups_input = '20';
}

$ia = elgg_set_ignore_access(TRUE);
$hidden_entities = access_get_show_hidden_status();
access_show_hidden_entities(TRUE);


$limit = get_input('limit', $delete_groups_input);
$offset = get_input('offset', 0);

$options = array(
	'type' => 'group',
	'limit' => $limit,
	'offset' => $offset,
	'count' => TRUE,
);


$count = elgg_get_entities($options);

if (!$count) {
	access_show_hidden_entities($hidden_entities);
	elgg_set_ignore_access($ia);

	echo autop(elgg_echo('admin:groups:nogroups'));
	return TRUE;
}

$options['count']  = FALSE;

$groups = elgg_get_entities($options);

access_show_hidden_entities($hidden_entities);
elgg_set_ignore_access($ia);


// setup pagination
$pagination = elgg_view('navigation/pagination',array(
	'base_url' => 'admin/groups/groups',
	'offset' => $offset,
	'count' => $count,
	'limit' => $limit,
));

$bulk_actions_checkbox = '<label><input type="checkbox" id="delete_groups-checkall" />'
	. elgg_echo('delete_groups:check_all') . '</label>';


$delete = elgg_view('output/url', array(
	'href' => 'action/delete_groups/delete/',
	'text' => '<h3>' . elgg_echo('admin:groups:delete') . '</h3>',
	'title' => elgg_echo('admin:groups:confirm_delete_checked'),
	'class' => 'delete_groups-submit',
	'is_action' => true,
	'is_trusted' => true,
));

$bulk_actions = <<<___END
	<ul class="elgg-menu elgg-menu-general elgg-menu-hz float-alt">
		<li>$delete</li>
	</ul>

	$bulk_actions_checkbox
___END;


if (is_array($groups) && count($groups) > 0) {
	$html = '<ul class="elgg-list elgg-list-distinct">';
	foreach ($groups as $group) {
			$html .= "<li id=\"delete-groups-{$group->guid}\" class=\"elgg-item delete_groups-item\">";
			$html .= elgg_view('delete_groups/groups', array('group' => $group)) ;
			$html .= '</li>';
		}
	$html .= '</ul>';
}

echo <<<___END
<div class="elgg-module elgg-module-inline spammer-module">
	<div class="elgg-head">
		$bulk_actions
	</div>
	<div class="elgg-body">
		$html
	</div>
</div>
___END;

if ($count > 5) {
        echo $bulk_actions;
}


echo $pagination;
