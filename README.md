WB Explode
==========

Given a string, a value to look for, and optionally an offset, will take a string separated by pipes (e.g. |) and return the first or first value or the odd or even values.


Install
-------

1. Download the repository
2. Move `system/expressionengine/third_party/wb_explode` to `system/expressionengine/expressionengine/third_party`


Usage
-----

### String ###

The string is the list of items separated by pipes. This string is turned into an array which is then modified and returned as either a string or iterates over the data between the tag pair.

### Values

There are four options for value:

- odd: the odd values in the array
- even: the even values in the array
- first: the first value in the array
- last: the last value in the warray
	
### Limits

#### Tag Pair

	{exp:wb_explode string="1|2|3|4|5|7|9|13" value="odd" limit="2"}
		{explode_value}<br />
	{/exp:wb_explode}
	
would return

	1<br />
	3<br />

#### Single Tag

	{exp:wb_explode string="1|2|3|4|5|7|9|13" value="odd" limit="2"}

would return "1|3"

### Offsets ###

You can supply an offset that will remove items from the beginning of the array:

	{exp:wb_explode string="1|2|3|4|5|7|9|13" value="odd" offset="1"}

would return "2|4|7|13"


Examples
--------

### Single Tags

	{exp:wb_explode string="1|2|3|4|5|7|9|13" value="odd"}

would return "1|3|5|9"

	{exp:wb_explode string="1|2|3|4|5|7|9|13" value="even"}

would return "2|4|7|13"

	

### Tag Pairs

	{exp:wb_explode string="1|2|3|4|5|7|9|13" value="odd"}
		{explode_value}<br />
	{/exp:wb_explode}
	
would return

	1<br />
	3<br />
	5<br />
	9<br />


Change Log
----------

- 1.2
	- Added a limit parameter
- 1.1
	- Added the ability to use a tag pair and loop over the values
- 1.0
	- Initial Version of WB Explode  
