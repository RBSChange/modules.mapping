<?php
class mapping_ActionBase extends f_action_BaseAction
{
		
	/**
	 * Returns the mapping_AreaService to handle documents of type "modules_mapping/area".
	 *
	 * @return mapping_AreaService
	 */
	public function getAreaService()
	{
		return mapping_AreaService::getInstance();
	}
		
	/**
	 * Returns the mapping_CircareaService to handle documents of type "modules_mapping/circarea".
	 *
	 * @return mapping_CircareaService
	 */
	public function getCircareaService()
	{
		return mapping_CircareaService::getInstance();
	}
		
	/**
	 * Returns the mapping_MappingService to handle documents of type "modules_mapping/mapping".
	 *
	 * @return mapping_MappingService
	 */
	public function getMappingService()
	{
		return mapping_MappingService::getInstance();
	}
		
	/**
	 * Returns the mapping_PolyareaService to handle documents of type "modules_mapping/polyarea".
	 *
	 * @return mapping_PolyareaService
	 */
	public function getPolyareaService()
	{
		return mapping_PolyareaService::getInstance();
	}
		
	/**
	 * Returns the mapping_RectareaService to handle documents of type "modules_mapping/rectarea".
	 *
	 * @return mapping_RectareaService
	 */
	public function getRectareaService()
	{
		return mapping_RectareaService::getInstance();
	}
		
}