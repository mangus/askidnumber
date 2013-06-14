<?php

class askidnumber_exceptions {

    public static function add_exception($reason, $key) {
        global $DB;
        $data = new stdClass();
        $data->id = 1;
        $data->userid = 27665; // TODO get user ID
        $data->status = 'new';
        $data->sendtime = time();
        $data->reason = $reason;
        $newid = $DB->insert_record('ask_id_number_exception', $data);
        self::notify_admin($newid);
        return $newid;
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
