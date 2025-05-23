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
 * Helper functions for local_configkeeper plugin.
 *
 * @package   local_configkeeper
 * @copyright 2025 Jon Deavers <jondeavers@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_configkeeper;

use local_configkeeper\local\data\config_note;

class util {
    public static function get_confignotes(array $ids): array {
        $notes = [];

        // TODO: YOU LEFT OFF HERE. YOU NEED TO GET THE CONFIGLOG DATA FOR EACH NOTE.
        // This should probably be done inside of a util method. Think about how to do it
        // in a way that doesn't require query the db for every note.
        foreach ($ids as $id) {
            $note = new config_note($id);
            $configlog =
        }

        return $notes;
    }
}
