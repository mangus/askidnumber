<?php
 
/**
 * This plugin adds a link to the admin menu, for use with askidnumber. 
 *
 * @package   local_askidnumber
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @link https://github.com/mangus/askidnumber
 */
 
defined('MOODLE_INTERNAL') || die();
 
$plugin->version   = 2013211100;
 
$plugin->dependencies = array(
    'auth_askidnumber' => ANY_VERSION
);