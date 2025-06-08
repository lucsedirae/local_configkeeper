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
 * External service class to save config note changes from modal.
 *
 * @package   local_configkeeper
 * @copyright 2025 Jon Deavers <jondeavers@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_configkeeper\external;

use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_multiple_structure;
use core_external\external_single_structure;
use core_external\external_value;
use local_configkeeper\util;

/**
 * Class to handle passing of config notes data to modal.
 *
 * @package local_configkeeper\external
 */
class save_confignotes extends external_api {
    // TODO YOU LEFT OFF HERE: Update this class to handle saving config notes.

    /**
     * Execute the external function to retrieve config notes.
     *
     * @param array $ids
     * @return array
     * @throws \invalid_parameter_exception
     */
    public static function execute(array $ids): array {
        // Validate the external params.
        [
            'ids' => $ids,
        ] = self::validate_parameters(self::execute_parameters(), [
            'ids' => $ids,
        ]);

        return ['confignotes' => util::get_confignotes($ids)];
    }

    /**
     * Define the parameters for the external function.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([
            'ids' => new external_multiple_structure(
                new external_value(PARAM_INT, 'Confignote id'),
                'Array of confignote ids'
            ),
        ]);
    }

    /**
     * Define the return structure for the external function.
     *
     * @return external_single_structure
     */
    public static function execute_returns(): external_single_structure {
        return new external_single_structure([
            'confignotes' => new external_multiple_structure(
                new external_single_structure([
                    'id' => new external_value(PARAM_INT, 'Confignote id'),
                    'plugin' => new external_value(PARAM_TEXT, 'Plugin name'),
                    'setting' => new external_value(PARAM_TEXT, 'Setting name'),
                    'value' => new external_value(PARAM_TEXT, 'Value'),
                    'note' => new external_value(PARAM_TEXT, 'Note'),
                ]),
                'Array of confignote data'
            ),
        ]);
    }
}
