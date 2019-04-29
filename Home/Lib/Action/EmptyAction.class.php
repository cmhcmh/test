<?php
class EmptyAction extends Action {

public function index()
{
	header("Location: /index.php");
}
   
}
