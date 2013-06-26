<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/lib/weblib.php');

class askidnumber_exception_insert_form extends moodleform {
    function definition() {
        $mform =& $this->_form;
        $mform->addElement('textarea', 'reason', get_string('yourreason', 'auth_askidnumber'),
            'rows="10" cols="80"');
        $mform->addRule('reason', get_string('pleaseinsertreason', 'auth_askidnumber'), 'required');

        $mform->addElement('hidden', 'secret', '');
        $mform->setType('secret', PARAM_NOTAGS);
        $mform->addRule('secret', 'you can not hack this way', 'alphanumeric', null, 'server');

        $this->add_action_buttons(false, get_string('sendapplication', 'auth_askidnumber'));
    }
}

