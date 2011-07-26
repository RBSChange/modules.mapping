<?php
/**
 * mapping_persistentdocument_mapping
 * @package mapping
 */
class mapping_persistentdocument_mapping extends mapping_persistentdocument_mappingbase
{
	function getPictureAlt()
	{
		if ($this->getDescription())
		{
			return $this->getDescription();
		}
		return $this->getLabel();
	}

	function getMapLabel()
	{
		return 'mapping_' . $this->getId();
	}

	function getMapLabelAnchor()
	{
		return '#'.$this->getMapLabel();
	}
	
	/**
	 * @return array
	 */
	public function getZonesInfo()
	{
		$data = array();
		foreach ($this->getAreaArray() as $area) 
		{			 
			$data[] = $this->getAreaInfo($area);
		}
		return array('zones' => $data);
	}
	
	
	/**
	 * @param mapping_persistentdocument_area $area
	 * @return array
	 */
	private function getAreaInfo($area)
	{
		return array(
			'id' => $area->getId(), 
			'label' => $area->getLabel(),
			'form' => $area->getShape(),
			'href' => $area->getHref(),
			'status' => LocaleService::getInstance()->transBO(DocumentHelper::getStatusLocaleKey($this))
		);
	}
	
	/**
	 * @return string
	 */
	public function getZonesInfoJSON()
	{
		return JsonService::getInstance()->encode($this->getZonesInfo());
	}
}