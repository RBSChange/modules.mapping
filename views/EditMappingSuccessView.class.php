<?php
class mapping_EditMappingSuccessView extends f_view_BaseView
{

	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
    {
		$documentId = $request->getParameter(K::COMPONENT_ID_ACCESSOR);

		// prepare "EditMappingSuccess" template
		$this->setTemplateName( 'EditMappingSuccess', K::XML );

		// get the image map attributes
		$picture = $request->getAttribute('picture');
		$pictureURL = $request->getAttribute('pictureURL');
		$pictureURL = str_replace('&', '&amp;', $pictureURL);
		$pictureSize = $request->getAttribute('pictureSize');
		$areasToDisplay = $request->getAttribute('areasToDisplay');
		$picturewidth = $request->getAttribute('picturewidth');
		$pictureheight = $request->getAttribute('pictureheight');

		//send attribute to the tempalte
		$this->setAttribute('areasToDisplay', $areasToDisplay);
		$this->setAttribute('picture', $picture);
		$this->setAttribute('pictureURL', sprintf(
		    'background-image: url(%s); background-repeat: no-repeat; width: %spx; height: %spx;',
		    $pictureURL,
		    $picturewidth,
		    $pictureheight
		));
		$this->setAttribute('pictureSize', $pictureSize);
		$this->setAttribute('styleSize', sprintf(
		    'height: %spx; width: %spx;',
		    $pictureheight,
		    $picturewidth
		));
		$this->setAttribute('onInit', sprintf(
		    'mdInit(%s, %s);',
		    $pictureheight,
		    $picturewidth
		));
		$this->setAttribute('componentId', $documentId);
		$this->setAttribute('documentLabel', $request->getAttribute('documentLabel'));
		$this->setAttribute('docType', '<!DOCTYPE html [<!ATTLIST mozdraw:canvas id ID #IMPLIED>]>');

		// include styles
		$styleService = StyleService::getInstance();
		$styleService->registerStyle('modules.mapping.bindings');
		$styleService->registerStyle('modules.generic.backoffice');
		$styleService->registerStyle('modules.mapping.mapping');
        $this->setAttribute('cssInclusion', $styleService->execute(K::XUL));

		$this->setAttribute('updatingLabel', f_Locale::translate('&modules.mapping.bo.action.UpdatingArea;'));
		$this->setAttribute('savingLabel', f_Locale::translate('&modules.mapping.bo.action.SavingArea;'));
	}
}
