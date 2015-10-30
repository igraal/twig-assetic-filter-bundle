<?php

/**
 * Copyright (c) 2012 iGraal
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace IgraalOSB\TwigAsseticFilterBundle\Twig\Filter;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;
use Assetic\Filter\HashableInterface;

class TwigFilter implements FilterInterface, HashableInterface
{
    private $twig;
    private $loader;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function filterLoad(AssetInterface $asset)
    {
        $loader = new \Twig_Loader_String();
        $this->loader = $loader;
    }

    public function filterDump(AssetInterface $asset)
    {
        $defaultLoader = $this->twig->getLoader();
        $this->twig->setLoader($this->loader);

        $asset->setContent($this->twig->render($asset->getContent()));

        $this->twig->setLoader($defaultLoader);
    }
    
    public function hash()
    {
        return 'IgraalOSB\TwigAsseticFilterBundle\Twig\Filter\TwigFilter';
    }

}
