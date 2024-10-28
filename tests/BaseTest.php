<?php

namespace Muscobytes\Laravel\TraitsCollection\Tests\Console\Command;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(BaseTest::class)]
class BaseTest extends TestCase
{
    public function testTrue()
    {
        $this->assertTrue(true);
    }
}