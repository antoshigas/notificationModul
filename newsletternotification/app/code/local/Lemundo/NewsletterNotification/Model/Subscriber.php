<?php

class Lemundo_NewsletterNotification_Model_Subscriber extends Mage_Newsletter_Model_Subscriber {
     /**
     * Sends out confirmation email
     *
     * @return Mage_Newsletter_Model_Subscriber
     */
    public function sendConfirmationRequestEmail()
    {
        return $this->allEmailsConfig('confirmation', self::XML_PATH_CONFIRM_EMAIL_TEMPLATE, self::XML_PATH_CONFIRM_EMAIL_IDENTITY);
    }

    /**
     * Sends out confirmation success email
     *
     * @return Mage_Newsletter_Model_Subscriber
     */
    public function sendConfirmationSuccessEmail()
    {
        return $this->allEmailsConfig('success', self::XML_PATH_SUCCESS_EMAIL_TEMPLATE, self::XML_PATH_SUCCESS_EMAIL_IDENTITY);
    }

    /**
     * Sends out unsubsciption email
     *
     * @return Mage_Newsletter_Model_Subscriber
     */
    public function sendUnsubscriptionEmail()
    {
        return $this->allEmailsConfig('unsubscription', self::XML_PATH_UNSUBSCRIBE_EMAIL_TEMPLATE, self::XML_PATH_UNSUBSCRIBE_EMAIL_IDENTITY);
    }

    /**
     * Code optimizer
     *
     * @return Mage_Newsletter_Model_Subscriber
     */
    private function allEmailsConfig($subscriptionConfig, $firstStoreConfig, $secondStoreConfig) {
        if (!empty(Mage::getStoreConfig('lemundo_newsletter_notification/notification/' . $subscriptionConfig)) || $this->getImportMode() || !Mage::getStoreConfig($firstStoreConfig) || !Mage::getStoreConfig($secondStoreConfig)) {
            return $this;
        }

        $translate = Mage::getSingleton('core/translate');
        /* @var $translate Mage_Core_Model_Translate */
        $translate->setTranslateInline(false);

        $email = Mage::getModel('core/email_template');

        $email->sendTransactional(
            Mage::getStoreConfig($firstStoreConfig),
            Mage::getStoreConfig($secondStoreConfig),
            $this->getEmail(),
            $this->getName(),
            array('subscriber'=>$this)
        );

        $translate->setTranslateInline(true);

        return $this;
    }
}
