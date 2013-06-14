<?php
/**
 * @author Mart Mangus
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 *
 * Page where users can request exception not to insert their ID-number..
 *
 */

require_once('../../../config.php');
require_once('exceptions.php');
require_once('insert_form.php');

$context = context_system::instance();
$PAGE->set_url("$CFG->httpswwwroot/auth/askidnumber/exceptions/insert.php");
$PAGE->set_context($context);
$PAGE->set_pagelayout('login');
$PAGE->set_heading(get_string('exceptioninidnumberinsertion', 'auth_askidnumber'));

// Form...
$form = new askidnumber_exception_insert_form();
if ($fromform=$form->get_data()) {
    askidnumber_exceptions::add_exception($fromform->reason, $fromform->secret);
    $done = true;
} else if (!$form->is_submitted()) {
    $key = required_param('key', PARAM_ALPHANUM);
    $form->set_data(array('secret' => $key));
}


// Outuput start...
echo $OUTPUT->header();
if (isset($done)) { // Successful form submit
    echo $OUTPUT->box(get_string('exceptionsent', 'auth_askidnumber'));
} else {
    echo $OUTPUT->box(get_string('exceptionreason', 'auth_askidnumber'));
    $form->display();
    echo get_string('exceptionhandling', 'auth_askidnumber');
}
echo $OUTPUT->footer();

