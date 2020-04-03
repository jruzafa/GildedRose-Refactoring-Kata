<?php

namespace App;

class GildedRoseTest extends \PHPUnit\Framework\TestCase {
    public function testFoo() {
        $items      = [new Item("fixme", 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("fixme", $items[0]->name);
    }
}
