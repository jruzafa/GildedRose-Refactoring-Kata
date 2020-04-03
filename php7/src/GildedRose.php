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

                case self::BACKSTAGE_PASSES_TO_A_TAFKAL_80_ETC_CONCERT:
                    $this->decreaseSellIn($item);

                    if ($item->quality < self::MAX_QUALITY) {

                        $this->increaseQuality($item);

                        if ($item->sell_in < 11) {
                            if ($item->quality < self::MAX_QUALITY) {
                                $this->increaseQuality($item);
                            }
                        }

                        if ($item->sell_in < 6) {
                            if ($item->quality < self::MAX_QUALITY) {
                                $this->increaseQuality($item);
                            }
                        }
                    }
                    
                    if ($item->sell_in < 0) {
                        if ($item->name != self::AGED_BRIE) {
                            $this->resetQuality($item);
                        }
                    }

                    break;

                case self::AGED_BRIE:
                    $this->decreaseSellIn($item);

                    if ($item->quality < self::MAX_QUALITY) {
                        $this->increaseQuality($item);
                    }

                    if ($item->sell_in < 0) {
                        if ($item->quality < self::MAX_QUALITY) {
                            $this->increaseQuality($item);
                        }
                    }

                    break;


                case self::SULFURAS_HAND_OF_RAGNAROS:
                    break;

                default: // Conjured or others
                    $this->decreaseQuality($item);
                    $this->decreaseSellIn($item);

                    if ($item->sell_in < 0) {
                        if ($item->name != self::AGED_BRIE) {
                            if ($item->name != self::BACKSTAGE_PASSES_TO_A_TAFKAL_80_ETC_CONCERT) {
                                if ($item->quality > self::MIN_QUALITY) {
                                    if ($item->name != self::SULFURAS_HAND_OF_RAGNAROS) {
                                        $this->decreaseQuality($item);
                                    }
                                }
                            }
                        }
                    }

                    break;
            }

        }
    }

    /**
     * @param $item
     */
    private function decreaseQuality( $item )
    {
        $item->quality -= 1;
    }

    /**
     * @param $item
     */
    private function increaseQuality( $item )
    {
        $item->quality += 1;
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
}

