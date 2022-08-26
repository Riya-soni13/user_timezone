<?php

namespace Drupal\user_timezone\Services;


/**
 * Class TimezoneService
 * @package Drupal\user_timezone\Services
 */
class TimezoneService {

  public function getTimezoneData() {

  	$config = \Drupal::config('user_timezone.settings');
  	$timezone = $config->get('timezone');
  	$timestamp = date_default_timezone_set($timezone);
  	$date = date('jS F Y - H:i A');
    return $date;
  }

}