#LinkTo Grav Plugin

The **LinkTo** plugin for Grav is an extension to twig. This extension contains a filter and a function used to convert a given set of variables and options to some html link tags.

## Usage

### Create a link with a page object

If nothing else than a page object is passed, the url and the content will default to it's *url* and *menu* properties.

```twig
{{ pages.find('/home')|link_to }}
{# or #}
{{ link_to(pages.find('/home')) }}

{# outputs '<a href="/">Home</a>' #}
```

### Adding some options

It is possible to configure the link that will be displayed by passing an array of [options](#options) to the filter.

```twig
{{ pages.find('/home')|link_to({'class': 'some-class'}) }}
{# or #}
{{ link_to(pages.find('/home'), {'class': 'some-class'}) }}

{# outputs '<a href="/" class="some-class">Home</a>' #}
```

### Using a string as content

A string can be passed to the link_to filter. This will be used as the link's body. If no [options](#options) are passed to the link, the link will have no href and can be used as a [placeholder hyperlink](https://www.w3.org/TR/html-markup/a.html#placeholder-hyperlink)

```twig
{{ 'Some External Page'|link_to({'class': 'some-class', href="http://example.com/"}) }}
{# or #}
{{ link_to('Some External Page', {'class': 'some-class', href="http://example.com/"}) }}

{# outputs '<a href="http://example.com/" class="some-class">Some External Page</a>' #}
```


### Creating a link from array

It is also possible to create a link only from an array of option. If a second array of [options](#options) is passed, the [options](#options) contained in this second array will override [options](#options) from the first array.

```twig
{{ {'page': pages.find('/home'), 'class': 'some-class'}|link_to }}
{# or #}
{{ link_to({'page': pages.find('/home'), 'class': 'some-class'}) }}

{# outputs '<a href="/" class="some-class">Home</a>' #}
```

### Using a block as content

The [filter](http://twig.sensiolabs.org/doc/tags/filter.html) section can be used to pass a block of content as the body of the link.

```twig
{% filter link_to({'class': 'some-class', href="http://example.com/image.jpg"}) %}
  <img src="http://example.com/thumbnail.jpg" width="100" height="100" alt="Sample image">
{% endfilter %}

{# outputs '<a href="http://example.com/image.jpg" class="some-class"><img src="http://example.com/img.jpg" width="100" height="100" alt="Sample image"></a>' #}
```

## Options

Options are used to configure the html link tag that will be outputted.

Valid options are:
* **page**: Page object passed to set default link and content.
* **content**: Html string that will be inserted as content into the link. When specified, it will overwrite any content retrieved from a page object.

Any other attributes passed to the option array will be added to the html link tag.

```twig
{{ {'href': '/lorem-ipsum', 'data-lorem-ipsum': 'dolor-sit-amet', 'content': 'Lorem Ipsum'}|link_to }}

{# outputs '<a href="/lorem-ipsum" data-lorem-ipsum="dolor-sit-amet">Lorem Ipsum</a>' #}
```
