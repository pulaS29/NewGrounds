<?php

namespace App\Service;

use Michelf\MarkdownInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkdownHelper
{
    public function parse(string $source, AdapterInterface $cache, MarkdownInterface $markdown): string
    {

        //adding an item to cache memory. Not neccessarily storing it in cache
        $item = $cache->getItem('markdown_'.md5($source));
        //Check if item is in memory?
        if(!$item->isHit()){
            $item->set($markdown->transform($source));
            $cache->save($item);
        }
        return $item->get();
    }
}