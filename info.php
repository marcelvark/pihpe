<?
   /*
      Use this to define a content section for your website. This includes all
      <style>, HTML, and <script> needed to render it, as well as any links for
      external CSS and JavaScript.

      Note that blocks (<? ob_start()...ob_get_clean(); ?>) are optional.
   */

   $root = $_SERVER['DOCUMENT_ROOT'];
   require_once($root . '/[pihpe]/pihpe.php');

   /*
      Add links to external CSS and JavaScript here as needed.
      Note that these links best use URNs defined in /[pihpe]/paths.php.
   */

   links([
      'example'
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
            <li>create static versions (i.e. GitHub), too <span>C</span></li>
            <li>use HTML/CSS/JS, with a bit of PHP</li>
            <li>have proper syntax highlighting</li>
         </ul>
      </p>
   </section>

   <hr>

   <h2>How</h2>

   <section>
      <h3>info.php <span>A</span></h3>
      <p>
         I carefully spread my content over different files, making it much nicer to work on. Here's one section of content:
      </p>

      <pre>
&lt;? ob_start(); ?&gt; 
   <mark>&lt;p&gt;A bit of PHP to help me create...&lt;/p&gt;</mark>
&lt;? $body = ob_get_clean(); ?&gt;</pre>

      <small>
         Each file contains all HTML, CSS, and JavaScript for one content section. External stylesheets and -scripts are also declared here. Including links is managed by PiHPe.
      </small>
   </section>

   <section>
      <h3>header.php</h3>
      <p>
         And here's another, easily reused on many pages!
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
         I use this file to map resources and paths to unique names:
      </p>
      <pre>
$paths = [
   <mark>'info'    =&gt; '/info.php',
   'header'  =&gt; '/_php/header.php'</mark>,
   'layout'  =&gt; '/_php/layout.php',
   'favicon' =&gt; '/_images/favicon.png'
];</pre>
      </p>
      
      <small>
         This is just an example. 'How to choose a good resource name' could be a perfect identifier for a section of content. To include it, use:
      </small>

      <pre>
&lt;link rel=&quot;icon&quot; href=&quot;<mark>&lt;?= url('favicon'); ?&gt;</mark>&quot;&gt;
      </pre>
   </section>

   <section>
      <h3>index.php</h3>
      <p>
         Here I decide what to add to a page, and which layout to use:
         <pre>
parse([
   <mark>'header',
   'info'</mark>
]);

include($root . <mark>url('layout')</mark>);
         </pre>
      </p>
   </section>

   <section>
      <h3>layout.php</h3>
      <p>
         Which I need to define first, obviously:
      </p>

      <pre>
   &lt;style&gt;
      <mark>h1 { color: LightGreen; }</mark>
   &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
<mark>&lt;main&gt;</mark>
   &lt;? insert($body); ?&gt;
<mark>&lt;/main&gt;</mark></pre>
   </section>

   <section>
      <h3>/_pihpe/build.php <span>C</span></h3>
      <p>
         To create a static version, I browse to <a href="/[pihpe]/build.php">/[pihpe]/build.php</a>. In this file I also specify what to include in a build:
      </p>

      <pre>
build([
   <mark>'/index.php'</mark>
]);</pre>
   </section>

   <hr>

   <h2>Next</h2>

   <section>
      <p>
         <ul>
            <li>Test a build on GitHub.</li>
            <li>Finish this page. Add a Why section.</li>
            <li>Write a proper README.md.</li>
            <li>Add simple template facility.</li>
         </ul>
      </p>
   </section>
<? $body = ob_get_clean(); ?>