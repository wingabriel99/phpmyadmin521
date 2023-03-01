<?php

declare(strict_types=1);

namespace PhpMyAdmin\Tests\Config\Settings;

use PhpMyAdmin\Config\Settings\Export;
use PHPUnit\Framework\TestCase;

use function array_keys;
use function array_merge;

/** @covers \PhpMyAdmin\Config\Settings\Export */
class ExportTest extends TestCase
{
    /** @var array<string, bool|int|string> */
    private array $defaultValues = [
        'format' => 'sql',
        'method' => 'quick',
        'compression' => 'none',
        'lock_tables' => false,
        'as_separate_files' => false,
        'asfile' => true,
        'charset' => '',
        'onserver' => false,
        'onserver_overwrite' => false,
        'quick_export_onserver' => false,
        'quick_export_onserver_overwrite' => false,
        'remember_file_template' => true,
        'file_template_table' => '@TABLE@',
        'file_template_database' => '@DATABASE@',
        'file_template_server' => '@SERVER@',
        'codegen_structure_or_data' => 'data',
        'codegen_format' => 0,
        'ods_columns' => false,
        'ods_null' => 'NULL',
        'odt_structure_or_data' => 'structure_and_data',
        'odt_columns' => true,
        'odt_relation' => true,
        'odt_comments' => true,
        'odt_mime' => true,
        'odt_null' => 'NULL',
        'htmlword_structure_or_data' => 'structure_and_data',
        'htmlword_columns' => false,
        'htmlword_null' => 'NULL',
        'texytext_structure_or_data' => 'structure_and_data',
        'texytext_columns' => false,
        'texytext_null' => 'NULL',
        'csv_columns' => true,
        'csv_structure_or_data' => 'data',
        'csv_null' => 'NULL',
        'csv_separator' => ',',
        'csv_enclosed' => '"',
        'csv_escaped' => '"',
        'csv_terminated' => 'AUTO',
        'csv_removeCRLF' => false,
        'excel_columns' => true,
        'excel_null' => 'NULL',
        'excel_edition' => 'win',
        'excel_removeCRLF' => false,
        'excel_structure_or_data' => 'data',
        'latex_structure_or_data' => 'structure_and_data',
        'latex_columns' => true,
        'latex_relation' => true,
        'latex_comments' => true,
        'latex_mime' => true,
        'latex_null' => '\\textit{NULL}',
        'latex_caption' => true,
        'latex_structure_caption' => 'strLatexStructure',
        'latex_structure_continued_caption' => 'strLatexStructure strLatexContinued',
        'latex_data_caption' => 'strLatexContent',
        'latex_data_continued_caption' => 'strLatexContent strLatexContinued',
        'latex_data_label' => 'tab:@TABLE@-data',
        'latex_structure_label' => 'tab:@TABLE@-structure',
        'mediawiki_structure_or_data' => 'data',
        'mediawiki_caption' => true,
        'mediawiki_headers' => true,
        'ods_structure_or_data' => 'data',
        'pdf_structure_or_data' => 'data',
        'phparray_structure_or_data' => 'data',
        'json_structure_or_data' => 'data',
        'json_pretty_print' => false,
        'json_unicode' => true,
        'sql_structure_or_data' => 'structure_and_data',
        'sql_compatibility' => 'NONE',
        'sql_include_comments' => true,
        'sql_disable_fk' => false,
        'sql_views_as_tables' => false,
        'sql_metadata' => false,
        'sql_use_transaction' => true,
        'sql_create_database' => false,
        'sql_drop_database' => false,
        'sql_drop_table' => false,
        'sql_if_not_exists' => false,
        'sql_view_current_user' => false,
        'sql_or_replace_view' => false,
        'sql_procedure_function' => true,
        'sql_create_table' => true,
        'sql_create_view' => true,
        'sql_create_trigger' => true,
        'sql_auto_increment' => true,
        'sql_backquotes' => true,
        'sql_dates' => false,
        'sql_relation' => false,
        'sql_truncate' => false,
        'sql_delayed' => false,
        'sql_ignore' => false,
        'sql_utc_time' => true,
        'sql_hex_for_binary' => true,
        'sql_type' => 'INSERT',
        'sql_max_query_size' => 50000,
        'sql_mime' => false,
        'sql_header_comment' => '',
        'sql_insert_syntax' => 'both',
        'pdf_report_title' => '',
        'xml_structure_or_data' => 'data',
        'xml_export_struc' => true,
        'xml_export_events' => true,
        'xml_export_functions' => true,
        'xml_export_procedures' => true,
        'xml_export_tables' => true,
        'xml_export_triggers' => true,
        'xml_export_views' => true,
        'xml_export_contents' => true,
        'yaml_structure_or_data' => 'data',
    ];

