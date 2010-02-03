<?php
class mapping_AreaListTreeParser extends tree_parser_XmlListTreeParser
{
    public function getTree($componentId = null, $offset = 0, $order = null, $filter = null)
    {
    	$request = Context::getInstance()->getRequest();
    	return parent::getTree($request->getParameter(K::COMPONENT_ID_ACCESSOR), $offset, $order, $filter);
    }
}