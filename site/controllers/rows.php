<?php
	
return function($site, $pages, $page) {

  // get all articles and add pagination
  $containers = $page->children(); //->visible();

  // pass $articles and $pagination to the template
  return compact('containers');

};

?>