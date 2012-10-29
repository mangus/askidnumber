<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/lib/weblib.php');

class askidnumber_bulkactions_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $mform->addElement('textarea', 'list', get_string('insertcommaseparatedlist', 'auth_askidnumber'), 'wrap="virtual" rows="14" cols="100"');
        $mform->addRule('list', get_string('err_list', 'auth_askidnumber'),
            'callback', 'askidnumber_bulkactions_form::is_valid_input', 'server');
        $this->add_action_buttons(true);
    }

    static function is_valid_input($input) {
        $list = explode(',', $input);

        if (!count($list))
            return false;

        foreach ($list as $email) {
            if (!validate_email(trim($email)))
                return false;
        }
        return true;
    }
    
}

