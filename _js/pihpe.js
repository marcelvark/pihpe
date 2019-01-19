/*
   Indicates whether the site is being served as static HTML.
*/
const PiHPe = {
   static: (Date.now() - <?= time() * 1000; ?> > 30000) // after 30s
}