<?php
/**
 * @date Thu May 10 09:33:02 CEST 2007
 * @author INTcoutL
 */
class mapping_AreaService extends f_persistentdocument_DocumentService
{
	/**
	 * @var mapping_AreaService
	 */
	private static $instance;

	/**
	 * @return mapping_AreaService
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
	 * @return mapping_persistentdocument_area
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_mapping/area');
	}

	/**
	 * Create a query based on 'modules_mapping/area' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_mapping/area');
	}

}