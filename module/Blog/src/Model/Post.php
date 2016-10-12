<?php

namespace Blog\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

/**
 * Class Post
 *
 * @package Blog\Model
 */

/**
 * Class Post
 *
 * @package Blog\Model
 */
class Post implements InputFilterAwareInterface
{
  /**
   * @var int|null
   */
  private $id;
  /**
   * @var string
   */
  private $text;
  /**
   * @var string
   */
  private $title;
  /**
   * @var
   */
  private $inputFilter;
  
  /**
   * Post constructor.
   *
   * @param $data
   */
  public function __construct($data)
  {
    $this->id = $data['id'];
    $this->title = $data['title'];
    $this->text = $data['text'];
  }
  
  /**
   * @param $data
   */
  public function exchangeArray($data)
  {
    $this->id = $data['id'];
    $this->title = $data['title'];
    $this->text = $data['text'];
  }
  
  /**
   * @return int|null
   */
  public function getId()
  {
    return $this->id;
  }
  
  /**
   * @return string
   */
  public function getText()
  {
    return $this->text;
  }
  
  /**
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }
  
  /**
   * @param InputFilterInterface $inputFilter
   */
  public function setInputFilter(InputFilterInterface $inputFilter)
  {
    throw new DomainException(sprintf(
      '%s does not allow injection of an alternate input filter',
      __CLASS__
    ));
  }
  
  /**
   * @return InputFilter
   */
  public function getInputFilter()
  {
    if ($this->inputFilter) {
      return $this->inputFilter;
    }
    
    $inputFilter = new InputFilter();
    
    $inputFilter->add([
      'name' => 'id',
      'required' => true,
      'filters' => [
        ['name' => ToInt::class]
      ]
    ]);
    
    $inputFilter->add([
      'name' => 'title',
      'required' => true,
      'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class]
      ],
      'validators' => [
        [
          'name' => StringLength::class,
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 1,
            'max' => 100
          ]
        ]
      ]
    ]);
    
    $inputFilter->add([
      'name' => 'text',
      'required' => true,
      'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
      ],
      'validators' => [
        [
          'name' => StringLength::class,
          'options' => [
            'encoding' => 'UTF-8',
            'min' => 100,
          ]
        ]
      ]
    ]);
    
    
    $this->inputFilter = $inputFilter;
    return $this->inputFilter;
  }
}