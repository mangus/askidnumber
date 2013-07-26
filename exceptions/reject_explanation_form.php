<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/lib/weblib.php');

class askidnumber_exception_reject_explanation_form extends moodleform {
    function definition() {
        $mform =& $this->_form;
        $mform->addElement('textarea', 'explanation', get_string('rejectreason', 'auth_askidnumber'));

        $mform->addElement('hidden', 'exceptionid', '');
        $mform->setType('exceptionid', PARAM_INT);

        $this->add_action_buttons(false, get_string('reject', 'auth_askidnumber'));
    }
}

