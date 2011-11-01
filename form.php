<?php

require('../../config.php');
require('auth.php');
require('insertidnumber_form.php');

$context = get_context_instance(CONTEXT_SYSTEM);

$PAGE->set_url("$CFG->httpswwwroot/auth/askidnumber/form.php");
$PAGE->set_context($context);
$PAGE->set_pagelayout('login');

$PAGE->navbar->add(get_string("loginsite"));
$PAGE->set_heading(get_string('pleaseinsertyouridnumber', 'auth_askidnumber'));

// Outuput start...
echo $OUTPUT->header();
echo $OUTPUT->box('Isikukoodi sisestamise teade ja siia alla vorm...');

// Form...
$form = new auth_insertidnumber_form();
if ($fromform=$form->get_data()) {
    print_r($fromform);
    die('here We update the data...');
} else {
    //print_header_simple('eee1', '', "veateated", $form->focus(), "", false); 
    $form->set_data($fromform);
}
$form->display();

echo $OUTPUT->footer();

