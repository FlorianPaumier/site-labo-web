const hljs = require('highlight.js/lib/highlight');
const php = require('highlight.js/lib/languages/php');
const twig = require('highlight.js/lib/languages/twig');

hljs.registerLanguage('php', php);
hljs.registerLanguage('twig', twig);

hljs.initHighlightingOnLoad();
