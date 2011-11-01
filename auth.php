<?php
/**
 * @author Mart Mangus
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 *
 * Authentication Plugin: Requre ID-number in login when it is not set
 *
 */

require_once($CFG->libdir.'/authlib.php');

class auth_plugin_requireidnumber extends auth_plugin_base {

    /** Constructor */
    function auth_plugin_requireidnumber() {
        $this->authtype = 'requireidnumber';
    }

    function user_authenticated_hook($user) {
        global $OUTPUT;
        if (!$this->valididnumber($user->idnumber))
        {   // Here We ask to insert the correct ID-number
            $USER = complete_user_login($user);

            $goto = $CFG->wwwroot.'/auth/requireidnumber/form.php'; // TODO
            header("Location: $goto");
            die();
        }
    }

    private function valididnumber($idnumber)
    {
        if (strlen($idnumber) != 11)
            return false;
        return true;
    }

    /**
     * Custom auth hook for web services.
     * @param string $username
     * @param string $password
     * @return bool success
     */
    /*
    function user_login_requireidnumber($username, $password) {
        global $CFG, $DB;
        die('test1');
        // special web service login
        if ($user = $DB->get_record('user', array('username'=>$username, 'mnethostid'=>$CFG->mnet_localhost_id))) {
            return validate_internal_user_password($user, $password);
        }
        return false;
    }
    */

    //TODO: save ID-code into ID-number field.
}

