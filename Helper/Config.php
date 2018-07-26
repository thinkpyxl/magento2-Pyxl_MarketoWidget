<?php
/**
 * @category    Pyxl
 * @package     Pyxl_MarketoWidget
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

namespace Pyxl\MarketoWidget\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{

    const XML_PATH_MARKETO = 'pyxl_marketo/settings/';

	/**
	 * @param string $field
	 * @param \Magento\Store\Model\Store|int|string $store
	 *
	 * @return string|null
	 */
	public function getConfigData($field, $store = null)
	{
		$result = $this->scopeConfig->getValue(
			self::XML_PATH_MARKETO . $field,
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE,
			$store
        );
		return $result;
	}

	/**
	 * Get the Munchkin ID of the Marketo Subscription
	 *
	 * @return string
	 */
	public function getMunchkinId()
    {
		return $this->getConfigData('munchkin_id' . ($this->isSandbox() ? '_sandbox' : ''));
	}

	/**
	 * Get the Base URL of the Marketo Subscription
	 *
	 * @return string
	 */
	public function getBaseUrl()
    {
		return $this->getConfigData('base_url' . ($this->isSandbox() ? '_sandbox' : ''));
	}

    /**
     * Return if Sandbox mode is enabled
     * 
     * @return boolean
     */
    public function isSandbox()
    {
        return (boolean)$this->getConfigData('sandbox');
	}

}