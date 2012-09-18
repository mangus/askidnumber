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

    function user_authenticated_hook($user) {
        global $CFG, $SESSION;

	if (!$user->confirmed)
            return;

        if (isset($user->profile['dontaskidnumber']) && $user->profile['dontaskidnumber'])
            // Administrator has set dontaskidnumber to true
            return;

        if (!auth_insertidnumber_form::valid_estonian_idnumber($user->idnumber))
        {
            if ($user->preference['auth_forcepasswordchange'])
            {   // Still ask for ID number after password change
                $SESSION->wantsurl = $CFG->wwwroot.'/auth/askidnumber/form.php';
                return;
            }
            // Here We ask to insert the correct ID-number
            $USER = complete_user_login($user);
            $goto = $CFG->wwwroot.'/auth/askidnumber/form.php';
            redirect($goto);
        }
    }

    function user_login($username, $password) {
        return false;
    }
}

