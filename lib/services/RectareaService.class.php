<?php
/**
 * @date Thu May 10 09:33:02 CEST 2007
 * @author INTcoutL
 */
class mapping_RectareaService extends mapping_AreaService
{
	/**
	 * @var mapping_RectareaService
	 */
	private static $instance;

	/**
	 * @return mapping_RectareaService
	 */
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = self::getServiceClassInstance(get_class());
		}
		return self::$instance;
	}

	/**
	 * @return mapping_persistentdocument_rectarea
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_mapping/rectarea');
	}

	/**
	 * Create a query based on 'modules_mapping/rectarea' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_mapping/rectarea');
	}
}