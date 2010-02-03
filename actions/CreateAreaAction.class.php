<?php
class mapping_CreateAreaAction extends mapping_Action
{

    public function _execute($context, $request)
	{
        //get the area shape
        $shape = $request->getParameter('shape');

        // get the parent node of the area to create
        $mapping = DocumentHelper::getDocumentInstance($request->getParameter('parentId'));

        $areaNb = $request->getParameter('areaNb');

        switch ($shape)
        {
            case 'mappingbox':

                try
                {
	            	//create a news instance of area document
	                $rectAreaService = $this->getRectareaService();
	                $document = $rectAreaService->getNewDocumentInstance();

	                //set the values
	                $document->setXcoord($request->getParameter('xshape'));
	                $document->setYcoord($request->getParameter('yshape'));
	                $document->setWidth($request->getParameter('widthrect'));
	                $document->setHeight($request->getParameter('heightrect'));
                }
                catch (Exception $e)
                {
                    Framework::exception($e);

                	$request->setAttribute('message', $e->getMessage());
                	return self::getErrorView();
                }

                break;

            case 'mappingcircle':

            	try
                {
	            	//create a news instance of area document
	                $circAreaService = $this->getCircareaService();
	                $document = $circAreaService->getNewDocumentInstance();

	                //set the values
	                $document->setXcenter($request->getParameter('xshape'));
	                $document->setYcenter($request->getParameter('yshape'));
	                $document->setRadius($request->getParameter('rcircle'));

                }
                catch (Exception $e)
                {
                    Framework::exception($e);

                	$request->setAttribute('message', $e->getMessage());
                	return self::getErrorView();
                }

                break;

            case 'mappingpolygon':

            	try
                {
	            	//create a news instance of area document
	                $polyAreaService = $this->getPolyareaService();
	                $document = $polyAreaService->getNewDocumentInstance();

	                //set the values
	                $document->setCoordinates($request->getParameter('points'));

                }
                catch (Exception $e)
                {
                    Framework::exception($e);

                	$request->setAttribute('message', $e->getMessage());
                	return self::getErrorView();
                }

                break;
        }

        try
		{
	        // Set Area properties
	        $document->setLabel(f_Locale::translate('&modules.mapping.bo.general.Newzone;', array('count' => $areaNb)));
		    $document->setDescription('');

		    // Add area to mapping
		    $mapping->addArea($document);
		    $mapping->save();
       	}
        catch (Exception $e)
        {
            Framework::exception($e);

        	$request->setAttribute('message', $e->getMessage());
        	return self::getErrorView();
        }

        //save the id of the new area
        $request->setAttribute('document', $document);

        return self::getSuccessView();
    }
}