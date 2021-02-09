<?php
/**
 * Helper class for Hello World! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class ModHelloWorldHelper
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getHello($params)
    {
        //return 'Hello, World!';
		// Obtain a database connection
		//$db = JFactory::getDbo();
		// Retrieve the shout. Note that we are now retrieving the id not the lang field.
		//$query = $db->getQuery(true)
					//->select($db->quoteName('hello'))
					//->from($db->quoteName('#__helloworld'))
					//->where('lang = ' . $db->Quote('en-GB'));
					//->where('id = '. $db->Quote($params));
		// Prepare the query
		//$db->setQuery($query);
		// Load the row.
		//$result = $db->loadResult();
		// Return the Hello
		//return $result;
	    
	    // Get a db connection.
$db = JFactory::getDbo();

// Create a new query object.
$query = $db->getQuery(true);

// Select all articles for users who have a username which starts with 'a'.
// Order it by the created date.
// Note by putting 'a' as a second parameter will generate `#__content` AS `a`
$query
    ->select(array('a.*', 'b.username', 'b.name'))
    ->from($db->quoteName('#__content', 'a'))
    ->join('INNER', $db->quoteName('#__users', 'b') . ' ON ' . $db->quoteName('a.created_by') . ' = ' . $db->quoteName('b.id'))
    ->where($db->quoteName('b.username') . ' LIKE ' . $db->quote('a%'))
    ->order($db->quoteName('a.created') . ' DESC');

// Reset the query using our newly populated query object.
$db->setQuery($query);

// Load the results as a list of stdClass objects (see later for more options on retrieving data).
$results = $db->loadObjectList();
	    return $results;
    }
}
