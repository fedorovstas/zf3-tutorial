<?php

namespace Blog\Factory;

use Blog\Controller\WriteController;
use Blog\Form\PostForm;
use Blog\Model\PostCommandInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Blog\Model\PostRepositoryInterface;

/**
 * Class WriteControllerFactory
 * @package Blog\Factory
 */
class WriteControllerFactory implements FactoryInterface
{
  /**
   * @param ContainerInterface $container
   * @param string $requestedName
   * @param array|null $option
   * @return WriteController
   */
  public function __invoke(
    ContainerInterface $container,
    $requestedName,
    array $option = null
  )
  {
    $formManager = $container->get('FormElementManager');
    return new WriteController(
      $container->get(PostCommandInterface::class),
      $formManager->get(PostForm::class),
      $container->get(PostRepositoryInterface::class)
    );
  }
}