<?php

class GildedRose {

    private $items;

    function __construct($items) {
        $this->items = $items;
    }

    function normal_tick ($item) { 
    	if ($item->quality != 0) {
	    	$item->quality = $item->quality - 1;
	    	if ($item->sell_in <= 0)
	    		$item->quality = $item->quality - 1;
    	}
    	$item->sell_in = $item->sell_in - 1;
    }
    
    function aged_brie_tick ($item) {
    	if ($item->quality < 50) {
    		$item->quality = $item->quality + 1;
    		if ($item->sell_in <= 0)
    			$item->quality = $item->quality + 1; 			
    	}			 
    	$item->sell_in = $item->sell_in - 1;    	
    }
    
    function sulfuras_tick ($item) {
    }
    
    function backstage_tick ($item) {
    	if ($item->quality < 50) {
    		if ($item->sell_in > 10) {
    			$item->quality = $item->quality + 1;
    		}
    		if ($item->sell_in <= 10) {    			
    			$item->quality = $item->quality + 2;
    		}
    		if ($item->sell_in <= 5) {
    			$item->quality = $item->quality + 1;
    		}
    		if ($item->quality > 50) {
    			$item->quality = 50;
    		}
    	}
    	if ($item->sell_in <= 0) {
    		$item->quality = 0;
    	}
    	$item->sell_in = $item->sell_in - 1;
    }
    
    function update_quality() {
        foreach ($this->items as $item) {
        	
        	if ($item->name == "Normal") {
        		$this->normal_tick($item);
        		continue;
        	}
        	
        	if ($item->name == "Aged Brie") {
        		$this->aged_brie_tick($item);
        		continue;
        	}
        	
        	if ($item->name == "Sulfuras, Hand of Ragnarose") {
        		$this->sulfuras_tick($item);
        		continue;
        	}
        	
        	if ($item->name == "Backstage passes to a TAFKAL80ETC concert") {
        		$this->backstage_tick($item);
        		continue;
        	}
        	
            if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality > 0) {
                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sell_in < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sell_in < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }
            
            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->sell_in = $item->sell_in - 1;
            }
            
            if ($item->sell_in < 0) {
                if ($item->name != 'Aged Brie') {
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality > 0) {
                            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}

class Item {

    public $name;
    public $sell_in;
    public $quality;

    function __construct($name, $sell_in, $quality) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}

