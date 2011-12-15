PageDocSite: A very simple PHP and markdown publishing system
==================================================

I made this simple publishing system to run my personal website and as a bit of an experiment in coding a minimal site management system.  I needed an escape from the complexity of my day job and the bloat and overhead of custom Drupal module development. 

This little engine parses content from [markdown syntax text files](http://daringfireball.net/projects/markdown/syntax), processes them and displays them through a template. For parsing the markdown, it uses [Michel Fortin's PHP Markdown](http://michelf.com/projects/php-markdown/). That's the only dependency. The rest is my custom code. 

That's about it. I added some ability to embed partials within pages, and for a PHP override to the markdown content page where you can apply custom templates. It's deliberately simple and not intended to be an all singing, all dancing, all formats CMS. I wanted the flexibility to add things in a raw and light way. 

Check the code, it's fairly simple and self-explanatory. 

What it does do:
----------------
- URL path is used to route requests to content files in the  __./pages__ directory. 
- supports content _sub directories_ and _sub directory pages_ 
- index.php or index.md files are the default file for a directory
- check the .htaccess file for the rewrite rules. Trailing slashes are always added. Existing files are left. System files are protected. 
- .php content files take priority of same-named .md files
- serves a 404 if the content page can't be found
- allows metadata (Author, Date, Description, Keywords and Title) at the top of the markdown. Follows the [multimarkdown syntax guide for adding metadata to markdown](https://github.com/fletcher/MultiMarkdown/wiki/MultiMarkdown-Syntax-Guide). Metadata is available to the template. 
- the default page template (for the page structure) is  __./templates/page.php__ 
- the default content template is displayed via __./templates/article.php__  
- here is a [custom PHP page](custom) (__./pages/custom.php__)that overrides the markdown and template system and includes some partials and a custom content template. 
- a CSS class name matching the page is added to the body to allow custom styles for pages of content


What it doesn't do:
----------------
 - currently no support for generating navigation automatically. Best to put this in the template. 
 - doesn't do much in the way of error capturing. Check your code.
 - no modular blocks of embedded functionality. Some of your own PHP will help you here. 
 - no search, categorisation, taxonomy or any of that good stuff. 
 - no default style or javascript. I'll leave it up to you to add your own. 
 - no media management or image thumbnail generation
 - no caching.


Be warned, this is not meant to support large and scalable websites - and comes with no guarantees. It is an experiment in code, and serves my purposes fine. YOu may be able to use it for something. Feel free. Read the license. 

Requires PHP5 and Apache with mod_rewrite enabled.