<?php
/**
 * Formats and list groups
 *
 * @subpackage Administration
 */

$group = elgg_extract('group', $vars);

$checkbox = elgg_view('input/checkbox', array(
	'name' => 'group_guids[]',
	'value' => $group->guid,
	'default' => false,
));

$created = elgg_echo('delete_groups:admin:group_created', array(elgg_view_friendly_time($group->time_created)));

$delete = elgg_view('output/url', array(
	'confirm' => elgg_echo('delete_groups:confirm_delete', array($group->name)),
	'href' => "action/delete_groups/delete?group_guids[]=$group->guid",
	'text' => elgg_echo('admin:group:delete')
));

$menu = 'delete';


if( $group->grouptype){
        $block = "<label>$group->name: $group->briefdescription : $group->grouptype</label>";
}else{
        $block = "<label>$group->name</label>";
}

$menu = <<<__END
        <ul class="elgg-menu elgg-menu-general elgg-menu-hz float-alt">
                <li>$delete</li>
        </ul>
__END;



echo elgg_view_image_block($checkbox, $block, array('image_alt' => $menu));
