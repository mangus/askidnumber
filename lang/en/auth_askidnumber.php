<?php

$string['auth_askidnumberdescription'] = 'This plugin asks users to insert their id-number during login if it is not set in user profile.<br />You can switch off ID-number asking for alot of users through <a href="/auth/askidnumber/bulk_actions/">this form</a>.';
$string['pluginname'] = 'Ask for ID-number after login';

$string['pleaseinsertyouridnumber'] = 'Please insert your ID-number';
$string['youridnumberwhy'] = 'ID-number is needed in Moodle for users to login with Estonian ID-card and Mobile-ID.<br />All Moodle users have to insert their Estonian ID-number.<br />';
$string['youridnumber'] = 'Your ID-number';

$string['err_whyempty'] = 'Please insert your ID-number';
$string['err_wronglenght'] = 'The ID-number should be exactly 11 numbers long';
$string['err_notnumber'] = 'The ID-number should contain only numbers';
$string['err_notunique'] = 'Inserted ID-number already exists in Moodle database. Please contact Moodle helpdesk (<a href="mailto:moodle@eitsa.ee">moodle@eitsa.ee</a>).';
$string['err_incorrectid'] = 'Inserted ID-number is not a correct Estonian ID-number';

$string['bulkactions'] = 'Bulk actions connected to forced idnumber insertion';
$string['bulkactionsintroduction'] = 'Through this form you can switch off idnumber asking for many users at the same time.';
$string['insertcommaseparatedlist'] = 'Insert comma separated list of users e-mail aadresses';

$string['err_list'] = 'Inserted value is not a valid comma separated e-mail list.';

$string['usersnotfound'] = 'Following e-mails are not connected to any Moodle user:';
$string['usersmodified'] = 'Following users (with e-mails) were modified not to ask for idnumber:';

$string['toidcodeinsert'] = 'To ID-number entering';

$string['exceptioninidnumberinsertion'] = 'Request to free from ID-number insertion';
$string['noestonianidnumber'] = 'I don\'t have an Estonian ID code';
$string['exceptionreason'] = 'In this page You can apply to free Your account from ID-number insertion. Please explain why You want this release in Moodle?<br /><br />If You still have an Estonian ID-number (all Estonian citizens have issued an ID-number), then please <a href="{$a->link}">return to previous page to insert it</a>.<br /><br />NB! Without the ID-number it is not possible to login to Moodle using ID-card or Mobile-ID!';
$string['yourreason'] = 'Your reason to free Your acount from inserting the ID-number';
$string['pleaseinsertreason'] = 'Please insert reason';
$string['sendapplication'] = 'Send application about ID-number insertion release';
$string['exceptionhandling'] = 'Application review is done by Moodle administrator and takes time about 24 hours.';
$string['exceptionsent'] = 'Your application about ID-number insertion release is sent and will be reviewed in 24 hours.<br /><br />Decision about Your application will be sent to Your e-mail address that You used during registring in Moodle.';
$string['unansweredapplication'] = 'You have already send an application to free your account from inserting your ID-number at {$a->date}.<br /><br />Please wait for reply from the site administrator or if you still have an ID-number (all Estonian citizen have issued an ID-number), then please <a href="{$a->link}">return to previous page and insert your ID-number</a>.';

$string['exceptionapplications'] = 'ID-number insertion exceptions';
$string['applicantname'] = 'Applicant name';
$string['applicationsendtime'] = 'Send time';
$string['reason'] = 'Reason';
$string['choices'] = 'Choices';

$string['accepted'] = 'Accepted';
$string['accept'] = 'Accept';
$string['reject'] = 'Reject';
$string['rejected'] = 'Rejected';
$string['userinsertedidnumber'] = 'User inserted ID-number';

$string['message_accepted'] = 'Application accepted.';

$string['rejectreason'] = 'Reject reason';

