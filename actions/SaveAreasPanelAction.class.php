<?php
class mapping_SaveAreasPanelAction extends change_JSONAction
{
	
	/**
	 * @see f_action_BaseAction::_execute()
	 *
	 * @param change_Context $context
	 * @param change_Request $request
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
	 * @param change_Request $request
	 * @return mapping_persistentdocument_mapping
	 */
	private function getMapping($request)
	{
		return $this->getDocumentInstanceFromRequest($request);
	}
}