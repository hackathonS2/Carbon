<?php

namespace App\Data;

class SearchData
{
    /**
     * @var string
     */
    public $search = '';

    /**
     * @var Techno[]
     */
    public $hardSkills = [];

    /**
     * @var User[]
     */
    public $softSkills = [];

    /**
     * @var string
     */
    public $sort = '';
}