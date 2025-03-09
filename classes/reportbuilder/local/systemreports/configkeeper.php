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

namespace local_configkeeper\reportbuilder\local\systemreports;

use core_reportbuilder\system_report;

/**
 * System report for local_configkeeper plugin
 *
 * @package   local_configkeeper
 * @copyright 2025 Jon Deavers <jondeavers@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class configkeeper extends system_report {
    /**
     * Initialise the report
     *
     * @return void
     */
    protected function initialise(): void {

        $this->add_columns();
        $this->add_filters();
        $this->set_downloadable(true);
    }

    /**
     * Check permissions
     *
     * @return bool
     */
    protected function can_view(): bool {
        // TODO: Add a capability check here.
        return true;
    }

    /**
     * Add columns to report
     *
     * @return void
     */
    public function add_columns(): void {
        $columns = [];

        $this->add_columns_from_entities($columns);
    }

    /**
     * Add filters to report
     *
     * @return void
     */
    public function add_filters(): void {
        $filters = [];

        $this->add_filters_from_entities($filters);
    }
}
