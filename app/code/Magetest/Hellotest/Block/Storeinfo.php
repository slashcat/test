<?php
namespace Magetest\Hellotest\Block;
use \Magento\Store\Model\StoreRepository;


class Storeinfo extends \Magento\Framework\View\Element\Template
{

	/**
	 * @var Rate
	 */
	protected $_storeRepository;


	protected $_storeManager;    



	/**
	 * @var \Magento\Cms\Model\ResourceModel\Website
	 */
	protected $_webResource;    


	/**
	 * @var \Magento\Cms\Model\ResourceModel\Page
	 */
	protected $_resourcePage;


	protected $pageRepository;
	

	protected $_pageExtend;

	public function __construct(
	        \Magento\Cms\Api\PageRepositoryInterface $pageRepository,
		StoreRepository $storeRepository,
		\Magento\Cms\Model\PageFactory $pageFactory,
		\Magento\Backend\Block\Template\Context $context,        
		\Magento\Store\Model\StoreManagerInterface $storeManager,   
		\Magento\Cms\Model\ResourceModel\Page $resourcePage,     
		\Magento\Store\Model\ResourceModel\Website $webResource,
		\Magento\Cms\Model\Page $page,
		\Magetest\Hellotest\Model\ResourceModel\Page $pageExtend,
		array $data = []
	)
	{
		$this->pageExtend = $pageExtend;
		$this->pageRepository = $pageRepository;
		$this->_page = $page;
		$this->_webResource = $webResource;
		$this->_resourcePage = $resourcePage;
		$this->pageFactory = $pageFactory;   
		$this->_storeRepository = $storeRepository;        
		$this->_storeManager = $storeManager;        
		parent::__construct($context, $data);
	}

	/**
	 * Get store identifier
	 *
	 * @return  int
	 */
	public function getStoreId()
	{
		return $this->_storeManager->getStore()->getId();
	}

	/**
	 * Get website identifier
	 *
	 * @return string|int|null
	 */
	public function getWebsiteId()
	{
		return $this->_storeManager->getStore()->getWebsiteId();
	}



	/**
	 * Get Store code
	 *
	 * @return string
	 */
	public function getStoreCode()
	{
		return $this->_storeManager->getStore()->getCode();
	}

	/**
	 * Get Store name
	 *
	 * @return string
	 */
	public function getStoreName()
	{
		return $this->_storeManager->getStore()->getName();
	}


        /**
         * Get Cms-Page Url 
         *
         * @return string
         */

	public function getUrlCmsPage()
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$cmsPage = $objectManager->get('\Magento\Cms\Model\Page');
		$this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$CMSPageURL = $this->_objectManager->create('Magento\Cms\Helper\Page')
			->getPageUrl($cmsPage->getId());

		return $CMSPageURL;
	}


	/**
	 * Get Store name
	 *
	 * @return string
	 */
	public function getHref()
	{
		return $this->_storeManager->getStore()->getHreflang();
	}

	/**
	 * Get current url for store
	 *
	 * @param bool|string $fromStore Include/Exclude from_store parameter from URL
	 * @return string     
	 */
	public function getStoreUrl($fromStore = true)
	{
		return $this->_storeManager->getStore()->getCurrentUrl($fromStore);
	}



	/**
	 * Get page key by id
	 *
	 * @return int
	 */

	public function getCreareCMSPages($id){

		$page = $this->pageFactory->create();

		return $page->getCollection();
	}


	/**
	 * Get page key by id
	 *
	 * @return string
	 */
	public function getCurrentPageUrlKey($id)
	{
		try {
			$page = $this->pageRepository->getById($id);  
			return $page->getIdentifier();
		} catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
			return null;
		}
	}


         /**
         * Get qty of stores by webpage for store
         *
         * @return int
         */ 

	public function QtyStoresbysite()
	{


			$qty =0;
			foreach ($this->_webResource->readAllWebsites() as $res)
			{
				$i = 0;

				foreach($this->pageExtend->getCmsStoreByWId($res["website_id"]) as $rb)
				{
					if(( $this->_resourcePage->checkIdentifier("about-us",$rb['store_id'])!=false) && ($i!=1))
					{
						$i++;
					}
				}
				$qty = $qty + $i;

			}
			return $qty;
		
	}  





	/**
	 * Check if store is active
	 *
	 * @return boolean
	 */

	public function isStoreActive()
	{
		return $this->_storeManager->getStore()->isActive();
	}


}
