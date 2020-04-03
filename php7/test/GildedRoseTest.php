<?php

namespace App;

class GildedRoseTest extends \PHPUnit\Framework\TestCase {
    public function testFoo() {
        $items      = [new Item("fixme", 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals("fixme", $items[0]->name);
    }

    public function testCheckDegradeInTowUnitsQualityConjuredItem(){
        $items      = [new Item("Conjured Mana Cake", 3, 6)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(4, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(2, $items[0]->quality);
    }
}
