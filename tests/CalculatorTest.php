<?php
/**
 * Created by Sabri Hamda.
 * Date: 19.09.18
 * Time: 10:54
 */

namespace App\Tests;


use App\Tools\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{

    public function testCalculate()
    {
        $calculator = new Calculator();
        $result = $calculator->calculate(30, 12);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }
}