<?php
/**
 * Spam Checkker
 * This plugin checks your groups database for spammers. 
 * Author Gerard Kanters
 * copyright Elgg 2013
 * https://www.centillien.com/
 * 
 * @package delete_groups
 */

elgg_register_event_handler('init', 'system', 'delete_groups_init');

function delete_groups_init() {

	$action_path = elgg_get_plugins_path() . "delete_groups/actions/";

        //Admin menu for spam check GK
       	elgg_extend_view('css/admin', 'delete_groups/css');
       	elgg_extend_view('js/elgg', 'delete_groups/js');

       	elgg_register_admin_menu_item('administer', 'groups', 'groups');

        //Register actions
	elgg_register_action('delete_groups/bulk_action', "$action_path/bulk_action.php", 'admin');
	elgg_register_action('delete_groups/delete', "$action_path/delete.php", 'admin');
}
