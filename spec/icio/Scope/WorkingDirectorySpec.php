<?php

namespace spec\icio\Scope;


use PhpSpec\ObjectBehavior;

class WorkingDirectorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf('icio\Scope\WorkingDirectory');
    }

    function it_should_error_if_unable_to_cd()
    {
        $this->beConstructedWith("some-nonexistant-directory");
        $this->shouldThrow("RuntimeException")->duringEnter();
    }

    function it_should_track_other_cds()
    {
        $parent = dirname(__DIR__);
        $this->beConstructedWith(__DIR__, true);

        $this->setCurrentWorkingDirectory($parent);

        $this->enter();
        chdir($parent);
        $this->leave();

        $this->enter();
        $this->leave();
    }
} 
