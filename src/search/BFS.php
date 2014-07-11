<?php

/**
 * @author Ulbrec
 */

namespace graph;

class BFS {

  /**
   * @var Graph
   */
  protected $graph = null;
  protected $needle = null;
  protected $nodes = null;
  protected $color = null;

  const VISITED = "BLACK";

  public function __construct(Graph $graph, $data) {
    $this->graph = $graph;
    $this->needle = $data;
  }

  public function BFS() {
    $queue = array();
    $this->nodes = $this->graph->getNodes();
    $queue[] = $this->nodes[0];
    $this->color[$queue[0]->getId()] = BFS::VISITED;
    $i = 0;
    while (count($queue) > 0) {
      $queue = array_values($queue);
      $element = $queue[0];
      unset($queue[0]);
      if ($element->getData() == $this->needle) {
        return $element;
      }
      $adjacentList = $element->getAdjacentList();
      foreach ($adjacentList as $child) {
        if (empty($this->color[$child->getId()])) {
          $this->color[$child->getId()] = BFS::VISITED;
          $queue[] = $child;
        }
      }
    }
    return null;
  }

}
