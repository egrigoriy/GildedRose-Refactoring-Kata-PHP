<?php

class GildedRose {

	private $items;

	function __construct($items) {
		$this->items = $items;
	}

	function update_quality() {
		foreach ($this->items as $item) {
			 
			switch ($item->name) {
				case "Normal":
					$this->normal_tick($item);
					break;
				case "Aged Brie":
					$this->aged_brie_tick($item);
					break;
				case "Sulfuras, Hand of Ragnarose":
					$this->sulfuras_tick($item);
					break;
				case "Backstage passes to a TAFKAL80ETC concert":
					$this->backstage_tick($item);
					break;
			}
		}
	}

	function normal_tick($item) {
		$normal = new Normal($item->sell_in, $item->quality);
		$normal->tick($item);
	}

	function aged_brie_tick ($item) {
		$brie = new Brie($item->sell_in, $item->quality);
		$brie->tick($item);
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

Class Normal {

	function __construct($sell_in, $quality) {
		$this->sell_in = $sell_in;
		$this->quality = $quality;
	}

	function tick ($item) {
		if ($item->quality != 0) {
			$item->quality = $item->quality - 1;
			if ($item->sell_in <= 0)
				$item->quality = $item->quality - 1;
		}
		$item->sell_in = $item->sell_in - 1;
	}
}

Class Brie {

	function __construct($sell_in, $quality) {
		$this->sell_in = $sell_in;
		$this->quality = $quality;
	}

	function tick ($item) {
		if ($item->quality < 50) {
			$item->quality = $item->quality + 1;
			if ($item->sell_in <= 0)
				$item->quality = $item->quality + 1;
		}
		$item->sell_in = $item->sell_in - 1;
	}
}