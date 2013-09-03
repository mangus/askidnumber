<?php

$string['auth_askidnumberdescription'] = 'See moodul küsib pärast sisselogimist isikukoodi neilt kasutajalt, kes pole seda veel sisestanud.<br />Paljudel kasutajatel isikukoodi küsimise väljalülitamine käib <a href="/auth/askidnumber/bulk_actions/">selle vormi</a> kaudu.<br /><br /><a href="/auth/askidnumber/exceptions/admin.php">Erandite halduse lehekülg</a>';
$string['pluginname'] = 'Küsi isikukoodi pärast sisselogimist';

$string['pleaseinsertyouridnumber'] = 'Palun sisesta oma isikukood';
$string['youridnumberwhy'] = 'Isikukood Moodles on vajalik, et kasutajatel oleks võimalik ID-kaardi ja Mobiil-ID-ga sisse logida.<br />Kõik Moodle kasutajad peavad sisestama oma isikukoodi.';
$string['youridnumber'] = 'Sinu isikukood';

$string['err_whyempty'] = 'Palun sisesta allolevasse lahtrisse oma isikukood';
$string['err_wronglenght'] = 'Isikukood peab olema täpselt 11 numbrit pikk';
$string['err_notnumber'] = 'Isikukood tohib sisaldada ainult numbreid';
$string['err_notunique'] = 'Sisestatud isikukoodiga kasutaja on Moodles juba olemas. Palun võta ühendust Moodle kasutajatoega (<a href="mailto:moodle@hitsa.ee">moodle@hitsa.ee</a>).';
$string['err_incorrectid'] = 'Sisestatud isikukood ei ole korrektne Eesti isikukood';

$string['bulkactions'] = 'Isikukoodi sisestamisega seotud masstegevused';
$string['bulkactionsintroduction'] = 'Selle vormi kaudu saab välja lülitada isikukoodi küsimist paljudel kasutajatel korraga.';
$string['insertcommaseparatedlist'] = 'Sisesta komadega eraldatud kasutajate e-posti aadressid';

$string['err_list'] = 'Sisestatud väärtus ei ole korrektne komadega eraldatud e-posti aadresside nimekiri.';

$string['usersnotfound'] = 'Järgnevad e-posti aadressid ei ole ühegi Moodle kontoga seotud:';
$string['usersmodified'] = 'Kasutajad (koos e-posti aadressidega), keda muudeti mitte küsima isikukoodi:';

$string['toidcodeinsert'] = 'Isikukoodi sisestama';

$string['exceptioninidnumberinsertion'] = 'Isikukoodi sisestusest vabastamise taotlemine';
$string['noestonianidnumber'] = 'Mul ei ole Eesti isikukoodi';
$string['exceptionreason'] = 'Käesoleval lehel saad taotleda oma kasutajatunnuse vabastamist isikukoodi sisestamise nõudest. Palun põhjenda, miks sa soovid saada vabastust isikukoodi sisestamisest Moodle keskkonnas?<br /><br />Kui sul on siiski olemas Eesti isikukood (kõigile Eesti Vabariigi kodanikele on välja antud isikukood), siis palun <a href="{$a->link}">pöördu tagasi eelmisele lehele ja sisesta oma isikukood</a>.<br /><br />NB! Isikukoodi puudumisel ei ole sul võimalik logida Moodlesse sisse ID-kaardi ega Mobiil-ID-ga!';
$string['yourreason'] = 'Sinu põhjendus isikukoodi nõudest vabanemiseks:';
$string['pleaseinsertreason'] = 'Palun sisesta põhjendus';
$string['sendapplication'] = 'Esitan taotluse isikukoodi nõudest vabanemiseks';
$string['exceptionhandling'] = 'Taotluse läbivaatamine toimub käsitsi keskkonna administraatori poolt ja võtab aega umbes 24 tundi.';
$string['exceptionsent'] = 'Sinu taotlus kasutajatunnuse vabastamiseks isikukoodi nõudest on esitatud ja vaadatakse üle 24 tunni jooksul.<br /><br />Otsus taotluse kohta saadetakase sulle kasutajatunnuse registreerimisel sisestatud e-posti aadressile.';
$string['unansweredapplication'] = 'Oled {$a->date} juba esitanud taotluse isikukoodi sisestamisest vabastuse saamiseks.<br /><br />Palun oota keskkonna administraatori vastust oma taotlusele või kui sul on siiski olemas Eesti isikukood (kõigile Eesti Vabariigi kodanikele on välja antud isikukood), siis palun <a href="{$a->link}">pöördu tagasi eelmisele lehele ja sisesta oma isikukood</a>.';

