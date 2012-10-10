<?php

require_once('../../config.php');
require_once('auth.php');
require_once('insertidnumber_form.php');

$context = get_context_instance(CONTEXT_SYSTEM);

$PAGE->set_url("$CFG->httpswwwroot/auth/askidnumber/form.php");
$PAGE->set_context($context);
$PAGE->set_pagelayout('login');

$PAGE->set_heading(get_string('pleaseinsertyouridnumber', 'auth_askidnumber'));

// Form...
$form = new auth_insertidnumber_form();
if ($fromform=$form->get_data()) {
    $ask = new auth_plugin_askidnumber();
    $ask->update_user_profile($fromform->secret, $fromform->idnumber);
    $goto = isset($SESSION->wantsurl) ? $SESSION->wantsurl : $CFG->wwwroot;
    redirect($goto);    
} else if (!$form->is_submitted()) {
    $key = required_param('key', PARAM_ALPHANUM);
    $form->set_data(array('secret' => $key));
}

// Outuput start...
echo $OUTPUT->header();
echo $OUTPUT->box(get_string('youridnumberwhy', 'auth_askidnumber'));
$form->display();
echo $OUTPUT->footer();

