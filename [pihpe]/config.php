<?
   /* -------------------------------------------------------------------------
      PiHPe settings.
   */

   return [
      /*
         Defines the link format returned by url(). When you're linking from
         /index.html to /_css/style.css, then in order of recommendation:

            #  method           returns
            1. 'file-relative'  ../_css/style.css
            2. 'root-relative'  /_css/style.css
            3. 'absolute'       http://www.site.com/_css/style.css

         TIP: use the first setting, unless you know what you're doing.
      */
      'urls' => 'file-relative',


      /*
         A base URL that may be inserted into pages. Note that this will have
         an effect on the link format used.
         (see [pihpe]/exmaples/layout.php)
      */
      'base' => ''
   ];
?>

