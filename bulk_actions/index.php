<?php
/**
 * @author Mart Mangus
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 *
 * Bulk user actions for changing profile field 'dontaskidnumber' in many users at the same time.
 *
 */

require_once('../../../config.php');
require_once('bulk_actions.php');
require_once('form.php');

$context = context_system::instance();
if (!has_capability('moodle/site:config', $context)) {
    print_error('accessdenied', 'admin');
}

$PAGE->set_url("$CFG->httpswwwroot/auth/askidnumber/bulk_actions/");
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_heading(get_string('bulkactions', 'auth_askidnumber'));

// Form...
$form = new askidnumber_bulkactions_form();
if ($fromform=$form->get_data()) {
    $idbulk = new askidnumber_bulkactions();
    $statistics = $idbulk->dont_ask_idnumber($fromform->list);
}

// Outuput start...
echo $OUTPUT->header();
if (isset($statistics)) { // Successful form submit
    echo $OUTPUT->heading(get_string('usersnotfound', 'auth_askidnumber'), 3);
    echo $OUTPUT->box(count($statistics['notfound']) ? implode($statistics['notfound'], '<br />') : get_string('none'));
    echo $OUTPUT->heading(get_string('usersmodified', 'auth_askidnumber'), 3);
    echo $OUTPUT->box(count($statistics['updated']) ? implode($statistics['updated'], '<br />') : get_string('none'));
    echo '<a href="' . new moodle_url('/auth/askidnumber/bulk_actions/') . '">' . get_string('back') . '</a>';
} else {
    echo $OUTPUT->box(get_string('bulkactionsintroduction', 'auth_askidnumber'));
    $form->display();
}
echo $OUTPUT->footer();

