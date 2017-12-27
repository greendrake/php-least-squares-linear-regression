<?php

declare(strict_types=1);

namespace Greendrake\LSLR;

use PHPUnit_Framework_TestCase;

class Test extends PHPUnit_Framework_TestCase
{

    public function testIt()
    {
        $finder = new Finder;
        // Data for a=2 and b=3:
        foreach ([
            [0, 3],
            [1, 5],
            [2, 7]
        ] as $data) {
            call_user_func_array([$finder, 'add'], $data);
        }
        list($a, $b) = $finder();
        $this->assertEquals(2, $a);
        $this->assertEquals(3, $b);
    }

}