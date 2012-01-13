<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class auth_insertidnumber_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;
        $mform =& $this->_form;
        $mform->addElement('text', 'idnumber', get_string('youridnumber', 'auth_askidnumber'), array('size'=>'11'));

        $mform->addRule('idnumber', get_string('err_whyempty', 'auth_askidnumber'),
            'required', null, 'client');
        $mform->addRule('idnumber', get_string('err_wronglenght', 'auth_askidnumber'),
            'rangelength', array(11, 11), 'client');
        $mform->addRule('idnumber', get_string('err_notnumber', 'auth_askidnumber'),
            'numeric', null, 'client');
        $mform->addRule('idnumber', get_string('err_incorrectid', 'auth_askidnumber'),
            'callback', 'auth_insertidnumber_form::valid_estonian_idnumber', 'server');
        $mform->addRule('idnumber', get_string('err_notunique', 'auth_askidnumber'),
            'callback', 'auth_insertidnumber_form::is_unique', 'server');
        $this->add_action_buttons(false);
    }

    static function is_unique($value) {
        global $DB;
        $condition = array('idnumber' => $value);
        return !$DB->record_exists('user', $condition);
    }

    /* from http://et.wikipedia.org/wiki/Isikukood */
    static function valid_estonian_idnumber($code) {
        if(strlen($code) != 11 || !is_numeric($code)) return false;
        $subcode = substr($code, 0, -1);
        for ( $k = 1; $k <= 3; ++$k ) 
        {
            $s = 0;
            for ( $i = 0; $i < 10; ++$i ) 
            { 
                $s += $k * $subcode{$i}; 
                $k  = ( 9 == $k ? 1 : $k + 1 ); 
            }
            if ( ( $s %= 11 ) < 10 )  
                break;
        }
        $s = $s == 10 ? 0 : $s;
        return substr($code, -1) == $s;
    }    
}

