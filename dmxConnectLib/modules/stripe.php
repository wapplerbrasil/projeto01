<?php

namespace modules;

require_once(__DIR__ . '/../stripe/init.php');

use \lib\core\Module;

class stripe extends Module
{
  public $stripe;

  function __construct($app) {
    $this->stripe = new \Stripe\StripeClient(CONFIG('STRIPE_SECRET_KEY'));
    parent::__construct($app);
  }

  // /v1/3d_secure - post
  public function createThreeDsecure($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->threeDSecure->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/3d_secure/{three_d_secure} - get
  public function retrieveThreeDsecure($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'three_d_secure');
    $three_d_secure = $options->three_d_secure;
    unset($options->three_d_secure);
    return $this->stripe->threeDSecure->retrieve($three_d_secure)->toArray();
  }

  // /v1/account_links - post
  public function createAccountLink($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->accountLinks->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts - get
  public function listAccounts($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->accounts->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts - post
  public function createAccount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->accounts->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account} - delete
  public function deleteAccount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    return $this->stripe->accounts->delete($account)->toArray();
  }

  // /v1/accounts/{account} - get
  public function retrieveAccount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    return $this->stripe->accounts->retrieve($account)->toArray();
  }

  // /v1/accounts/{account} - post
  public function updateAccount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    return $this->stripe->accounts->update($account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/capabilities - get
  public function listAccountCapabilities($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    return $this->stripe->accounts->listCapabilities($account)->toArray();
  }

  // /v1/accounts/{account}/capabilities/{capability} - get
  public function retrieveAccountCapabilitie($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    option_require($options, 'capability');
    $capability = $options->capability;
    unset($options->capability);
    return $this->stripe->accounts->retrieveCapabilitie($account, $capability)->toArray();
  }

  // /v1/accounts/{account}/capabilities/{capability} - post
  public function updateAccountCapabilitie($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    option_require($options, 'capability');
    $capability = $options->capability;
    unset($options->capability);
    return $this->stripe->accounts->updateCapabilitie($account, $capability, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/external_accounts - get
  public function listAccountExternalAccounts($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    return $this->stripe->accounts->listExternalAccounts($account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/external_accounts - post
  public function createAccountExternalAccount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    return $this->stripe->accounts->createExternalAccount($account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/external_accounts/{id} - delete
  public function deleteAccountExternalAccount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->accounts->deleteExternalAccount($account, $id)->toArray();
  }

  // /v1/accounts/{account}/external_accounts/{id} - get
  public function retrieveAccountExternalAccount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->accounts->retrieveExternalAccount($account, $id)->toArray();
  }

  // /v1/accounts/{account}/external_accounts/{id} - post
  public function updateAccountExternalAccount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->accounts->updateExternalAccount($account, $id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/login_links - post
  public function createAccountLoginLink($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    return $this->stripe->accounts->createLoginLink($account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/persons - get
  public function listAccountPersons($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    return $this->stripe->accounts->listPersons($account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/persons - post
  public function createAccountPerson($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    return $this->stripe->accounts->createPerson($account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/persons/{person} - delete
  public function deleteAccountPerson($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    option_require($options, 'person');
    $person = $options->person;
    unset($options->person);
    return $this->stripe->accounts->deletePerson($account, $person)->toArray();
  }

  // /v1/accounts/{account}/persons/{person} - get
  public function retrieveAccountPerson($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    option_require($options, 'person');
    $person = $options->person;
    unset($options->person);
    return $this->stripe->accounts->retrievePerson($account, $person)->toArray();
  }

  // /v1/accounts/{account}/persons/{person} - post
  public function updateAccountPerson($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    option_require($options, 'person');
    $person = $options->person;
    unset($options->person);
    return $this->stripe->accounts->updatePerson($account, $person, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/reject - post
  public function createAccountReject($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    return $this->stripe->accounts->createReject($account, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/x-stripeParametersOverride_bank_account/{id} - post
  public function updateAccountXStripeParametersOverrideBankAccount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->accounts->updateXStripeParametersOverrideBankAccount($account, $id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/accounts/{account}/x-stripeParametersOverride_card/{id} - post
  public function updateAccountXStripeParametersOverrideCard($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'account');
    $account = $options->account;
    unset($options->account);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->accounts->updateXStripeParametersOverrideCard($account, $id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/apple_pay/domains - get
  public function listApplePayDomains($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->applePay->domains->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/apple_pay/domains - post
  public function createApplePayDomain($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->applePay->domains->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/apple_pay/domains/{domain} - delete
  public function deleteApplePayDomain($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'domain');
    $domain = $options->domain;
    unset($options->domain);
    return $this->stripe->applePay->domains->delete($domain)->toArray();
  }

  // /v1/apple_pay/domains/{domain} - get
  public function retrieveApplePayDomain($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'domain');
    $domain = $options->domain;
    unset($options->domain);
    return $this->stripe->applePay->domains->retrieve($domain)->toArray();
  }

  // /v1/application_fees - get
  public function listApplicationFees($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->applicationFees->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/application_fees/{fee}/refunds/{id} - get
  public function retrieveApplicationFeeRefund($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'fee');
    $fee = $options->fee;
    unset($options->fee);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->applicationFees->retrieveRefund($fee, $id)->toArray();
  }

  // /v1/application_fees/{fee}/refunds/{id} - post
  public function updateApplicationFeeRefund($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'fee');
    $fee = $options->fee;
    unset($options->fee);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->applicationFees->updateRefund($fee, $id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/application_fees/{id} - get
  public function retrieveApplicationFee($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->applicationFees->retrieve($id)->toArray();
  }

  // /v1/application_fees/{id}/refunds - get
  public function listApplicationFeeRefunds($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->applicationFees->listRefunds($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/application_fees/{id}/refunds - post
  public function createApplicationFeeRefund($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->applicationFees->createRefund($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/balance - get
  public function retrieveBalance($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->balance->retrieve()->toArray();
  }

  // /v1/balance_transactions - get
  public function listBalanceTransactions($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->balanceTransactions->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/balance_transactions/{id} - get
  public function retrieveBalanceTransaction($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->balanceTransactions->retrieve($id)->toArray();
  }

  // /v1/billing_portal/configurations - get
  public function listBillingPortalConfigurations($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->billingPortal->configurations->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/billing_portal/configurations - post
  public function createBillingPortalConfiguration($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->billingPortal->configurations->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/billing_portal/configurations/{configuration} - get
  public function retrieveBillingPortalConfiguration($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'configuration');
    $configuration = $options->configuration;
    unset($options->configuration);
    return $this->stripe->billingPortal->configurations->retrieve($configuration)->toArray();
  }

  // /v1/billing_portal/configurations/{configuration} - post
  public function updateBillingPortalConfiguration($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'configuration');
    $configuration = $options->configuration;
    unset($options->configuration);
    return $this->stripe->billingPortal->configurations->update($configuration, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/billing_portal/sessions - post
  public function createBillingPortalSession($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->billingPortal->sessions->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/bitcoin/receivers - get
  public function listBitcoinReceivers($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->bitcoin->receivers->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/bitcoin/receivers/{id} - get
  public function retrieveBitcoinReceiver($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->bitcoin->receivers->retrieve($id)->toArray();
  }

  // /v1/bitcoin/receivers/{receiver}/transactions - get
  public function listBitcoinReceiverTransactions($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'receiver');
    $receiver = $options->receiver;
    unset($options->receiver);
    return $this->stripe->bitcoin->receivers->listTransactions($receiver, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges - get
  public function listCharges($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->charges->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges - post
  public function createCharge($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->charges->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges/{charge} - get
  public function retrieveCharge($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'charge');
    $charge = $options->charge;
    unset($options->charge);
    return $this->stripe->charges->retrieve($charge)->toArray();
  }

  // /v1/charges/{charge} - post
  public function updateCharge($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'charge');
    $charge = $options->charge;
    unset($options->charge);
    return $this->stripe->charges->update($charge, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges/{charge}/capture - post
  public function createChargeCapture($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'charge');
    $charge = $options->charge;
    unset($options->charge);
    return $this->stripe->charges->createCapture($charge, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges/{charge}/refunds - get
  public function listChargeRefunds($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'charge');
    $charge = $options->charge;
    unset($options->charge);
    return $this->stripe->charges->listRefunds($charge, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/charges/{charge}/refunds/{refund} - get
  public function retrieveChargeRefund($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'charge');
    $charge = $options->charge;
    unset($options->charge);
    option_require($options, 'refund');
    $refund = $options->refund;
    unset($options->refund);
    return $this->stripe->charges->retrieveRefund($charge, $refund)->toArray();
  }

  // /v1/checkout/sessions - get
  public function listCheckoutSessions($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->checkout->sessions->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/checkout/sessions - post
  public function createCheckoutSession($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    if ($options && isset($options->lineItemsType)) {
      if ($options->lineItemsType == 'custom' || $options->lineItemsType == 'customRef') {
        if (isset($options->line_items)) {
          $options->line_items = json_decode(json_encode($options->line_items));
          if (!is_array($options->line_items)) {
            if (is_object($options->line_items)) {
              $options->line_items = array($options->line_items);
            } else {
              throw new \Exception('createCheckoutSession: line_items must be array or object for references!');
            }
          } else if (empty($options->line_items)) {
            throw new \Exception('createCheckoutSession: line_items is empty!');
          }
        } else {
          throw new \Exception('createCheckoutSession: line_items is not set!');
        }

        $options->line_items = array_map(function($item) {
          $item = (object)$item;
          $output = (object)array();
          $output->price_data = (object)array();
          $output->price_data->currency = isset($item->currency) ? $item->currency : 'USD';
          $output->price_data->product_data = (object)array();
          $output->price_data->product_data->name = $item->title;
          $output->price_data->unit_amount_decimal = $item->amount;
          $output->quantity = isset($item->quantity) ? $item->quantity : 1;
          return $output;
        }, $options->line_items);
      }
      unset($options->lineItemsType);
    } else {
      if (isset($options->line_items)) {
        $options->line_items = json_decode(json_encode($options->line_items));
        if (is_array($options->line_items)) {
          if (empty($options->line_items)) {
            throw new \Exception('createCheckoutSession: line_items is empty!');
          }
          $options->line_items = array_map(function($item) {
            $item = (object)$item;
            $output = (object)array();
            $output->price = $item->price;
            $output->quantity = isset($item->quantity) ? $item->quantity : 1;
            return $output;
          }, $options->line_items);
        } else if (is_object($options->line_items)) {
          $options->line_items = array($options->line_items);
        } else if (is_string($options->line_items)) {
          $output = (object)array();
          $output->price = $options->line_items;
          $output->quantity = 1;
          $options->line_items = array($output);
        }
      }
    }

    return $this->stripe->checkout->sessions->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/checkout/sessions/{session} - get
  public function retrieveCheckoutSession($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'session');
    $session = $options->session;
    unset($options->session);
    return $this->stripe->checkout->sessions->retrieve($session)->toArray();
  }

  // /v1/checkout/sessions/{session}/line_items - get
  public function listCheckoutSessionLineItems($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'session');
    $session = $options->session;
    unset($options->session);
    return $this->stripe->checkout->sessions->listLineItems($session, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/country_specs - get
  public function listCountrySpecs($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->countrySpecs->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/country_specs/{country} - get
  public function retrieveCountrySpec($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'country');
    $country = $options->country;
    unset($options->country);
    return $this->stripe->countrySpecs->retrieve($country)->toArray();
  }

  // /v1/coupons - get
  public function listCoupons($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->coupons->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/coupons - post
  public function createCoupon($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->coupons->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/coupons/{coupon} - delete
  public function deleteCoupon($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'coupon');
    $coupon = $options->coupon;
    unset($options->coupon);
    return $this->stripe->coupons->delete($coupon)->toArray();
  }

  // /v1/coupons/{coupon} - get
  public function retrieveCoupon($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'coupon');
    $coupon = $options->coupon;
    unset($options->coupon);
    return $this->stripe->coupons->retrieve($coupon)->toArray();
  }

  // /v1/coupons/{coupon} - post
  public function updateCoupon($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'coupon');
    $coupon = $options->coupon;
    unset($options->coupon);
    return $this->stripe->coupons->update($coupon, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes - get
  public function listCreditNotes($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->creditNotes->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes - post
  public function createCreditNote($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->creditNotes->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes/preview - get
  public function retrieveCreditNotesPreview($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoice');
    $invoice = $options->invoice;
    unset($options->invoice);
    return $this->stripe->creditNotes->preview->retrieve($invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes/preview/lines - get
  public function listCreditNotesPreviewLines($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoice');
    $invoice = $options->invoice;
    unset($options->invoice);
    return $this->stripe->creditNotes->preview->lines->all($invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes/{credit_note}/lines - get
  public function listCreditNoteLines($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'credit_note');
    $credit_note = $options->credit_note;
    unset($options->credit_note);
    return $this->stripe->creditNotes->listLines($credit_note, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes/{id} - get
  public function retrieveCreditNote($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->creditNotes->retrieve($id)->toArray();
  }

  // /v1/credit_notes/{id} - post
  public function updateCreditNote($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->creditNotes->update($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/credit_notes/{id}/void - post
  public function createCreditNoteVoid($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->creditNotes->createVoid($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers - get
  public function listCustomers($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->customers->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers - post
  public function createCustomer($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->customers->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer} - delete
  public function deleteCustomer($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    return $this->stripe->customers->delete($customer)->toArray();
  }

  // /v1/customers/{customer} - get
  public function retrieveCustomer($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    return $this->stripe->customers->retrieve($customer)->toArray();
  }

  // /v1/customers/{customer} - post
  public function updateCustomer($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    return $this->stripe->customers->update($customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/balance_transactions - get
  public function listCustomerBalanceTransactions($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    return $this->stripe->customers->listBalanceTransactions($customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/balance_transactions - post
  public function createCustomerBalanceTransaction($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    return $this->stripe->customers->createBalanceTransaction($customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/balance_transactions/{transaction} - get
  public function retrieveCustomerBalanceTransaction($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    option_require($options, 'transaction');
    $transaction = $options->transaction;
    unset($options->transaction);
    return $this->stripe->customers->retrieveBalanceTransaction($customer, $transaction)->toArray();
  }

  // /v1/customers/{customer}/balance_transactions/{transaction} - post
  public function updateCustomerBalanceTransaction($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    option_require($options, 'transaction');
    $transaction = $options->transaction;
    unset($options->transaction);
    return $this->stripe->customers->updateBalanceTransaction($customer, $transaction, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/discount - delete
  public function deleteCustomerDiscount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    return $this->stripe->customers->deleteDiscount($customer)->toArray();
  }

  // /v1/customers/{customer}/sources - get
  public function listCustomerSources($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    return $this->stripe->customers->listSources($customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/sources - post
  public function createCustomerSource($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    return $this->stripe->customers->createSource($customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/sources/{id} - delete
  public function deleteCustomerSource($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->customers->deleteSource($customer, $id)->toArray();
  }

  // /v1/customers/{customer}/sources/{id} - get
  public function retrieveCustomerSource($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->customers->retrieveSource($customer, $id)->toArray();
  }

  // /v1/customers/{customer}/sources/{id} - post
  public function updateCustomerSource($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->customers->updateSource($customer, $id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/tax_ids - get
  public function listCustomerTaxIds($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    return $this->stripe->customers->listTaxIds($customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/tax_ids - post
  public function createCustomerTaxId($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    return $this->stripe->customers->createTaxId($customer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/tax_ids/{id} - delete
  public function deleteCustomerTaxId($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->customers->deleteTaxId($customer, $id)->toArray();
  }

  // /v1/customers/{customer}/tax_ids/{id} - get
  public function retrieveCustomerTaxId($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->customers->retrieveTaxId($customer, $id)->toArray();
  }

  // /v1/customers/{customer}/x-stripeParametersOverride_bank_accounts/{id} - post
  public function updateCustomerXStripeParametersOverrideBankAccount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->customers->updateXStripeParametersOverrideBankAccount($customer, $id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/customers/{customer}/x-stripeParametersOverride_cards/{id} - post
  public function updateCustomerXStripeParametersOverrideCard($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->customers->updateXStripeParametersOverrideCard($customer, $id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/disputes - get
  public function listDisputes($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->disputes->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/disputes/{dispute} - get
  public function retrieveDispute($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'dispute');
    $dispute = $options->dispute;
    unset($options->dispute);
    return $this->stripe->disputes->retrieve($dispute)->toArray();
  }

  // /v1/disputes/{dispute} - post
  public function updateDispute($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'dispute');
    $dispute = $options->dispute;
    unset($options->dispute);
    return $this->stripe->disputes->update($dispute, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/disputes/{dispute}/close - post
  public function createDisputeClose($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'dispute');
    $dispute = $options->dispute;
    unset($options->dispute);
    return $this->stripe->disputes->createClose($dispute, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/ephemeral_keys - post
  public function createEphemeralKey($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->ephemeralKeys->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/ephemeral_keys/{key} - delete
  public function deleteEphemeralKey($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'key');
    $key = $options->key;
    unset($options->key);
    return $this->stripe->ephemeralKeys->delete($key)->toArray();
  }

  // /v1/events - get
  public function listEvents($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->events->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/events/{id} - get
  public function retrieveEvent($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->events->retrieve($id)->toArray();
  }

  // /v1/exchange_rates - get
  public function listExchangeRates($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->exchangeRates->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/exchange_rates/{rate_id} - get
  public function retrieveExchangeRate($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'rate_id');
    $rate_id = $options->rate_id;
    unset($options->rate_id);
    return $this->stripe->exchangeRates->retrieve($rate_id)->toArray();
  }

  // /v1/file_links - get
  public function listFileLinks($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->fileLinks->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/file_links - post
  public function createFileLink($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->fileLinks->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/file_links/{link} - get
  public function retrieveFileLink($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'link');
    $link = $options->link;
    unset($options->link);
    return $this->stripe->fileLinks->retrieve($link)->toArray();
  }

  // /v1/file_links/{link} - post
  public function updateFileLink($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'link');
    $link = $options->link;
    unset($options->link);
    return $this->stripe->fileLinks->update($link, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/files - get
  public function listFiles($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->files->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/files - post
  public function createFile($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->files->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/files/{file} - get
  public function retrieveFile($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'file');
    $file = $options->file;
    unset($options->file);
    return $this->stripe->files->retrieve($file)->toArray();
  }

  // /v1/invoiceitems - get
  public function listInvoiceitems($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->invoiceitems->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoiceitems - post
  public function createInvoiceitem($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->invoiceitems->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoiceitems/{invoiceitem} - delete
  public function deleteInvoiceitem($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoiceitem');
    $invoiceitem = $options->invoiceitem;
    unset($options->invoiceitem);
    return $this->stripe->invoiceitems->delete($invoiceitem)->toArray();
  }

  // /v1/invoiceitems/{invoiceitem} - get
  public function retrieveInvoiceitem($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoiceitem');
    $invoiceitem = $options->invoiceitem;
    unset($options->invoiceitem);
    return $this->stripe->invoiceitems->retrieve($invoiceitem)->toArray();
  }

  // /v1/invoiceitems/{invoiceitem} - post
  public function updateInvoiceitem($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoiceitem');
    $invoiceitem = $options->invoiceitem;
    unset($options->invoiceitem);
    return $this->stripe->invoiceitems->update($invoiceitem, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices - get
  public function listInvoices($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->invoices->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices - post
  public function createInvoice($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->invoices->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/upcoming - get
  public function retrieveInvoicesUpcoming($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->invoices->upcoming->retrieve(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/upcoming/lines - get
  public function listInvoicesUpcomingLines($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->invoices->upcoming->lines->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice} - delete
  public function deleteInvoice($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoice');
    $invoice = $options->invoice;
    unset($options->invoice);
    return $this->stripe->invoices->delete($invoice)->toArray();
  }

  // /v1/invoices/{invoice} - get
  public function retrieveInvoice($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoice');
    $invoice = $options->invoice;
    unset($options->invoice);
    return $this->stripe->invoices->retrieve($invoice)->toArray();
  }

  // /v1/invoices/{invoice} - post
  public function updateInvoice($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoice');
    $invoice = $options->invoice;
    unset($options->invoice);
    return $this->stripe->invoices->update($invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/finalize - post
  public function createInvoiceFinalize($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoice');
    $invoice = $options->invoice;
    unset($options->invoice);
    return $this->stripe->invoices->createFinalize($invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/lines - get
  public function listInvoiceLines($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoice');
    $invoice = $options->invoice;
    unset($options->invoice);
    return $this->stripe->invoices->listLines($invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/mark_uncollectible - post
  public function createInvoiceMarkUncollectible($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoice');
    $invoice = $options->invoice;
    unset($options->invoice);
    return $this->stripe->invoices->createMarkUncollectible($invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/pay - post
  public function createInvoicePay($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoice');
    $invoice = $options->invoice;
    unset($options->invoice);
    return $this->stripe->invoices->createPay($invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/send - post
  public function createInvoiceSend($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoice');
    $invoice = $options->invoice;
    unset($options->invoice);
    return $this->stripe->invoices->createSend($invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/invoices/{invoice}/void - post
  public function createInvoiceVoid($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'invoice');
    $invoice = $options->invoice;
    unset($options->invoice);
    return $this->stripe->invoices->createVoid($invoice, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuer_fraud_records - get
  public function listIssuerFraudRecords($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->issuerFraudRecords->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuer_fraud_records/{issuer_fraud_record} - get
  public function retrieveIssuerFraudRecord($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'issuer_fraud_record');
    $issuer_fraud_record = $options->issuer_fraud_record;
    unset($options->issuer_fraud_record);
    return $this->stripe->issuerFraudRecords->retrieve($issuer_fraud_record)->toArray();
  }

  // /v1/issuing/authorizations - get
  public function listIssuingAuthorizations($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->issuing->authorizations->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/authorizations/{authorization} - get
  public function retrieveIssuingAuthorization($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'authorization');
    $authorization = $options->authorization;
    unset($options->authorization);
    return $this->stripe->issuing->authorizations->retrieve($authorization)->toArray();
  }

  // /v1/issuing/authorizations/{authorization} - post
  public function updateIssuingAuthorization($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'authorization');
    $authorization = $options->authorization;
    unset($options->authorization);
    return $this->stripe->issuing->authorizations->update($authorization, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/authorizations/{authorization}/approve - post
  public function createIssuingAuthorizationApprove($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'authorization');
    $authorization = $options->authorization;
    unset($options->authorization);
    return $this->stripe->issuing->authorizations->createApprove($authorization, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/authorizations/{authorization}/decline - post
  public function createIssuingAuthorizationDecline($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'authorization');
    $authorization = $options->authorization;
    unset($options->authorization);
    return $this->stripe->issuing->authorizations->createDecline($authorization, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cardholders - get
  public function listIssuingCardholders($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->issuing->cardholders->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cardholders - post
  public function createIssuingCardholder($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->issuing->cardholders->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cardholders/{cardholder} - get
  public function retrieveIssuingCardholder($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'cardholder');
    $cardholder = $options->cardholder;
    unset($options->cardholder);
    return $this->stripe->issuing->cardholders->retrieve($cardholder)->toArray();
  }

  // /v1/issuing/cardholders/{cardholder} - post
  public function updateIssuingCardholder($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'cardholder');
    $cardholder = $options->cardholder;
    unset($options->cardholder);
    return $this->stripe->issuing->cardholders->update($cardholder, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cards - get
  public function listIssuingCards($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->issuing->cards->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cards - post
  public function createIssuingCard($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->issuing->cards->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/cards/{card} - get
  public function retrieveIssuingCard($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'card');
    $card = $options->card;
    unset($options->card);
    return $this->stripe->issuing->cards->retrieve($card)->toArray();
  }

  // /v1/issuing/cards/{card} - post
  public function updateIssuingCard($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'card');
    $card = $options->card;
    unset($options->card);
    return $this->stripe->issuing->cards->update($card, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/disputes - get
  public function listIssuingDisputes($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->issuing->disputes->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/disputes - post
  public function createIssuingDispute($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->issuing->disputes->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/disputes/{dispute} - get
  public function retrieveIssuingDispute($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'dispute');
    $dispute = $options->dispute;
    unset($options->dispute);
    return $this->stripe->issuing->disputes->retrieve($dispute)->toArray();
  }

  // /v1/issuing/disputes/{dispute} - post
  public function updateIssuingDispute($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'dispute');
    $dispute = $options->dispute;
    unset($options->dispute);
    return $this->stripe->issuing->disputes->update($dispute, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/disputes/{dispute}/submit - post
  public function createIssuingDisputeSubmit($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'dispute');
    $dispute = $options->dispute;
    unset($options->dispute);
    return $this->stripe->issuing->disputes->createSubmit($dispute, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/transactions - get
  public function listIssuingTransactions($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->issuing->transactions->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/issuing/transactions/{transaction} - get
  public function retrieveIssuingTransaction($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'transaction');
    $transaction = $options->transaction;
    unset($options->transaction);
    return $this->stripe->issuing->transactions->retrieve($transaction)->toArray();
  }

  // /v1/issuing/transactions/{transaction} - post
  public function updateIssuingTransaction($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'transaction');
    $transaction = $options->transaction;
    unset($options->transaction);
    return $this->stripe->issuing->transactions->update($transaction, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/mandates/{mandate} - get
  public function retrieveMandate($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'mandate');
    $mandate = $options->mandate;
    unset($options->mandate);
    return $this->stripe->mandates->retrieve($mandate)->toArray();
  }

  // /v1/order_returns - get
  public function listOrderReturns($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->orderReturns->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/order_returns/{id} - get
  public function retrieveOrderReturn($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->orderReturns->retrieve($id)->toArray();
  }

  // /v1/orders - get
  public function listOrders($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->orders->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/orders - post
  public function createOrder($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->orders->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/orders/{id} - get
  public function retrieveOrder($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->orders->retrieve($id)->toArray();
  }

  // /v1/orders/{id} - post
  public function updateOrder($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->orders->update($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/orders/{id}/pay - post
  public function createOrderPay($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->orders->createPay($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/orders/{id}/returns - post
  public function createOrderReturn($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->orders->createReturn($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents - get
  public function listPaymentIntents($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->paymentIntents->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents - post
  public function createPaymentIntent($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->paymentIntents->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents/{intent} - get
  public function retrievePaymentIntent($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'intent');
    $intent = $options->intent;
    unset($options->intent);
    return $this->stripe->paymentIntents->retrieve($intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents/{intent} - post
  public function updatePaymentIntent($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'intent');
    $intent = $options->intent;
    unset($options->intent);
    return $this->stripe->paymentIntents->update($intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents/{intent}/cancel - post
  public function createPaymentIntentCancel($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'intent');
    $intent = $options->intent;
    unset($options->intent);
    return $this->stripe->paymentIntents->createCancel($intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents/{intent}/capture - post
  public function createPaymentIntentCapture($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'intent');
    $intent = $options->intent;
    unset($options->intent);
    return $this->stripe->paymentIntents->createCapture($intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_intents/{intent}/confirm - post
  public function createPaymentIntentConfirm($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'intent');
    $intent = $options->intent;
    unset($options->intent);
    return $this->stripe->paymentIntents->createConfirm($intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_methods - get
  public function listPaymentMethods($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'customer');
    $customer = $options->customer;
    unset($options->customer);
    option_require($options, 'type');
    $type = $options->type;
    unset($options->type);
    return $this->stripe->paymentMethods->all($customer, $type, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_methods - post
  public function createPaymentMethod($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->paymentMethods->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_methods/{payment_method} - get
  public function retrievePaymentMethod($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'payment_method');
    $payment_method = $options->payment_method;
    unset($options->payment_method);
    return $this->stripe->paymentMethods->retrieve($payment_method)->toArray();
  }

  // /v1/payment_methods/{payment_method} - post
  public function updatePaymentMethod($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'payment_method');
    $payment_method = $options->payment_method;
    unset($options->payment_method);
    return $this->stripe->paymentMethods->update($payment_method, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_methods/{payment_method}/attach - post
  public function createPaymentMethodAttach($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'payment_method');
    $payment_method = $options->payment_method;
    unset($options->payment_method);
    return $this->stripe->paymentMethods->createAttach($payment_method, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payment_methods/{payment_method}/detach - post
  public function createPaymentMethodDetach($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'payment_method');
    $payment_method = $options->payment_method;
    unset($options->payment_method);
    return $this->stripe->paymentMethods->createDetach($payment_method, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payouts - get
  public function listPayouts($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->payouts->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payouts - post
  public function createPayout($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->payouts->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payouts/{payout} - get
  public function retrievePayout($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'payout');
    $payout = $options->payout;
    unset($options->payout);
    return $this->stripe->payouts->retrieve($payout)->toArray();
  }

  // /v1/payouts/{payout} - post
  public function updatePayout($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'payout');
    $payout = $options->payout;
    unset($options->payout);
    return $this->stripe->payouts->update($payout, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payouts/{payout}/cancel - post
  public function createPayoutCancel($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'payout');
    $payout = $options->payout;
    unset($options->payout);
    return $this->stripe->payouts->createCancel($payout, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/payouts/{payout}/reverse - post
  public function createPayoutReverse($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'payout');
    $payout = $options->payout;
    unset($options->payout);
    return $this->stripe->payouts->createReverse($payout, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/plans - get
  public function listPlans($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->plans->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/plans - post
  public function createPlan($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->plans->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/plans/{plan} - delete
  public function deletePlan($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'plan');
    $plan = $options->plan;
    unset($options->plan);
    return $this->stripe->plans->delete($plan)->toArray();
  }

  // /v1/plans/{plan} - get
  public function retrievePlan($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'plan');
    $plan = $options->plan;
    unset($options->plan);
    return $this->stripe->plans->retrieve($plan)->toArray();
  }

  // /v1/plans/{plan} - post
  public function updatePlan($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'plan');
    $plan = $options->plan;
    unset($options->plan);
    return $this->stripe->plans->update($plan, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/prices - get
  public function listPrices($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->prices->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/prices - post
  public function createPrice($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->prices->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/prices/{price} - get
  public function retrievePrice($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'price');
    $price = $options->price;
    unset($options->price);
    return $this->stripe->prices->retrieve($price)->toArray();
  }

  // /v1/prices/{price} - post
  public function updatePrice($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'price');
    $price = $options->price;
    unset($options->price);
    return $this->stripe->prices->update($price, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/products - get
  public function listProducts($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->products->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/products - post
  public function createProduct($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->products->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/products/{id} - delete
  public function deleteProduct($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->products->delete($id)->toArray();
  }

  // /v1/products/{id} - get
  public function retrieveProduct($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->products->retrieve($id)->toArray();
  }

  // /v1/products/{id} - post
  public function updateProduct($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->products->update($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/promotion_codes - get
  public function listPromotionCodes($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->promotionCodes->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/promotion_codes - post
  public function createPromotionCode($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->promotionCodes->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/promotion_codes/{promotion_code} - get
  public function retrievePromotionCode($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'promotion_code');
    $promotion_code = $options->promotion_code;
    unset($options->promotion_code);
    return $this->stripe->promotionCodes->retrieve($promotion_code)->toArray();
  }

  // /v1/promotion_codes/{promotion_code} - post
  public function updatePromotionCode($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'promotion_code');
    $promotion_code = $options->promotion_code;
    unset($options->promotion_code);
    return $this->stripe->promotionCodes->update($promotion_code, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/early_fraud_warnings - get
  public function listRadarEarlyFraudWarnings($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->radar->earlyFraudWarnings->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/early_fraud_warnings/{early_fraud_warning} - get
  public function retrieveRadarEarlyFraudWarning($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'early_fraud_warning');
    $early_fraud_warning = $options->early_fraud_warning;
    unset($options->early_fraud_warning);
    return $this->stripe->radar->earlyFraudWarnings->retrieve($early_fraud_warning)->toArray();
  }

  // /v1/radar/value_list_items - get
  public function listRadarValueListItems($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'value_list');
    $value_list = $options->value_list;
    unset($options->value_list);
    return $this->stripe->radar->valueListItems->all($value_list, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/value_list_items - post
  public function createRadarValueListItem($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->radar->valueListItems->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/value_list_items/{item} - delete
  public function deleteRadarValueListItem($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'item');
    $item = $options->item;
    unset($options->item);
    return $this->stripe->radar->valueListItems->delete($item)->toArray();
  }

  // /v1/radar/value_list_items/{item} - get
  public function retrieveRadarValueListItem($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'item');
    $item = $options->item;
    unset($options->item);
    return $this->stripe->radar->valueListItems->retrieve($item)->toArray();
  }

  // /v1/radar/value_lists - get
  public function listRadarValueLists($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->radar->valueLists->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/value_lists - post
  public function createRadarValueList($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->radar->valueLists->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/radar/value_lists/{value_list} - delete
  public function deleteRadarValueList($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'value_list');
    $value_list = $options->value_list;
    unset($options->value_list);
    return $this->stripe->radar->valueLists->delete($value_list)->toArray();
  }

  // /v1/radar/value_lists/{value_list} - get
  public function retrieveRadarValueList($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'value_list');
    $value_list = $options->value_list;
    unset($options->value_list);
    return $this->stripe->radar->valueLists->retrieve($value_list)->toArray();
  }

  // /v1/radar/value_lists/{value_list} - post
  public function updateRadarValueList($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'value_list');
    $value_list = $options->value_list;
    unset($options->value_list);
    return $this->stripe->radar->valueLists->update($value_list, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/recipients - get
  public function listRecipients($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->recipients->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/recipients - post
  public function createRecipient($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->recipients->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/recipients/{id} - delete
  public function deleteRecipient($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->recipients->delete($id)->toArray();
  }

  // /v1/recipients/{id} - get
  public function retrieveRecipient($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->recipients->retrieve($id)->toArray();
  }

  // /v1/recipients/{id} - post
  public function updateRecipient($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->recipients->update($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/refunds - get
  public function listRefunds($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->refunds->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/refunds - post
  public function createRefund($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->refunds->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/refunds/{refund} - get
  public function retrieveRefund($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'refund');
    $refund = $options->refund;
    unset($options->refund);
    return $this->stripe->refunds->retrieve($refund)->toArray();
  }

  // /v1/refunds/{refund} - post
  public function updateRefund($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'refund');
    $refund = $options->refund;
    unset($options->refund);
    return $this->stripe->refunds->update($refund, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/reporting/report_runs - get
  public function listReportingReportRuns($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->reporting->reportRuns->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/reporting/report_runs - post
  public function createReportingReportRun($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->reporting->reportRuns->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/reporting/report_runs/{report_run} - get
  public function retrieveReportingReportRun($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'report_run');
    $report_run = $options->report_run;
    unset($options->report_run);
    return $this->stripe->reporting->reportRuns->retrieve($report_run)->toArray();
  }

  // /v1/reporting/report_types - get
  public function listReportingReportTypes($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->reporting->reportTypes->all()->toArray();
  }

  // /v1/reporting/report_types/{report_type} - get
  public function retrieveReportingReportType($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'report_type');
    $report_type = $options->report_type;
    unset($options->report_type);
    return $this->stripe->reporting->reportTypes->retrieve($report_type)->toArray();
  }

  // /v1/reviews - get
  public function listReviews($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->reviews->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/reviews/{review} - get
  public function retrieveReview($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'review');
    $review = $options->review;
    unset($options->review);
    return $this->stripe->reviews->retrieve($review)->toArray();
  }

  // /v1/reviews/{review}/approve - post
  public function createReviewApprove($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'review');
    $review = $options->review;
    unset($options->review);
    return $this->stripe->reviews->createApprove($review, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_attempts - get
  public function listSetupAttempts($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'setup_intent');
    $setup_intent = $options->setup_intent;
    unset($options->setup_intent);
    return $this->stripe->setupAttempts->all($setup_intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents - get
  public function listSetupIntents($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->setupIntents->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents - post
  public function createSetupIntent($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->setupIntents->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents/{intent} - get
  public function retrieveSetupIntent($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'intent');
    $intent = $options->intent;
    unset($options->intent);
    return $this->stripe->setupIntents->retrieve($intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents/{intent} - post
  public function updateSetupIntent($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'intent');
    $intent = $options->intent;
    unset($options->intent);
    return $this->stripe->setupIntents->update($intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents/{intent}/cancel - post
  public function createSetupIntentCancel($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'intent');
    $intent = $options->intent;
    unset($options->intent);
    return $this->stripe->setupIntents->createCancel($intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/setup_intents/{intent}/confirm - post
  public function createSetupIntentConfirm($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'intent');
    $intent = $options->intent;
    unset($options->intent);
    return $this->stripe->setupIntents->createConfirm($intent, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sigma/scheduled_query_runs - get
  public function listSigmaScheduledQueryRuns($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->sigma->scheduledQueryRuns->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sigma/scheduled_query_runs/{scheduled_query_run} - get
  public function retrieveSigmaScheduledQueryRun($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'scheduled_query_run');
    $scheduled_query_run = $options->scheduled_query_run;
    unset($options->scheduled_query_run);
    return $this->stripe->sigma->scheduledQueryRuns->retrieve($scheduled_query_run)->toArray();
  }

  // /v1/skus - get
  public function listSkus($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->skus->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/skus - post
  public function createSku($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->skus->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/skus/{id} - delete
  public function deleteSku($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->skus->delete($id)->toArray();
  }

  // /v1/skus/{id} - get
  public function retrieveSku($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->skus->retrieve($id)->toArray();
  }

  // /v1/skus/{id} - post
  public function updateSku($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->skus->update($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sources - post
  public function createSource($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->sources->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sources/{source} - get
  public function retrieveSource($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'source');
    $source = $options->source;
    unset($options->source);
    return $this->stripe->sources->retrieve($source, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sources/{source} - post
  public function updateSource($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'source');
    $source = $options->source;
    unset($options->source);
    return $this->stripe->sources->update($source, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sources/{source}/source_transactions - get
  public function listSourceSourceTransactions($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'source');
    $source = $options->source;
    unset($options->source);
    return $this->stripe->sources->listSourceTransactions($source, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/sources/{source}/verify - post
  public function createSourceVerify($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'source');
    $source = $options->source;
    unset($options->source);
    return $this->stripe->sources->createVerify($source, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_items - get
  public function listSubscriptionItems($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'subscription');
    $subscription = $options->subscription;
    unset($options->subscription);
    return $this->stripe->subscriptionItems->all($subscription, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_items - post
  public function createSubscriptionItem($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->subscriptionItems->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_items/{item} - delete
  public function deleteSubscriptionItem($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'item');
    $item = $options->item;
    unset($options->item);
    return $this->stripe->subscriptionItems->delete($item, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_items/{item} - get
  public function retrieveSubscriptionItem($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'item');
    $item = $options->item;
    unset($options->item);
    return $this->stripe->subscriptionItems->retrieve($item)->toArray();
  }

  // /v1/subscription_items/{item} - post
  public function updateSubscriptionItem($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'item');
    $item = $options->item;
    unset($options->item);
    return $this->stripe->subscriptionItems->update($item, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_items/{subscription_item}/usage_record_summaries - get
  public function listSubscriptionItemUsageRecordSummaries($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'subscription_item');
    $subscription_item = $options->subscription_item;
    unset($options->subscription_item);
    return $this->stripe->subscriptionItems->listUsageRecordSummaries($subscription_item, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_items/{subscription_item}/usage_records - post
  public function createSubscriptionItemUsageRecord($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'subscription_item');
    $subscription_item = $options->subscription_item;
    unset($options->subscription_item);
    return $this->stripe->subscriptionItems->createUsageRecord($subscription_item, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_schedules - get
  public function listSubscriptionSchedules($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->subscriptionSchedules->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_schedules - post
  public function createSubscriptionSchedule($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->subscriptionSchedules->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_schedules/{schedule} - get
  public function retrieveSubscriptionSchedule($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'schedule');
    $schedule = $options->schedule;
    unset($options->schedule);
    return $this->stripe->subscriptionSchedules->retrieve($schedule)->toArray();
  }

  // /v1/subscription_schedules/{schedule} - post
  public function updateSubscriptionSchedule($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'schedule');
    $schedule = $options->schedule;
    unset($options->schedule);
    return $this->stripe->subscriptionSchedules->update($schedule, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_schedules/{schedule}/cancel - post
  public function createSubscriptionScheduleCancel($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'schedule');
    $schedule = $options->schedule;
    unset($options->schedule);
    return $this->stripe->subscriptionSchedules->createCancel($schedule, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscription_schedules/{schedule}/release - post
  public function createSubscriptionScheduleRelease($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'schedule');
    $schedule = $options->schedule;
    unset($options->schedule);
    return $this->stripe->subscriptionSchedules->createRelease($schedule, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscriptions - get
  public function listSubscriptions($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->subscriptions->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscriptions - post
  public function createSubscription($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->subscriptions->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscriptions/{subscription_exposed_id} - delete
  public function deleteSubscription($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'subscription_exposed_id');
    $subscription_exposed_id = $options->subscription_exposed_id;
    unset($options->subscription_exposed_id);
    return $this->stripe->subscriptions->delete($subscription_exposed_id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscriptions/{subscription_exposed_id} - get
  public function retrieveSubscription($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'subscription_exposed_id');
    $subscription_exposed_id = $options->subscription_exposed_id;
    unset($options->subscription_exposed_id);
    return $this->stripe->subscriptions->retrieve($subscription_exposed_id)->toArray();
  }

  // /v1/subscriptions/{subscription_exposed_id} - post
  public function updateSubscription($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'subscription_exposed_id');
    $subscription_exposed_id = $options->subscription_exposed_id;
    unset($options->subscription_exposed_id);
    return $this->stripe->subscriptions->update($subscription_exposed_id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/subscriptions/{subscription_exposed_id}/discount - delete
  public function deleteSubscriptionDiscount($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'subscription_exposed_id');
    $subscription_exposed_id = $options->subscription_exposed_id;
    unset($options->subscription_exposed_id);
    return $this->stripe->subscriptions->deleteDiscount($subscription_exposed_id)->toArray();
  }

  // /v1/tax_rates - get
  public function listTaxRates($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->taxRates->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/tax_rates - post
  public function createTaxRate($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->taxRates->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/tax_rates/{tax_rate} - get
  public function retrieveTaxRate($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'tax_rate');
    $tax_rate = $options->tax_rate;
    unset($options->tax_rate);
    return $this->stripe->taxRates->retrieve($tax_rate)->toArray();
  }

  // /v1/tax_rates/{tax_rate} - post
  public function updateTaxRate($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'tax_rate');
    $tax_rate = $options->tax_rate;
    unset($options->tax_rate);
    return $this->stripe->taxRates->update($tax_rate, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/connection_tokens - post
  public function createTerminalConnectionToken($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->terminal->connectionTokens->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/locations - get
  public function listTerminalLocations($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->terminal->locations->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/locations - post
  public function createTerminalLocation($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->terminal->locations->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/locations/{location} - delete
  public function deleteTerminalLocation($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'location');
    $location = $options->location;
    unset($options->location);
    return $this->stripe->terminal->locations->delete($location)->toArray();
  }

  // /v1/terminal/locations/{location} - get
  public function retrieveTerminalLocation($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'location');
    $location = $options->location;
    unset($options->location);
    return $this->stripe->terminal->locations->retrieve($location)->toArray();
  }

  // /v1/terminal/locations/{location} - post
  public function updateTerminalLocation($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'location');
    $location = $options->location;
    unset($options->location);
    return $this->stripe->terminal->locations->update($location, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/readers - get
  public function listTerminalReaders($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->terminal->readers->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/readers - post
  public function createTerminalReader($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->terminal->readers->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/terminal/readers/{reader} - delete
  public function deleteTerminalReader($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'reader');
    $reader = $options->reader;
    unset($options->reader);
    return $this->stripe->terminal->readers->delete($reader)->toArray();
  }

  // /v1/terminal/readers/{reader} - get
  public function retrieveTerminalReader($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'reader');
    $reader = $options->reader;
    unset($options->reader);
    return $this->stripe->terminal->readers->retrieve($reader)->toArray();
  }

  // /v1/terminal/readers/{reader} - post
  public function updateTerminalReader($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'reader');
    $reader = $options->reader;
    unset($options->reader);
    return $this->stripe->terminal->readers->update($reader, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/tokens - post
  public function createToken($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->tokens->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/tokens/{token} - get
  public function retrieveToken($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'token');
    $token = $options->token;
    unset($options->token);
    return $this->stripe->tokens->retrieve($token)->toArray();
  }

  // /v1/topups - get
  public function listTopups($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->topups->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/topups - post
  public function createTopup($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->topups->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/topups/{topup} - get
  public function retrieveTopup($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'topup');
    $topup = $options->topup;
    unset($options->topup);
    return $this->stripe->topups->retrieve($topup)->toArray();
  }

  // /v1/topups/{topup} - post
  public function updateTopup($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'topup');
    $topup = $options->topup;
    unset($options->topup);
    return $this->stripe->topups->update($topup, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/topups/{topup}/cancel - post
  public function createTopupCancel($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'topup');
    $topup = $options->topup;
    unset($options->topup);
    return $this->stripe->topups->createCancel($topup, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/transfers - get
  public function listTransfers($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->transfers->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/transfers - post
  public function createTransfer($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->transfers->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/transfers/{id}/reversals - get
  public function listTransferReversals($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->transfers->listReversals($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/transfers/{id}/reversals - post
  public function createTransferReversal($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    return $this->stripe->transfers->createReversal($id, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/transfers/{transfer} - get
  public function retrieveTransfer($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'transfer');
    $transfer = $options->transfer;
    unset($options->transfer);
    return $this->stripe->transfers->retrieve($transfer)->toArray();
  }

  // /v1/transfers/{transfer} - post
  public function updateTransfer($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'transfer');
    $transfer = $options->transfer;
    unset($options->transfer);
    return $this->stripe->transfers->update($transfer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/transfers/{transfer}/reversals/{id} - get
  public function retrieveTransferReversal($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    option_require($options, 'transfer');
    $transfer = $options->transfer;
    unset($options->transfer);
    return $this->stripe->transfers->retrieveReversal($id, $transfer)->toArray();
  }

  // /v1/transfers/{transfer}/reversals/{id} - post
  public function updateTransferReversal($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'id');
    $id = $options->id;
    unset($options->id);
    option_require($options, 'transfer');
    $transfer = $options->transfer;
    unset($options->transfer);
    return $this->stripe->transfers->updateReversal($id, $transfer, json_decode(json_encode($options), true))->toArray();
  }

  // /v1/webhook_endpoints - get
  public function listWebhookEndpoints($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->webhookEndpoints->all(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/webhook_endpoints - post
  public function createWebhookEndpoint($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    return $this->stripe->webhookEndpoints->create(json_decode(json_encode($options), true))->toArray();
  }

  // /v1/webhook_endpoints/{webhook_endpoint} - delete
  public function deleteWebhookEndpoint($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'webhook_endpoint');
    $webhook_endpoint = $options->webhook_endpoint;
    unset($options->webhook_endpoint);
    return $this->stripe->webhookEndpoints->delete($webhook_endpoint)->toArray();
  }

  // /v1/webhook_endpoints/{webhook_endpoint} - get
  public function retrieveWebhookEndpoint($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'webhook_endpoint');
    $webhook_endpoint = $options->webhook_endpoint;
    unset($options->webhook_endpoint);
    return $this->stripe->webhookEndpoints->retrieve($webhook_endpoint)->toArray();
  }

  // /v1/webhook_endpoints/{webhook_endpoint} - post
  public function updateWebhookEndpoint($options) {
    $options = $this->app->parseObject($options, NULL, TRUE);
    option_require($options, 'webhook_endpoint');
    $webhook_endpoint = $options->webhook_endpoint;
    unset($options->webhook_endpoint);
    return $this->stripe->webhookEndpoints->update($webhook_endpoint, json_decode(json_encode($options), true))->toArray();
  }

}
