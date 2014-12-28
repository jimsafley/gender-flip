# GenderFlip

Accepts any text and returns it [gender flipped](http://tvtropes.org/pmwiki/pmwiki.php/Main/GenderFlip). For example:

> It is a truth universally acknowledged, that a single man in possession of a good fortune, must be in want of a wife.

flips to:

> It is a truth universally acknowledged, that a single woman in possession of a good fortune, must be in want of a husband.

Implementation is easy:

```php
require_once 'GenderFlip.php';
$text = file_get_contents('/path/to/text.txt');
$genderFlip = new GenderFlip($text);
echo $genderFlip->flip();
```