$string['exceptionapplications'] = 'Isikukoodi sisestamisest vabastuse taotlused';
$string['applicantname'] = 'Taotleja nimi';
$string['usernameand'] = 'Kasutajanimi ja keel';
$string['applicationsendtime'] = 'Taotluse esitamise aeg';
$string['reason'] = 'Põhjendus';
$string['choices'] = 'Valikud';

$string['accepted'] = 'Kinnitatud';
$string['accept'] = 'Kinnita';
$string['reject'] = 'Lükka&nbsp;tagasi';
$string['rejected'] = 'Tagasi lükatud';
$string['userinsertedidnumber'] = 'Kasutaja sisestas isikukoodi';

$string['messageaccepted'] = 'Kasutaja taotlus kinnitatud.';
$string['messagerejected'] = 'Kasutaja taotlus tagasi lükatud.';

$string['rejectreason'] = 'Tagasi lükkamise põhjus';

$string['newrequests'] = 'Uued vabastamise taotlused';
$string['proccessedrequests'] = 'Töödeldud taotlused';

$string['idnumberexceptions'] = 'Moodle isikukoodi erandite haldussüsteem';

$string['notify_accepted_title'] = 'Moodle: isikukoodi vabastuse taotlus on HEAKS KIIDETUD';
$string['notify_accepted_message'] = 'Tere {$a->name},

Sinu taotlus Moodle keskkonnas ({$a->siteurl}) kasutajatunnusele isikukoodi sisestamisest vabastus saada on HEAKS KIIDETUD. {$a->explanation}

Saad nüüd Moodle keskkonda sisse logida ja seda edukalt kasutada. Kui soovid Moodles kasutada ID-kaardi või Mobiil-ID-ga sisse logimise võimalusi, siis soovitame sul esimesel võimalusel siiski isikukood enda profiilis ära märkida.

Tervitustega '{$a->sitename}' administraatorilt,
{$a->signoff}';
$string['notify_rejected_title'] = 'Moodle: isikukoodi vabastuse taotlus on TAGASI LÜKATUD';
$string['notify_rejected_message'] = 'Tere {$a->name},

Sinu taotlus Moodle keskkonnas ({$a->siteurl}) kasutajatunnusele isikukoodi sisestamisest vabastus saada on TAGASI LÜKATUD. {$a->explanation}

Järgmine kord Moodlesse sisse logides pead esmalt sisestama isikukoodi, et süsteemi edasi kasutada. Kui soovid siiski saada vabastust isikukoodi sisestamise nõudest, siis palun saada Moodle keskkonna kaudu uus põhjendatud taotlus isikukoodi sisestamise nõudest vabanemiseks.

Tervitustega '{$a->sitename}' administraatorilt,
{$a->signoff}';

$string['notify_admin_title'] = 'Moodle: isikukoodi vabastuse taotlus kasutajalt {$a->name}';
$string['notify_admin_message'] = 'Kasutaja {$a->name} soovib saada kasutajatunnuse juurde isikukoodi sisestamise kohustusest vabastust ja põhjendab seda järgnevalt:

{$a->reason}

Taotluse kinnitamiseks või tagasi lükkamiseks mine aadressile {$a->url}';

$string['explanation'] = 'Selgitus';
$string['sendexplanation'] = 'Saada selgitus kasutajale';
$string['senttouser'] = 'Selgitus saadeti kasutajale';

$string['exception_handlers'] = 'Erandite töötlejad (erandite e-kirjade teavitus)';

