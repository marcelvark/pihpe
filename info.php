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
      mark { background-color: transparent; }
      h3 mark { color: White; letter-spacing: 0.05em; }
      pre mark { color: LightGreen; }
      /*pre:not(code) { font-family: Courier New, monospace; }*/

      /*ul { padding-left: 0; list-style: none; }
      li::before { color: Khaki; margin: 0 0.5em 0 0; padding: 0; content: '■'; }*/

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
         padding: 0.1em 0.35em; border-radius: 1em; background-color: Khaki; color: Black; 
         font-size: 0.7rem; font-weight: bold; font-family: Courier New, monospace; 
         vertical-align: top;
         /*display: none;*/
      }
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
      <h3><mark>info.php <span>A</span></mark></h3>
      <p>
         I like to spread my content over different files, making it much nicer to work on. Here's an example of a section:
      </p>

<pre><code>&lt;? ob_start(); ?&gt; 
   <mark>&lt;p&gt;A bit of PHP to help me create...&lt;/p&gt;</mark>
&lt;? $body = ob_get_clean(); ?&gt;</code></pre>

      <small>
         Each file contains all HTML, CSS, and JavaScript for one section. External stylesheet and -script links are also declared here. Including them is managed by PiHPe.
      </small>
   </section>

   <section>
      <h3><mark>header.php</mark></h3>
      <p>
         And here's another one, easy to reuse on multiple pages!
      </p>

<pre><code>&lt;? ob_start(); ?&gt; 
   <mark>&lt;style&gt;
      h1 { line-height: 100vh; }
   &lt;/style&gt;</mark>
&lt;? $style = ob_get_clean(); ?&gt;
&lt;? ob_start(); ?&gt; 
   <mark>&lt;h1&gt;PiHPe&lt;/h1&gt;</mark>
&lt;? $body = ob_get_clean(); ?&gt;</code></pre>
   </section>

   <section>
      <h3><mark>[pihpe]/paths.php <span>B</span></mark></h3>
      <p>
         In <kbd>paths.php</kbd>, I map resources and paths to unique names:
      </p>

<pre><code>$paths = [
   <mark>'info'    =&gt; '/info.php',
   'header'  =&gt; '/_php/header.php',
   'layout'  =&gt; '/_php/layout.php',
   'favicon' =&gt; '/_images/favicon.png'</mark>
];</code></pre>
      
      <small>
         'How to choose a good resource name' could be a perfect name for a section. These paths can now be included anywhere using:
      </small>

      <pre>
&lt;link rel=&quot;icon&quot; href=&quot;<mark>&lt;?= url('favicon'); ?&gt;</mark>&quot;&gt;</pre>
   </section>

   <section>
      <h3><mark>index.php</mark></h3>
      <p>
         Creating pages is a matter of choosing which sections to use in what order, and the layout to use for rendering:
      </p>
      
<pre><code>parse([
   <mark>'header',
   'info'</mark>
]);

include($root . <mark>url('layout')</mark>);</code></pre>
   </section>

   <section>
      <h3><mark>layout.php</mark></h3>
      <p>
         Design flexibility was one reason for creating PiHPe. I like to create layouts, and piece together my pages.
      </p>

<pre><code>   &lt;style&gt;
      <mark>h1 { color: LightGreen; }</mark>
   &lt;/style&gt;
   &lt;? insert($style); ?&gt;
&lt;/head&gt;
&lt;body&gt;
<mark>&lt;main&gt;</mark>
   &lt;? insert($body); ?&gt;
<mark>&lt;/main&gt;</mark></code></pre>
   </section>

   <section>
      <h3><mark>[pihpe]/build.php <span>C</span></mark></h3>
      <p>
         For GitHub I also needed a static build facility. A visit to <a href="/[pihpe]/build.php">build.php</a> will save HTML for those files specified:
      </p>

<pre><code>build([
   <mark>'/index.php'</mark>
]);</code></pre>

      <small>
         <i>A pattern-based copy to isolate static files is already on my todo list ;-)</i>
      </small>
   </section>

   <hr>

   <h2>More</h2>

   <section>
      <h3>Files</h3>
      <p>
         PiHPe uses a bit of a system with files and folders:
      </p>

<pre>[pihpe]
   examples
      index.php    <mark>Copy these when creating new files.</mark>
      layout.php
      section.php
   output          <mark>Build output is saved in here.</mark>
   build.php
   paths.php
   pihpe.php</pre>
   </section>

   <section>
      <h3>Usage</h3>
      <p>
         I like to use this approach for websites:
      </p>

<pre>[pihpe]
_css            <mark>For generic stuff. Underscores help with sorting.</mark>
_images
   favicon.png
_js
_php
   header.php
   layout.php
about           <mark>Lowercase folder names map to nice URLs.</mark>
   index.php    <mark>And so does index.php for page files.</mark>
index.php
info.php</pre>
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