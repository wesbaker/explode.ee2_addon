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
		$d = '|';

		$this->EE =& get_instance();
		
		$tagdata = $this->EE->TMPL->tagdata;
		
		
		if ($this->EE->TMPL->fetch_param('delemiter'))
		{
			$d = $this->EE->TMPL->fetch_param('delemiter');
		}
		

		if ($this->EE->TMPL->fetch_param('string'))
		{
			$string = $this->EE->TMPL->fetch_param('string');
			$items = explode($d, $string);
		} else {
			$this->return_data = $tagdata;
			exit;
		}
		
		if ($this->EE->TMPL->fetch_param('offset')) {
			$offset = $this->EE->TMPL->fetch_param('offset');
			$items = array_slice($items, $offset);
		}
		
		// Looking for first, last, odd or even
		if ($this->EE->TMPL->fetch_param('value')) {
			$value = $this->EE->TMPL->fetch_param('value');
			
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
		}
		
		if ($this->EE->TMPL->fetch_param('limit')){
			$limit = $this->EE->TMPL->fetch_param('limit');
			$items = array_slice($items, 0, $limit);
		}
		
		if (strlen($tagdata)) {
				$this->return_data = $this->EE->TMPL->parse_variables($tagdata, $this->_build_variable_array($items));
		} else {
			$this->return_data = implode($d, $items);
		}
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
	
	/**
	 * Builds an array of variables to pass to parse_variables
	 *
	 * http://expressionengine.com/user_guide/development/usage/template.html#parsing_variables
	 *
	 * @param Array $items The array of items to build the array for
	 * @return Array The array of items for parse_variables
	 */
	private function _build_variable_array($items)
	{
		$new_array = array();
		
		// Make sure the $items parameter is an array, if not then make it so
		if ( ! is_array($items)) {
			$items = array($items);
		}
		
		foreach ($items as $key => $value) {
			$new_array[] = array(
				'explode_value' => $value
			);
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

		{exp:wb_explode string="1,2,3,4" delimiter=","}

		would return "1,2,3,4"


		<?php
		$buffer = ob_get_contents();
		ob_end_clean(); 
		return $buffer;
	}
}

// End File pi.addon.php
// File Source /system/expressionengine/third_party/wb_explode/pi.wb_explode.php
?>