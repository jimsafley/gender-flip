<?php
/**
 * Flip the genders of some text.
 */
class GenderFlip
{
    /**
     * Map for simple gender-flips.
     *
     * All words will be converted to lowercase and then duplicated with the
     * first character uppercased.
     *
     * @var array
     */
    protected $flips = [
        // lower case
        'he' => 'she',
        'she' => 'he',
        'him' => 'her',
        'her' => 'him', // conflict with her/his
        'his' => 'her', // conflict with his/hers
        'her' => 'his', // conflict with her/him
        'his' => 'hers', // conflict with his/her
        'hers' => 'his',
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
        '/\bSir\b/' => 'Madam',
        '/\bSir\b/' => 'Ma\'am',
        '/\bLady\b/' => 'Sir',
        '/\bMadam\b/' => 'Sir',
        '/\bMa\'am\b/' => 'Sir',
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
        $fromFormat = '/\b%s\b/';
        $toFormat = $this->placeholder . '%s' . $this->placeholder;

        $flips = [];
        foreach ($this->flips as $from => $to) {
            $from = strtolower($from);
            $to = strtolower($to);
            $flips[sprintf($fromFormat, $from)] = sprintf($toFormat, $to);
            $flips[sprintf($fromFormat, ucfirst($from))] = sprintf($toFormat, ucfirst($to));
        }
        foreach ($this->patternFlips as $from => $to) {
            $flips[$from] = sprintf($toFormat, $to);
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
