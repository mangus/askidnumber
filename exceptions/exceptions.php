<?php

require_once($CFG->dirroot . '/auth/askidnumber/auth.php');
require_once($CFG->dirroot . '/user/profile/lib.php');
require_once($CFG->dirroot . '/lib/adminlib.php');

class askidnumber_exceptions {

    public static function add_exception($reason, $key) {
        global $DB;
        if (self::has_unanswered_application($key))
            return;
        $data = new stdClass();
        $data->userid = auth_plugin_askidnumber::get_user_id($key);
        $data->status = 'new';
        $data->sendtime = time();
        $data->reason = $reason;
        $newid = $DB->insert_record('ask_id_number_exception', $data);
        self::notify_admin($newid);
        return $newid;
    }

    public static function has_unanswered_application($key) {
        global $DB;
        $info = $DB->get_record('ask_id_number_exception', array('userid' => auth_plugin_askidnumber::get_user_id($key), 'status' => 'new'), 'sendtime');
        if (empty($info->sendtime))
            return false;
        else
            return $info->sendtime;
    }

    public static function inserted_idnumber($userid) {
        global $DB;
        $record = $DB->get_record('ask_id_number_exception', array('userid' => $userid, 'status' => 'new'));
        if (!empty($record->id)) {
            self::update_status($record->id, 'inserted');
        }
    }

    public static function accept($exceptionid, $explanation, $touser) {
	    global $DB;
        self::update_status($exceptionid, 'accepted', $explanation, $touser);
	    $exception = $DB->get_record('ask_id_number_exception', array('id' => $exceptionid));
	    $update = new stdClass();
        $update->id = $exception->userid;
        $update->profile_field_dontaskidnumber = 1;
	    profile_save_data($update);
        self::notify_user($exceptionid);
    }

    public static function reject($exceptionid, $explination) {
        self::update_status($exceptionid, 'rejected', $explination);
        self::notify_user($exceptionid);
    }

    private static function update_status($exceptionid, $newstatus, $explanation = null, $touser = true) {
        global $DB;
        $data = new stdClass();
        $data->id = $exceptionid;
        $data->status = $newstatus;
        $data->statusupdatetime = time();
        if ($explanation)
            $data->explanation = $explanation;
        $data->explanationsent = $touser;
        $DB->update_record('ask_id_number_exception', $data);
    }

    private static function get_exception_handlers() {
        $setting = new admin_setting_users_with_capability(
            'askidnumber/exception_handlers',
            new lang_string('exception_handlers', 'auth_askidnumber'),
            '',
            array(),
            'moodle/site:config'
        );
        $users = $setting->get_setting();
        if ($users[0] == '$@NONE@$') {
            $users = array();
        } else if ($users[0] == '$@ALL@$') {
            $users = array();
            $capusers = get_users_by_capability(context_system::instance(), 'moodle/site:config', 'id');
            foreach ($capusers as $user) {
                $users[] = $user->id;
            }
        }
        return $users;
    }

    private static function notify_admin($exceptionid) {
        global $DB, $CFG;
        $exception = $DB->get_record('ask_id_number_exception', array('id' => $exceptionid));
        $user = $DB->get_record('user', array('id' => $exception->userid));
        $data = array(
            'name' => fullname($user),
            'reason' => $exception->reason,
            'url' => $CFG->wwwroot . '/auth/askidnumber/exceptions/admin.php'
        );
        foreach (self::get_exception_handlers() as $userid) {
            $conditions = array('id' => $userid);
            $emailto = $DB->get_record('user', $conditions, $fields='*');
            $title = get_string_manager()->get_string('notify_admin_title', 'auth_askidnumber', $data, $emailto->lang);
            $message = get_string_manager()->get_string('notify_admin_message', 'auth_askidnumber', $data, $emailto->lang);
            $from = get_string_manager()->get_string('idnumberexceptions', 'auth_askidnumber', null, $emailto->lang);
            if (!email_to_user($emailto, $from, $title, $message))
                throw new exception('Sending notification to admin failed.');
        }
    }

    private static function notify_user($exceptionid) {
        global $DB;
        $exception = $DB->get_record('ask_id_number_exception', array('id' => $exceptionid));
        $user = $DB->get_record('user', array('id' => $exception->userid));
        $from = get_string('idnumberexceptions', 'auth_askidnumber');
        $data = array(
            'name' => fullname($user),
            'explanation' => !empty($exception->explanation)
                ?   ($exception->status == 'rejected'
                        ? "\n\n" . get_string_manager()->get_string('rejectreason', 'auth_askidnumber', null, $user->lang) . ': ' . $exception->explanation
                        :   ( $exception->explanationsent
                                ? "\n\n" . get_string_manager()->get_string('explanation', 'auth_askidnumber', null, $user->lang) . ': ' . $exception->explanation
                                : ''
                            )
                    )
                : ''
        );
        switch ($exception->status) {
            case 'accepted':
                $title = get_string_manager()->get_string('notify_accepted_title', 'auth_askidnumber', null, $user->lang);
                $message = get_string_manager()->get_string('notify_accepted_message', 'auth_askidnumber', $data, $user->lang);
                break;
            case 'rejected':
                $title = get_string_manager()->get_string('notify_rejected_title', 'auth_askidnumber', null, $user->lang);
                $message = get_string_manager()->get_string('notify_rejected_message', 'auth_askidnumber', $data, null, $user->lang);
                break;
            default:
                throw new exception('Logic error in /auth/askidnumber/exceptions/exceptions.php');
        }
        if (!email_to_user($user, $from, $title, $message))
            throw new exception('Sending notification to user failed.');
    }
}

