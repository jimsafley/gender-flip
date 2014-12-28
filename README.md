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

You can even add your own flips (i.e. find and replace):

```php
require_once 'GenderFlip.php';
$text = file_get_contents('/path/to/text.txt');
$genderFlip = new GenderFlip($text);
$genderFlip->addFlip('Elizabeth', 'John');
$genderFlip->addFlip('Jane', 'Paul');
$genderFlip->addFlip('Mary', 'George');
$genderFlip->addFlip('Kitty', 'Ringo');
$genderFlip->addFlip('Lydia', 'Pete');
echo $genderFlip->flip();
```
