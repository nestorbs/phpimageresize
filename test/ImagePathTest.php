<?php

include 'ImagePath.php';

class ImagePathTest extends PHPUnit_Framework_TestCase
{
    public function testIsSanitizedAtInstantation(){
        $url = 'https://www.google.es/search?q=url+bal&oq=url+bal&aqs=chrome..69i57j69i65j69i60l3j69i59.1529j0j1&sourceid=chrome&ie=UTF-8';
        $expected = 'https://www.google.es/search?q=url bal&oq=url bal&aqs=chrome..69i57j69i65j69i60l3j69i59.1529j0j1&sourceid=chrome&ie=UTF-8';
        $imagePath = new ImagePath($url);

        $this->assertEquals($expected, $imagePath->sanitizedPath());
    }

    public function testIsHttpProtocol(){
        $url = 'https://example.com';

        $imagePath = new ImagePath($url);

        $this->assertTrue($imagePath->isHttpProtocol());

        $imagePath = new ImagePath('ftp://example.com');

        $this->assertFalse($imagePath->isHttpProtocol());

        $imagePath = new ImagePath(null);

        $this->assertFalse($imagePath->isHttpProtocol());
    }

    public function testObtainFilename(){
        $url = 'https://pbs.twimg.com/profile_images/79787739/mf-tg-sq_400x400.jpg?query=hello&s=fowler';

        $imagePath = new ImagePath($url);

        $this->assertEquals('mf-tg-sq_400x400.jpg', $imagePath->obtainFilename());


    }
}
