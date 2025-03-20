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
use core_reportbuilder\local\report\column;
use lang_string;
use stdClass;

/**
 * Config change entity for local_configkeeper plugin reportbuilder
 *
 * @package   local_configkeeper
 * @copyright 2025 Jon Deavers <jondeavers@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class config_note extends base {

    /**
     * Get the default table aliases
     *
     * @return string[]
     */
    protected function get_default_table_aliases(): array {
        return [
            'local_configkeeper_note' => 'lcn',
            'config_log' => 'cl',
        ];
    }

    /**
     * Get the default entity title
     *
     * @return lang_string
     */
    protected function get_default_entity_title(): lang_string {
        return new lang_string('entity:config_note', 'local_configkeeper');
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
     * @throws \coding_exception
     */
    public function get_all_columns(): array {
        $columns = [];
        $entityalias = $this->get_table_alias('local_configkeeper_note');
        $entityname = $this->get_entity_name();

        // Note column.
        $columns[] = (new column(
            'confignote',
            new lang_string("entity:config_note", 'local_configkeeper'),
            $entityname,
        ))->add_joins($this->get_joins())
            ->set_type(column::TYPE_TEXT)
            ->add_fields("{$entityalias}.logid, {$entityalias}.note")
            ->add_callback(static function(?string $value, $row): string {
                return self::get_confignote_field($value, $row);
            });

        // Actions column.
        $columns[] = (new column(
            'actions',
            new lang_string('actions'),
            $entityname,
        ))->add_joins($this->get_joins())
            ->set_type(column::TYPE_TEXT)
            ->add_fields("{$entityalias}.logid")
            ->add_callback(static function(?string $value, $row): string {
                return self::get_actions_field($value, $row);
            });

        return $columns;
    }

    /**
     * Get all filters
     *
     * @return array
     */
    public function get_all_filters(): array {
        return [];
    }

    /**
     * Callback for the note field
     *
     * @param int $value
     * @param stdClass $row
     * @return string
     */
    public static function get_confignote_field(int $value, stdClass $row): string {
        return $row->note;
    }

    /**
     * Callback for the actions field
     *
     * @param int|null $value
     * @param stdClass $row
     * @return string
     */
    private static function get_actions_field(?int $value, $row) {
        return '';
    }
}
