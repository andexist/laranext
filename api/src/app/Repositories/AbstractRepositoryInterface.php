<?php

namespace App\Repositories;

interface AbstractRepositoryInterface
{
    public function findById(int $id);
    public function findAll();
}
