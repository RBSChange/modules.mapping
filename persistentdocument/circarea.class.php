<?php
class mapping_persistentdocument_circarea extends mapping_persistentdocument_circareabase
{
	/**
	 * @return String
	 */
	function getShape()
	{
		return "circle";
	}

	/**
	 * @return String
	 */
	function getCoords()
	{
		return $this->getXcenter().",".$this->getYcenter().",".$this->getRadius();
	}
	
	/**
	 * @return array
	 */
	function getPanelInfo()
	{
		return array_merge(parent::getPanelInfo(),
			array('type' => 'circlearea', 
					'cx' => strval($this->getXcenter()),
					'cy' => strval($this->getYcenter()),
					'r' => strval($this->getRadius())
			));
	}
	
	/**
	 * @param array $zoneInfo
	 */
	function setPanelInfo($zoneInfo)
	{
		parent::setPanelInfo($zoneInfo);
		$this->setXcenter(doubleval($zoneInfo['cx']));
		$this->setYcenter(doubleval($zoneInfo['cy']));
		$this->setRadius(doubleval($zoneInfo['r']));
	}
}