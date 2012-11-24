SimpleWeb
===============

Simple Web based on Smarty template engine and Nette framework libraries.

Requirements
------------
PHP >= 5.3.0

Installation
------------

1. Copy repository to your hosting.

2. Edit language settings in /app/config/config.php file.

3. Edit website URL in .htaccess file.

4. For every page you want, create one PHP file in /app/{lang}/ directory and one TPL file to /app/{lang}/templates/ directory, where {lang} is shortcut for language corresponding languages setting in config.php. In PHP files do whatever you want. To access variables in templates use: $smarty->assign("variable", $variable);

5. Example of gallery is placed in /app/cz/gallery.php and /app/cz/templates/gallery.tpl
