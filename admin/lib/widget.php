<?php

  /**
   * This intarface is for the widget classes, to ensure they
   * all have the same callable functions.
   */
  interface Widget
  {
    public function onRegister($widget);
    public function onLoad();
    public function loadDatabase();
  }
