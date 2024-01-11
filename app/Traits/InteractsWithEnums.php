<?php
namespace App\Traits;

trait InteractsWithEnums
{
    /**
     * Returns enum values as an array.
     * 
     * @return array
     */
    public static function values(): array
    {
        foreach (self::cases() as $enum) {
            $values[] = $enum->value ?? $enum->name;
        }

        return $values;
    }

    /**
     * Returns enum values as a list.
     * 
     * @param string $separator
     * @return string
     */
    public static function list(string $separator = ','): string
    {
        return implode($separator, self::values());
    }

    /**
     * Get all name, color and value
     * 
     * @return array
     */
    public function getAll()
    {
        return [
            'name' => $this->getName(),
            'color' => $this->getColor(),
            'value' => $this->value
        ];
    }
}
