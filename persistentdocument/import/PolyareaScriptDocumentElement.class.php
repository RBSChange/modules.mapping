<?php
class mapping_PolyareaScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return mapping_persistentdocument_polyarea
     */
    protected function initPersistentDocument()
    {
    	return mapping_PolyareaService::getInstance()->getNewDocumentInstance();
    }
}