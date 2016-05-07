<?php

/*
 * This file is part of the Active Collab Human Name Parser project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

namespace ActiveCollab\HumanNameParser\Test;

use ActiveCollab\HumanNameParser\Name;
use PHPUnit_Framework_TestCase;

/**
 * @package ActiveCollab\HumanNameParser\Test
 */
class NamesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Name
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Name("Björn O'Malley");
    }

    public function testSetStrRemovesWhitespaceAtEnds()
    {
        $this->object->setStr("	Björn O'Malley \r\n");
        $this->assertEquals(
            "Björn O'Malley",
            $this->object->getStr()
        );
    }

    public function testSetStrRemovesRedudentantWhitespace()
    {
        $this->object->setStr(" Björn	O'Malley"); //tab between names
        $this->assertEquals(
            "Björn O'Malley",
            $this->object->getStr()
        );
    }

    public function testChopWithRegexReturnsChoppedSubstring()
    {
        $this->object->setStr("Björn O'Malley");
        $this->assertEquals(
            'Björn',
            $this->object->chopWithRegex('/^([^ ]+)(.+)/', 1)
        );
    }

    public function testChopWithRegexChopsStartOffNameStr()
    {
        $this->object->setStr("Björn O'Malley");
        $this->object->chopWithRegex('/^[^ ]+/', 0);
        $this->assertEquals(
            "O'Malley",
            $this->object->getStr()
        );
    }

    public function testChopWithRegexChopsEndOffNameStr()
    {
        $this->object->setStr("Björn O'Malley");
        $this->object->chopWithRegex('/ (.+)$/', 1);
        $this->assertEquals(
            'Björn',
            $this->object->getStr()
        );
    }

    public function testChopWithRegexChopsMiddleFromNameStr()
    {
        $this->object->setStr("Björn 'Bill' O'Malley");
        $this->object->chopWithRegex("/\ '[^']+' /", 0);
        $this->assertEquals(
            "Björn O'Malley",
            $this->object->getStr()
        );
    }

    public function testFlip()
    {
        $this->object->setStr("O'Malley, Björn");
        $this->object->flip(',');
        $this->assertEquals(
            "Björn O'Malley",
            $this->object->getStr()
        );
    }
}
