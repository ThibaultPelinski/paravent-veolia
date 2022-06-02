<?php

namespace Terre;

use Thibault\ParaventVeolia\Terre\Terre;
use PHPUnit\Framework\TestCase;

class TerreTest extends TestCase
{

    //Largeur / with

    public function testSmallWidth()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('La largeur ne peut pas etre inferieure 1 ; "0" donne');

        new Terre(0, '1');
    }

    public function testLargeWidth()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('La largeur ne peut pas etre plus grand que 100000 ; "100001" donne');

        new Terre(100001, '1');
    }

    // Hauteur / height

    public function testInvalidHeight()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Hauteur invalide ; "foobar" donne');

        new Terre(1, 'foobar');
    }

    public function testNegativeHeight()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('La hauteur ne peut pas etre inferieure à 0 ; "-1" donne');

        new Terre(1, '-1');
    }

    public function testLargeHeight()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('La hauteur ne peut pas etre plus grand que 100000 ; "100001" donne');

        new Terre(1, '100001');
    }

    // Terrain

    public function testInvalidTerrain()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->expectExceptionMessage('Le terrain ne peut pas être plus large que la terre');

        new Terre(1, '1 2');
    }

    //Safe zone

    public function testGetSafeZone()
    {
        $terre = new Terre(10, '30 27 17 42 29 12 14 41 42 42');

        $this->assertEquals(88, $terre ->getSafeZone());
    }
}