# Traits collection for Laravel

## Requirements
- PHP >= 8.2
- `ext-mbstring`
- Laravel >= 11

## Traits
### Commands
- [TableFormatter](src/Console/Command/TableFormatter.php) - provides utility functions for formatting table rows with
specified column widths, ideal for console output.
### Service Providers
- [PublishesMigrations](src/ServiceProviders/PublishesMigrations.php) - The following traits is intended for package 
developers. This will find all migrations properly named located in the default `database/migrations` directory, and it
will proceed to register each of them as publishable.