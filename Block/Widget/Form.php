<?php
/**
 * @category    Pyxl
 * @package     Pyxl_MarketoWidget
 * @copyright   2018 Joel Rainwater
 * @license     http://opensource.org/licenses/mit-license.php MIT License
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
	protected $_baseUrl;

	/**
	 * @var string
	 */
	protected $_munchkinId;

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
	) {
		parent::__construct( $context, $data );
		$this->_munchkinId = $marketoConfig->getMunchkinId();
		$this->_baseUrl = $marketoConfig->getBaseUrl();
	}

	/**
	 * Get the JS Source from Marketo
	 *
	 * @return string
	 */
	public function getSrc() {
		return "//" . $this->_baseUrl . "/js/forms2/js/forms2.min.js";
	}

	/**
	 * Returns the Marketo JS function with params
	 * for building an embedded form
	 *
	 * @return string
	 */
	public function buildForm() {
		return sprintf(
			'MktoForms2.loadForm("%s", "%s", %s);',
			$this->_baseUrl,
			$this->_munchkinId,
			$this->getData('form_id')
		);
	}

}