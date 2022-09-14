<?php
/**
 *
 * @description Contact form widget block
 *
 * @author Bina Commerce      <https://www.binacommerce.com>
 * @author C. M. de Picciotto <cmdepicciotto@binacommerce.com>
 *
 */
namespace Bina\ContactForm\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Form extends Template implements BlockInterface
{
    /**
     *
     * @var string
     *
     */
    protected $_template = "widget/form.phtml";

    /**
     *
     * Get form additional information HTML
     *
     * @param Template|null $block
     *
     * @return string
     *
     * @note Allow configured an optional block to add additional information to this form
     *
     */
    public function getFormAdditionalInfoHtml(Template $block = null)
    {
        /**
         *
         * @note Check block
         *
         */
        if (!is_null($block)) {
            /**
             *
             * @note Return block HTML
             *
             */
            return $block->toHtml();
        }

        /**
         *
         * @note Return additional HTML
         *
         */
        return $this->getChildHtml('form_additional_info');
    }
}
