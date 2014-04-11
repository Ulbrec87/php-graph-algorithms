<?php

namespace graph;

/**
 * @author Ulbrec
 * Graph (Graph)
 */
class Graph {

  private $id;
  private $nonDirected;
  private $nodes;

  public function __construct($nonDirected = true) {
    if (gettype($nonDirected) != "boolean") {
      $nonDirected = false;
    }
    $this->nonDirected = $nonDirected;
    $this->nodes = array();
    $this->id = rand();
  }

  public function addNode(Node $node) {
    $node->setId($this->getLastId() + 1);
    $node->setGraphId($this->id);
    $node->setGraphIsNonDirected($this->nonDirected);
    $this->nodes[] = $node;
  }

  public function getNodes() {
    return $this->nodes;
  }

  /**
   * Ritorna il massimo id contenuto nel grafo
   * @return integer
   */
  protected function getLastId() {
    $max_id = 0;
    foreach ($this->nodes as $node) {
      if ($max_id < $node->getId()) {
        $max_id = $node->getId();
      }
    }
    return $max_id;
  }

}
