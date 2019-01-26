<?
   /* -------------------------------------------------------------------------

      PiHPe

      A bit of PHP to help build simple dynamic/static websites.
      
   */

   $config = require_once($_SERVER['DOCUMENT_ROOT'] . '/[pihpe]/config.php');


   /* -------------------------------------------------------------------------
      Returns a URL for a resource (URN).
      (define these in /[pihpe]/paths.php, and use them anywhere)
   */

   require_once($_SERVER['DOCUMENT_ROOT'] . '/[pihpe]/paths.php');

   function url($name){
   	global $config;

   	if ($config['urls'] == 'file-relative'){
   		$source = debug_backtrace()[0]['file'];
   		$target = full($GLOBALS['paths'][$name]);
   		return map($source, $target);
   	}

   	else if ($config['urls'] == 'root-relative'){
      	return $GLOBALS['paths'][$name];
      }

      else if ($config['urls'] == 'absolute'){
      	$host = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
      	return $host . $GLOBALS['paths'][$name];
      }

      else {
      	throw new Exception('Invalid setting for \'urls\' in /[pihpe]/$config.php');
      }
   }


   /* -------------------------------------------------------------------------
      Returns a full path for a resource (URN).
   */
   function path($name){
   	return full($GLOBALS['paths'][$name]);
   }


   /* -------------------------------------------------------------------------
      Returns a filet-relative path between two paths.
   */
	function map($source, $target){
		$source = str_replace(['/', '//', '\\', '\\\\'], DIRECTORY_SEPARATOR, $source);
		$target = str_replace(['/', '//', '\\', '\\\\'], DIRECTORY_SEPARATOR, $target);

		$sparts = explode(DIRECTORY_SEPARATOR, rtrim($source, DIRECTORY_SEPARATOR));
		$tparts = explode(DIRECTORY_SEPARATOR, rtrim($target, DIRECTORY_SEPARATOR));

		while (count($sparts) && count($tparts) && ($sparts[0] == $tparts[0])){
			array_shift($sparts);
			array_shift($tparts);
		}
		return str_pad("", count($sparts) * 3, '../') . implode('/', $tparts);
	}


   /* -------------------------------------------------------------------------
      Parses a PHP file, containing a content section.
      (use in your pages - see /[pihpe]/examples/index.php)
   */

   // These global arrays collect page-specific sections,
   $style = $body = $script = [];

   // and these are for links to external CSS and JS
   $css = $js = [];

   function parse($sections){
      foreach($sections as $name){
         include(path($name));

         $GLOBALS['style'][] = $style;
         $GLOBALS['body'][] = $body;
         $GLOBALS['script'][] = $script;
      }
   }


   /* -------------------------------------------------------------------------
      Inserts HTML, CSS, JavaScript, or a link to externals into a page layout.
      (use in your page layouts - see /[pihpe]/examples/layout.php)
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
      (use in your content sections - see /[pihpe]/examples/section.php)
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
      global $root;

      foreach($files as $input){
         full($input);

         // Parse the PHP file
         ob_start();
         require($_SERVER['DOCUMENT_ROOT'] . $input);
         $html = ob_get_clean();

         // Save the HTML output
         $path = str_replace('php', 'html', $input);
         $output = fopen($_SERVER['DOCUMENT_ROOT'] . $path, 'w');
         fwrite($output, $html);
         fclose($output);
      }
   }


   /* -------------------------------------------------------------------------
      Returns a full properly formatted path. Note that the given root-relative
      path is also formatted.
   */

   function full(&$path){
      $path = str_replace(['/', '//', '\\', '\\\\'], DIRECTORY_SEPARATOR, $path);
      $path = DIRECTORY_SEPARATOR . trim($path, DIRECTORY_SEPARATOR);
      return $_SERVER['DOCUMENT_ROOT'] . $path;
   }


   /* -------------------------------------------------------------------------
      Recursively iterates over all items in a folder. The callback is provided 
      the name of the file or folder. Paths are relative to the document root.
   */

   function iterate($folder, $callback){
      // Sanitize the folder
      $path = full($folder);

      // Iterate over files
      if (file_exists($path)){
         $dir = opendir($path);
         while($item = readdir($dir)){
            if ($item[0] != '.'){
               if (is_dir($path . DIRECTORY_SEPARATOR . $item)){
                  iterate($folder . DIRECTORY_SEPARATOR . $item, $callback);
               }
               else {
                  // Pass a file to the callback
                  $callback($folder . DIRECTORY_SEPARATOR . $item);
               }
            }
         }

         closedir($dir);

         // Pass the folder to the callback
         $callback($folder);
      }
   }


   /* -------------------------------------------------------------------------
      Recursively copies files from a source- to target folder. All but hidden-
      and system files and folders are copied.
   */

   function xcopy($source, $target){
      full($target);

      iterate($source, function($item) use ($target){
         global $root;

         // Skip directories
         if (is_dir($root . $item)) return;

         // Return if the file was found inside the $target dir
         if (substr($item, 0, strlen($target)) === $target) return;

         // Make sure the target directory exists
         $dir = dirname($root . $target . $item);
         if (!is_dir($dir)) mkdir($dir, 0700, true);

         // Copy the file
         copy($root . $item, $root . $target . $item);
      });
   }


   /* -------------------------------------------------------------------------
      Recursively deletes all items from a folder.
   */

   function xrmdir($folder){
      full($folder);

      iterate($folder, function($item){
         global $root;

         // Return if the file was found inside the $target dir
         if (substr($item, 0, strlen($target)) === $target) return;

         // Remove the item
         if (is_dir($root . $item)){
            rmdir($root . $item);
         }
         else {
            unlink($root . $item);
         }
      });
   }
?>