<?php
/**
 * TableFormatter
 * The TableFormatter trait provides utility functions for formatting table rows with specified column widths, ideal for
 * console output. It includes methods to truncate values to fit within defined column widths and to generate formatted
 * rows based on these specifications.
 *
 * ## Installation
 * To use this trait in your Laravel project, include it within any class where you want to format table rows. Ensure the
 * class imports the trait and Laravel's autoloading recognizes it.
 *
 * ## Usage
 * ```php
 *  use Illuminate\Console\Command;
 *  use Muscobytes\Laravel\TraitsCollection\Command\TableFormatter;
 *
 *  class MyCommand extends Command
 *  {
 *      use TableFormatter;
 *
 *      protected $signature = 'app:mycommand';
 *
 *      protected $description = 'Example command';
 *
 *      public function handle(): void
 *      {
 *          $row = ['Name' => 'John Doe', 'Role' => 'Developer'];
 *          $widths = [ 15, 20 ];
 *
 *          $this->formatRow($row, $widths);
 *      }
 *  }
 *
 * This trait is designed primarily for console output where fixed-width columns are required.
 * The trait assumes multi-byte encoding compatibility using PHP's mb_ string functions for accurate truncation.
 *
 * ## License
 * This trait is open-source and can be freely used within any project compliant with the MIT License.
 */

namespace Muscobytes\Laravel\TraitsCollection\Console\Command;

trait TableFormatter
{
    protected const DEFAULT_COLUMN_WIDTH = 20;


    protected function arrayCombineKeys(
        array $array1,
        string $key1,
        array $array2,
        string $key2
    ): array {
        $result = [];

        foreach ($array1 as $key => $value1) {
            $value2 = $array2[$key] ?? self::DEFAULT_COLUMN_WIDTH;
            $result[] = [
                $key1 => $this->getTruncatedValue((string)$value1, $value2),
                $key2 => (int)$value2
            ];
        }

        return $result;
    }


    protected function getTruncatedValue(string $string, int $length): string
    {
        return mb_strlen(mb_substr($string, 0, $length - 2)) == mb_strlen($string)
            ? $string
            : mb_substr($string, 0, $length - 2) . "\u{2026}" // "…"
            ;
    }


    public function formatRow(array $row, array $widths = []): string
    {
        return implode('', array_map(function($row) {
            return $row['value'] . str_repeat(' ', $row['width'] - mb_strlen($row['value']));
        }, $this->arrayCombineKeys($row, 'value', $widths, 'width')));
    }
}
