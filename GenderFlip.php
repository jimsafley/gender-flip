<?php
/**
 * Flip the genders of some text.
 */
class GenderFlip
{
    /**
     * Map for simple gender-flips.
     *
     * @var array
     */
    protected $flips = [
        // lower case
        'he' => 'she',
        'she' => 'he',
        'him' => 'her',
        'her' => 'him',
        'his' => 'her',
        'her' => 'his',
        'man' => 'woman',
        'woman' => 'man',
        'husband' => 'wife',
        'wife' => 'husband',
        'mom' => 'dad',
        'dad' => 'mom',
        'mother' => 'father',
        'mothers' => 'fathers',
        'father' => 'mother',
        'fathers' => 'mothers',
        'daughter' => 'son',
        'daughters' => 'sons',
        'son' => 'daughter',
        'sons' => 'daughters',
        'girl' => 'boy',
        'girls' => 'boys',
        'boy' => 'girl',
        'boys' => 'girls',
        'sister' => 'brother',
        'sisters' => 'brothers',
        'brother' => 'sister',
        'brothers' => 'sisters',
        'men' => 'women',
        'women' => 'men',
        'herself' => 'himself',
        'himself' => 'herself',
        'mamma' => 'papa',
        'papa' => 'mamma',
        'niece' => 'nephew',
        'nephew' => 'niece',
        'nieces' => 'nephews',
        'nephews' => 'nieces',
        'lady' => 'gentleman',
        'ladies' => 'gentlemen',
        'gentleman' => 'lady',
        'gentlemen' => 'ladies',
        // upper case
        'He' => 'She',
        'She' => 'He',
        'Him' => 'Her',
        'Her' => 'Him',
        'His' => 'Her',
        'Her' => 'His',
        'Man' => 'Woman',
        'Woman' => 'Man',
        'Husband' => 'Wife',
        'Wife' => 'Husband',
        'Mom' => 'Dad',
        'Dad' => 'Mom',
        'Mother' => 'Father',
        'Mothers' => 'Fathers',
        'Father' => 'Mother',
        'Fathers' => 'Mothers',
        'Daughter' => 'Son',
        'Daughters' => 'Sons',
        'Son' => 'Daughter',
        'Sons' => 'Daughters',
        'Girl' => 'Boy',
        'Girls' => 'Boys',
        'Boy' => 'Girl',
        'Boys' => 'Girls',
        'Sister' => 'Brother',
        'Sisters' => 'Brothers',
        'Brother' => 'Sister',
        'Brothers' => 'Sisters',
        'Men' => 'Women',
        'Women' => 'Men',
        'Herself' => 'Himself',
        'Himself' => 'Herself',
        'Mamma' => 'Papa',
        'Papa' => 'Mamma',
        'Niece' => 'Nephew',
        'Nephew' => 'Niece',
        'Nieces' => 'Nephews',
        'Nephews' => 'Nieces',
        'Lady' => 'Gentleman',
        'Ladies' => 'Gentlemen',
        'Gentleman' => 'Lady',
        'Gentlemen' => 'Ladies',
    ];

    /**
     * Map for pattern-based gender-flips.
     *
     * For special cases that require custom regex patterns.
     *
     * @var array
     */
    protected $patternFlips = [
        '/\bMr\b\./' => 'Ms.',
        '/\bMrs\b\./' => 'Mr.',
        '/\bMiss\b/' => 'Mr.',
        '/\bSir\b/' => 'Lady',
        '/\bLady\b/' => 'Sir',
    ];

    /**
     * Placeholder characters.
     *
     * Used to differentiate words that have been flipped from those that haven't.
     *
     * @var string
     */
    protected $placeholder = '____';

    /**
     * The original, unmodified text passed into the constructor.
     *
     * @var string
     */
    protected $originalText;

    /**
     * Construct this object, setting the original text.
     */
    public function __construct($text)
    {
        $this->originalText = $text;
    }

    /**
     * Flip the genders of the original text.
     *
     * @param string $text
     * @param string
     */
    public function flip()
    {
        $valueFormat = $this->placeholder . '%s' . $this->placeholder;

        $flips = [];
        foreach ($this->flips as $key => $value) {
            $flips["/\b{$key}\b/"] = sprintf($valueFormat, $value);
        }
        foreach ($this->patternFlips as $key => $value) {
            $flips[$key] = sprintf($valueFormat, $value);
        }

        $text = preg_replace(array_keys($flips), array_values($flips), $this->originalText);
        $text = str_replace($this->placeholder, '', $text);

        return $text;
    }

    /**
     * Add a flip to the flip map.
     *
     * @param string $from
     * @param string $to
     */
    public function addFlip($from, $to)
    {
        $this->flips[$from] = $to;
    }

    /**
     * Add a flip to the pattern flip map.
     *
     * @param string $from
     * @param string $to
     */
    public function addPatternFlip($from, $to)
    {
        $this->patternFlips[$from] = $to;
    }
}
