<?php
$ADMIN->add('accounts', new admin_externalpage('askidnumber/id_requests', get_string('menunewrequests', 'local_askidnumber'), $CFG->wwwroot . '/auth/askidnumber/exceptions/admin.php', 'moodle/site:config'));
?>
