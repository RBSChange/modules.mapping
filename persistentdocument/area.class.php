<?php
/**
 * mapping_persistentdocument_area
 * @package mapping
 */
class mapping_persistentdocument_area extends mapping_persistentdocument_areabase
{
	/**
	 * @return String
	 */
	function getHref()
	{
		$resource = $this->getResource();
		if ($resource !== null)
		{
			return LinkHelper::getDocumentUrl($resource);
		}
		return $this->getUrl();
	}
	
	/**
	 * @return String
	 */
	function getAlt()
	{
		$description = $this->getDescription();
		if ($description !== null)
		{
			return $description;
		}
		return $this->getLabel();
	}
	
	/**
	 * @return String
	 */
	function getShape()
	{
		// to be implemented in sub classes
	}

	/**
	 * @return String
	 */
	function getCoords()
	{
		// to be implemented in sub classes
	}

	/**
	 * @return array
	 */
	function getPanelInfo()
	{
		return array('id' => $this->getId(), 'name' => $this->getLabel());
	}
	
	/**
	 * @param array $zoneInfo
	 */
	function setPanelInfo($zoneInfo)
	{
		if (isset($zoneInfo['name']))
		{
			$this->setLabel($zoneInfo['name']);
		}
	}
}