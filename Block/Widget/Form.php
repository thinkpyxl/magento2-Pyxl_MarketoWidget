<?php
/**
 * @category    Pyxl
 * @package     Pyxl_MarketoWidget
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

namespace Pyxl\MarketoWidget\Block\Widget;

use Magento\Framework\View\Element\Template;

class Form extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{

	/**
	 * @var string
	 */
	protected $_template = "widget/marketo_form.phtml";

	/**
	 * @var string
	 */
	private $baseUrl;

	/**
	 * @var string
	 */
	private $munchkinId;

    /**
     * @var bool
     */
	private $isSandbox;

	/**
	 * Form constructor.
	 *
	 * @param Template\Context $context
	 * @param \Pyxl\MarketoWidget\Helper\Config $marketoConfig
	 * @param array $data
	 */
	public function __construct(
		Template\Context $context,
		\Pyxl\MarketoWidget\Helper\Config $marketoConfig,
		array $data = []
	)
    {
		parent::__construct($context, $data);
		$this->munchkinId = $marketoConfig->getMunchkinId();
		$this->baseUrl = $marketoConfig->getBaseUrl();
		$this->isSandbox = $marketoConfig->isSandbox();
	}

	/**
	 * Get the JS Source from Marketo
	 *
	 * @return string
	 */
	public function getSrc()
    {
		return "//" . $this->baseUrl . "/js/forms2/js/forms2.min.js";
	}

	/**
	 * Returns the Marketo JS function with params
	 * for building an embedded form
	 *
	 * @return string
	 */
	public function buildForm()
    {
		return sprintf(
			'MktoForms2.loadForm("%s", "%s", %s);',
			$this->baseUrl,
			$this->munchkinId,
			$this->getFormId()
		);
	}

    /**
     * Build JSON config for loading
     * the form in JS component
     *
     * @return string
     */
    public function getConfig()
    {
        $config = [
            'base_url' => $this->baseUrl,
            'munchkin_id' => $this->munchkinId,
            'form_id' => $this->getFormId()
        ];
        return json_encode($config);
	}

    /**
     * Get the Form ID based on production/sandbox mode
     *
     * @return string
     */
    public function getFormId()
    {
        return $this->getData('form_id' . ($this->isSandbox ? '_sandbox' : ''));
	}

}