<?
   /* -------------------------------------------------------------------------

      PiHPe

      A bit of PHP to help build dynamic or static websites.
   */


   /* -------------------------------------------------------------------------
      Returns a URL for a resource (URN).
      (define these in /[pihpe]/paths.php, and use them anywhere)
   */

   require_once($_SERVER['DOCUMENT_ROOT'] . '/[pihpe]/paths.php');

   function url($name){
      // Use paths relative to the site root:
      return $GLOBALS['paths'][$name];

      /* 
      // or use absolute paths (perhaps for later?):
      $host = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
      return $host . $GLOBALS['paths'][$name];
      */
   }


   /* -------------------------------------------------------------------------
      Parses a PHP file, containing a content section.
      (use in your pages - see /[pihpe]/_index.php)
   */

   // These global arrays collect page-specific sections,
   $style = $body = $script = [];

   // and these are for links to external CSS and JS
   $css = $js = [];

   function parse($sections){
      foreach($sections as $name){
         include($_SERVER['DOCUMENT_ROOT'] . $GLOBALS['paths'][$name]);

         $GLOBALS['style'][] = $style;
         $GLOBALS['body'][] = $body;
         $GLOBALS['script'][] = $script;
      }
   }


   /* -------------------------------------------------------------------------
      Inserts HTML, CSS, JavaScript, or a link to externals into a page layout.
      (use in your page layouts - see /[pihpe]/_layout.php)
   */

   function insert($array){
      global $style, $body, $script, $css, $js;

      switch ($array){
         case $style:
         case $body:
         case $script:
            foreach ($array as $item){
               echo $item;
            }
            break;

         case $css:
            foreach ($array as $item){
               echo '<link rel="stylesheet" href="' . url($item).'">' . "\r\n";
            }
            break;

         case $js:
            foreach ($array as $item){
               echo '<script src="' . url($item) . '"></script>' . "\r\n";
            }
            break;
      }
   }


   /* -------------------------------------------------------------------------
      Keeps track of links of external CSS and JavaSCript for a page.
      (use in your content sections - see /[pihpe]/_section.php)
   */

   function links($names){
      global $paths, $css, $js;

      foreach($names as $name){
         $url = $paths[$name];
         $ext = pathinfo($url, PATHINFO_EXTENSION);

         switch ($ext){
            case 'css':
               if (!in_array($name, $css)) $css[] = $name;
               break;

            case 'js':
               if (!in_array($name, $js)) $js[] = $name;
               break;
         }
      }
   }


   /* -------------------------------------------------------------------------
      Renders the given PHP pages, and saves the output as HTML.
      (used by PiHPe in /[pihpe]/build.php)
   */

   function build($files){
      foreach($files as $input){
         // Parse the PHP file
         ob_start();
         include($_SERVER['DOCUMENT_ROOT'] . $input);
         $html = ob_get_clean();

         // Save the HTML output
         $path = str_replace('php', 'html', $input);
         echo $path;

         $output = fopen($_SERVER['DOCUMENT_ROOT'] . $path, 'w');
         fwrite($output, $html);
         fclose($output);
      }
   }
?>