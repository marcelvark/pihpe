<?
   $root = $_SERVER['DOCUMENT_ROOT'];
   require_once($root . '/[pihpe]/pihpe.php');
   
   /* -------------------------------------------------------------------------
      Add page sections here, in order of appearance.
   */

   parse([
      'section'
   ]);

   /* -------------------------------------------------------------------------
      Choose a layout for rendering.
   */

   include(path('layout'));
?>