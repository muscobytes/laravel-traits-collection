# TableFormatter Trait
The TableFormatter trait provides utility functions for formatting table rows with specified column widths, ideal for
console output. It includes methods to truncate values to fit within defined column widths and to generate formatted
rows based on these specifications.

## Requirement
- 'php-ext-mbstring'

## Namespace
```php
Muscobytes\Laravel\TraitsCollection\Command
```

## Installation
To use this trait in your Laravel project, include it within any class where you want to format table rows. Ensure the
class imports the trait and Laravel's autoloading recognizes it.

## Usage
```php
use Illuminate\Console\Command;
use Muscobytes\Laravel\TraitsCollection\Command\TableFormatter;

class MyCommand extends Command
{
    use TableFormatter;
    
        /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mycommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Example command';


    public function handle(): void
    {
        $row = ['Name' => 'John Doe', 'Role' => 'Developer'];
        $widths = ['Name' => 15, 'Role' => 20];

        $this->info(
            $this->formatRow($row, $widths)
        );
    }
}
```

This will output a formatted row with the Name column truncated to 15 characters and the Role column to 20 characters.

## Methods

### formatRow(array $row, array $widths = []): string
Formats a row for output by aligning each value to its specified column width. This method combines values and widths
and produces a formatted string.

#### Parameters:
- array `$row`: Array of row values.
- array `$widths`: Array of column widths.

#### Returns
- string - Formatted row as a single string.

## Constants
- `DEFAULT_COLUMN_WIDTH` - Defines the default column width (20) used when no width is specified.

## Notes
This trait is designed primarily for console output where fixed-width columns are required.
The trait assumes multi-byte encoding compatibility using PHP's mb_ string functions for accurate truncation.

## License
This trait is open-source and can be freely used within any project compliant with the MIT License.
