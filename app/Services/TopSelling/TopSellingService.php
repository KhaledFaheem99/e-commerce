<?php

namespace App\Services\TopSelling;

use App\Http\Controllers\Controller;
use App\Repositories\TopSelling\TopSellingRepository;

class TopSellingService extends Controller {
    protected $repositoryTopSelling;
    public function __construct(TopSellingRepository $repositoryTopSelling) {
        return $this->repositoryTopSelling = $repositoryTopSelling;
    }
    public function getTopSelling () {
        return $this->repositoryTopSelling->getTopSelling();
    }
}