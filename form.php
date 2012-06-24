<?php

require_once('../../config.php');
require_once('auth.php');
require_once('insertidnumber_form.php');

// For security
if (empty($USER->id))
    throw new Exception('User is not logged in!');

$context = get_context_instance(CONTEXT_SYSTEM);

$PAGE->set_url("$CFG->httpswwwroot/auth/askidnumber/form.php");
$PAGE->set_context($context);
$PAGE->set_pagelayout('login');

//$PAGE->navbar->add(get_string("loginsite"));
$PAGE->set_heading(get_string('pleaseinsertyouridnumber', 'auth_askidnumber'));

// Form...
$form = new auth_insertidnumber_form();
if ($fromform=$form->get_data())
{   // Update the user profile...
    $USER->idnumber = $fromform->idnumber;
    $DB->update_record('user', $USER);
    $goto = isset($SESSION->wantsurl) ? $SESSION->wantsurl : $CFG->wwwroot;
    redirect($goto);    
}
else
    $form->set_data($fromform);

// Outuput start...
echo $OUTPUT->header();
echo $OUTPUT->box(get_string('youridnumberwhy', 'auth_askidnumber'));
$form->display();
echo $OUTPUT->footer();

