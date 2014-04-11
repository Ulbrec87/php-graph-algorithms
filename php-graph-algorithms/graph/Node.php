<?php

namespace graph;

/**
 * @author Ulbrec
 * Node (Graph)
 */
class Node {

  private $id;

  /**
   *
   */
  private $data;
  private $adjacentList;
  private $graphId;
  private $graphIsNonDirected;

  public function __construct($data = null) {
    $this->id = -1;
    $this->data = $data;
    $this->graphId = false;
    $this->adjacentList = array();
    $this->graphIsNonDirected = null;
  }

  public function getData() {
    return $this->data;
  }

  public function getAdjacentList() {
    return $this->adjacentList;
  }

  public function getId() {
    return $this->id;
  }

  public function setGraphId($graphId) {
    $this->graphId = $graphId;
  }

  public function setGraphIsNonDirected($nonDirected) {
    $this->graphIsNonDirected = $nonDirected;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function adjacentTo(Node $node) {
    if (!$this->graphId) {
      return false;
    } else {
      $this->adjacentList[] = $node;
      if ($this->graphIsNonDirected) {
        $node->adjacentList[] = $this;
      }
    }
  }

}
