<?
   $root = $_SERVER['DOCUMENT_ROOT'];
   require_once($root . '/[pihpe]/pihpe.php');
   
   /*
      Add page sections here, in order of appearance.
   */

   parse([
      'header',
      'info'
   ]);

   // Renders the page
   include($root . url('layout'));
?>