<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * External page for local_configkeeper plugin interface
 *
 * @package   local_configkeeper
 * @copyright 2025 Jon Deavers <jondeavers@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core_reportbuilder\system_report_factory;
use local_configkeeper\reportbuilder\local\systemreports\configkeeper;

require_once(__DIR__ . '/../../config.php');

global $PAGE, $OUTPUT;

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/configkeeper'));
$PAGE->set_heading(get_string('pluginname', 'local_configkeeper'));
$PAGE->set_title(get_string('pluginname', 'local_configkeeper'));
$PAGE->set_pagelayout('report');

require_login();

$report = system_report_factory::create(configkeeper::class, $context);

echo $OUTPUT->header();

echo $report->output();

echo $OUTPUT->footer();
