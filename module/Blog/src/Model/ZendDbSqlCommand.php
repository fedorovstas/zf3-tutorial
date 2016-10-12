<?php

namespace Blog\Model;

use RuntimeException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;

/**
 * Class ZendDbSqlCommand
 *
 * @package Blog\Model
 */
class ZendDbSqlCommand implements PostCommandInterface
{
  /**
   * @var AdapterInterface
   */
  private $db;
  
  /**
   * ZendDbSqlCommand constructor.
   *
   * @param AdapterInterface $db
   */
  public function __construct(AdapterInterface $db)
  {
    $this->db = $db;
  }
  
  /**
   * @param Post $post
   *
   * @return Post
   */
  public function insertPost(Post $post)
  {
    $insert = new Insert('posts');
    $insert->values([
      'title' => $post->getTitle(),
      'text' => $post->getText(),
    ]);
    
    $sql = new Sql($this->db);
    $stmt = $sql->prepareStatementForSqlObject($insert);
    $result = $stmt->execute();
    
    if ( ! $result instanceof ResultInterface) {
      throw new RuntimeException(
        'Database error occurred during blog post insert operation'
      );
    }
    
    $data = [
      'id' => $result->getGeneratedValue(),
      'title' => $post->getTitle(),
      'text' => $post->getText(),
    ];
    
    return new Post($data);
  }
  
  
  /**
   * @param Post $post
   *
   * @return Post
   */
  public function updatePost(Post $post)
  {
    if ( ! $post->getId()) {
      throw RuntimeException('Cannot update post; missing identifier');
    }
    
    $update = new Update('posts');
    $update->set([
      'title' => $post->getTitle(),
      'text' => $post->getText(),
    ]);
    $update->where(['id = ?' => $post->getId()]);
    
    $sql = new Sql($this->db);
    $stmt = $sql->prepareStatementForSqlObject($update);
    $result = $stmt->execute();
    
    if ( ! $result instanceof ResultInterface) {
      throw new RuntimeException(
        'Database error occurred during blog post update operation'
      );
    }
    
    return $post;
  }
  
  
  /**
   * @param Post $post
   *
   * @return bool
   */
  public function deletePost(Post $post)
  {
    if ( ! $post->getId()) {
      throw RuntimeException('Cannot update post; missing identifier');
    }
    
    $delete = new Delete('posts');
    $delete->where(['id = ?' => $post->getId()]);
    
    $sql = new Sql($this->db);
    $stmt = $sql->prepareStatementForSqlObject($delete);
    $result = $stmt->execute();
    
    if ( ! $result instanceof ResultInterface) {
      return false;
    }
    
    return true;
  }
  
  
}