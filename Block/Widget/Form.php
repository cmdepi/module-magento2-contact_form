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
}
