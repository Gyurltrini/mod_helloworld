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
		$jversion = new JVersion();
		echo '<p>Anything here happens before the installation/update/uninstallation of the module.</p>';
		//installing manifest file version
		$this->release = $parent->get("manifest")->version;
		
		//compare manifest file minimum Joomla version
		$this->minimum_joomla_release = $parent->get( "manifest" )->attributes()->version;
		
		//show essential information
		echo '<p>'.$type.'ing module manifest file version = ' . $this->release;
		echo '<br />Current manifest cache module version = ' . $this->getParam('version');
		echo '<br />'.$type.'ing module manifest file minimum Joomla version = ' . $this->minimum_joomla_release;
		echo '<br />Current Joomla version = ' . $jversion->getShortVersion();
		
		//abort if the current Joomla version is older
		if( version_compare( $jversion->getShortVersion(), $this->minimum_joomla_release, 'lt' ) ) {
			Jerror::raiseWarning(null, 'Cannot install com_democompupdate in a Joomla release prior to '.$this->minimum_joomla_release);
			return false;
		}
		
		//abort if the module version is not newer
		if ( $type == 'update' ) {
			$oldRelease = $this->getParam('version');
			$rel = $oldRelease . ' to ' . $this->release;
			if ( version_compare( $this->release, $oldRelease, 'le' ) ) {
				Jerror::raiseWarning(null, 'Incorrect version sequence. Cannot upgrade ' . $rel);
				return false;
			}
		}
		else { $rel = $this->release; }
		
		if($type === 'install')
        	{
			//check if component <component name here> is installed and enabled
			if (!JComponentHelper::getComponent('com_phocadownload', true)->enabled)
			{
				echo 'the phocadownload component is not installed and enabled';
				//stop process and output error
			}else{
				echo 'the phocadownload component is installed and enabled';
			}
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
