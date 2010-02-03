<?php
class mapping_AreaScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return mapping_persistentdocument_area
     */
    protected function initPersistentDocument()
    {
    	return mapping_AreaService::getInstance()->getNewDocumentInstance();
    }
}