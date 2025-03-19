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

use local_configkeeper\local\data\config_change;

/**
 * Data handling class for config changes
 *
 * @package   local_configkeeper
 * @copyright 2025 Jon Deavers <jondeavers@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class config_change_handler {
    /**
     * Create a config change record
     *
     * @param array $data
     * @return void
     */
    public function process_observer(array $data): void {
        $debug = [
            'data' => $data,
        ];
        file_put_contents('/tmp/DEBUG.json', json_encode($debug) . PHP_EOL, FILE_APPEND);

        config_change::create_from_observer($data);
    }
}
