<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class auth_insertidnumber_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $mform->addElement('text', 'idnumber', get_string('insertyouridnumber'), array('size'=>'11'));
        $mform->addRule('idnumber', get_string('error1'), 'rangelength', '11-11', 'server');
        $this->add_action_buttons(false);
    }

}

