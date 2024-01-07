<?php
 
class Person
{
    public string $first_name;
    // sexe : masculin => true, féminin => false
    public bool $genre;
 
    public function __construct($first_name, $genre)
    {
        $this->first_name = $first_name;
        $this->genre = $genre;
    }
}
 
