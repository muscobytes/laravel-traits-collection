<?php
namespace Muscobytes\Laravel\TraitsCollection\Tests\Unit\Console\Command;

use Muscobytes\Laravel\TraitsCollection\Console\Command\TableFormatter;
use Muscobytes\Laravel\TraitsCollection\Tests\Console\Command\BaseTest;
use PHPUnit\Framework\Attributes\CoversMethod;

#[CoversMethod(TableFormatter::class, 'formatRow')]
class TableFormatterTest extends BaseTest
{
    public function testFormat()
    {
        $class = new class {
            use TableFormatter;
        };

        $result = $class->formatRow([1, 'Name', 'Third']);
        $this->assertEquals('1                   Name                Third               ', $result);

        $result = $class->formatRow([
            'random',
            'some string that should be truncated because of it\'s length',
            'third column value'
        ]);
        $this->assertEquals('random              some string that s… third column value  ', $result);

        $result = $class->formatRow([
            'random',
            'some string that should be truncated because of it\'s length',
            'third column value'
        ], [5, 10, 10]);
        $this->assertEquals('ran… some str… third co… ', $result);
    }
}