<?php
class mapping_Setup extends object_InitDataSetup
{

	public function install()
	{
		try
		{
			//$scriptReader = import_ScriptReader::getInstance();
			//$scriptReader->executeModuleScript('mapping', 'init.xml');
		}
		catch (Exception $e)
		{
			echo "ERROR: " . $e->getMessage() . "\n";
			Framework::exception($e);
		}
	}
}