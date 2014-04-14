<?php

namespace search;

use graph\Node;
use graph\Graph;

/**
 * @author Ulbrec
 * DFS (Depth First Search)
 */
class DFS {

  /**
   * @var Graph
   */
  protected $graph = null;
  protected $color = null;
  protected $father = null;
  protected $time = 0;
  protected $nodes = null;
  protected $startTime = null;
  protected $endTime = null;
  protected $path = null;

  /**
   * @var Node
   */
  protected $needle = null;
  protected $haystack = null;

  const NOT_VISITED = "WHITE";
  const SEMI_VISITED = "GREY";
  const VISITED = "BLACK";

  public function __construct(Graph $graph, $data) {
    $this->graph = $graph;
    $this->needle = $data;
    $this->haystack = array();
  }

  protected function initDFS() {
    $this->time = 0;
    $this->color = array();
    $this->startTime = array();
    $this->endTime = array();
    $this->nodes = $this->graph->getNodes();
    $this->path = array();
    foreach ($this->nodes as $node) {
      $this->color[$node->getId()] = DFS::NOT_VISITED;
      $this->father[$node->getId()] = null;
    }
  }

  public function DFS() {
    $this->initDFS();
    foreach ($this->nodes as $node) {
      if ($this->color[$node->getId()] == DFS::NOT_VISITED) {
        $return = $this->DFSVisit($node);
      }
    }
    if (!empty($this->haystack)) {
      $path = array();
      foreach ($this->haystack as $haystack) {
        $this->path = array();
        $path[] = $this->buildPath($haystack);
      }
      return $path;
    }
    return false;
  }

  protected function DFSVisit(Node $u) {
    $this->color[$u->getId()] = DFS::SEMI_VISITED;
    $this->startTime[$u->getId()] = $this->time = $this->time + 1;
    if ($u->getData() === $this->needle) {
      $this->haystack[] = $u;
    }
    $adjacentList = $u->getAdjacentList();
    foreach ($adjacentList as $node) {
      if ($this->color[$node->getId()] == DFS::NOT_VISITED) {
        $this->father[$node->getId()] = $u;
        $this->DFSVisit($node);
      }
    }
    $this->color[$u->getId()] = DFS::VISITED;
    $this->endTime[$u->getId()] = $this->time = $this->time + 1;
  }

  protected function buildPath(Node $v, $path = false) {
    $path[] = $v;
    if (!empty($this->father[$v->getId()])) {
      return $this->buildPath($this->father[$v->getId()], $path);
    } else {
      return array_reverse($path);
    }
  }

}
