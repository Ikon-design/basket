<?php
 //require('../models/Model.php');

 abstract class Controller {
     public function loadModel($model){
         include (ROOT.'models/'.$model.'.php');
         $this->$model = new $model();
         //var_dump(ROOT.'models/'.$model.'.php');
     }
     public function render($fichier, $data = []){
         extract($data);
         include (ROOT.'views/'.strtolower(get_class($this)).'/'.$fichier.'.php');
         //var_dump(ROOT.'views/'.strtolower(get_class($this)).'/'.$fichier.'.php');
     }
 }
