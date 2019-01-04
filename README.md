# PiHPe
Here's an [example](https://marcelvark.github.io/) made with PiHPe. It is a styled version of the information below. All files used in the build are in the repository.

## What
A bit of PHP to help me create simple websites. It allows me to:

- isolate content in separate files
- have relative paths and links sorted
- create static versions (i.e. GitHub), too
- use HTML/CSS/JS, with a bit of PHP
- have proper syntax highlighting

## How
### info.php
I like to spread my content over different files, making it much nicer to work on. Here's an example of a section:

    <? ob_start(); ?> 
        <p>A bit of PHP to help me create...</p>
    <? $body = ob_get_clean(); ?>

*Each file contains all HTML, CSS, and JavaScript for one section. External stylesheet and -script links are also declared here. Including them is managed by PiHPe.*

### header.php
And here's another one, easy to reuse on multiple pages!

    <? ob_start(); ?> 
        <style>
            h1 { line-height: 100vh; }
        </style>
    <? $style = ob_get_clean(); ?>
    <? ob_start(); ?> 
        <h1>PiHPe</h1>
    <? $body = ob_get_clean(); ?>

### /[pihpe]/paths.php
In **paths.php**, I map resources and paths to unique names:

    $paths = [
        'info'    => '/info.php',
        'header'  => '/_php/header.php',
        'layout'  => '/_php/layout.php',
        'favicon' => '/_images/favicon.png'
    ];

*'How to choose a good resource name' could be a perfect name for a section. These paths can now be included anywhere using:*

    <link rel="icon" href="<?= url('favicon'); ?>">

### index.php
Creating pages is a matter of choosing which sections to use in what order, and the layout to use for rendering:

    parse([
        'header',
        'info'
    ]);

    include($root . url('layout'));

### layout.php
Design flexibility was one reason for creating PiHPe. I like to create layouts, and piece together my pages.

        <style>
           h1 { color: LightGreen; }
        </style>
        <? insert($style); ?>
    </head>
    <body>
    <main>
        <? insert($body); ?>
    </main>

### /[pihpe]/build.php
For GitHub I also needed a added static build facility. A visit to **/[pihpe]/build.php** will save HTML for those files specified:

    build([
        '/index.php'
    ]);

*A pattern-based copy to isolate static files is already on my todo list ;-)*

## Next
- Improve the build mechanism.
- Create a simple template facility.
- Add file-relative linking.