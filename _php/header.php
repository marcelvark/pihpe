<?
   /*
      Use this to define a content section for your website. This includes all
      <style>, HTML, and <script> needed to render it, as well as any links for
      external CSS and JavaScript.
   */

   $root = $_SERVER['DOCUMENT_ROOT'];
   require_once($root . '/[pihpe]/pihpe.php');

   /*
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
      footer { color: Gray; font-size: 0.8rem; letter-spacing: 0.025em; font-family: Arial, sans-serif; }
      footer { padding-top: 0.5rem; position: absolute; top: 0; }
      /*footer a { color: Gray; }*/
   </style>
<? $style = ob_get_clean(); ?>
<? ob_start(); ?> 
   <!-- Page header ---------------------------------------------------------->

   <header>
      <h1>PiHPe</h1>
      <footer>Marcel Varkevisser | <a href="https://nl.linkedin.com/in/marcel-varkevisser">LinkedIn</a> | <a href="https://marcelvark.github.io">GitHub</a></footer>
   </header>
<? $body = ob_get_clean(); ?>
<? ob_start(); ?> 
   <!-- Page header ---------------------------------------------------------->

   <script>
   </script>
<? $script = ob_get_clean(); ?>