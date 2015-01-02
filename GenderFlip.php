<?php
/**
 * Flip the genders of some text.
 */
class GenderFlip
{
    /**
     * Map for simple gender flips.
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
        'her' => 'his', // conflict with her/him
        'his' => 'hers', // conflict with his/her
        'her' => 'him', // conflict with her/his
        'his' => 'her', // conflict with his/hers
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
     * Map for pattern-based gender flips.
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
     * The original, unmodified text passed into the constructor.
     *
     * @var string
     */
    protected $originalText;

    /**
     * Construct this object, setting the original text.
     *
     * @param string $text
     */
    public function __construct($text)
    {
        $this->originalText = $text;
    }

    /**
     * Flip the genders of the original text.
     *
     * @return string
     */
    public function flip()
    {
        $findFormat = '/\b%s\b/';
        $replaceFormat = '____%s____';

        // First, regularize the simple flips for processing.
        $flips = [];
        foreach ($this->flips as $find => $replace) {
            $find = strtolower($find);
            $replace = strtolower($replace);
            $flips[$find] = $replace;
            $flips[ucfirst($find)] = ucfirst($replace);
        }

        // Process the pattern flips and simple flips, giving them temporary
        // placeholders and corresponding replacements.
        $i = 0;
        $tempFlips = [];
        $replacements = [];
        foreach ($this->patternFlips as $find => $replace) {
            $tempFlips[$find] = sprintf($replaceFormat, $i);
            $replacements[$i] = $replace;
            $i++;
        }
        foreach ($flips as $find => $replace) {
            $tempFlips[sprintf($findFormat, $find)] = sprintf($replaceFormat, $i);
            $replacements[$i] = $replace;
            $i++;
        }

        // Temporarily replace all gendered words with an indexed placeholder.
        $text = preg_replace(
            array_keys($tempFlips),
            array_values($tempFlips),
            $this->originalText
        );

        // Find all placeholders, replacing them with the corresponding text.
        $text = preg_replace_callback(
            '/\b_{4}(\d+)_{4}\b/',
            function($matches) use ($replacements) {
                return $replacements[$matches[1]];
            },
            $text
        );

        return $text;
    }

    /**
     * Get the original text.
     *
     * @return string
     */
    public function getOriginalText()
    {
        return $this->originalText;
    }

    /**
     * Add a flip to the flip map.
     *
     * @param string $find A word in lowercase
     * @param string $replace
     */
    public function addFlip($find, $replace)
    {
        $this->flips[$find] = $replace;
    }

    /**
     * Add a flip to the pattern flip map.
     *
     * @param string $find A regular expression pattern
     * @param string $replace
     */
    public function addPatternFlip($find, $replace)
    {
        $this->patternFlips[$find] = $replace;
    }
}
