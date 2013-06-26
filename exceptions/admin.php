<?php
/**
 * @author Mart Mangus
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 *
 * Page for administrator(s) to approve/reject exceptions.
 *
 */

require_once('../../../config.php');
require_once('exceptions.php');
require_once('reject_reason_form.php');

$context = context_system::instance();
$PAGE->set_url(new moodle_url('/auth/askidnumber/exceptions/admin.php'));
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_heading(get_string('exceptionapplications', 'auth_askidnumber'));

//echo 'User permissions check TODO!';

if ($id = optional_param('accept', false, PARAM_INT)) {
    askidnumber_exceptions::accept($id);
    $message = get_string('message_accepted', 'auth_askidnumber');
}
/*
$form = new askidnumber_exception_reject_reason_form();
if ($fromform=$form->get_data()) {
    askidnumber_exceptions::add_exception($fromform->reason, $fromform->secret);
    $done = true;
} else if (!$form->is_submitted()) {
    $key = required_param('key', PARAM_ALPHANUM);
    $form->set_data(array('secret' => $key));
}
*/


$records = $DB->get_records('ask_id_number_exception');

$table = new html_table();
$table->attributes['class'] = 'admintable generaltable';
$table->head = array();
$table->colclasses = array();
$table->head[] = get_string('applicantname', 'auth_askidnumber');
$table->colclasses[] = 'leftalign';
$table->head[] = get_string('username');
$table->colclasses[] = 'leftalign';
$table->head[] = get_string('applicationsendtime', 'auth_askidnumber');
$table->colclasses[] = 'leftalign';
$table->head[] = get_string('reason', 'auth_askidnumber');
$table->colclasses[] = 'leftalign';
$table->head[] = get_string('status');
$table->colclasses[] = 'centeralign';
$table->head[] = get_string('choices', 'auth_askidnumber');
$table->colclasses[] = 'centeralign';

foreach($records as $request) {

    $user = $DB->get_record('user', array('id' => $request->userid), $fields='firstname, lastname, username');
    $row = array();
    $fullname = fullname($user);
    $row[] = "<a target=\"blank\" href=\"/user/view.php?id=$request->userid\">$fullname</a>";
    $row[] = "<a target=\"blank\" href=\"/user/view.php?id=$request->userid\">$user->username</a>";
    $row[] = date('Y-m-d (H:i:s)', $request->sendtime);
    $row[] = htmlspecialchars($request->reason);

    $buttons = array();
    switch ($request->status) {
        case 'new':
            $status = get_string('new');
            $buttons[] = html_writer::link(new moodle_url('/auth/askidnumber/exceptions/admin.php', array('accept'=>$request->id)), get_string('accept', 'auth_askidnumber'));
            $buttons[] = html_writer::link(new moodle_url('/auth/askidnumber/exceptions/admin.php', array('reject'=>$request->id)), get_string('reject', 'auth_askidnumber'));
            break;
        case 'accepted':
            $status = get_string('accepted', 'auth_askidnumber') . '<br />' .  date('Y-m-d (H:i:s)', $request->statusupdatetime);
            break;
        case 'rejected':
            $status = get_string('rejected', 'auth_askidnumber') . '<br />' .  date('Y-m-d (H:i:s)', $request->statusupdatetime);
            break;
        case 'inserted':
            $status = get_string('userinsertedidnumber', 'auth_askidnumber') . '<br />' .  date('Y-m-d (H:i:s)', $request->statusupdatetime);
            break;
        default:
            throw new exception('Unknown status: ' . $request->status);
    }

    $row[] = $status;

    if (count($buttons)) {
        $buttonsrow = implode(' | ', $buttons);
        $form = new askidnumber_exception_reject_reason_form();
        $form->set_data(array('exceptionid' => $request->id));
        $buttonsrow .= $form->render();
    } else {
        $buttonsrow = '';
    }
    $row[] = $buttonsrow;
    $table->data[] = $row;
}


echo $OUTPUT->header();
if (isset($message))
    echo html_writer::tag('div', $message);
echo html_writer::table($table);
echo $OUTPUT->footer();

