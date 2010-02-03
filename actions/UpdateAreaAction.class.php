<?php
class mapping_UpdateAreaAction extends mapping_Action
{
	
	public function _execute($context, $request)
	{
		$shape = $request->getParameter('shape');
		$shapeId = $request->getParameter('shapeId');
		try
		{
			$document = DocumentHelper::getDocumentInstance($shapeId);
		}
		catch (Exception $e)
		{
			Framework::exception($e);
			$request->setAttribute('message', $e->getMessage());
			return self::getErrorView();
		}
		
		// for each type of area shape
		switch ($shape)
		{
			case 'mappingbox' :
				try
				{
					if (! $document instanceof mapping_persistentdocument_rectarea) 
					{
						throw new Exception('Shape is not a rectarea');
					}
					
					//set the new value and save the component
					$document->setXcoord($request->getParameter('xshape'));
					$document->setYcoord($request->getParameter('yshape'));
					$document->setWidth($request->getParameter('widthrect'));
					$document->setHeight($request->getParameter('heightrect'));
					$document->save();
				}
				catch (Exception $e)
				{
					Framework::exception($e);
					
					$request->setAttribute('message', $e->getMessage());
					return self::getErrorView();
				}
				break;
			
			case 'mappingcircle' :				
				try
				{
					if (! $document instanceof mapping_persistentdocument_circarea) 
					{
						throw new Exception('Shape is not a circarea');
					}
					//set the new value and save the component
					$document->setXcenter($request->getParameter('xshape'));
					$document->setYcenter($request->getParameter('yshape'));
					$document->setRadius($request->getParameter('rcircle'));
					$document->save();
				}
				catch (Exception $e)
				{
					Framework::exception($e);
					
					$request->setAttribute('message', $e->getMessage());
					return self::getErrorView();
				}		
				break;		
			case 'mappingpolygon' :
				try
				{
					if (!$document instanceof mapping_persistentdocument_polyarea) 
					{
						throw new Exception('Shape is not a polyarea');
					}
					//set the new value and save the component
					$document->setCoordinates($request->getParameter('points'));
					$document->save();
				}
				catch (Exception $e)
				{
					Framework::exception($e);
					
					$request->setAttribute('message', $e->getMessage());
					return self::getErrorView();
				}
				break;
			default:
				$request->setAttribute('message', 'Inavlid shape type : ' . $shape);
				return self::getErrorView();
				break;	
		}
		
		//save the id of the new area
		$request->setAttribute('document', $document);
		
		return self::getSuccessView();
	}

}