<?php
/**
 * @date Thu May 10 09:33:02 CEST 2007
 * @author INTcoutL
 */
class mapping_CircareaService extends mapping_AreaService
{
	/**
	 * @var mapping_CircareaService
	 */
	private static $instance;

	/**
	 * @return mapping_CircareaService
	 */
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * @return mapping_persistentdocument_circarea
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_mapping/circarea');
	}

	/**
	 * Create a query based on 'modules_mapping/circarea' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_mapping/circarea');
	}

}