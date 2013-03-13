<?php
/**
 * @author Mart Mangus
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 *
 * Authentication Plugin: Ask for ID-number in login when it is not set
 *
 */

require_once($CFG->libdir.'/authlib.php');
require_once('insertidnumber_form.php');

class auth_plugin_askidnumber extends auth_plugin_base {

    /** Constructor */
    function auth_plugin_askidnumber() {
        $this->authtype = 'askidnumber';
    }

    function user_authenticated_hook(&$user, $username, $password) {

	    if (!$user->confirmed)
            return;

        if (isset($user->profile['dontaskidnumber']) && $user->profile['dontaskidnumber'])
            // Administrator has set dontaskidnumber to true
            return;

        if (!auth_insertidnumber_form::valid_estonian_idnumber($user->idnumber)) {
            redirect($this->generate_url($user->id));
        }
    }

    function user_login($username, $password) {
        return false;
    }

    function create_key($userid) {
        global $DB;
        $record = new stdClass();
        $record->userid = $userid;
        $record->secret = $key = $this->generate_secret();
        $record->starttime = time();
        $DB->insert_record('ask_id_number', $record);
        return $key;
    }

    private function generate_secret() {
        $len = 49;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $string = '';
        for ($i = 0; $i < $len; $i++) {
            $pos = rand(0, strlen($chars)-1);
            $string .= $chars{$pos};
        }
        return $string;
    }

    private function get_user_id($key) {
        global $DB;
        $info = $DB->get_record('ask_id_number', array('secret' => $key), 'userid');
        if (empty($info->userid))
            throw new Exception('Invalid key for login through askidnumber');
        return $info->userid;
    }

    function update_user_profile($key, $idnumber) {
        global $DB;
        $userid = $this->get_user_id($key);
        $record = new stdClass();
        $record->id = $userid;
        $record->idnumber = $idnumber;
        $DB->update_record('user', $record, false);
        $this->delete_key($key);
        $this->clean_old_keys();
        $this->login_user($userid);
    }

    function delete_key($key) {
        global $DB;
        $DB->delete_records('ask_id_number', array('secret' => $key));
    }

    /** Deletes used (unactive) keys from database */
    private function clean_old_keys() {
        global $DB;
        $DB->delete_records_select('ask_id_number', 'starttime < ?', array(time()-300 /* 5 minutes */));
    }

    private function login_user($userid) {
        global $DB;
        $usertologin = $DB->get_record('user', array('id' => $userid), $fields='*');
        $USER = complete_user_login($usertologin);
    }

    public function generate_url($userid) {
        global $CFG;
        $key = $this->create_key($userid);
        return $CFG->wwwroot.'/auth/askidnumber/form.php?key=' . $key;
    }

}

