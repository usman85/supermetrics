<?php

namespace Statistics\Calculator;

use SocialPost\Dto\SocialPostTo;
use Statistics\Dto\StatisticsTo;

/**
 * Class Calculator
 *
 * @package Statistics\Calculator
 */
class AveragePostPerUser extends AbstractCalculator
{

    protected const UNITS = 'posts';

    /**
     * @var int
     */
    private $postCount = 0;

    /**
     * @var array
     */
    private $users = [];

    /**
     * @param SocialPostTo $postTo
     */
    protected function doAccumulate(SocialPostTo $postTo): void
    {
        $key = $postTo->getAuthorId();
        $this->users[$key] = $postTo->getAuthorName();
        $this->postCount++;
    }

    /**
     * @return StatisticsTo
     */
    protected function doCalculate(): StatisticsTo
    {
        $userCount = !empty($this->users) ? count($this->users) : 0;
        $value = $userCount > 0
            ? $this->postCount / $userCount
            : 0;        
        return (new StatisticsTo())->setValue(round($value,2));
    }
}
