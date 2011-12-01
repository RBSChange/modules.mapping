<?php
/**
 * @date Thu May 10 09:33:02 CEST 2007
 * @author INTcoutL
 */
class mapping_MappingService extends f_persistentdocument_DocumentService
{
	/**
	 * @var mapping_MappingService
	 */
	private static $instance;

	/**
	 * @return mapping_MappingService
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
	 * @return mapping_persistentdocument_mapping
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_mapping/mapping');
	}

	/**
	 * Create a query based on 'modules_mapping/mapping' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_mapping/mapping');
	}

	/**
	 * @param mapping_persistentdocument_mapping $mapping
	 * @return array
	 */
	public function getAreasPanelInfo($mapping)
	{
		$media = $mapping->getPicture();
		$imageInfo = $media->getInfo();
		$url = LinkHelper::getUIActionLink('media', 'BoDisplay')
			->setQueryParameter('cmpref', $media->getId())
			->setQueryParameter('lang', RequestContext::getInstance()->getLang())
			->setQueryParameter('time', date_Calendar::now()->getTimestamp())->getUrl();
		$imageInfo['src'] = $url;

		$zonesInfo = array();
		foreach ($mapping->getAreaArray() as $area)
		{
			$zonesInfo[] = $area->getPanelInfo();
		}
		return array('imageInfo' => $imageInfo, 'zonesInfo' => $zonesInfo);
	}

	/**
	 * @param mapping_persistentdocument_mapping $mapping
	 * @param array $zonesInfo
	 */
	public function setZonesInfo($mapping, $zonesInfo)
	{
		try
		{
			$this->tm->beginTransaction();
			$areaIds = array();
			foreach ($zonesInfo as $zoneInfo)
			{
				if (f_util_StringUtils::beginsWith($zoneInfo['id'], 't'))
				{
					switch ($zoneInfo['type'])
					{
						case 'rectarea':
							$area = mapping_RectareaService::getInstance()->getNewDocumentInstance();
							break;
						case 'circlearea':
							$area = mapping_CircareaService::getInstance()->getNewDocumentInstance();
							break;
						case 'polygonarea':
							$area = mapping_PolyareaService::getInstance()->getNewDocumentInstance();
							break;
						default:
							throw new Exception('Invalid-area-type: ' . $zoneInfo['type']);
							break;
					}
					$area->setLabel(f_Locale::translateUI('&modules.mapping.bo.general.newzone;', array('count' => count($areaIds) + 1)));
				}
				else
				{
					$area = DocumentHelper::getDocumentInstance($zoneInfo['id'], 'modules_mapping/area');
					$index = $mapping->getIndexofArea($area);
					if ($index < 0)
					{
						throw new Exception('Invalid-area-id: ' . $zoneInfo['id']);
					}
				}
				$area->setPanelInfo($zoneInfo);
				if ($area->isNew())
				{
					$mapping->addArea($area);
				}
				$area->save();
				$areaIds[] = $area->getId();
			}
				
			foreach ($mapping->getAreaArray() as $area)
			{
				if (!in_array($area->getId(), $areaIds))
				{
					$area->delete();
				}
			}
				
			$mapping->save();
			$this->tm->commit();
		}
		catch (Exception $e)
		{
			$this->tm->rollBack($e);
			throw $e;
		}
	}

	/**
	 * @param mapping_persistentdocument_mapping $document
	 * @param string $forModuleName
	 * @param array $allowedSections
	 * @return array
	 */
	public function getResume($document, $forModuleName, $allowedSections = null)
	{
		$data = parent::getResume($document, $forModuleName, $allowedSections);

		$media = $document->getPicture();

		$rc = RequestContext::getInstance();
		$lang = ($media->isContextLangAvailable()) ? $rc->getLang() : $media->getLang();
		try
		{
			$rc->beginI18nWork($lang);

			$info = $media->getCommonInfo();
			$data['content'] = array(
				'mimetype' => $media->getMimetype(),
				'size' => $info['size'],
				'previewimgurl' => array('id' => $media->getId(), 'lang' => $lang)
			);

			if ($media->getMediatype() == MediaHelper::TYPE_IMAGE)
			{
				$pixelsLabel = LocaleService::getInstance()->trans('m.media.bo.doceditor.pixels');
				$data['content']['width'] = $info['width'].' '.$pixelsLabel;
				$data['content']['height'] = $info['height'].' '.$pixelsLabel;
				$data['content']['previewimgurl']['image'] = LinkHelper::getUIActionLink('media', 'BoDisplay')
					->setQueryParameter('cmpref', $media->getId())
					->setQueryParameter('max-height', 128)
					->setQueryParameter('max-width', 128)
					->setQueryParameter('lang', $lang)
					->setQueryParameter('time', date_Calendar::now()->getTimestamp())->getUrl();
			}
			else
			{
				$data['content']['previewimgurl']['image'] = '';
			}
				
			$openNotificationUri = join(',' , array('media', 'openDocument', $media->getPersistentModel()->getBackofficeName(), $media->getId(), 'resume'));
			$backUri = join(',', array('mapping', 'openDocument', $document->getPersistentModel()->getBackofficeName(), $document->getId(), 'resume'));
			$data['content']['picture'] = array('uri' => $openNotificationUri, 'label' => f_Locale::translateUI('&modules.uixul.bo.doceditor.open;'), 'backuri' => $backUri);

			$rc->endI18nWork();
		}
		catch (Exception $e)
		{
			$rc->endI18nWork($e);
		}

		return $data;
	}
}