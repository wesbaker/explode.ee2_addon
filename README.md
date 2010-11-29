WB Explode
==========

Given a string, a value to look for, and optionally an offset, will take a string separated by pipes (e.g. |) and return the first or first value or the odd or even values.


Install
-------

1. Download the repository
2. Move system/expressionengine/third\_party/wb\_category\_select to system/expressionengine/expressionengine/third\_party


Examples
--------

	{exp:wb_explode string="1|2|3|4|5|7|9|13" value="odd"}

would return "1|3|5|9"

	{exp:wb_explode string="1|2|3|4|5|7|9|13" value="even"}

would return "2|4|7|13"

	{exp:wb_explode string="1|2|3|4|5|7|9|13" value="odd" offset="1"}

would return "2|4|7|13"


Change Log
----------

- 1.0.0
	- Initial Version of WB Explode  
