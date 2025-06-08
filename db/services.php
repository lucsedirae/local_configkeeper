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
 * External services for local_configkeeper plugin.
 *
 * @package   local_configkeeper
 * @copyright 2025 Jon Deavers <jondeavers@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$functions = [
    'local_configkeeper_get_confignotes' => [
        'classname' => 'local_configkeeper\external\get_confignotes',
        'description' => 'Retrieves config note data for modal table.',
        'type' => 'read',
        'ajax' => true,
    ],
    'local_configkeeper_save_confignotes' => [
        'classname' => 'local_configkeeper\external\save_confignotes',
        'description' => 'Saves notes on config changes.',
        'type' => 'write',
        'ajax' => true,
    ],
];
