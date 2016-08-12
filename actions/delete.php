<?php
/**
 * Delete a group or groups by guid
 *
 * @package Elgg.Core.Plugin
 * @subpackage UserValidationByEmail
 */

$group_guids = get_input('group_guids');
$error = FALSE;

if (!$group_guids) {
        register_error(elgg_echo('delete_groups:errors:unknown_groups'));
        forward(REFERRER);
}

$access = access_get_show_hidden_status();
access_show_hidden_entities(TRUE);

foreach ($group_guids as $guid) {
        $group = get_entity($guid);
        if (!$group instanceof ElggGroup) {
                $error = TRUE;
                continue;
	}else{
		$group->delete();
	}
}

access_show_hidden_entities($access);

if (count($group_guids) == 1) {
        $message_txt = elgg_echo('delete_groups:messages:deleted_group');
        $error_txt = elgg_echo('delete_groups:errors:could_not_delete_group');
} else {
        $message_txt = elgg_echo('delete_groups:messages:deleted_groups');
        $error_txt = elgg_echo('delete_groups:errors:could_not_delete_groups');
}

if ($error) {
        register_error($error_txt);
} else {
        system_message($message_txt);
}

