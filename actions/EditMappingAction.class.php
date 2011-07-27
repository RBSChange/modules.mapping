<?php
class mapping_EditMappingAction extends mapping_Action
{

	public function _execute($context, $request)
	{
		try
		{
			$document = DocumentHelper::getDocumentInstance($request->getParameter(K::COMPONENT_ID_ACCESSOR));

			// get the value oh the mapping picture
			$picture = $document->getPicture();

			if (empty($picture))
			{
				throw new BaseException('no-picture-for-mapping', 'modules.mapping.errors.No-picture-for-mapping');
			}

			$mediaInfo = MediaHelper::getInfo($picture);

			$request->setAttribute('picturewidth', $mediaInfo['width']);
			$request->setAttribute('pictureheight', $mediaInfo['height']);
			$request->setAttribute('pictureSize', array('width' => $mediaInfo['width'], 'height' => $mediaInfo['height']));
			$request->setAttribute('pictureURL', LinkHelper::getDocumentUrl($picture));
			$request->setAttribute('picture', MediaHelper::getContent($picture, K::HTML));

			$request->setAttribute('documentLabel', $document->getLabel());

			// get the area already map on the image
			$areas = $document->getAreaArray();

			$areasToDisplay = array();

			if (is_array($areas))
			{
				foreach ($areas as $area)
				{
					$type = $area->getDocumentModelName();

					// prepare an array ($areasToDisplay) of the code of each area to draw
					switch ($type)
					{
						case 'modules_mapping/rectarea':
							$areasToDisplay[] = sprintf(
							    '<mappingbox id="%s" x="%s" y="%s" width="%s" height="%s" style="fill: aliceblue; stroke: navy; stroke-width: 1; stroke-dasharray: 4,2,4,2; fill-opacity: 0.3;" />',
							    $area->getId(),
							    $area->getXcoord(),
							    $area->getYcoord(),
							    $area->getWidth(),
							    $area->getHeight()
							);
							break;

						case 'modules_mapping/circarea':
							$areasToDisplay[] = sprintf(
							    '<mappingcircle id="%s" cx="%s" cy="%s" r="%s" style="fill: aliceblue; stroke: navy; stroke-width: 1; stroke-dasharray: 4,2,4,2; fill-opacity: 0.3;" />',
							    $area->getId(),
							    $area->getXcenter(),
							    $area->getYcenter(),
							    $area->getRadius()
							);
							break;

						case 'modules_mapping/polyarea':
							$points = $area->getCoordinates();

							$areasToDisplay[] = sprintf(
							    '<mappingpolygon id="%s" points="%s" style="fill: aliceblue; stroke: navy; stroke-width: 1; stroke-dasharray: 4,2,4,2; fill-opacity: 0.3;">',
							    $area->getId(),
							    $points
							);

							$allPoints = explode(' ', $points);
							$index = 1;
							foreach ($allPoints as $onePoint)
							{
								$onePoint = explode(',', $onePoint);

								$areasToDisplay[] = sprintf(
								    '<controlpoint type="mappingpolygon-control-%s" anonid="resize-mappingpolygon-%s" cx="%s" cy="%s" />',
								    $index,
								    $index,
								    $onePoint[0],
								    $onePoint[1]
								);

								$index ++;
							}

							$areasToDisplay[] = '</mappingpolygon>';
							break;

						default:
							break;

					}
				}
			}

			$request->setAttribute('areasToDisplay', $areasToDisplay);
		}
		catch (Exception $e)
		{
		    Framework::exception($e);

		    $request->setAttribute('message', $e->getMessage());
			return self::getErrorView();
		}

		return View::SUCCESS;
	}
}
