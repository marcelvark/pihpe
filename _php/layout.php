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
      @font-face {
         font-family: Mono;
         src: url("<?= url('monospace'); ?>") format('woff2');
      }

      * { margin: 0; padding: 0; box-sizing: border-box; }
      
      body { background-color: #444; }
      h1, h2, h3 { color: LightGreen; }
      p, li, pre, small { color: Silver; }
      a { color: SkyBlue; }
      kbd { color: White; }
      hr { background-image: linear-gradient(to right, #fff3, transparent); }

      *:focus { outline: 0.12rem dashed SkyBlue; outline-offset: 0.1rem; }
      ::-moz-selection { background: LightGreen; color: #444; }
      ::selection { background: rgba(144, 238, 144, 0.99); color: #444; }

      html { font-size: calc(1rem + 0.3vw); font-family: Sans; }
      h1, h2, h3, a, kbd { letter-spacing: 0.025em; font-family: Arial, sans-serif; }
      h1, h2, h3 { font-weight: normal; }
      h1 { font-size: 3rem; }
      h2 { font-size: 2rem; }
      h3 { font-size: 1rem; }
      p a, p kbd { font-size: 89%; }
      p, li { line-height: 140%; letter-spacing: 0.036em; font-family: Times New Roman, serif; }
      pre, code { font-size: 0.6rem; font-family: Mono, monospace; }
      small { font-size: 0.8rem; letter-spacing: 0.045em; }

      h1, h2 { width: 100%; }
      a { padding: 0.2em 0; text-decoration: none; }
      a:hover { border-bottom: 0.1em solid SkyBlue; }
      ul, ol { padding-left: 1em; }
      ul { list-style-type: square; }
      pre { overflow: hidden; white-space: pre-wrap; }

      html { padding-bottom: calc(50vh - 6vw); overscroll-behavior-y: contain; }
      main { padding: 0 3vw 1vw; display: flex; flex-wrap: wrap; }
      main > section { margin: 0 1vw 6vw 0; width: 29rem; }
      h1, h2, h3, p, ul, ol, pre { margin: 0.5rem 0; }
      hr { margin: 0 0 6vw; height: 0.2rem; border: none; width: 100%; }
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