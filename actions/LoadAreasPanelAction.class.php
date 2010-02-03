<?php
class mapping_LoadAreasPanelAction extends f_action_BaseJSONAction
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
		$this->sendJSON($mapping->getDocumentService()->getAreasPanelInfo($mapping));
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