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
 * Persistent class for config changes.
 *
 * @package   local_configkeeper
 * @copyright 2025 Jon Deavers <jondeavers@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_configkeeper\local\data;

use core\invalid_persistent_exception;

/**
 * Config note persistent class.
 */
class config_note extends base {
    /** Config keeper plugin table */
    const TABLE = 'local_configkeeper';

    /** New */
    const CONFIGKEEPER_NEW = 'new';

    /** Reviewed */
    const CONFIGKEEPER_REVIEWED = 'reviewed';

    /**
     * Define persistent properties.
     *
     * @return array[]
     */
    protected static function define_properties(): array {
        return [
            'logid' => [
                'type' => PARAM_INT,
                'null' => NULL_NOT_ALLOWED,
            ],
            'status' => [
                'type' => PARAM_ALPHA,
                'null' => NULL_NOT_ALLOWED,
            ],
            'note' => [
                'type' => PARAM_TEXT,
                'null' => NULL_NOT_ALLOWED,
            ],
        ];
    }

    /**
     * Create a new config change record from an observer event.
     *
     * @param array $data Resulting array from the observer event getData() method
     * @return config_note|null
     * @throws \coding_exception
     * @throws invalid_persistent_exception
     */
    public static function create_from_observer(array $data): ?config_note {
        $record = new \stdClass();
        $record->logid = $data['objectid'];
        $record->status = self::CONFIGKEEPER_NEW;
        $record->note = '';
        $persistent = new static(0, $record);

        return $persistent->create();
    }

    /**
     * Gets new changes that have been recorded by the observer.
     *
     * @param string $status
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function get_notes(string $status): array {
        global $DB;

        // Validate the status parameter.
        if (!in_array($status, [self::CONFIGKEEPER_NEW, self::CONFIGKEEPER_REVIEWED])) {
            throw new \coding_exception('Invalid status parameter provided');
        }

        // Get records from database that match the status.
        $records = $DB->get_records(self::TABLE, ['status' => $status]);
        $notes = [];
        foreach ($records as $record) {
            $notes[] = new static(0, $record);
        }

        return $notes;
    }

    /**
     * Get the status of the config change.
     *
     * @param string $status
     * @return void
     * @throws \coding_exception
     * @throws invalid_persistent_exception
     */
    public function set_note_status(string $status): void {
        $this->set('status', $status);
        $this->update();
    }
}
