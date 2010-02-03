<?php
/**
 * mapping_persistentdocument_polyarea
 * @package mapping
 */
class mapping_persistentdocument_polyarea extends mapping_persistentdocument_polyareabase
{
	/**
	 * @return String
	 */
	function getShape()
	{
		return "poly";
	}

	/**
	 * @return String
	 */
	function getCoords()
	{
		return str_replace(' ', ',', $this->getCoordinates());
	}
	
	/**
	 * @return array
	 */
	function getPanelInfo()
	{
		return array_merge(parent::getPanelInfo(),
			array('type' => 'polygonarea', 
					'points' => $this->getCoordinates()
			));
	}
	
	/**
	 * @param array $zoneInfo
	 */
	function setPanelInfo($zoneInfo)
	{
		parent::setPanelInfo($zoneInfo);
		$this->setCoordinates($zoneInfo['points']);
	}
}