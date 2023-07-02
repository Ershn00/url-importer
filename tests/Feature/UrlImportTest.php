<?php

namespace App\Tests\Feature;

use App\Filter\HttpFilter;
use PHPUnit\Framework\TestCase;

class UrlImportTest extends TestCase
{
    public function testApplyWithHttpUrl()
    {
        $httpFilter = new HttpFilter();

        $result = $httpFilter->apply('http://example.com');

        $this->assertTrue($result);
    }

    public function testApplyWithHttpsUrl()
    {
        $httpFilter = new HttpFilter();

        $result = $httpFilter->apply('https://example.com');

        $this->assertTrue($result);
    }

    public function testApplyWithNonHttpUrl()
    {
        $httpFilter = new HttpFilter();

        $result = $httpFilter->apply('ftp://example.com');

        $this->assertFalse($result);
    }
}