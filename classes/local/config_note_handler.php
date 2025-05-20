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
     * @throws \dml_exception|\moodle_exception
     */
    public function process_hook(): void {
        // Get the config changes that have not yet been viewed.
        $changes = config_note::get_notes(config_note::CONFIGKEEPER_NEW);

        // Mark the config changes as viewed.
        foreach ($changes as $change) {
            $change->set_note_status(config_note::CONFIGKEEPER_REVIEWED);
        }

        // If not empty, display the modal.
        if (!empty($changes)) {
            global $PAGE;
            $html = $this->export_for_template($changes);

            $debug = [
                'html' => $html,
            ];
            file_put_contents('/tmp/DEBUG.json', json_encode($debug) . PHP_EOL);
            chmod('/tmp/DEBUG.json', 664);

            $PAGE->requires->js_call_amd('local_configkeeper/confignotemodal', 'init', [$html]);
        }
    }

    /**
     * Prepare the data for the template.
     *
     * @param array $changes
     * @return bool|string
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public function export_for_template(array $changes): bool|string {
        // Get the config change data.
        global $DB, $OUTPUT;

        $rows = [];
        foreach ($changes as $change) {
            $logentry = $DB->get_record('config_log', ['id' => $change->get('logid')], '*', MUST_EXIST);

            $rows[] = [
                'id' => $change->get('id'),
                'plugin' => $logentry->plugin ?? get_string('core', 'local_configkeeper'),
                'name' => $logentry->name,
                'value' => $logentry->value,
                'note' => $change->get('note'),
            ];
        }

        $data = [
            'rows' => $rows,
        ];

        return $OUTPUT->render_from_template('local_configkeeper/confignote_row', $data);
    }
}
