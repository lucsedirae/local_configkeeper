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

namespace local_configkeeper\reportbuilder\local\entities;

use core_reportbuilder\local\entities\base;
use lang_string;

/**
 * Config change entity for local_configkeeper plugin reportbuilder
 *
 * @package   local_configkeeper
 * @copyright 2025 Jon Deavers <jondeavers@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class config_change extends base {
    /**
     * Get the default table aliases
     *
     * @return string[]
     */
    protected function get_default_table_aliases(): array {
        return [
            'local_configkeeper' => 'lc',
        ];
    }

    /**
     * Get the default entity title
     *
     * @return lang_string
     */
    protected function get_default_entity_title(): lang_string {
        return new lang_string('entity:config_change', 'local_configkeeper');
    }

    /**
     * Initialise the entity
     *
     * @return base
     */
    public function initialise(): base {
        $columns = $this->get_all_columns();
        foreach ($columns as $column) {
            $this->add_column($column);
        }

        $filters = $this->get_all_filters();
        foreach ($filters as $filter) {
            $this->add_filter($filter);
        }

        return $this;
    }

    /**
     * Get all columns
     *
     * @return array
     */
    public function get_all_columns(): array {
        return [];
    }

    /**
     * Get all filters
     *
     * @return array
     */
    public function get_all_filters(): array {
        return [];
    }
}
