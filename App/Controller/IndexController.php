<?php

namespace App\Controller;

class IndexController extends Controller {

  public function __construct()
  {
    $this->protege();
  }

  public function indexAction() {

    $view = $this->view();
    echo $view->render('index', array());

  }

}