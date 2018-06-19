<?php
namespace App;

class Tree
{
    const NODES_ALPHABET = ['X', 'Y', 'Z'];

    public $nodes;
    public $numLevels;

    public function __construct($numLevels)
    {
        if (!is_int($numLevels) || $numLevels <= 0) {
            throw new \InvalidArgumentException('Argument is not a positive integer');
        }
        $this->numLevels = $numLevels;
        $this->generateNodes($numLevels);
    }

    /**
     * Get node value
     *
     * @param int $level Level number
     * @param int $numDown Node number
     * @return void
     */
    public function index($level, $numDown)
    {
        if (!is_int($level) || $level <= 0) {
            throw new \InvalidArgumentException('Argument is not a positive integer');
        }
        if (!is_int($numDown) || $numDown <= 0) {
            throw new \InvalidArgumentException('Argument is not a positive integer');
        }

        $startLevelIndex = $this->getStartLevelIndex($level);

        if ($numDown > $level) {
            throw new \InvalidArgumentException('Wrong node position');
        }
        if ($level > $this->numLevels) {
            throw new \InvalidArgumentException(
                "Wrong level $level, tree contains only $this->numLevels levels"
            );
        }

        $node = $this->nodes[$startLevelIndex + $numDown];
        if ($node) {
            echo "Level: $level, NodeNumber: $numDown --> $node \n";
        }
    }

    public function draw()
    {
        echo "\n";
        for ($level = 1; $level <= $this->numLevels; $level++) {
            printf('%-5s ', $level);
            $startLevelIndex = $this->getStartLevelIndex($level);
            for ($nodeNum = 1; $nodeNum <= $level; $nodeNum++) {
                echo $this->nodes[$startLevelIndex + $nodeNum] . ' ';
            }
            echo "\n";
        }
        echo "\n";
    }

    /**
     * Formula for calculating total numbers of nodes by level count
     *
     * @param int $n Levels count
     * @return int
     */
    protected function sumOfAllIntegers($n)
    {
        return $n * ($n + 1) / 2;
    }

    /**
     * Calculate start level index in nodes array
     *
     * @param int $level Current level
     * @return int
     */
    protected function getStartLevelIndex($level)
    {
        return $this->sumOfAllIntegers($level) - $level - 1;
    }

    protected function generateNodes($numLevels)
    {
        $nodesCount = $this->sumOfAllIntegers($numLevels);
        for ($i = 0; $i < $nodesCount; $i++) {
            $this->nodes[] = self::NODES_ALPHABET[array_rand(self::NODES_ALPHABET)];
        }
    }
}
