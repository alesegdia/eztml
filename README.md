# eztml

## Why?

When writing slides using `reveal.js`, I found some issues trying to use CSS classes, so
thought on making this little project for fun and (very little) profit. I know there are tools like
zen coding, and it works great in vim, but this was a small and funny project.

Enclosing syntax is based on django templates, and personally, I found it more readable than a lot of
html tags.

## Requirements

PHP-cli 5.2+ or less with json support.

## Usage

You can use this script to avoid opening and closing html tags. There is a `eztml_config.json` file where you can
set options pre-wrap and post-wrap text. Check `eztml_config.json` to easily see how it works.

It is intended to be used with `stdin`, so an example that you can run:

```
cat test.html | php eztml.php > test_out.html
```

This way and with the example `eztml_config.json`, you will turn this...

```
<p>This is {(b) a test {(i)to show} how this little }and dummy script works</p>
<p>Another paragraph {(tt,h1) to show {(i,b)that it really} }works</p>
```

... into this ...

```
<p>This is <b> a test <i>to show</i> how this little </b>and dummy script works</p>
<p>Another paragraph <h1><pre> to show <b><i>that it really</i></b> </pre></h1>works</p>
```

and that's it.
