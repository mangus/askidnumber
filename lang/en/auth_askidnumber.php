<?php

$string['auth_askidnumberdescription'] = 'This plugin asks users to insert their Estonian personal identification code as the ID-number during login if it is not set in user profile.<br />You can switch off ID-number asking for multiple users through <a href="/auth/askidnumber/bulk_actions/">this form</a>.<br /><br /><a href="/auth/askidnumber/exceptions/admin.php">Exceptions handling page</a>';
$string['pluginname'] = 'Ask for ID-number after login';

$string['pleaseinsertyouridnumber'] = 'Please insert your Estonian personal identification code';
$string['youridnumberwhy'] = 'The Estonian personal identification code (ID-number) is needed in Moodle for users to login with Estonian ID-card and Mobile-ID.<br />All Moodle users have to insert their Estonian personal identification code.<br />';
$string['youridnumber'] = 'Your ID-number';

$string['err_whyempty'] = 'Please insert your ID-number';
$string['err_wronglenght'] = 'The ID-number should be exactly 11 numbers long';
$string['err_notnumber'] = 'The ID-number should contain only numbers';
$string['err_notunique'] = 'Inserted ID-number already exists in Moodle database. Please contact support at (<a href="mailto:moodle@hitsa.ee">moodle@hitsa.ee</a>).';
$string['err_incorrectid'] = 'Inserted ID-number is not a correct Estonian personal identification code';

$string['bulkactions'] = 'Bulk actions connected to forced ID-number insertion';
$string['bulkactionsintroduction'] = 'Through this form you can switch off ID-number requirement multiple users at the same time.';
$string['insertcommaseparatedlist'] = 'Insert comma separated list of users e-mail aadresses';

$string['err_list'] = 'Inserted value is not a valid comma-separated e-mail list.';

$string['usersnotfound'] = 'Following e-mails are not connected to any Moodle user:';
$string['usersmodified'] = 'Following users (with e-mails) were modified not to ask for ID-number:';

$string['toidcodeinsert'] = 'To ID-number entering';

$string['exceptioninidnumberinsertion'] = 'Request for an exemption of ID-number requirement';
$string['noestonianidnumber'] = 'I don\'t have an Estonian personal identification code';
$string['exceptionreason'] = 'On this page You can apply for an exemption to free Your account from requiring the Estonian personal identification code (ID-number) insertion. Please explain why are you applying for an exemption regarding the ID-number requirement in Moodle?<br /><br />If You have an Estonian personal identification code (all Estonian citizens have been issued one), then please <a href="{$a->link}">return to the previous page and insert it</a>.<br /><br />NB! Without the ID-number it is not possible to login to Moodle using the Estonian ID-card or Mobile-ID!';
$string['yourreason'] = 'Your reason to apply for an exemption to free Your account from the ID-number requirement';
$string['pleaseinsertreason'] = 'Please insert your explanation';
$string['sendapplication'] = 'Send application to free Your account from ID-number requirement';
$string['exceptionhandling'] = 'Application review is done by the site administrator and it will take about 24 hours. Please note that you will not be able use Moodle before your application has been reviewed.';
$string['exceptionsent'] = 'Your application for an exemption for ID-number requirement has been sent and will be reviewed in 24 hours.<br /><br />Decision about Your application will be sent to Your e-mail address that You used during registering to Moodle. Please note that you will not be able use Moodle before your application has been reviewed.';
$string['unansweredapplication'] = 'You have already sent an application to free your account from the ID-number requirement at {$a->date}.<br /><br />Please wait for a reply from the site administrator. If you have an Estonian personal identification code (all Estonian citizen have been issued one), then please <a href="{$a->link}">return to the previous page and insert it</a>.';

$string['exceptionapplications'] = 'ID-number requirement exemptions';
$string['applicantname'] = 'Applicant name';
$string['usernameand'] = 'Username and language';
$string['applicationsendtime'] = 'Sent';
$string['reason'] = 'Reason';
$string['choices'] = 'Choices';

$string['accepted'] = 'Accepted';
$string['accept'] = 'Accept';
$string['reject'] = 'Reject';
$string['rejected'] = 'Rejected';
$string['userinsertedidnumber'] = 'User inserted ID-number';

$string['messageaccepted'] = 'Application accepted.';
$string['messagerejected'] = 'Application rejected.';

$string['rejectreason'] = 'Reason for rejection';

$string['newrequests'] = 'New requests';
$string['proccessedrequests'] = 'Processed requests';

$string['idnumberexceptions'] = 'Moodle ID-number exceptions system';

$string['notify_accepted_title'] = 'Moodle: ID-number requirement exemption ACCEPTED';
$string['notify_accepted_message'] = 'Hello {$a->name},

Your application to free Your account from the requirement of insterting Your Estonian personal identification code (ID-number) has been ACCEPTED. {$a->explanation}

You can now start using Moodle ({$a->siteurl}). If You would like to use the Estonian ID-card or Mobile-ID to log into Moodle then we would suggest for You to open your profile and insert Your Estonian personal identification code into the ID-number field.

Cheers from the "{$a->sitename}" administrator,
{$a->supportemail}';
$string['notify_rejected_title'] = 'Moodle: ID-number requirement exemption REJECTED';
$string['notify_rejected_message'] = 'Hello {$a->name},

We are sorry to inform You, but your application to free Your account from the Estonian personal identification code (ID-number) requirement has been REJECTED.{$a->explanation}

If You would like to continue using Moodle ({$a->siteurl}) then you will have to enter Your Estonian personal identification code next time you log into Moodle. You can also apply for the exemption again by logging into Moodle and filling in the same form as previously with updated information and explanation.

Cheers from the "{$a->sitename}" administrator,
{$a->supportemail}';

$string['notify_admin_title'] = 'Moodle: New application for personal identification code exemption by {$a->name}';
$string['notify_admin_message'] = 'The user {$a->name} would like to get an exemption for the ID-number requirement and explains it in the following way:

{$a->reason}

To review the applications and answer them visit {$a->url}';

$string['explanation'] = 'Explanation';
$string['sendexplanation'] = 'Send this explanation to user';
$string['senttouser'] = 'Explanation sent to user';

$string['exception_handlers'] = 'Exception handlers (exceptions e-mail recievers)';

