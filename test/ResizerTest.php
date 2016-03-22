<?php

include 'Resizer.php';
include 'imagePath.php';
include 'configuration.php';

class ResizerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testNecessaryCollaboration(){
        $resizer = new Resizer('anyNonPathObject');

    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testOptionalCollaboration(){
        $resizer = new Resizer(new ImagePath(''), 'nonConfigurationObject');

    }

    public function testInstantiation(){
        $this->assertInstanceOf('Resizer', new Resizer(new ImagePath(''), new Configuration()));
        $this->assertInstanceOf('Resizer', new Resizer(new ImagePath('')));
    }

    public function testObtainLocallyCachedFilePath(){
        $resizer = new Resizer(new ImagePath('https://pbs.twimg.com/profile_images/79787739/mf-tg-sq_400x400.jpg?query=hello&s=fowler'));

        $stub = $this->getMockBuilder('FileSystem')
                ->getMock();
        $stub->method('file_get_contents')
            ->willReturn('foo');

        $resizer->injectFileSystem($stub);

        $this->assertEquals('./cache/remote/mf-tg-sq_400x400.jpg', $resizer->obtainFilePath());
    }
}
