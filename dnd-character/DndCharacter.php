<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class DndCharacter {

    /**
     * Characters strength attribute.
     */
    public int $strength;

    /**
     * Characters dexterity attribute.
     */
    public int $dexterity;

    /**
     * Characters constitution attribute.
     */
    public int $constitution;

    /**
     * Characters intelligence attribute.
     */
    public int $intelligence;

    /**
     * Characters wisdom attribute.
     */
    public int $wisdom;

    /**
     * Characters charisma attribute.
     */
    public int $charisma;

    /**
     * Characters maximum hitpoints.
     */
    public int $hitpoints;

    public function __construct($strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma) {
        $this->strength = $strength;
        $this->dexterity = $dexterity;
        $this->constitution = $constitution;
        $this->intelligence = $intelligence;
        $this->wisdom = $wisdom;
        $this->charisma = $charisma;

        $this->hitpoints = 10 + self::modifier($constitution);
    }

    /**
     * Get the consitution modifier based on provided constitution.
     *
     * @param constitution
     * @return int
     *
     * Your character's initial hitpoints are 10 + your character's constitution modifier.
     * You find your character's constitution modifier by subtracting 10
     * from your character's constitution, divide by 2 and round down.
     *
     */
    public static function modifier(int $constitution) {
        return (int) floor(($constitution - 10) / 2);
    }

    /**
     * Generate an ability score (randomly) between 3 and 18.
     * @return int
     */
    public static function ability() {
        return random_int(3, 18);
    }

    /**
     * Generate an DnD character with random stats.
     * @return DndCharacter
     */
    public static function generate() {
        $character = new DndCharacter(
            self::ability(),
            self::ability(),
            self::ability(),
            self::ability(),
            self::ability(),
            self::ability());
        return $character;
    }
}

