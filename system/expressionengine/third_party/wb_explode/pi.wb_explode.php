<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once PATH_THIRD.'wb_explode/config.php';

$plugin_info = array(
	'pi_name'        => EXPLODE_NAME,
	'pi_version'     => EXPLODE_VER,
	'pi_author'      => EXPLODE_AUTHOR,
	'pi_author_url'  => EXPLODE_URL,
	'pi_description' => EXPLODE_DESC,
	'pi_usage'       => Wb_explode::usage()
);

/**
 * 
 */
class Wb_explode {
	var $return_data;
	
	/**
	 * Given a string, a value to look for, and optionally an offset, will take a string separated by pipes (e.g. |) and return the first or first value or the odd or even values.
	 */
	public function Wb_explode()
	{
		$this->EE =& get_instance();
		
		if ($this->EE->TMPL->fetch_param('string'))
		{
			$string = $this->EE->TMPL->fetch_param('string');
		} else {
			$string = $this->EE->TMPL->tagdata;
		}
		
		// Looking for first, last, odd or even
		if ($this->EE->TMPL->fetch_param('value')) {
			$value = $this->EE->TMPL->fetch_param('value');
		}
		
		$items = explode('|', $string);
		
		if ($this->EE->TMPL->fetch_param('offset')) {
			$offset = $this->EE->TMPL->fetch_param('offset');
			$items = array_slice($items, $offset);
		}
		
		switch ($value) {
			case 'first':
				$items = array_shift($items);
				break;
			case 'last':
				$items = array_pop($items);
				break;
			case 'odd':
				$items = $this->_filter_array($items, 'odd');
				break;
			case 'even':
				$items = $this->_filter_array($items, 'even');
				break;
		}
		
		$this->return_data = implode('|', $items);
	}
	
	/**
	 * Filters the array for either the even or odd items using the bitwise operator
	 *
	 * Some information on the bitwise operator:
	 *  - http://stackoverflow.com/questions/738168/filter-array-odd-even
	 *  - http://us2.php.net/manual/en/language.operators.bitwise.php
	 * 
	 * @param Array $array The array to filter
	 * @param String $type The type of filtering: odd, even
	 * @return Array The new filtered array
	 */
	private function _filter_array($array, $type)
	{
		$new_array = array();
		
		foreach ($array as $key => $value) {
			if ($type == "odd" AND ! ($key & 1)) {
				$new_array[] = $value;
			} else if ($type == "even" AND ($key & 1)) {
				$new_array[] = $value;
			}
		}
		
		return $new_array;
	}
		
	public function usage()
	{
		ob_start(); 
		?>	
		Examples
		--------
		
		{exp:wb_explode string="1|2|3|4|5|7|9|13" value="odd"}
		
		would return "1|3|5|9"
		
		{exp:wb_explode string="1|2|3|4|5|7|9|13" value="even"}
		
		would return "2|4|7|13"
		
		{exp:wb_explode string="1|2|3|4|5|7|9|13" value="odd" offset="1"}
		
		would return "2|4|7|13"
		
		<?php
		$buffer = ob_get_contents();
		ob_end_clean(); 
		return $buffer;
	}
}

// End File pi.addon.php
// File Source /system/expressionengine/third_party/wb_explode/pi.wb_explode.php