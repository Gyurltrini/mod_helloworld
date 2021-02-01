<?php
// No direct access to this file
defined('_JEXEC') or die;

/**
 * Script file of HelloWorld module
 */
class mod_helloWorldInstallerScript
{
	/**
	 * Method to install the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function install($parent) 
	{
		echo '<p>The module has been installed.</p>';
	}

	/**
	 * Method to uninstall the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		echo '<p>The module has been uninstalled.</p>';
	}

	/**
	 * Method to update the extension
	 * $parent is the class calling this method
	 *
	 * @return void
	 */
	function update($parent) 
	{
		echo '<p>The module has been updated to version' . $parent->get('manifest')->version . '.</p>';
	}

	/**
	 * Method to run before an install/update/uninstall method
	 * $parent is the class calling this method
	 * $type is the type of change (install, update or discover_install)
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
		echo '<p>Anything here happens before the installation/update/uninstallation of the module.</p>';
		//check joomla version --- compatibility
		
		//check check php version for compatibility
		
		//check database version compatibility
		
		//check if component <component name here> is installed and enabled
		if (!JComponentHelper::getComponent('com_phocadownload', true)->enabled)
		{
			echo 'the phocadownload component is not installed and enabled';
			//stop process and output error
		}else{
			echo 'the phocadownload component is installed and enabled';
		}
	}

	/**
	 * Method to run after an install/update/uninstall method
	 * $parent is the class calling this method
	 * $type is the type of change (install, update or discover_install)
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		echo '<p>Anything here happens after the installation/update/uninstallation of the module.</p>';
	}
}
