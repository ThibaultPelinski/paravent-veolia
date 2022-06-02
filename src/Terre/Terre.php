<?php

namespace Thibault\ParaventVeolia\Terre;

class Terre
{
    public const DEFAULT_MIN_WIDTH = 1;
    public const DEFAULT_MAX_WIDTH = 100000;
    public const DEFAULT_MIN_HEIGHT = 0;
    public const DEFAULT_MAX_HEIGHT = 100000;

    /**
     * @var int largeur de la terre
     */
    private int $width;

    /**
     * @var array Tableau hauteur de terrain
     */
    private array $terrain;


    public function __construct(int $width, string $terrain)
    {
        $this->setWidth($width);
        $this->setTerrain($terrain);
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        if ($width < 1) {
            throw new \InvalidArgumentException(
                sprintf(
                    'La largeur ne peut pas etre inferieure %s ; "%s" donne',
                    self::DEFAULT_MIN_WIDTH,
                    $width
                )
            );
        }


        elseif ($width > 100000) {
            throw new \InvalidArgumentException(
                sprintf(
                    'La largeur ne peut pas etre plus grand que %s ; "%s" donne',
                    self::DEFAULT_MAX_WIDTH,
                    $width
                )
            );
        }

        $this->width = $width;
    }

    /**
     * @param array $terrain
     */
    private function setTerrain(string $terrain): void
    {
        $terrain = explode(' ', $terrain);

        if (\count($terrain) > $this->width) {
            throw new \InvalidArgumentException('Le terrain ne peut pas être plus large que la terre');

        }


//Decimale 
        foreach ($terrain as $height) {
                if (! is_numeric($height)) {
                    throw new \InvalidArgumentException(
                        sprintf(
                            'Hauteur invalide ; "%s" donne',
                            $height
                        )
                    );
                }
                elseif ($height < 0) {
                    throw new \InvalidArgumentException(
                        sprintf(
                            'La hauteur ne peut pas etre inferieure à %s ; "%s" donne',
                            self::DEFAULT_MIN_HEIGHT,
                            $height
                        )
                    );
                }

                elseif ($height > 100000) {
                    throw new \InvalidArgumentException(
                        sprintf(
                            'La hauteur ne peut pas etre plus grand que %s ; "%s" donne',
                            self::DEFAULT_MAX_HEIGHT,
                            $height
                        )
                    );
                }
            }

            $this->terrain = $terrain;
        }

    /**
     * Nous calculons la zone de sécurité pour le prolosaure
     *
     * @return int
     */
    public function getSafeZone(): int
    {
        $zone = 0;
        $highest = 0;

        for ($i = 0; $i < $this->width; ++$i) {

            $height = $this->terrain[$i] ?? 0;

            if ($height > $highest) {

                $highest = $height;
            } else {

                $zone += $highest - $height;
            }
        }

        return $zone;
    }
}