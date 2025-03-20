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
use local_configkeeper\reportbuilder\local\entities\config_note;
use report_configlog\reportbuilder\local\entities\config_change;

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
        // Main entity.
        $entitymain = new config_note();
        $entitymainalias = $entitymain->get_table_alias('local_configkeeper_note');
        $this->set_main_table('local_configkeeper_note', $entitymainalias);
        $this->add_entity($entitymain);

        // Config change entity.
        $entityconfigchange = new config_change();
        $entityconfigchangealias = $entityconfigchange->get_table_alias('config_log');
        $this->add_entity($entityconfigchange->add_join(
            "JOIN {config_log} {$entityconfigchangealias} ON {$entityconfigchangealias}.id = {$entitymainalias}.logid"
        ));

        // Add table to report.
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
        return true;
    }

    /**
     * Add columns to report
     *
     * @return void
     */
    public function add_columns(): void {
        $columns = [
            'config_change:plugin',
            'config_change:setting',
            'config_change:timemodified',
            'config_note:confignote',
            'config_note:actions',
        ];

        $this->add_columns_from_entities($columns);
    }

    /**
     * Add filters to report
     *
     * @return void
     */
    public function add_filters(): void {
        $filters = [
            'config_change:setting',
        ];

        $this->add_filters_from_entities($filters);
    }
}
