<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/lib/weblib.php');

class askidnumber_exception_reject_reason_form extends moodleform {
    function __construct() {
        parent::__construct(null, null, 'post', '', array('class' => ''));
    }
    function definition() {
        $mform =& $this->_form;
        $mform->addElement('textarea', 'reason', get_string('rejectreason', 'auth_askidnumber'),
            '' /*rows="4" cols="20"' */);

        $mform->addElement('hidden', 'exceptionid', '');
        $mform->setType('exceptionid', PARAM_INT);

        $this->add_action_buttons(false, get_string('reject', 'auth_askidnumber'));
    }
}

