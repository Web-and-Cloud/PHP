<?php

//tehdään uudelleen ohjaus
function redirect($page)
{
  header("Location: ". URLROOT . "/{$page}");
}