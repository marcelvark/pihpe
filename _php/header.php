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
      'example.js'
   ]);
?>
<? ob_start(); ?> 
   <!-- Page header ---------------------------------------------------------->

   <style>
      header { min-height: 100vh; }
      h1 { line-height: 100vh; text-align: middle; font-size: 6rem; margin: 0; }
      h1 a { padding: 0; color: inherit; }
      h1 a:hover { border: none; }
      footer { color: Gray; font-size: 0.8rem; letter-spacing: 0.025em; font-family: Arial, sans-serif; }
      footer { padding-top: 0.5rem; position: absolute; top: 0; }
   </style>
<? $style = ob_get_clean(); ?>
<? ob_start(); ?> 
   <!-- Page header ---------------------------------------------------------->

   <header>
      <h1><a href="https://github.com/marcelvark/pihpe">PiHPe</a></h1>
      <footer>Marcel Varkevisser | <a href="https://marcelvark.github.io">GitHub</a></footer>
   </header>
<? $body = ob_get_clean(); ?>