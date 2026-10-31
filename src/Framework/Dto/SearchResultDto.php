<?php

namespace Micronomics\Passport\Framework\Dto;

class SearchResultDto
{
    public const int DEFAULT_PAGE_SIZE = 25;

    protected(set) int $page = 1;
    protected(set) int $pageSize = self::DEFAULT_PAGE_SIZE;
    protected(set) int $totalCount;
    protected(set) array $items = [];

    public function setPage(int $page): SearchResultDto
    {
        $this->page = $page;
        return $this;
    }

    public function setPageSize(int $pageSize): SearchResultDto
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function setTotalCount(int $totalCount): SearchResultDto
    {
        $this->totalCount = $totalCount;
        return $this;
    }

    public function setItems(array $items): SearchResultDto
    {
        $this->items = $items;
        return $this;
    }
}