    /**
     * @param mixed[][] $values
     * @psalm-param (array{0: string, 1: mixed, 2: mixed})[] $values
     *
     * @dataProvider providerForTestConstructor
     */
    public function testConstructor(array $values): void
    {
        $actualValues = [];
        $expectedValues = [];
        /** @psalm-suppress MixedAssignment */
        foreach ($values as $value) {
            $actualValues[$value[0]] = $value[1];
            $expectedValues[$value[0]] = $value[2];
        }

        $expected = array_merge($this->defaultValues, $expectedValues);
        $settings = new Export($actualValues);
        $exportArray = $settings->asArray();

        foreach (array_keys($expectedValues) as $key) {
            $this->assertSame($expected[$key], $settings->$key);
            $this->assertArrayHasKey($key, $exportArray);
            $this->assertSame($expected[$key], $exportArray[$key]);
        }
    }

    /**
     * [setting key, actual value, expected value]
     *
     * @return mixed[][][][]
     * @psalm-return (array{0: string, 1: mixed, 2: mixed})[][][]
     */
    public static function providerForTestConstructor(): array
    {
        return [
            'null values' => [
                [
                    ['format', null, 'sql'],
                    ['method', null, 'quick'],
                    ['compression', null, 'none'],
                    ['lock_tables', null, false],
                    ['as_separate_files', null, false],
                    ['asfile', null, true],
                    ['charset', null, ''],
                    ['onserver', null, false],
                    ['onserver_overwrite', null, false],
                    ['quick_export_onserver', null, false],
                    ['quick_export_onserver_overwrite', null, false],
                    ['remember_file_template', null, true],
                    ['file_template_table', null, '@TABLE@'],
                    ['file_template_database', null, '@DATABASE@'],
                    ['file_template_server', null, '@SERVER@'],
                    ['codegen_structure_or_data', null, 'data'],
                    ['codegen_format', null, 0],
                    ['ods_columns', null, false],
                    ['ods_null', null, 'NULL'],
                    ['odt_structure_or_data', null, 'structure_and_data'],
                    ['odt_columns', null, true],
                    ['odt_relation', null, true],
                    ['odt_comments', null, true],
                    ['odt_mime', null, true],
                    ['odt_null', null, 'NULL'],
                    ['htmlword_structure_or_data', null, 'structure_and_data'],
                    ['htmlword_columns', null, false],
                    ['htmlword_null', null, 'NULL'],
                    ['texytext_structure_or_data', null, 'structure_and_data'],
                    ['texytext_columns', null, false],
                    ['texytext_null', null, 'NULL'],
                    ['csv_columns', null, true],
                    ['csv_structure_or_data', null, 'data'],
                    ['csv_null', null, 'NULL'],
                    ['csv_separator', null, ','],
                    ['csv_enclosed', null, '"'],
                    ['csv_escaped', null, '"'],
                    ['csv_terminated', null, 'AUTO'],
                    ['csv_removeCRLF', null, false],
                    ['excel_columns', null, true],
                    ['excel_null', null, 'NULL'],
                    ['excel_edition', null, 'win'],
                    ['excel_removeCRLF', null, false],
                    ['excel_structure_or_data', null, 'data'],
                    ['latex_structure_or_data', null, 'structure_and_data'],
                    ['latex_columns', null, true],
                    ['latex_relation', null, true],
                    ['latex_comments', null, true],
                    ['latex_mime', null, true],
                    ['latex_null', null, '\textit{NULL}'],
                    ['latex_caption', null, true],
                    ['latex_structure_caption', null, 'strLatexStructure'],
                    ['latex_structure_continued_caption', null, 'strLatexStructure strLatexContinued'],
                    ['latex_data_caption', null, 'strLatexContent'],
                    ['latex_data_continued_caption', null, 'strLatexContent strLatexContinued'],
                    ['latex_data_label', null, 'tab:@TABLE@-data'],
                    ['latex_structure_label', null, 'tab:@TABLE@-structure'],
                    ['mediawiki_structure_or_data', null, 'data'],
                    ['mediawiki_caption', null, true],
                    ['mediawiki_headers', null, true],
                    ['ods_structure_or_data', null, 'data'],
                    ['pdf_structure_or_data', null, 'data'],
                    ['phparray_structure_or_data', null, 'data'],
                    ['json_structure_or_data', null, 'data'],
                    ['json_pretty_print', null, false],
                    ['json_unicode', null, true],
                    ['sql_structure_or_data', null, 'structure_and_data'],
                    ['sql_compatibility', null, 'NONE'],
                    ['sql_include_comments', null, true],
                    ['sql_disable_fk', null, false],
                    ['sql_views_as_tables', null, false],
                    ['sql_metadata', null, false],
                    ['sql_use_transaction', null, true],
                    ['sql_create_database', null, false],
                    ['sql_drop_database', null, false],
                    ['sql_drop_table', null, false],
                    ['sql_if_not_exists', null, false],
                    ['sql_view_current_user', null, false],
                    ['sql_or_replace_view', null, false],
                    ['sql_procedure_function', null, true],
                    ['sql_create_table', null, true],
                    ['sql_create_view', null, true],
                    ['sql_create_trigger', null, true],
                    ['sql_auto_increment', null, true],
                    ['sql_backquotes', null, true],
                    ['sql_dates', null, false],
                    ['sql_relation', null, false],
                    ['sql_truncate', null, false],
                    ['sql_delayed', null, false],
                    ['sql_ignore', null, false],
                    ['sql_utc_time', null, true],
                    ['sql_hex_for_binary', null, true],
                    ['sql_type', null, 'INSERT'],
                    ['sql_max_query_size', null, 50000],
                    ['sql_mime', null, false],
                    ['sql_header_comment', null, ''],
                    ['sql_insert_syntax', null, 'both'],
                    ['pdf_report_title', null, ''],
                    ['xml_structure_or_data', null, 'data'],
                    ['xml_export_struc', null, true],
                    ['xml_export_events', null, true],
                    ['xml_export_functions', null, true],
                    ['xml_export_procedures', null, true],
                    ['xml_export_tables', null, true],
                    ['xml_export_triggers', null, true],
                    ['xml_export_views', null, true],
                    ['xml_export_contents', null, true],
                    ['yaml_structure_or_data', null, 'data'],
                ],
            ],
            'valid values' => [
                [
                    ['format', 'codegen', 'codegen'],
                    ['method', 'quick', 'quick'],
                    ['compression', 'none', 'none'],
                    ['lock_tables', false, false],
                    ['as_separate_files', false, false],
                    ['asfile', true, true],
                    ['charset', 'test', 'test'],
                    ['onserver', false, false],
                    ['onserver_overwrite', false, false],
                    ['quick_export_onserver', false, false],
                    ['quick_export_onserver_overwrite', false, false],
                    ['remember_file_template', true, true],
                    ['file_template_table', 'test', 'test'],
                    ['file_template_database', 'test', 'test'],
                    ['file_template_server', 'test', 'test'],
                    ['codegen_structure_or_data', 'structure', 'structure'],
                    ['codegen_format', 0, 0],
                    ['ods_columns', false, false],
                    ['ods_null', 'test', 'test'],
                    ['odt_structure_or_data', 'structure', 'structure'],
                    ['odt_columns', true, true],
                    ['odt_relation', true, true],
                    ['odt_comments', true, true],
                    ['odt_mime', true, true],
                    ['odt_null', 'test', 'test'],
                    ['htmlword_structure_or_data', 'structure', 'structure'],
                    ['htmlword_columns', false, false],
                    ['htmlword_null', 'test', 'test'],
                    ['texytext_structure_or_data', 'structure', 'structure'],
                    ['texytext_columns', false, false],
                    ['texytext_null', 'test', 'test'],
                    ['csv_columns', true, true],
                    ['csv_structure_or_data', 'structure', 'structure'],
                    ['csv_null', 'test', 'test'],
                    ['csv_separator', 'test', 'test'],
                    ['csv_enclosed', 'test', 'test'],
                    ['csv_escaped', 'test', 'test'],
                    ['csv_terminated', 'test', 'test'],
                    ['csv_removeCRLF', false, false],
                    ['excel_columns', true, true],
                    ['excel_null', 'test', 'test'],
                    ['excel_edition', 'win', 'win'],
                    ['excel_removeCRLF', false, false],
                    ['excel_structure_or_data', 'structure', 'structure'],
                    ['latex_structure_or_data', 'structure', 'structure'],
                    ['latex_columns', true, true],
                    ['latex_relation', true, true],
                    ['latex_comments', true, true],
                    ['latex_mime', true, true],
                    ['latex_null', 'test', 'test'],
                    ['latex_caption', true, true],
                    ['latex_structure_caption', 'test', 'test'],
                    ['latex_structure_continued_caption', 'test', 'test'],
                    ['latex_data_caption', 'test', 'test'],
                    ['latex_data_continued_caption', 'test', 'test'],
                    ['latex_data_label', 'test', 'test'],
                    ['latex_structure_label', 'test', 'test'],
                    ['mediawiki_structure_or_data', 'structure', 'structure'],
                    ['mediawiki_caption', true, true],
                    ['mediawiki_headers', true, true],
                    ['ods_structure_or_data', 'structure', 'structure'],
                    ['pdf_structure_or_data', 'structure', 'structure'],
                    ['phparray_structure_or_data', 'structure', 'structure'],
                    ['json_structure_or_data', 'structure', 'structure'],
                    ['json_pretty_print', false, false],
                    ['json_unicode', true, true],
                    ['sql_structure_or_data', 'structure', 'structure'],
                    ['sql_compatibility', 'NONE', 'NONE'],
                    ['sql_include_comments', true, true],
                    ['sql_disable_fk', false, false],
                    ['sql_views_as_tables', false, false],
                    ['sql_metadata', false, false],
                    ['sql_use_transaction', true, true],
                    ['sql_create_database', false, false],
                    ['sql_drop_database', false, false],
                    ['sql_drop_table', false, false],
                    ['sql_if_not_exists', false, false],
                    ['sql_view_current_user', false, false],
                    ['sql_or_replace_view', false, false],
                    ['sql_procedure_function', true, true],
                    ['sql_create_table', true, true],
                    ['sql_create_view', true, true],
                    ['sql_create_trigger', true, true],
                    ['sql_auto_increment', true, true],
                    ['sql_backquotes', true, true],
                    ['sql_dates', false, false],
                    ['sql_relation', false, false],
                    ['sql_truncate', false, false],
                    ['sql_delayed', false, false],
                    ['sql_ignore', false, false],
                    ['sql_utc_time', true, true],
                    ['sql_hex_for_binary', true, true],
                    ['sql_type', 'INSERT', 'INSERT'],
                    ['sql_max_query_size', 0, 0],
                    ['sql_mime', false, false],
                    ['sql_header_comment', 'test', 'test'],
                    ['sql_insert_syntax', 'complete', 'complete'],
                    ['pdf_report_title', 'test', 'test'],
                    ['xml_structure_or_data', 'structure', 'structure'],
                    ['xml_export_struc', true, true],
                    ['xml_export_events', true, true],
                    ['xml_export_functions', true, true],
                    ['xml_export_procedures', true, true],
                    ['xml_export_tables', true, true],
                    ['xml_export_triggers', true, true],
                    ['xml_export_views', true, true],
                    ['xml_export_contents', true, true],
                    ['yaml_structure_or_data', 'structure', 'structure'],
                ],
            ],
            'valid values 2' => [
                [
                    ['format', 'csv', 'csv'],
                    ['method', 'custom', 'custom'],
                    ['compression', 'zip', 'zip'],
                    ['lock_tables', true, true],
                    ['as_separate_files', true, true],
                    ['asfile', false, false],
                    ['onserver', true, true],
                    ['onserver_overwrite', true, true],
                    ['quick_export_onserver', true, true],
                    ['quick_export_onserver_overwrite', true, true],
                    ['remember_file_template', false, false],
                    ['codegen_structure_or_data', 'data', 'data'],
                    ['codegen_format', 1, 1],
                    ['ods_columns', true, true],
                    ['odt_structure_or_data', 'data', 'data'],
                    ['odt_columns', false, false],
                    ['odt_relation', false, false],
                    ['odt_comments', false, false],
                    ['odt_mime', false, false],
                    ['htmlword_structure_or_data', 'data', 'data'],
                    ['htmlword_columns', true, true],
                    ['texytext_structure_or_data', 'data', 'data'],
                    ['texytext_columns', true, true],
                    ['csv_columns', false, false],
                    ['csv_structure_or_data', 'data', 'data'],
                    ['csv_removeCRLF', true, true],
                    ['excel_columns', false, false],
                    ['excel_edition', 'mac_excel2003', 'mac_excel2003'],
                    ['excel_removeCRLF', true, true],
                    ['excel_structure_or_data', 'data', 'data'],
                    ['latex_structure_or_data', 'data', 'data'],
                    ['latex_columns', false, false],
                    ['latex_relation', false, false],
                    ['latex_comments', false, false],
                    ['latex_mime', false, false],
                    ['latex_caption', false, false],
                    ['mediawiki_structure_or_data', 'data', 'data'],
                    ['mediawiki_caption', false, false],
                    ['mediawiki_headers', false, false],
                    ['ods_structure_or_data', 'data', 'data'],
                    ['pdf_structure_or_data', 'data', 'data'],
                    ['phparray_structure_or_data', 'data', 'data'],
                    ['json_structure_or_data', 'data', 'data'],
                    ['json_pretty_print', true, true],
                    ['json_unicode', false, false],
                    ['sql_structure_or_data', 'data', 'data'],
                    ['sql_compatibility', 'ANSI', 'ANSI'],
                    ['sql_include_comments', false, false],
                    ['sql_disable_fk', true, true],
                    ['sql_views_as_tables', true, true],
                    ['sql_metadata', true, true],
                    ['sql_use_transaction', false, false],
                    ['sql_create_database', true, true],
                    ['sql_drop_database', true, true],
                    ['sql_drop_table', true, true],
                    ['sql_if_not_exists', true, true],
                    ['sql_view_current_user', true, true],
                    ['sql_or_replace_view', true, true],
                    ['sql_procedure_function', false, false],
                    ['sql_create_table', false, false],
                    ['sql_create_view', false, false],
                    ['sql_create_trigger', false, false],
                    ['sql_auto_increment', false, false],
                    ['sql_backquotes', false, false],
                    ['sql_dates', true, true],
                    ['sql_relation', true, true],
                    ['sql_truncate', true, true],
                    ['sql_delayed', true, true],
                    ['sql_ignore', true, true],
                    ['sql_utc_time', false, false],
                    ['sql_hex_for_binary', false, false],
                    ['sql_type', 'UPDATE', 'UPDATE'],
                    ['sql_mime', true, true],
                    ['sql_insert_syntax', 'extended', 'extended'],
                    ['xml_structure_or_data', 'data', 'data'],
                    ['xml_export_struc', false, false],
                    ['xml_export_events', false, false],
                    ['xml_export_functions', false, false],
                    ['xml_export_procedures', false, false],
                    ['xml_export_tables', false, false],
                    ['xml_export_triggers', false, false],
                    ['xml_export_views', false, false],
                    ['xml_export_contents', false, false],
                    ['yaml_structure_or_data', 'data', 'data'],
                ],
            ],
            'valid values 3' => [
                [
                    ['format', 'excel', 'excel'],
                    ['method', 'custom-no-form', 'custom-no-form'],
                    ['compression', 'gzip', 'gzip'],
                    ['codegen_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['odt_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['htmlword_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['texytext_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['csv_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['excel_edition', 'mac_excel2008', 'mac_excel2008'],
                    ['excel_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['latex_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['mediawiki_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['ods_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['pdf_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['phparray_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['json_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['sql_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['sql_compatibility', 'DB2', 'DB2'],
                    ['sql_type', 'REPLACE', 'REPLACE'],
                    ['sql_insert_syntax', 'both', 'both'],
                    ['xml_structure_or_data', 'structure_and_data', 'structure_and_data'],
                    ['yaml_structure_or_data', 'structure_and_data', 'structure_and_data'],
                ],
            ],
            'valid values 4' => [
                [
                    ['format', 'htmlexcel', 'htmlexcel'],
                    ['sql_compatibility', 'MAXDB', 'MAXDB'],
                    ['sql_insert_syntax', 'none', 'none'],
                ],
            ],
            'valid values 5' => [
                [
                    ['format', 'htmlword', 'htmlword'],
                    ['sql_compatibility', 'MYSQL323', 'MYSQL323'],
                ],
            ],
            'valid values 6' => [
                [
                    ['format', 'latex', 'latex'],
                    ['sql_compatibility', 'MYSQL40', 'MYSQL40'],
                ],
            ],
            'valid values 7' => [
                [
                    ['format', 'ods', 'ods'],
                    ['sql_compatibility', 'MSSQL', 'MSSQL'],
                ],
            ],
            'valid values 8' => [
                [
                    ['format', 'odt', 'odt'],
                    ['sql_compatibility', 'ORACLE', 'ORACLE'],
                ],
            ],
            'valid values 9' => [
                [
                    ['format', 'pdf', 'pdf'],
                    ['sql_compatibility', 'TRADITIONAL', 'TRADITIONAL'],
                ],
            ],
            'valid values 10' => [[['format', 'sql', 'sql']]],
            'valid values 11' => [[['format', 'texytext', 'texytext']]],
            'valid values 12' => [[['format', 'xml', 'xml']]],
            'valid values 13' => [[['format', 'yaml', 'yaml']]],
            'valid values with type coercion' => [
                [
                    ['lock_tables', 1, true],
                    ['as_separate_files', 1, true],
                    ['asfile', 0, false],
                    ['charset', 1234, '1234'],
                    ['onserver', 1, true],
                    ['onserver_overwrite', 1, true],
                    ['quick_export_onserver', 1, true],
                    ['quick_export_onserver_overwrite', 1, true],
                    ['remember_file_template', 0, false],
                    ['file_template_table', 1234, '1234'],
                    ['file_template_database', 1234, '1234'],
                    ['file_template_server', 1234, '1234'],
                    ['codegen_format', '1', 1],
                    ['ods_columns', 1, true],
                    ['ods_null', 1234, '1234'],
                    ['odt_columns', 0, false],
                    ['odt_relation', 0, false],
                    ['odt_comments', 0, false],
                    ['odt_mime', 0, false],
                    ['odt_null', 1234, '1234'],
                    ['htmlword_columns', 1, true],
                    ['htmlword_null', 1234, '1234'],
                    ['texytext_columns', 1, true],
                    ['texytext_null', 1234, '1234'],
                    ['csv_columns', 1, true],
                    ['csv_null', 1234, '1234'],
                    ['csv_separator', 1234, '1234'],
                    ['csv_enclosed', 1234, '1234'],
                    ['csv_escaped', 1234, '1234'],
                    ['csv_terminated', 1234, '1234'],
                    ['csv_removeCRLF', 1, true],
                    ['excel_columns', 0, false],
                    ['excel_null', 1234, '1234'],
                    ['excel_removeCRLF', 1, true],
                    ['latex_columns', 0, false],
                    ['latex_relation', 0, false],
                    ['latex_comments', 0, false],
                    ['latex_mime', 0, false],
                    ['latex_null', 1234, '1234'],
                    ['latex_caption', 0, false],
                    ['latex_structure_caption', 1234, '1234'],
                    ['latex_structure_continued_caption', 1234, '1234'],
                    ['latex_data_caption', 1234, '1234'],
                    ['latex_data_continued_caption', 1234, '1234'],
                    ['latex_data_label', 1234, '1234'],
                    ['latex_structure_label', 1234, '1234'],
                    ['mediawiki_caption', 0, false],
                    ['mediawiki_headers', 0, false],
                    ['json_pretty_print', 1, true],
                    ['json_unicode', 0, false],
                    ['sql_include_comments', 0, false],
                    ['sql_disable_fk', 1, true],
                    ['sql_views_as_tables', 1, true],
                    ['sql_metadata', 1, true],
                    ['sql_use_transaction', 0, false],
                    ['sql_create_database', 1, true],
                    ['sql_drop_database', 1, true],
                    ['sql_drop_table', 1, true],
                    ['sql_if_not_exists', 1, true],
                    ['sql_view_current_user', 1, true],
                    ['sql_or_replace_view', 1, true],
                    ['sql_procedure_function', 0, false],
                    ['sql_create_table', 0, false],
                    ['sql_create_view', 0, false],
                    ['sql_create_trigger', 0, false],
                    ['sql_auto_increment', 0, false],
                    ['sql_backquotes', 0, false],
                    ['sql_dates', 1, true],
                    ['sql_relation', 1, true],
                    ['sql_truncate', 1, true],
                    ['sql_delayed', 1, true],
                    ['sql_ignore', 1, true],
                    ['sql_utc_time', 0, false],
                    ['sql_hex_for_binary', 0, false],
                    ['sql_max_query_size', '1', 1],
                    ['sql_mime', 1, true],
                    ['sql_header_comment', 1234, '1234'],
                    ['pdf_report_title', 1234, '1234'],
                    ['xml_export_struc', 0, false],
                    ['xml_export_events', 0, false],
                    ['xml_export_functions', 0, false],
                    ['xml_export_procedures', 0, false],
                    ['xml_export_tables', 0, false],
                    ['xml_export_triggers', 0, false],
                    ['xml_export_views', 0, false],
                    ['xml_export_contents', 0, false],
                ],
            ],
            'invalid values' => [
                [
                    ['format', 'invalid', 'sql'],
                    ['method', 'invalid', 'quick'],
                    ['compression', 'invalid', 'none'],
                    ['codegen_structure_or_data', 'invalid', 'data'],
                    ['codegen_format', -1, 0],
                    ['odt_structure_or_data', 'invalid', 'structure_and_data'],
                    ['htmlword_structure_or_data', 'invalid', 'structure_and_data'],
                    ['texytext_structure_or_data', 'invalid', 'structure_and_data'],
                    ['csv_structure_or_data', 'invalid', 'data'],
                    ['excel_edition', 'invalid', 'win'],
                    ['excel_structure_or_data', 'invalid', 'data'],
                    ['latex_structure_or_data', 'invalid', 'structure_and_data'],
                    ['mediawiki_structure_or_data', 'invalid', 'data'],
                    ['ods_structure_or_data', 'invalid', 'data'],
                    ['pdf_structure_or_data', 'invalid', 'data'],
                    ['phparray_structure_or_data', 'invalid', 'data'],
                    ['json_structure_or_data', 'invalid', 'data'],
                    ['sql_structure_or_data', 'invalid', 'structure_and_data'],
                    ['sql_compatibility', 'invalid', 'NONE'],
                    ['sql_type', 'invalid', 'INSERT'],
                    ['sql_max_query_size', -1, 50000],
                    ['sql_insert_syntax', 'invalid', 'both'],
                    ['xml_structure_or_data', 'invalid', 'data'],
                    ['yaml_structure_or_data', 'invalid', 'data'],
                ],
            ],
            'invalid values 2' => [[['codegen_format', 2, 0]]],
        ];
    }
}
