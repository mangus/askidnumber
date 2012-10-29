<?php

class askidnumber_bulkactions {

    public function dont_ask_idnumber($cslist) {
        global $DB;
        $list = $this->list_to_array($cslist);
        $return['updated'] = array();
        $return['notfound'] = array();
        foreach ($list as $email) {
            // Search connected user from database...
            $conditions = array('email' => $email);
            $user = $DB->get_record('user', $conditions, 'id,email,CONCAT(firstname," ",lastname) AS name');
            if ($user) {
                // Update database entry
                $this->update_user_noasking($user->id);
                $return['updated'][] = $user->name . ' (' . $user->email . ')';
            } else {
                $return['notfound'][] = $email;
            }
        }
        return $return;
    }

    private function list_to_array($commalist) {
        // No need for validation -- already validated in form
        $list = explode(',', trim($commalist));
        return array_map('trim', $list);
    }

    private function update_user_noasking($userid) {
        global $DB;

        $data = new stdClass();
        $data->userid = $userid;
        $data->data = true;
        $data->fieldid = /*TODO*/1;
 
        if ($dataid = $DB->get_field('user_info_data', 'id', array('userid' => $data->userid, 'fieldid' => $data->fieldid))) {
            $data->id = $dataid;
            $DB->update_record('user_info_data', $data);
        } else {
            $DB->insert_record('user_info_data', $data);
        }
    }
}
