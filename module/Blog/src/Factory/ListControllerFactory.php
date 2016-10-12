<?php

namespace Blog\Factory;

use Blog\Controller\ListController;
use Blog\Model\PostRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ListControllerFactory
 * @package Blog\Factory
 */
class ListControllerFactory implements FactoryInterface
{
  /**
   * @param ContainerInterface $container
   * @param string $requestedName
   * @param array|null $options
   * @return ListController
   */
  public function __invoke(
    ContainerInterface $container,
    $requestedName,
    array $options = null
  )
  {
    return new ListController($container->get(PostRepositoryInterface::class));
  }
}