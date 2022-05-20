<?php
declare(strict_types=1);
/**
 * @category MyApp
 * @package MyApp_Migration
 * @author Kirolos Nashed <info@scandiweb.com>
 * @copyright Copyright (c) 2022 Scandiweb, Inc (https://scandiweb.com)
 * @license http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0 (OSL-3.0)
 */
namespace MyApp\Migration\Setup\Patch\Data;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Scandiweb\Migration\Helper\Cms\CmsFileParser;
use Scandiweb\Migration\Helper\MediaMigration;
/**
 * Class CreateLandingPage
 * @package MyApp\Migration\Setup\Patch\Data
 */
class CreateLandingPage implements DataPatchInterface
{
    const PATH = 'app/code/MyApp/Migration/files/data/json/pages/landing.json';
    /**
     * @var CmsFileParser
     */
    protected CmsFileParser $cmsHelper;

    /**
     * @param CmsFileParser $cmsHelper
     */
    public function __construct(CmsFileParser $cmsHelper)
    {
        $this->cmsHelper = $cmsHelper;
    }

    /**
     * @return void
     */
    public function apply(): void
    {
        foreach ($this->cmsHelper->getCmsDataFromFile(self::PATH) as $data) {
            $this->cmsHelper->createPage($data['identifier'], $data['content'], $data);
        }
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }
}
