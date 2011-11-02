<?php
/**
 * @author Mart Mangus
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 *
 * Authentication Plugin: Requre ID-number in login when it is not set
 *
 */

require_once($CFG->libdir.'/authlib.php');

class auth_plugin_askidnumber extends auth_plugin_base {

    /** Constructor */
    function auth_plugin_askidnumber() {
        $this->authtype = 'askidnumber';
    }

    function user_authenticated_hook($user) {
        global $CFG;
        if (!$this->valididnumber($user->idnumber))
        {   // Here We ask to insert the correct ID-number
            $USER = complete_user_login($user);
            $goto = $CFG->wwwroot.'/auth/askidnumber/form.php';
            redirect($goto);
        }
    }

    private function valididnumber($idnumber)
    {
        if (strlen($idnumber) != 11)
            return false;
        return true;
    }
}

