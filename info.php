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
   <!-- Info ----------------------------------------------------------------->

   <style>
      h3 { font-size: 1rem; color: White; }

      /*ul { list-style: none; }
      li::before { margin: 0 0.5em 0 0; padding: 0; content: '■'; }*/

      /*ol { padding-left: 0; counter-reset: count; list-style: none; }
      ol li { counter-increment: count; }
      ol li::before { 
         content: counter(count) ''; 
         padding: 0.1em 0.4em; margin-right: 1em; border-radius: 1em;
         background-color: LightGreen; color: Black; 
         font-size: 80%; font-weight: bold; font-family: Courier New, monospace; 
         vertical-align: bottom;
      }*/

      li span, h3 span { 
         padding: 0.1em 0.35em; border-radius: 1em; background-color: Silver; color: Black; 
         font-size: 0.7rem; font-weight: bold; font-family: Courier New, monospace; 
         vertical-align: top;
      }

      pre mark { color: LightGreen; background-color: transparent; }
   </style>
<? $style = ob_get_clean(); ?>
<? ob_start(); ?> 
   <!-- Info ----------------------------------------------------------------->

   <h2>What</h2>

   <section>
      <p>
         A bit of PHP to help me create simple websites. It allows me to:
         <ul>
            <li>isolate content in separate files <span>A</span></li>
            <li>have relative paths and links sorted <span>B</span></li>
            <li>publish static versions (i.e. GitHub), too <span>C</span></li>
            <li>use HTML/CSS/JS, with a bit of PHP</li>
            <li>have proper syntax highlighting</li>
         </ul>
      </p>
   </section>

   <hr>

   <h2>How</h2>

   <section>
      <h3>message.php <span>A</span></h3>
      <p>
         Carefully spreading content over different files, makes it much nicer to work on...
      </p>

      <pre>
&lt;? ob_start(); ?&gt; 
   <mark>&lt;p&gt;A bit of PHP to help me create...&lt;/p&gt;</mark>
&lt;? $body = ob_get_clean(); ?&gt;</pre>

      <small>
         Each file contains all HTML, CSS, and JavaScript for one piece of content. External stylesheets and -scripts are also declared here. And when content is combined on a page, those externals are loaded only once by PiHPe.
      </small>
   </section>

   <section>
      <h3>header.php</h3>
      <p>
         ...and easy to reuse content on multiple pages:
      </p>

      <pre>
&lt;? ob_start(); ?&gt; 
   <mark>&lt;style&gt;
      h1 { line-height: 100vh; }
   &lt;/style&gt;</mark>
&lt;? $style = ob_get_clean(); ?&gt;
&lt;? ob_start(); ?&gt; 
   <mark>&lt;h1&gt;PiHPe&lt;/h1&gt;</mark>
&lt;? $body = ob_get_clean(); ?&gt;</pre>
   </section>

   <section>
      <h3>/_pihpe/paths.php <span>B</span></h3>
      <p>
         I give everything a unique name:
      </p>
      <pre>
$paths = [
   <mark>'message' =&gt; '/message.php',
   'header'  =&gt; '/header.php'</mark>,
   'layout'  =&gt; '/_php/layout.php',
   'favicon' =&gt; '/favicon.png'
];</pre>
      </p>
      
      <small>
         Remember DRY, and simply include URL's with a but of PHP:
      </small>

      <pre>
&lt;link rel=&quot;icon&quot; href=&quot;<mark>&lt;?= url('favicon'); ?&gt;</mark>&quot;&gt;
      </pre>
   </section>

   <section>
      <h3>index.php</h3>
      <p>
         Decide what to add to a page, and which layout to use:
         <pre>
parse([
   <mark>'header',
   'message'</mark>
]);

include($root . <mark>url('layout')</mark>);
         </pre>
      </p>
   </section>

   <section>
      <h3>layout.php</h3>
      <p>
         <pre>
<mark>&lt;main&gt;</mark>
   &lt;? insert($body); ?&gt;
<mark>&lt;/main&gt;</mark>
         </pre>
      </p>
   </section>

   <section>
      <h3>/_pihpe/build.php <span>C</span></h3>
      <p>
         Define what to include in a build. Browse to <a href="/[pihpe]/build.php">/[pihpe]/build</a> to create a static version:
         <pre>
build([
   <mark>'/index.php'</mark>
]);
         </pre>
      </p>
   </section>

   <hr>

   <h2>Next</h2>

   <section>
      <p>
         <ul>
            <li>Test a build on GitHub.</li>
            <li>Write a proper README.md.</li>
            <li>Add simple template facility.</li>
         </ul>
      </p>
   </section>
<? $body = ob_get_clean(); ?>
<? ob_start(); ?> 
   <!-- Info ----------------------------------------------------------------->

   <script>
   </script>
<? $script = ob_get_clean(); ?>