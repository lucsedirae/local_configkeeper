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

/**
 * Utilities class for local_configkeeper.
 */
class util {
    /**
     * Retrieves config notes for the given IDs.
     *
     * @param array $ids
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function get_confignotes(array $ids): array {
        global $DB;
        $rows = [];

        // Get config change logs.
        $params = [
            'ids' => implode(',', $ids),
        ];
        $sql = "SELECT * FROM m_config_log WHERE id IN (" . implode(',', $ids) . ")";
        $configlogs = $DB->get_records_sql($sql, $params);

        foreach ($ids as $id) {
            $note = config_note::get_note_by_logid($id);
            $log = $configlogs[$id];



            $rows[] = [
                'id' => $note->get('id'),
                'plugin' => $log->plugin,
                'setting' => $log->setting,
                'value' => $log->value,
                'note' => $note->get('note'),
            ];
        }

        return $rows;
    }
}
