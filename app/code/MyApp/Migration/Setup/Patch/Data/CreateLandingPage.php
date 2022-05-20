<?PHP
		declare(strict_types=1);

    namespace MyApp\Migration\Setup\Patch\Data;

    use Magento\Framework\Setup\Patch\DataPatchInterface;
    // use Magento\Framework\Setup\Patch\PatchRevertableInterface; implements PatchRevertableInterface
    use Magento\Framework\Exception\NoSuchEntityException;
    

    
    use Scandiweb\Migration\Helper\Cms\CmsFileParser;
    use Scandiweb\Migration\Helper\MediaMigration;

    class CreateLandingPage implements DataPatchInterface{


        const PATH = 'app/code/MyApp/Migration/files/data/json/pages/landing.json';


        /**
         * MEDIA files path (relative to module's /view/media/)
         */
        // const MEDIA_FILES = [
        //     'blocks/lions/lion.jpeg'
        // ];

        protected CmsFileParser $cmsHelper;
        
        public function __construct(CmsFileParser $cmsHelper, MediaMigration $mediaMigration){
		    $this->cmsHelper = $cmsHelper;
            $this->mediaMigration = $mediaMigration;
		}

        /**
         * {@inheritdoc}
         */
        public function apply() {
            foreach ($this->cmsHelper->getCmsDataFromFile(self::PATH) as $data) {
                $this->cmsHelper->createPage($data['identifier'], $data['content'], $data);
            }
    
            // $this->mediaMigration->copyMediaFiles(
            //     self::MEDIA_FILES,
            //     'MyApp_Migration',
            //     'cms'
            // );

        }




        /**
         * {@inheritdoc}
         */
        public static function getDependencies() : array
        {
            return [
                // SomeDependency::class
            ];
        }

        // public function revert() {}

        /**
         * {@inheritdoc}
         */
        public function getAliases() :array
        {
            return [];
        }
        // public static function getVersion()
        // {
        //     return '2.0.0';
        // }
    }