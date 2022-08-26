<?php

namespace Drupal\user_timezone\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements the form controller.
 */
class TimezoneConfigSettings extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'user_timezone_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['user_timezone.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    /* Variable initialization */
    $config = $this->config('user_timezone.settings');
    $country = $config->get('country');
    $city = $config->get('city');
    $timezone = $config->get('timezone');
    $timezone_arr = [
      'America/Chicago' => t('America/Chicago'),
      'America/New_york' => t('America/New_york'),
      'Asia/Tokyo' => t('Asia/Tokyo'),
      'Asia/Dubai' => t('Asia/Dubai'),
      'Asia/Kolkata' => t('Asia/Kolkata'),
      'Europe/Amsterdam' => t('Europe/Amsterdam'),
      'Europe/Oslo' => t('Europe/Oslo'),
      'Europe/London' => t('Europe/London'),
    ];

    $form['country'] = [
      '#type' => 'textfield',
      '#required' => TRUE,
      '#title' => $this->t('Country'),
      '#default_value' => $country,
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#required' => TRUE,
      '#title' => $this->t('City'),
      '#default_value' => $city,
    ];
    $form['timezone'] = [
      '#type' => 'select',
      '#required' => TRUE,
      '#title' => $this->t('Timezone'),
      '#default_value' => $timezone,
      '#options' => $timezone_arr,
      '#empty_option' => t('-None-')
    ];
    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form_state->setCached(FALSE);

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => t('Submit'),
    ];
    return $form;
  }

  /**
   * Implements a form submit handler.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('user_timezone.settings');
    $country = $form_state->getValue(['country']);
    $city = $form_state->getValue(['city']);
    $timezone = $form_state->getValue(['timezone']);
    
    $config
      ->set('country', $country)
      ->set('city', $city)
      ->set('timezone', $timezone)
      ->save();

    drupal_set_message(t('User timezone configuration have been updated.'));
  }

}
