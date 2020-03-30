<?php

class Lemundo_NewsletterNotification_Model_Subscriber extends Mage_Newsletter_Model_Subscriber {
        /**
     * Sends out confirmation email
     *
     * @return Mage_Newsletter_Model_Subscriber
     */
    public function sendConfirmationRequestEmail()
    {
        if (!empty(Mage::getStoreConfig('lemundo_newsletter_notification/notification/confirmation'))) {
            return $this;
        }
        
        if ($this->getImportMode()) {
            return $this;
        }

        if(!Mage::getStoreConfig(self::XML_PATH_CONFIRM_EMAIL_TEMPLATE)
           || !Mage::getStoreConfig(self::XML_PATH_CONFIRM_EMAIL_IDENTITY)
        )  {
            return $this;
        }

        $translate = Mage::getSingleton('core/translate');
        /* @var $translate Mage_Core_Model_Translate */
        $translate->setTranslateInline(false);

        $email = Mage::getModel('core/email_template');

        $email->sendTransactional(
            Mage::getStoreConfig(self::XML_PATH_CONFIRM_EMAIL_TEMPLATE),
            Mage::getStoreConfig(self::XML_PATH_CONFIRM_EMAIL_IDENTITY),
            $this->getEmail(),
            $this->getName(),
            array('subscriber'=>$this)
        );

        $translate->setTranslateInline(true);

        return $this;
    }

    /**
     * Sends out confirmation success email
     *
     * @return Mage_Newsletter_Model_Subscriber
     */
    public function sendConfirmationSuccessEmail()
    {
        if (!empty(Mage::getStoreConfig('lemundo_newsletter_notification/notification/success'))) {
            return $this;
        }

        if ($this->getImportMode()) {
            return $this;
        }

        if(!Mage::getStoreConfig(self::XML_PATH_SUCCESS_EMAIL_TEMPLATE)
           || !Mage::getStoreConfig(self::XML_PATH_SUCCESS_EMAIL_IDENTITY)
        ) {
            return $this;
        }

        $translate = Mage::getSingleton('core/translate');
        /* @var $translate Mage_Core_Model_Translate */
        $translate->setTranslateInline(false);

        $email = Mage::getModel('core/email_template');

        $email->sendTransactional(
            Mage::getStoreConfig(self::XML_PATH_SUCCESS_EMAIL_TEMPLATE),
            Mage::getStoreConfig(self::XML_PATH_SUCCESS_EMAIL_IDENTITY),
            $this->getEmail(),
            $this->getName(),
            array('subscriber'=>$this)
        );

        $translate->setTranslateInline(true);

        return $this;
    }

    /**
     * Sends out unsubsciption email
     *
     * @return Mage_Newsletter_Model_Subscriber
     */
    public function sendUnsubscriptionEmail()
    {
        if (!empty(Mage::getStoreConfig('lemundo_newsletter_notification/notification/unsubscription'))) {
            return $this;
        }

        if ($this->getImportMode()) {
            return $this;
        }
        if(!Mage::getStoreConfig(self::XML_PATH_UNSUBSCRIBE_EMAIL_TEMPLATE)
           || !Mage::getStoreConfig(self::XML_PATH_UNSUBSCRIBE_EMAIL_IDENTITY)
        ) {
            return $this;
        }

        $translate = Mage::getSingleton('core/translate');
        /* @var $translate Mage_Core_Model_Translate */
        $translate->setTranslateInline(false);

        $email = Mage::getModel('core/email_template');

        $email->sendTransactional(
            Mage::getStoreConfig(self::XML_PATH_UNSUBSCRIBE_EMAIL_TEMPLATE),
            Mage::getStoreConfig(self::XML_PATH_UNSUBSCRIBE_EMAIL_IDENTITY),
            $this->getEmail(),
            $this->getName(),
            array('subscriber'=>$this)
        );

        $translate->setTranslateInline(true);

        return $this;
    }
}