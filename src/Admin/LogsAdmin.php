<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;


/**
 * Class LogsAdmin
 * @package App\Admin
 */
class LogsAdmin extends AbstractAdmin
{

  /**
   * @var string
   */
  protected $baseRoutePattern = 'logs';

  /**
   * @var string
   */
  protected $baseRouteName = 'logs';

  /**
   * @param RouteCollection $collection
   */
  protected function configureRoutes(RouteCollection $collection)
  {
    $collection->clearExcept(['list']);
    $collection->add("apk")
      ->add("extracted")
      ->add("backup");
  }
}