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
$PAGE->set_url(new moodle_url('/auth/askidnumber/exceptions/insert.php?key=' . optional_param('key', '', PARAM_ALPHANUM)));
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
    $data = $form->get_submitted_data();
    $key = isset($data->secret) ? $data->secret : required_param('key', PARAM_ALPHANUM);
    $params['link'] = '' . new moodle_url('/auth/askidnumber/form.php', array('key' => $key));
    if ($date = askidnumber_exceptions::has_unanswered_application($key)) {
        $params['date'] = date('Y-m-d (H:i)', $date);
        echo $OUTPUT->box(get_string('unansweredapplication', 'auth_askidnumber', $params));
    } else {
        echo $OUTPUT->box(get_string('exceptionreason', 'auth_askidnumber', $params));
        $form->display();
        echo get_string('exceptionhandling', 'auth_askidnumber');
    }
}
echo $OUTPUT->footer();

