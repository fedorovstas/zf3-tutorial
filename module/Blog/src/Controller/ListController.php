<?php

namespace Blog\Controller;

use Blog\Model\PostRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;
use InvalidArgumentException;

/**
 * Class ListController
 * @package Blog\Controller
 */
class ListController extends AbstractActionController
{
  /**
   * @var PostRepositoryInterface
   */
  private $postRepository;
  
  /**
   * ListController constructor.
   * @param PostRepositoryInterface $postRepository
   */
  public function __construct(PostRepositoryInterface $postRepository)
  {
    $this->postRepository = $postRepository;
  }
  
  /**
   * @return array
   */
  public function indexAction()
  {
    $paginator = $this->postRepository->findAllPosts(true);
    
    $page = (int) $this->params()->fromQuery('page', 1);
    $page = ($page < 1) ? 1 : $page;
    $paginator->setCurrentPageNumber($page);
    
    // Set the number of items per page to 10:
    $paginator->setItemCountPerPage(10);
    
    return ['paginator' => $paginator];
  }
  
  
  /**
   * @return array|\Zend\Http\Response
   */
  public function detailAction()
  {
    $id = $this->params()->fromRoute('id');
    
    try {
      $post = $this->postRepository->findPost($id);
    } catch (\InvalidArgumentException $ex) {
      return $this->redirect()->toRoute('blog');
    }
    
    return ['post' => $post];
  }
}