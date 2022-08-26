<?php

namespace Drupal\user_timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\user_timezone\Services\TimezoneService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides a 'User Timezone' Block.
 *
 * @Block(
 *   id = "user_timezone",
 *   admin_label = @Translation("Current User Timezone"),
 *   category = @Translation("Current User Timezone"),
 * )
 */

class TimezoneBlock extends BlockBase implements ContainerFactoryPluginInterface {
    /**
   *
   * @var Drupal\user_timezone\Services\TimezoneService
   */
  protected $timezone_services;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, TimezoneService $timezoneService) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->timezone_services = $timezoneService;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('timezone_services')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $date = $this->timezone_services->getTimezoneData();
    return array(
        // output
        '#markup' => $date,
        // prevent block caching
        '#cache' => [
          'max-age' => 0,
          ],
      );
  }

}
