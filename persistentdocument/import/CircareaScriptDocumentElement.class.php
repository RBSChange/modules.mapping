<?php
class mapping_CircareaScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return mapping_persistentdocument_circarea
     */
    protected function initPersistentDocument()
    {
    	return mapping_CircareaService::getInstance()->getNewDocumentInstance();
    }
}