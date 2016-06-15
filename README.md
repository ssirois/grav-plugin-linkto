#LinkTo Grav Plugin

The **LinkTo** plugin for Grav is an extention to twig. This extention contains a filter and a function used to convert a given set of variables and options to some html link tags.

## Usage

### Create a link with a page object
```twig
{{ pages.find('/home')|link_to }}
{# or #}
{{ link_to(pages.find('/home')) }}

{# <a href="{{page.link}}">{{page.menu}}</a> #}
```

### Adding some options
```twig
{{ pages.find('/home')|link_to({'class': 'fancy-class'}) }}
{# or #}
{{ link_to(pages.find('/home'), {'class': 'fancy-class'}) }}

{# <a href="{{page.link}}" class="fancy-class">{{page.menu}}</a> #}
```

### Using a string as content
```twig
{{ 'I am Link!'|link_to({'class': 'epic-class', href="link_s_page.html"}) }}
{# or #}
{{ link_to('I am Link!', {'class': 'epic-class', href="link_s_page.html"}) }}

{# <a href="link_s_page.html" class="epic-class">I am Link!</a> #}
```

### Using a block as content
```twig
{% filter|link_to({'class': 'special-class', href="link_s_page.html"}) %}
  <img src="example.com/img.jpg" width="100" height="100" alt="Sample image">
{% endfilter %}

{# <a href="link_s_page.html" class="special-class"><img src="example.com/img.jpg" width="100" height="100" alt="Special image"></a> #}
```

### Creating a link from array
```twig
{{ {'page': pages.find('/home'), 'class': 'funny-class'}|link_to }
{# or #}
{{ link_to({'page': pages.find('/home'), 'class': 'funny-class'}) }}

{# <a href="{{page.link}}" class="funny-class">{{page.menu}}</a> #}
```
