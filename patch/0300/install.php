<?php
/**
 * mapping_patch_0300
 * @package modules.mapping
 */
class mapping_patch_0300 extends patch_BasePatch
{
//  by default, isCodePatch() returns false.
//  decomment the following if your patch modify code instead of the database structure or content.
    /**
     * Returns true if the patch modify code that is versionned.
     * If your patch modify code that is versionned AND database structure or content,
     * you must split it into two different patches.
     * @return Boolean true if the patch modify code that is versionned.
     */
//	public function isCodePatch()
//	{
//		return true;
//	}
 
	/**
	 * Entry point of the patch execution.
	 */
	public function execute()
	{
		parent::execute();
		$this->log("Compiling documents...");
		exec("change.php compile-documents");
		$this->log("Compiling locales...");
		exec("change.php compile-locales");
		$this->log("Patching database...");
		$this->executeSQLQuery("ALTER TABLE `m_mapping_doc_area` ADD `areabordercolor` VARCHAR(25)");
		$this->executeSQLQuery("ALTER TABLE `m_mapping_doc_area` ADD `areabgcolor` VARCHAR(25)");
		$this->executeSQLQuery("ALTER TABLE `m_mapping_doc_area` ADD `areaopacity` INT(11)");
	}

	/**
	 * Returns the name of the module the patch belongs to.
	 *
	 * @return String
	 */
	protected final function getModuleName()
	{
		return 'mapping';
	}

	/**
	 * Returns the number of the current patch.
	 * @return String
	 */
	protected final function getNumber()
	{
		return '0300';
	}
}
