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
      h3 { color: White; letter-spacing: 0.05em; }

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
         /*display: none;*/
      }

      pre mark { color: LightGreen; background-color: transparent; }
   </style>
<? $style = ob_get_clean(); ?>
<? ob_start(); ?> 
   <!-- Info ----------------------------------------------------------------->

   <h2>What</h2>

   <section>
      <p>
         A bit of PHP to help me create simple websites. In particular to:
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
         I like to spread my content over different files, making it much nicer to work on. Here's an example of a section:
      </p>

      <pre>
&lt;? ob_start(); ?&gt; 
   <mark>&lt;p&gt;A bit of PHP to help me create...&lt;/p&gt;</mark>
&lt;? $body = ob_get_clean(); ?&gt;</pre>

      <small>
         Each file contains all HTML, CSS, and JavaScript for one section. External stylesheet and -script links are also declared here. Including them is managed by PiHPe.
      </small>
   </section>

   <section>
      <h3>header.php</h3>
      <p>
         And here's another one, easy to reuse on multiple pages!
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
      <h3>/[pihpe]/paths.php <span>B</span></h3>
      <p>
         In <kbd>paths.php</kbd>, I map resources and paths to unique names:
      </p>
      <pre>
$paths = [
   <mark>'info'    =&gt; '/info.php',
   'header'  =&gt; '/_php/header.php',
   'layout'  =&gt; '/_php/layout.php',
   'favicon' =&gt; '/_images/favicon.png'</mark>
];</pre>
      </p>
      
      <small>
         'How to choose a good resource name' could be a perfect name for a section. These paths can now be included anywhere using:
      </small>

      <pre>
&lt;link rel=&quot;icon&quot; href=&quot;<mark>&lt;?= url('favicon'); ?&gt;</mark>&quot;&gt;</pre>
   </section>

   <section>
      <h3>index.php</h3>
      <p>
         Creating pages is a matter of choosing which sections to use in what order, and the layout to use for rendering:
      </p>
      
      <pre>
parse([
   <mark>'header',
   'info'</mark>
]);

include($root . <mark>url('layout')</mark>);</pre>
   </section>

   <section>
      <h3>layout.php</h3>
      <p>
         Design flexibility was one reason for creating PiHPe. I like to create layouts, and piece together my pages.
      </p>

      <pre>
   &lt;style&gt;
      <mark>h1 { color: LightGreen; }</mark>
   &lt;/style&gt;
   &lt;? insert($style); ?&gt;
&lt;/head&gt;
&lt;body&gt;
<mark>&lt;main&gt;</mark>
   &lt;? insert($body); ?&gt;
<mark>&lt;/main&gt;</mark></pre>
   </section>

   <section>
      <h3>/[pihpe]/build.php <span>C</span></h3>
      <p>
         For GitHub I also needed a added static build facility. A visit to <a href="/[pihpe]/build.php">/[pihpe]/build.php</a> will save HTML for those files specified:
      </p>

      <pre>
build([
   <mark>'/index.php'</mark>
]);</pre>

      <small>
         <i>A pattern-based copy to isolate static files is already on my todo list ;-)</i>
      </small>
   </section>

   <hr>

   <h2>Next</h2>

   <section>
      <p>
         <ul>
            <li>Improve the build mechanism.</li>
            <li>Create a simple template facility.</li>
            <li>Add file-relative linking.</li>
         </ul>
      </p>
   </section>
<? $body = ob_get_clean(); ?>