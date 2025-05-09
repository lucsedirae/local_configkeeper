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

namespace local_configkeeper\local;

use core\invalid_persistent_exception;
use local_configkeeper\local\data\config_note;

/**
 * Data handling class for config changes.
 *
 * @package   local_configkeeper
 * @copyright 2025 Jon Deavers <jondeavers@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class config_note_handler {
    /** SQL table shortname */
    const SQL_TABLE_SHORTNAME = 'local_configkeeper_confignote_table';

    /**
     * Create a config change record.
     *
     * @param array $data
     * @return void
     * @throws \coding_exception
     * @throws invalid_persistent_exception
     */
    public function process_observer(array $data): void {
        config_note::create_from_observer($data);
    }

    /**
     * Process the hook to display the config change modal.
     *
     * @return void
     * @throws \coding_exception
     * @throws invalid_persistent_exception
     * @throws \dml_exception
     */
    public function process_hook(): void {
        // Get the config changes that have not yet been viewed.
        $changes = config_note::get_notes(config_note::CONFIGKEEPER_NEW);

        $rows = [];
        foreach ($changes as $change) {
            // Add new changes to template.
            $rows[] = $this->format_row_for_template($change);

            // Mark the config changes as viewed.
            $change->set_status(config_note::CONFIGKEEPER_REVIEWED);
        }

        // If not empty, display the modal.
        if (!empty($changes)) {
            global $PAGE;
            $PAGE->requires->js_call_amd('local_configkeeper/confignotemodal', 'init');
        }
    }

    /**
     * Format the row for the template.
     *
     * @param object $row
     * @return string
     */
    private function format_row_for_template(object $row): string {
        // Replace this logic to format the row for your template.
        return $row;
    }
}
