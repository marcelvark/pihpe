<?
   $root = $_SERVER['DOCUMENT_ROOT'];
   require_once($root . '/[pihpe]/pihpe.php');

   global $style, $body, $script, $css, $js;
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <base href="<?= url('base'); ?>">
   
   <!-- ADD YOUR OWN BOILERPLATE MARKUP HERE --------------------------------->

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

   <link rel="apple-touch-icon" href="<?= url('apple-icon'); ?>">
   <link rel="icon" href="<?= url('favicon'); ?>">

   <title>PiHPe</title>

   <!-- Layout CSS ----------------------------------------------------------->

   <style>
   </style>

   <!-- Content CSS ---------------------------------------------------------->

   <? insert($css); ?>
   <? insert($style); ?>
</head>

<body>
   <!-- Content -------------------------------------------------------------->

   <main>
      <? insert($body); ?>
   </main>

   <!-- Layout scripts ------------------------------------------------------->

   <script>
      /*
         Add generic scripts here.
      */
   </script>

   <!-- Content scripts ------------------------------------------------------>

   <? insert($js); ?>
   <? insert($script); ?> 
</body>
</html>