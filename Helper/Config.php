<?php
/**
 * @category    Pyxl
 * @package     Pyxl_MarketoWidget
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

namespace Pyxl\MarketoWidget\Helper;

use Magento\Framework\App\Helper\Context;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{

	/** @var \Magento\Store\Model\StoreManagerInterface */
	protected $_storeManager;

	const XML_PATH_MARKETO = 'pyxl_marketo/settings/';

	/**
	 * Config constructor.
	 *
	 * @param Context $context
	 * @param \Magento\Store\Model\StoreManagerInterface $storeManager
	 */
	public function __construct(
		Context $context,
		\Magento\Store\Model\StoreManagerInterface $storeManager
	) {
		parent::__construct( $context );
		$this->_storeManager   = $storeManager;
	}

	/**
	 * @param string $field
	 * @param \Magento\Store\Model\Store|int|string $store
	 *
	 * @return string|null
	 */
	public function getConfigData($field, $store = null)
	{
		$store = $this->_storeManager->getStore($store);

		$result = $this->scopeConfig->getValue(
			self::XML_PATH_MARKETO . $field,
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE,
			$store);
		return $result;
	}

	/**
	 * Get the Munchkin ID of the Marketo Subscription
	 *
	 * @return string
	 */
	public function getMunchkinId() {
		return $this->getConfigData('munchkin_id');
	}

	/**
	 * Get the Base URL of the Marketo Subscription
	 *
	 * @return string
	 */
	public function getBaseUrl() {
		return $this->getConfigData('base_url');
	}

}