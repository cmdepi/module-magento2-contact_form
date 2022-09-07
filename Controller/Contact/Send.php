<?php
/**
 *
 * @description Contact AJAX action
 *
 * @author Bina Commerce      <https://www.binacommerce.com>
 * @author C. M. de Picciotto <cmdepicciotto@binacommerce.com>
 *
 */
namespace Bina\ContactForm\Controller\Contact;

use Exception;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\Json;
use Magento\Contact\Model\MailInterface;

class Send extends Action
{
    /**
     *
     * @var JsonFactory
     *
     */
    protected $_resultJsonFactory;

    /**
     *
     * @var MailInterface
     *
     */
    protected $_mail;

    /**
     *
     * Constructor
     *
     * @param JsonFactory   $resultJsonFactory
     * @param MailInterface $mail
     * @param Context       $context
     *
     */
    public function __construct(
        JsonFactory   $resultJsonFactory,
        MailInterface $mail,
        Context       $context
    ) {
        /**
         *
         * @note Init result JSON factory
         *
         */
        $this->_resultJsonFactory = $resultJsonFactory;

        /**
         *
         * @note Init mail model
         *
         */
        $this->_mail = $mail;

        /**
         *
         * @note Call parent constructor
         *
         */
        parent::__construct($context);
    }

    /**
     *
     * Execute
     *
     * @return Json
     *
     */
    public function execute()
    {
        /** @var Http $request */
        $request = $this->getRequest();

        /**
         *
         * @note Validate if it is an AJAX request
         *
         */
        if (!$request->isAjax()) {
            return null;
        }

        /**
         *
         * @note Init AJAX data
         *
         */
        /** @var array $data */
        $data            = array();
        $data['message'] = '';

        /**
         *
         * @note Send email
         *
         */
        try {
            $this->_sendEmail($this->_validatedContactParams());
            $data['message'] = __('Thank you very much for your contact! We will get back to you as quickly as possible.');
        }
        catch (LocalizedException $e) {
            $data['message'] = __($e->getMessage());
        }
        catch (Exception $e) {
            $data['message'] = __('An unexpected error has occurred. Please, try again in a few minutes.');
        }

        /**
         *
         * @note Send AJAX Response
         *
         */
        return $this->_resultJsonFactory->create()->setData($data);
    }

    /**
     *
     * Send contact email
     *
     * @param array $post
     *
     * @return void
     *
     */
    private function _sendEmail($post)
    {
        $this->_mail->send($post['email'], ['data' => new DataObject($post)]);
    }

    /**
     *
     * Validate contact form params
     *
     * @return array
     *
     * @throws Exception
     *
     */
    private function _validatedContactParams()
    {
        /** @var Http $request */
        $request = $this->getRequest();

        /**
         *
         * @note Validate name
         *
         */
        if (trim($request->getParam('name')) === '') {
            throw new LocalizedException(__('Name is missing.'));
        }

        /**
         *
         * @note Validate comment
         *
         */
        if (trim($request->getParam('comment')) === '') {
            throw new LocalizedException(__('Comment is missing.'));
        }

        /**
         *
         * @note Validate email
         *
         */
        if (false === \strpos($request->getParam('email'), '@')) {
            throw new LocalizedException(__('Invalid email address.'));
        }

        /**
         *
         * @note Return params
         *
         */
        return $request->getParams();
    }
}
