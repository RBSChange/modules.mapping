<?php
class mapping_SaveAreasPanelAction extends f_action_BaseJSONAction
{
	
	/**
	 * @see f_action_BaseAction::_execute()
	 *
	 * @param Context $context
	 * @param Request $request
	 */
	protected function _execute($context, $request)
	{
		$mapping = $this->getMapping($request);	
		$mapservice = $mapping->getDocumentService();	
		$zonesInfo = JsonService::getInstance()->decode($request->getParameter("zonesInfo"));
		$mapservice->setZonesInfo($mapping, $zonesInfo);
		$this->sendJSON($mapservice->getAreasPanelInfo($mapping));
	}
	
	/**
	 * @param Request $request
	 * @return mapping_persistentdocument_mapping
	 */
	private function getMapping($request)
	{
		return $this->getDocumentInstanceFromRequest($request);
	}
}