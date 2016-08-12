<?php
/**
 * Plugin settings
 */
$input_options = array(
	"40" => elgg_echo("40"),
	"100" => elgg_echo("100"),
	"250" => elgg_echo("250"),
	"500" => elgg_echo("500"),
);

$delete_groups_input = $vars['entity']->delete_groups_input;

echo elgg_echo('delete_groups:delete_groups_input');
echo '<br><br>';
echo elgg_view("input/dropdown", array("name" => "params[delete_groups_input]", "value" => $delete_groups_input, "options_values" => $input_options));
echo '<br><br>';
