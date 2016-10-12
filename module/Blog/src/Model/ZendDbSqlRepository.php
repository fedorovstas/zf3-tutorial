<?php

namespace Blog\Model;

use InvalidArgumentException;
use RuntimeException;
use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\ResultSet\ResultSet;
use Zend\Paginator\Paginator;

/**
 * Class ZendDbSqlRepository
 *
 * @package Blog\Model
 */
class ZendDbSqlRepository implements PostRepositoryInterface
{
  /**
   * @var AdapterInterface
   */
  private $db;
  
  /**
   * @var
   */
  private $hydrator;
  
  /**
   * @var
   */
  private $postPrototype;
  
  /**
   * ZendDbSqlRepository constructor.
   *
   * @param AdapterInterface $db
   */
  public function __construct(
    AdapterInterface $db,
    HydratorInterface $hydrator,
    Post $postPrototype
  )
  {
    $this->db = $db;
    $this->postPrototype = $postPrototype;
  }
  
  /**
   * {@inheritDoc}
   */
  public function findAllPosts($paginated = false)
  {
    $sql = new Sql($this->db);
    $select = $sql->select('posts');
    $statement = $sql->prepareStatementForSqlObject($select);
    $result = $statement->execute();
    
    if ( ! $result instanceof ResultInterface || ! $result->isQueryResult()) {
      return [];
    }
    
    $resultSet = new HydratingResultSet($this->hydrator,
      $this->postPrototype);
    $resultSet->initialize($result);
    
    if ($paginated) {
      $resultSetPrototype = new ResultSet();
      $resultSetPrototype->setArrayObjectPrototype(new Post(['id' => null, 'title' => '', 'text' => '']));
      
      // Create new pagination adapter object
      $paginatorAdapter = new DbSelect(
      // our configured select object:
        $select,
        // the adapter to run it against:
        $this->db,
        // the result set to hydrate:
        $resultSetPrototype
      );
      
      $paginator = new Paginator($paginatorAdapter);
      return $paginator;
    }
    
    return $resultSet;
  }
  
  /**
   * {@inheritDoc}
   * @throws InvalidArgumentException
   * @throws RuntimeException
   */
  public function findPost($id)
  {
    $sql = new Sql($this->db);
    $select = $sql->select('posts');
    $select->where(['id = ?' => $id]);
    
    $stmt = $sql->prepareStatementForSqlObject($select);
    $result = $stmt->execute();
    
    if ( ! $result instanceof ResultInterface || ! $result->isQueryResult()) {
      throw new RuntimeException(sprintf(
        'Failed retrieving blog post with identifier "%s"; unknown database error.',
        $id
      ));
    }
    
    $resultSet = new HydratingResultSet($this->hydrator,
      $this->postPrototype);
    $resultSet->initialize($result);
    $post = $resultSet->current();
    
    if ( ! $post) {
      throw new InvalidArgumentException(sprintf(
        'Blog post with identifier "%s" not found.',
        $id
      ));
    }
    
    return $post;
  }
}