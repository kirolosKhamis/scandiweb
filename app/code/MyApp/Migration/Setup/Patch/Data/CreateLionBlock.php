<?PHP
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
 * Class CreateLionBlock
 * @package MyApp\Migration\Setup\Patch\Data
 */
class CreateLionBlock implements DataPatchInterface
{
    const PATH = 'app/code/MyApp/Migration/files/data/json/blocks/lion.json';
    const MEDIA_FILES = [
        'blocks/lions/lion.jpeg'
    ];
    /**
     * @var CmsFileParser
     */
    protected CmsFileParser $cmsHelper;
    /**
     * @param CmsFileParser $cmsHelper
     * @param MediaMigration $mediaMigration
     */
    public function __construct(CmsFileParser $cmsHelper, MediaMigration $mediaMigration)
    {
        $this->cmsHelper = $cmsHelper;
        $this->mediaMigration = $mediaMigration;
    }
    /**
     * @return void
     */
    public function apply(): void
    {
        foreach ($this->cmsHelper->getCmsDataFromFile(self::PATH) as $data) {
            $this->cmsHelper->createBlock($data['identifier'], $data['content'], $data);
        }
        $this->mediaMigration->copyMediaFiles(
            self::MEDIA_FILES,
            'MyApp_Migration',
            'cms'
        );
    }
    /**
     * @return array
     */
    public static function getDependencies(): array
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
