<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/lib/weblib.php');

class askidnumber_exception_accept_explanation_form extends moodleform {
    function definition() {
        $mform =& $this->_form;
        $mform->addElement('textarea', 'explanation', get_string('explanation', 'auth_askidnumber'));
        $mform->addElement('advcheckbox', 'explanationsent', get_string('sendexplanation', 'auth_askidnumber'));

        $mform->addElement('hidden', 'exceptionid', '');
        $mform->setType('exceptionid', PARAM_INT);

        $this->add_action_buttons(false, get_string('accept', 'auth_askidnumber'));
    }
}

