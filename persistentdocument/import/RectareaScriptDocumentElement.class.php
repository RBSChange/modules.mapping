<?php
class mapping_RectareaScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return mapping_persistentdocument_rectarea
     */
    protected function initPersistentDocument()
    {
    	return mapping_RectareaService::getInstance()->getNewDocumentInstance();
    }
}