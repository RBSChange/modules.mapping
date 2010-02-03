<?php
/**
 * mapping_persistentdocument_rectarea
 * @package mapping
 */
class mapping_persistentdocument_rectarea extends mapping_persistentdocument_rectareabase
{
	/**
	 * @return String
	 */
	function getShape()
	{
		return "rect";
	}

	/**
	 * @return String
	 */
	function getCoords()
	{
		return $this->getXcoord().",".$this->getYcoord().",".($this->getXcoord()+$this->getWidth()).",".($this->getYcoord()+$this->getHeight());
	}
	
	/**
	 * @return array
	 */
	function getPanelInfo()
	{
		return array_merge(parent::getPanelInfo(),
			array('type' => 'rectarea', 
					'x' => $this->getXcoord(),
					'y' => $this->getYcoord(),
					'width' => $this->getWidth(),
					'height' => $this->getHeight()
			));
	}
	
	/**
	 * @param array $zoneInfo
	 */
	function setPanelInfo($zoneInfo)
	{
		parent::setPanelInfo($zoneInfo);
		$this->setXcoord($zoneInfo['x']);
		$this->setYcoord($zoneInfo['y']);
		$this->setWidth($zoneInfo['width']);
		$this->setHeight($zoneInfo['height']);
	}
}