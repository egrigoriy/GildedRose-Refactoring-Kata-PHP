<?php

require_once dirname(__FILE__) . '/../src/gilded_rose.php';

class GildedRoseTest extends PHPUnit_Framework_TestCase {
   
    function test_normal_item_before_sell_date () {
    	$items = array(new Item("Normal", 5, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(9, $items[0]->quality);
    	$this->assertEquals(4, $items[0]->sell_in);
    }
    
    function test_normal_item_on_sell_date () {
    	$items = array(new Item("Normal", 0, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(8, $items[0]->quality);
    	$this->assertEquals(-1, $items[0]->sell_in);
    }
    
    
    function test_normal_item_after_sell_date() {
    	$items = array(new Item("Normal", -10, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(8, $items[0]->quality);
    	$this->assertEquals(-11, $items[0]->sell_in);
    }

    function test_normal_item_of_zero_quality() {
    	$items = array(new Item("Normal", 5, 0));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(0, $items[0]->quality);
    	$this->assertEquals(4, $items[0]->sell_in);
    }

    function test_brie_before_sell_date() {
    	$items = array(new Item("Aged Brie", 5, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(11, $items[0]->quality);
    	$this->assertEquals(4, $items[0]->sell_in);
    }

    function test_brie_before_sell_date_with_max_quality() {
    	$items = array(new Item("Aged Brie", 5, 50));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(50, $items[0]->quality);
    	$this->assertEquals(4, $items[0]->sell_in);
    }
    
    function test_brie_on_sell_date() {
    	$items = array(new Item("Aged Brie", 0, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(12, $items[0]->quality);
    	$this->assertEquals(-1, $items[0]->sell_in);
    }

    function test_brie_on_sell_date_near_max_quality() {
    	$items = array(new Item("Aged Brie", 5, 49));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(50, $items[0]->quality);
    	$this->assertEquals(4, $items[0]->sell_in);
    }

    function test_brie_on_sell_date_with_max_quality() {
    	$items = array(new Item("Aged Brie", 5, 50));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(50, $items[0]->quality);
    	$this->assertEquals(4, $items[0]->sell_in);
    }
 
    function test_brie_after_sell_date() {
    	$items = array(new Item("Aged Brie", -10, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(12, $items[0]->quality);
    	$this->assertEquals(-11, $items[0]->sell_in);
    }
    
    function test_brie_after_sell_date_with_max_quality() {
    	$items = array(new Item("Aged Brie", -10, 50));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(50, $items[0]->quality);
    	$this->assertEquals(-11, $items[0]->sell_in);
    }
    
    function test_sulfuras_before_sell_date() {
    	$items = array(new Item("Sulfuras, Hand of Ragnaros", -5, 80));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(80, $items[0]->quality);
    	$this->assertEquals(-5, $items[0]->sell_in);
    }

    function test_sulfuras_on_sell_date() {
    	$items = array(new Item("Sulfuras, Hand of Ragnaros", 0, 80));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(80, $items[0]->quality);
    	$this->assertEquals(0, $items[0]->sell_in);
    }

    function test_sulfuras_after_sell_date() {
    	$items = array(new Item("Sulfuras, Hand of Ragnaros", -10, 80));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(80, $items[0]->quality);
    	$this->assertEquals(-10, $items[0]->sell_in);
    }
    
    function test_backstage_pass_long_before_sell_date() {
    	$items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 11, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(11, $items[0]->quality);
    	$this->assertEquals(10, $items[0]->sell_in);
    }

    function test_backstage_pass_medium_close_to_sell_date_upper_bound() {
    	$items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 10, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(12, $items[0]->quality);
    	$this->assertEquals(9, $items[0]->sell_in);
    }
    
    function test_backstage_pass_medium_close_to_sell_date_upper_bound_at_max_quality() {
    	$items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 10, 50));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(50, $items[0]->quality);
    	$this->assertEquals(9, $items[0]->sell_in);
    }
    
    function test_backstage_pass_medium_close_to_sell_date_lower_bound() {
    	$items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 6, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(12, $items[0]->quality);
    	$this->assertEquals(5, $items[0]->sell_in);
    }

    function test_backstage_pass_medium_close_to_sell_date_lower_bound_at_max_quality() {
    	$items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 6, 50));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(50, $items[0]->quality);
    	$this->assertEquals(5, $items[0]->sell_in);
    }
    
    function test_backstage_pass_very_close_to_sell_date_upper_bound() {
    	$items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 5, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(13, $items[0]->quality);
    	$this->assertEquals(4, $items[0]->sell_in);
    }

    function test_backstage_pass_very_close_to_sell_date_upper_bound_at_max_quality() {
    	$items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 5, 50));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(50, $items[0]->quality);
    	$this->assertEquals(4, $items[0]->sell_in);
    }
    
    function test_backstage_pass_very_close_to_sell_date_lower_bound() {
    	$items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 1, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(13, $items[0]->quality);
    	$this->assertEquals(0, $items[0]->sell_in);
    }
    
    function test_backstage_pass_very_close_to_sell_date_lower_bound_at_max_quality() {
    	$items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 1, 50));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(50, $items[0]->quality);
    	$this->assertEquals(0, $items[0]->sell_in);
    }
    
    function test_backstage_pass_on_sell_date() {
    	$items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 0, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(0, $items[0]->quality);
    	$this->assertEquals(-1, $items[0]->sell_in);
    }

    function test_backstage_pass_after_sell_date() {
    	$items = array(new Item("Backstage passes to a TAFKAL80ETC concert", -10, 10));
    	$gildedRose = new GildedRose($items);
    	$gildedRose->update_quality();
    	$this->assertEquals(0, $items[0]->quality);
    	$this->assertEquals(-11, $items[0]->sell_in);
    }

//     function test_conjured_item_before_sell_date() {
//     	$this->markTestSkipped('must be revisited.');
//     	$items = array(new Item("Conjured Mana Cak", 5, 10));
//     	$gildedRose = new GildedRose($items);
//     	$gildedRose->update_quality();
//     	$this->assertEquals(8, $items[0]->quality);
//		$this->assertEquals(4, $items[0]->sell_in);
//     }
    
//     function test_conjured_item_at_zero_quality() {
//     	$this->markTestSkipped('must be revisited.');
//     	$items = array(new Item("Conjured Mana Cak", 5, 0));
//     	$gildedRose = new GildedRose($items);
//     	$gildedRose->update_quality();
//     	$this->assertEquals(0, $items[0]->quality);
//		$this->assertEquals(4, $items[0]->sell_in);
//     }

//     function test_conjured_item_on_sell_date() {
//     	$this->markTestSkipped('must be revisited.');
//     	$items = array(new Item("Conjured Mana Cak", 0, 10));
//     	$gildedRose = new GildedRose($items);
//     	$gildedRose->update_quality();
//     	$this->assertEquals(6, $items[0]->quality);
//		$this->assertEquals(-1, $items[0]->sell_in);
//     }

//     function test_conjured_item_on_sell_date_at_zero_quality() {
//     	$this->markTestSkipped('must be revisited.');
//     	$items = array(new Item("Conjured Mana Cak", 0, 0));
//     	$gildedRose = new GildedRose($items);
//     	$gildedRose->update_quality();
//     	$this->assertEquals(0, $items[0]->quality);
//		$this->assertEquals(-1, $items[0]->sell_in);
//     }
    
//     function test_conjured_item_after_sell_date() {
//     	$this->markTestSkipped('must be revisited.');
//     	$items = array(new Item("Conjured Mana Cak", -10, 10));
//     	$gildedRose = new GildedRose($items);
//     	$gildedRose->update_quality();
//     	$this->assertEquals(6, $items[0]->quality);
//		$this->assertEquals(-11, $items[0]->sell_in);
//     }
    
//     function test_conjured_item_after_sell_date_at_zero_quality() {
//     	$this->markTestSkipped('must be revisited.');
//     	$items = array(new Item("Conjured Mana Cak", -10, 0));
//     	$gildedRose = new GildedRose($items);
//     	$gildedRose->update_quality();
//     	$this->assertEquals(0, $items[0]->quality);
//		$this->assertEquals(-11, $items[0]->sell_in);
//     }
    
    function test_several_items() {
    	$items = array(new Item("Normal", 5, 10), 
    			       new Item("Aged Brie", 4, 10));
    	$gildedRose = new GildedRose($items);
    	
    	$gildedRose->update_quality();
    	
    	$this->assertEquals(4, $items[0]->sell_in, "Normal item sell_in");
    	$this->assertEquals(9, $items[0]->quality, "Normal item quality");
    	$this->assertEquals(3, $items[1]->sell_in, "Aged Brie items sell_in");
    	$this->assertEquals(11, $items[1]->quality, "Aged Brie items quality");

    	
    }
       

}





