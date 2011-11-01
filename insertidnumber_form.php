<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class auth_insertidnumber_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $mform->addElement('text', 'idnumber', get_string('youridnumber', 'auth_askidnumber'), array('size'=>'11'));
        $mform->addRule('idnumber', get_string('err_whyempty', 'auth_askidnumber'), 'required', 'client');
        $mform->addRule('idnumber', get_string('err_wronglenght', 'auth_askidnumber'), 'rangelength', array(11, 11), 'client');
        $mform->addRule('idnumber', get_string('err_notnumber', 'auth_askidnumber'), 'numeric', null, 'client');
        $mform->addRule('idnumber', get_string('err_notunique', 'auth_askidnumber'), 'callback', 'auth_insertidnumber_form::is_unique', 'server');
        $this->add_action_buttons(false);
    }

    static function is_unique($value) {
        global $DB;
        $condition = array('idnumber' => $value);
        return !$DB->record_exists('user', $condition);
    }

}

