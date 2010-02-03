<?php
class mapping_MappingScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return mapping_persistentdocument_mapping
     */
    protected function initPersistentDocument()
    {
    	return mapping_MappingService::getInstance()->getNewDocumentInstance();
    }
}