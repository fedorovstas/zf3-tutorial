<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\View\Model\ViewModel;

use Album\Model\AlbumTable;
use Album\Model\Album;

use Album\Form\AlbumForm;

/**
 * Class AlbumController
 * @package Album\Controller
 */
class AlbumController extends AbstractActionController
{
  /**
   * @var AlbumTable
   */
  private $table;
  
  /**
   * AlbumController constructor.
   * @param AlbumTable $table
   */
  public function __construct(AlbumTable $table)
  {
    $this->table = $table;
  }
  
  /**
   * @return ViewModel
   */
  public function indexAction()
  {
    // Grab the paginator from the AlbumTable:
    $paginator = $this->table->fetchAll(true);
    
    // Set the current page to what has been passed in query string,
    // or to 1 if none is set, or the page is invalid:
    $page = (int) $this->params()->fromQuery('page', 1);
    $page = ($page < 1) ? 1 : $page;
    $paginator->setCurrentPageNumber($page);
    
    // Set the number of items per page to 10:
    $paginator->setItemCountPerPage(10);
    
    return new ViewModel(['paginator' => $paginator]);
  }
  
  /**
   * @return array|\Zend\Http\Response
   */
  public function addAction()
  {
    $form = new AlbumForm();
    $form->get('submit')->setValue('Add');
    
    $request = $this->getRequest();
    
    if ( ! $request->isPost()) {
      return ['form' => $form];
    }
    
    $album = new Album();
    
    $form->setInputFilter($album->getInputFilter());
    $form->setData($request->getPost());
    
    if ( ! $form->isValid()) {
      return ['form' => $form];
    }
    
    $album->exchangeArray($form->getData());
    $this->table->saveAlbum($album);
    
    return $this->redirect()->toRoute('album');
  }
  
  /**
   * @return array|\Zend\Http\Response
   */
  public function editAction()
  {
    $id = (int) $this->params()->fromRoute('id', 0);
    
    if (0 === $id) {
      return $this->redirect()->toRoute('album', ['action' => 'add']);
    }
    
    try {
      $album = $this->table->getAlbum($id);
    } catch (\Exception $e) {
      return $this->redirect()->toRoute('album', ['action' => 'index']);
    }
    
    $form = new AlbumForm();
    $form->bind($album);
    $form->get('submit')->setAttribute('value', 'Edit');
    
    $request = $this->getRequest();
    $viewData = ['id' => $id, 'form' => $form];
    
    if ( ! $request->isPost()) {
      return $viewData;
    }
    
    $form->setInputFilter($album->getInputFilter());
    $form->setData($request->getPost());
    
    if ( ! $form->isValid()) {
      return $viewData;
    }
    
    $this->table->saveAlbum($album);
    
    return $this->redirect()->toRoute('album', ['action' => 'index']);
  }
  
  /**
   * @return array|\Zend\Http\Response
   */
  public function deleteAction()
  {
    $id = (int) $this->params()->fromRoute('id', 0);
    if ( ! $id) {
      return $this->redirect()->toRoute('album');
    }
    
    $request = $this->getRequest();
    if ($request->isPost()) {
      $del = $request->getPost('del', 'No');
      
      if ($del == 'Yes') {
        $id = (int) $request->getPost('id');
        $this->table->deleteAlbum($id);
      }
      
      // Redirect to list of albums
      return $this->redirect()->toRoute('album');
    }
    
    return [
      'id' => $id,
      'album' => $this->table->getAlbum($id),
    ];
  }
}