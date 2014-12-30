# GenderFlip

Accepts any text and returns it [gender flipped](http://tvtropes.org/pmwiki/pmwiki.php/Main/GenderFlip). For example:

> It is a truth universally acknowledged, that a single man in possession of a good fortune, must be in want of a wife.

flips to:

> It is a truth universally acknowledged, that a single woman in possession of a good fortune, must be in want of a husband.

Using GenderFlip is easy. Just copy this repository to your web server and navigate to index.php. This will display a simple form that allows you to gender flip any web page. We also include several example texts from [Project Gutenberg](https://www.gutenberg.org/). 

Custom implementation is not required, but is also easy:

```php
require_once 'GenderFlip.php';
$text = file_get_contents('/path/to/text.txt');
$genderFlip = new GenderFlip($text);
echo $genderFlip->flip();
```

You can even add your own flips:

```php
require_once 'GenderFlip.php';
$text = file_get_contents('/path/to/text.txt');
$genderFlip = new GenderFlip($text);
// Flips match an exact word in both cases.
$genderFlip->addFlip('handsome', 'pretty');
// Pattern flips use regular expressions to match a word.
$genderFlip->addPatternFlip('/\bLizzy\b/', 'John');
$genderFlip->addPatternFlip('/\bJane\b/', 'Paul');
$genderFlip->addPatternFlip('/\bLydia\b/', 'Ringo');
echo $genderFlip->flip();
```

> "I desire you will do no such thing. John is not a bit better than the others; and I am sure he is not half so pretty as Paul, nor half so good-humoured as Ringo. But you are always giving his the preference."

Gender flipping is not an exact science. There are semantic inconsistencies (her/his, hers/his), as well as ambiguous cases (Lady/Sir, lady/gentleman). This tool does not attempt to flip gendered adjectives (pretty/handsome, womanly/manly) or gendered names (Jill/Jack, Marsha/John). Use the `addFlip()` or `addPatternFlip()` method to customize what words are flipped.
