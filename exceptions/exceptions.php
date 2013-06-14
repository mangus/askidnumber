<?php

require('../auth.php');

class askidnumber_exceptions {

    public static function add_exception($reason, $key) {
        global $DB;
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

    public static function accept($exceptionid) {
        self::update_status($exceptionid, 'accepted');
        notify_user($exceptionid);
    }

    public static function reject($exceptionid, $explination) {
        self::update_status($exceptionid, 'rejected', $explination);
        notify_user($exceptionid);
    }

    private static function update_status($exceptionid, $newstatus, $rejectreason = null) {
        global $DB;
        $data = new stdClass();
        $data->id = $exceptionid;
        $data->status = $newstatus;
        $data->statusupdatetime = time();
        if ($rejectreason)
            $data->rejectreason = $rejectreason;
        $DB->update_record('ask_id_number_exception', $data);
    }

    private static function notify_admin($exceptionid) {
        // E-mail to admin etc...
    }

    private static function notify_user($exceptionid) {
        // Get user e-mail...
    }
}

