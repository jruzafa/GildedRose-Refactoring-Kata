<?php

namespace App;

final class GildedRose {

    const BACKSTAGE_PASSES_TO_A_TAFKAL_80_ETC_CONCERT = 'Backstage passes to a TAFKAL80ETC concert';
    const SULFURAS_HAND_OF_RAGNAROS = 'Sulfuras, Hand of Ragnaros';
    const AGED_BRIE = 'Aged Brie';
    const MAX_QUALITY = 50;
    const MIN_QUALITY = 0;

    private $items = [];

    public function __construct($items) {
        $this->items = $items;
    }

    public function updateQuality() {
        foreach ($this->items as $item) {

            switch ($item->name){

                case self::SULFURAS_HAND_OF_RAGNAROS:
                    break;

                case self::BACKSTAGE_PASSES_TO_A_TAFKAL_80_ETC_CONCERT:
                    $this->decreaseSellIn($item);
                    $this->updateBackstagePassesQuality($item);
                    break;

                case self::AGED_BRIE:
                    $this->decreaseSellIn($item);
                    $this->updateAgedBrieQuality($item);
                    break;

                default: // Conjured or others types of items
                    $this->decreaseSellIn($item);
                    $this->updateDefaultItemQuality($item);
                    break;
            }

        }
    }

    /**
     * @param $item
     */
    private function decreaseQuality( $item )
    {
        if ($item->quality > self::MIN_QUALITY) {
            $item->quality -= 1;
        }
    }

    /**
     * @param $item
     */
    private function increaseQuality( $item )
    {

        if ($item->quality < self::MAX_QUALITY) {
            $item->quality += 1;
        }

    }

    /**
     * @param $item
     */
    private function decreaseSellIn( $item )
    {
        $item->sell_in -= 1;
    }

    /**
     * @param $item
     */
    private function resetQuality( $item )
    {
        $item->quality = 0;
    }

    /**
     * @param $item
     */
    private function updateBackstagePassesQuality( $item )
    {
        $this->increaseQuality($item);

        if ($item->sell_in < 11) {
            $this->increaseQuality($item);
        }

        if ($item->sell_in < 6) {
            $this->increaseQuality($item);
        }

        if ($item->sell_in < 0) {
            $this->resetQuality($item);
        }
    }

    /**
     * @param $item
     */
    private function updateAgedBrieQuality( $item )
    {
        $this->increaseQuality($item);

        if ($item->sell_in < 0) {
            $this->increaseQuality($item);
        }

    }

    /**
     * @param $item
     */
    private function updateDefaultItemQuality( $item )
    {
        $this->decreaseQuality($item);

        if ($item->sell_in < 0) {
            $this->decreaseQuality($item);
        }
    }
}

