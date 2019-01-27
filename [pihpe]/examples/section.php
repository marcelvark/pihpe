<?
   /* -------------------------------------------------------------------------
      Use this to define a content section for your website. This includes all
      <style>, HTML, and <script> needed to render it, as well as any links for
      external CSS and JavaScript.

      Note that blocks (<? ob_start()...ob_get_clean(); ?>) are optional.
   */

   $root = $_SERVER['DOCUMENT_ROOT'];
   require_once($root . '/[pihpe]/pihpe.php');

   /* ------------------------------------------------------------------------
      Add links to external CSS and JavaScript here as needed.
      Note that these links best use URNs defined in /[pihpe]/paths.php.
   */

   links([
      //'example'
   ]);
?>
<? ob_start(); ?> 
   <!-- SECTION NAME --------------------------------------------------------->

   <style>
   </style>
<? $style = ob_get_clean(); ?>
<? ob_start(); ?> 
   <!-- SECTION NAME --------------------------------------------------------->

   <p>Hello World</p>
<? $body = ob_get_clean(); ?>
<? ob_start(); ?> 
   <!-- SECTION NAME --------------------------------------------------------->

   <script>
   </script>
<? $script = ob_get_clean(); ?>