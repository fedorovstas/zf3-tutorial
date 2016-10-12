<?php

namespace Blog\Form;

use Zend\Form\Form;

/**
 * Class PostForm
 * @package Blog\Form
 */
class PostForm extends Form
{
  /**
   * @param null $name
   */
  public function init($name = null)
  {
    parent::__construct('blog');
    
    $this->add([
      'name' => 'post',
      'type' => PostFieldset::class,
      'options' => [
        'use_as_base_fieldset' => true,
      ],
    ]);
    
    $this->add([
      'type' => 'submit',
      'name' => 'submit',
      'attributes' => [
        'value' => 'Insert new Post',
      ],
    ]);
  }
}