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
require_once('reject_explanation_form.php');
require_once('accept_explanation_form.php');

require_login();

$context = context_system::instance();
if (!has_capability('moodle/site:config', $context)) {
    print_error('accessdenied', 'admin');
}

$PAGE->set_url(new moodle_url('/auth/askidnumber/exceptions/admin.php'));
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_heading(get_string('exceptionapplications', 'auth_askidnumber'));

$form = new askidnumber_exception_accept_explanation_form();
if ($fromform=$form->get_data()) {
    askidnumber_exceptions::accept($fromform->exceptionid, $fromform->explanation, $fromform->explanationsent);
    redirect(new moodle_url('/auth/askidnumber/exceptions/admin.php'), get_string('messageaccepted', 'auth_askidnumber'));
}

$form = new askidnumber_exception_reject_explanation_form();
if ($fromform=$form->get_data()) {
    askidnumber_exceptions::reject($fromform->exceptionid, $fromform->explanation);
    redirect(new moodle_url('/auth/askidnumber/exceptions/admin.php'), get_string('messagerejected', 'auth_askidnumber'));
}

$PAGE->requires->js('/auth/askidnumber/exceptions/admin.js');
$records = $DB->get_records('ask_id_number_exception', null, 'sendtime DESC');

$table = new html_table();
$table->attributes['class'] = 'admintable generaltable';
$table->head = array();
$table->colclasses = array();
$table->head[] = get_string('applicantname', 'auth_askidnumber');
$table->colclasses[] = 'leftalign';
$table->head[] = get_string('usernameand', 'auth_askidnumber');
$table->colclasses[] = 'leftalign';
$table->head[] = get_string('applicationsendtime', 'auth_askidnumber');
$table->colclasses[] = 'leftalign';
$table->head[] = get_string('reason', 'auth_askidnumber');
$table->colclasses[] = 'leftalign';

$newtable = $table;
$oldtable = clone $newtable;

$oldtable->head[] = get_string('status');
$oldtable->colclasses[] = 'centeralign';

$newtable->head[] = get_string('choices', 'auth_askidnumber');
$newtable->colclasses[] = 'centeralign';

foreach($records as $request) {

    $user = $DB->get_record('user', array('id' => $request->userid), $fields='firstname, lastname, username, lang');
    $row = array();
    $fullname = fullname($user);
    $row[] = "<a target=\"blank\" href=\"/user/view.php?id=$request->userid\">$fullname</a>";
    $row[] = "<a target=\"blank\" href=\"/user/view.php?id=$request->userid\">$user->username</a><br />" . $user->lang;
    $row[] = date('Y-m-d (H:i:s)', $request->sendtime);
    $row[] = nl2br(htmlspecialchars($request->reason));

    $buttons = array();
    switch ($request->status) {
        case 'new':
            $status = get_string('new');
            $buttons[] = html_writer::link('#', get_string('accept', 'auth_askidnumber'), array('class' => 'accept-button'));
            $buttons[] = html_writer::link('#', get_string('reject', 'auth_askidnumber'), array('class' => 'reject-button'));
            break;
        case 'accepted':
            $status = get_string('accepted', 'auth_askidnumber') . '<br />' .  date('Y-m-d (H:i:s)', $request->statusupdatetime);
            if (!empty($request->explanation)) {
                $status .= '<br /><br />' . get_string('explanation', 'auth_askidnumber') . ': ' . nl2br(htmlspecialchars($request->explanation));
                $status .= '<br /><br />' . get_string('senttouser', 'auth_askidnumber') . ': '
                    . ($request->explanationsent ? get_string('yes') : get_string('no'));
            }
            break;
        case 'rejected':
            $status = get_string('rejected', 'auth_askidnumber') . '<br />' .  date('Y-m-d (H:i:s)', $request->statusupdatetime)
                . '<br /><br />' . get_string('rejectreason', 'auth_askidnumber') . ': ' . nl2br(htmlspecialchars($request->explanation));
            break;
        case 'inserted':
            $status = get_string('userinsertedidnumber', 'auth_askidnumber') . '<br />' .  date('Y-m-d (H:i:s)', $request->statusupdatetime);
            break;
        default:
            throw new exception('Unknown status: ' . $request->status);
    }

    if (count($buttons)) {
        $buttonsrow = html_writer::tag('span', implode('&nbsp;|&nbsp;', $buttons), array('id' => 'buttons_' . $request->id));

        $form = new askidnumber_exception_reject_explanation_form();
        $form->set_data(array('exceptionid' => $request->id));
        $buttonsrow .= html_writer::tag('div', $form->render(), array('id' => 'reject_form_id_' . $request->id));

        $form = new askidnumber_exception_accept_explanation_form();
        $form->set_data(array('exceptionid' => $request->id));
        $buttonsrow .= html_writer::tag('div', $form->render(), array('id' => 'accept_form_id_' . $request->id));

        $row[] = $buttonsrow;
        $newtable->data[] = $row;
    } else {
        $row[] = $status;
        $oldtable->data[] = $row;
    }
}


echo $OUTPUT->header();

echo html_writer::tag('h2', get_string('newrequests', 'auth_askidnumber'));
echo html_writer::table($newtable);

echo html_writer::tag('h2', get_string('proccessedrequests', 'auth_askidnumber'));
echo html_writer::table($oldtable);

echo $OUTPUT->footer();

