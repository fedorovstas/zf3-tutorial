<?php
/**
 * Created by PhpStorm.
 * User: preacher
 * Date: 28.09.2016
 * Time: 0:38
 */

namespace Album\Form;


use Zend\Form\Form;


/**
 * Class AlbumForm
 * @package Album\Form
 */
class AlbumForm extends Form
{
  /**
   * AlbumForm constructor.
   * @param null $name
   */
  public function __construct($name = null)
    {
        parent::__construct('album');
        
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        
        $this->add([
            'name'    => 'title',
            'type'    => 'text',
            'options' => [
                'label' => 'Title'
            ]
        ]);
        
        $this->add([
            'name'    => 'artist',
            'type'    => 'text',
            'options' => [
                'label' => 'Artist',
            ]
        ]);
        
        $this->add([
            'name'       => 'submit',
            'type'       => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton'
            ]
        ]);
        
        
    }
}