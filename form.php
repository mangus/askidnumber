<?php

require('../../config.php');
require('insertidnumber_form.php');

$context = get_context_instance(CONTEXT_SYSTEM);

$PAGE->set_url("$CFG->httpswwwroot/auth/requreidnumber/form.php");
$PAGE->set_context($context);
$PAGE->set_pagelayout('login');

$loginsite = get_string("loginsite");
$PAGE->navbar->add($loginsite);
$PAGE->set_heading('Palun sisesta oma isikukood');

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

