<?php

/*
 * Elgg Forms
 * Kevin Jardine
 * Radagast Solutions
 * http://radagast.biz
 *
 * The main form for creating and changing forms.
 *
 */
 
// Load Elgg engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
    
// Define context
set_context('form:content');

global $CONFIG;

$form_data_id = get_input('d',0);
$form_data = $fd = get_entity($form_data_id);
$form_id = $form_data->form_id;
if($form_data->canEdit()) {
	add_submenu_item(elgg_echo('form:edit_content'),$CONFIG->wwwroot.'mod/form/form.php?id='.$form_id.'&d='.$form_data_id,'0formadmin');
	add_submenu_item(elgg_echo('form:delete_content'),$CONFIG->wwwroot.'action/form/manage_form_data?form_action=delete&d='.$form_data_id,'0formadmin');
}
set_input('form_id',$form_id);
$form = get_entity($form_id);

$body = elgg_view('form/display_object',array('form_data'=>$form_data, 'form'=>$form));

$title = sprintf(elgg_echo('form:display_object_title'),$form->title);

page_draw($title,elgg_view_layout("two_column_left_sidebar", '', elgg_view_title($title) . $body));

?>