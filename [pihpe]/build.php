<?
   /* -------------------------------------------------------------------------
      1. Delete any previous output
      2. Copy all files to the output
      3. Build all index.php files
      4. Build additional PHP files

			Use this to build additional PHP files.
   */

   $build = [
   ];


   /* -------------------------------------------------------------------------
      5. Delete all PHP files
      6. Delete additional files
         
			Add files here that you don't want in the build output.
   */

   $delete = [
      '/[pihpe]',
      '/LICENSE',
      '/README.md',
      '/serve.cmd'
   ];


   /* -------------------------------------------------------------------------
      7. Copy additional files
         
         Use this if you want to re-inlcude some PHP files in the build output, 
         perhaps for source code examples?
   */

   $copy = [
      '/.nojekyll',
      '/[pihpe]/build.html'
   ];


   /*
      8. Delete empty folders
   */
?>


<p><b><span style="font-family: sans-serif">PiHPe</span> - Edit <kbd>/[pihpe]/build.php</kbd> to configure the build process.</b></p>

<pre><?
   $root = $_SERVER['DOCUMENT_ROOT'];
   require_once($root . '/[pihpe]/pihpe.php');

   $output = '/[pihpe]/output/';

   function xecho($path){
      path($path);
      echo $path . PHP_EOL;
   }
?></pre>

<p>1. Delete any previous output</p>

<pre><?
   // (make sure any .nojekyll or other files starting with a . are gone)
   foreach ($copy as $item){
      if (file_exists($root . $output . $item)){
         xecho($output . $item);
         unlink($root . $output . $item);
      }
   }

   xecho($output);
   xrmdir($output);
?></pre>

<p>2. Copy all files to the output</p>

<pre><?
   xecho($output);
   xcopy('/', $output);
?></pre>

<p>3. Build all index.php files</p>

<pre><?
   iterate($output, function($item) use ($root){
      if (!is_dir($root . $item)){
         if (basename($item) == 'index.php'){
            xecho($item);
            build([$item]);
         }
      }
   });
?></pre>

<p>4. Build additional files</p>

<pre><?
   foreach ($build as $file){
      xecho($output . $file);
      build([$output . $file]);
   }
?></pre>

<p>5. Delete all PHP files</p>

<pre><?
   iterate($output, function($item) use ($root){
      if (!is_dir($root . $item)){
         if (pathinfo($item, PATHINFO_EXTENSION) == 'php'){
            xecho($item);
            unlink($root . $item);
         }
      }
   });
?></pre>

<p>6. Delete additional files</p>

<pre><?
   foreach ($delete as $item){
      if (is_dir($root . $output . $item)){
         xecho($output . $item);
         xrmdir($output . $item);
      }
      else {
         xecho($output . $item);
         unlink($root . $output . $item);
      }
   }
?></pre>

<p>7. Copy additional files</p>

<pre><?
   foreach ($copy as $file){
      xecho($file);
      
      $dir = dirname($root . $output . $file);
      if (!is_dir($dir)) mkdir($dir, 0700, true);
      copy($root . $file, $root . $output . $file);
   }
?></pre>

<p>8. Delete empty folders</p>

<pre><?
   iterate($output, function($item) use ($root){
      if (is_dir($root . $item)){
         if (!(new FilesystemIterator($root . $item))->valid()){
            xecho($output . $item);
            rmdir($root . $item);
         }
      }
   });
?></pre>