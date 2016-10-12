<?php

namespace Blog\Form;

use Zend\Form\Fieldset;
use Blog\Model\Post;
use Zend\Hydrator\Reflection as ReflectionHydrator;

/**
 * Class PostFieldset
 * @package Blog\Form
 */
class PostFieldset extends Fieldset
{
  /**
   *
   */
  public function init()
  {
    $this->setHydrator(new ReflectionHydrator());
    $this->setObject(new Post(['id' => null, 'title' => '', 'text' => '']));
    
    $this->add([
      'type' => 'hidden',
      'name' => 'id',
    ]);
    
    $this->add([
      'type' => 'text',
      'name' => 'title',
      'options' => [
        'label' => 'Post Title',
      ],
    ]);
    
    $this->add([
      'type' => 'textarea',
      'name' => 'text',
      'options' => [
        'label' => 'Post Text',
      ],
    ]);
  }
}