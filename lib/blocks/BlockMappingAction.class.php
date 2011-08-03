<?php
class mapping_BlockMappingAction extends website_BlockAction
{
	/**
	 * @return array<String>
	 */
	public function getCacheSpecifications()
	{
		return array('modules_mapping/mapping', 'modules_mapping/area', 'modules_mapping/circarea', 'modules_mapping/polyarea', 'modules_mapping/rectarea', 'modules_media/media');
	}
	
	/**
	 * @see f_mvc_Action::getCacheKeyParameters()
	 *
	 * @param website_BlockActionRequest $request
	 */
	public function getCacheKeyParameters($request)
	{
		return array("documentIdParameter" => $this->getRequiredDocumentIdParameter());
	}
	
	/**
	 * @see f_mvc_Action::execute()
	 *
	 * @param f_mvc_Request $request
	 * @param f_mvc_Response $response
	 * @return String
	 */
	public function execute($request, $response)
	{
		$this->getContext()->addScript('modules.mapping.lib.js.mapper');
		$areas = array();
		$mapping = $this->getRequiredDocumentParameter();
		foreach ($mapping->getAreaArray() as $area)
		{
			$AreaOpacity = $area->getAreaOpacity() ? 'iopacity' . $area->getAreaOpacity() : '';
			
			if (!is_null($area->getAreaBgColor()))
			{
				$bgColor = str_replace('#', '', $area->getAreaBgColor());
				$AreaBgColor = 'icolor' . $bgColor;
			}
			else
			{
				$AreaBgColor = '';
				$AreaOpacity = 'iopacity0';
			}
			if (!is_null($area->getAreaBorderColor()))
			{
				$borderColor = str_replace('#', '', $area->getAreaBorderColor());
				$AreaborderColor = 'iborder' . $borderColor;
			}
			else
			{
				$AreaborderColor = 'noborder';
			}
			$areas[] = array('class' => "$AreaOpacity $AreaborderColor $AreaBgColor", 'object' => $area);
		}
		$request->setAttribute("mapping", $this->getRequiredDocumentParameter());
		$request->setAttribute("areas", $areas);
		return website_BlockView::SUCCESS;
	}
}