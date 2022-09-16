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
     * Get contact URL
     *
     * @return string
     *
     */
    public function getContactUrl()
    {
        return $this->getUrl('contact/contact/send');
    }

    /**
     *
     * Get form additional info block
     *
     * @return Template|null
     *
     * @note Allow configured an optional block to add additional information to this form
     *
     */
    public function getFormAdditionalInfoBlock()
    {
        return $this->getData('form_additional_info_block');
    }

    /**
     *
     * Set form additional info block
     *
     * @param Template $block
     *
     * @return $this
     *
     * @note Allow configured an optional block to add additional information to this form
     *
     */
    public function setFormAdditionalInfoBlock(Template $block)
    {
        return $this->setData('form_additional_info_block', $block);
    }

    /**
     *
     * Get form additional information HTML
     *
     * @return string
     *
     * @note Allow configured an optional block to add additional information to this form
     *
     */
    public function getFormAdditionalInfoHtml()
    {
        /**
         *
         * @note Check block
         *
         */
        if (!is_null($block = $this->getFormAdditionalInfoBlock())) {
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
