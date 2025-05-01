<?php
namespace App\Core;

class Paginator
{
    public $totalItems;
    public $itemsPerPage;
    public $currentPage;
    public $totalPages;
    public $visiblePages;

    public function __construct($totalItems, $itemsPerPage , $currentPage = 1, $visiblePages )
    {
        $this->totalItems = (int) $totalItems;
        $this->itemsPerPage = (int) $itemsPerPage;
        $this->currentPage = (int) $currentPage;
        $this->visiblePages = (int) $visiblePages;
        $this->totalPages = (int) ceil($this->totalItems / $this->itemsPerPage);
    }

    public function render($baseUrl = '?page=')
    {
        if ($this->totalPages <= 1) return '';

        $half = (int) floor($this->visiblePages / 2);
        $startPage = max(1, $this->currentPage - $half);
        $endPage = min($this->totalPages, $startPage + $this->visiblePages - 1);

        if ($endPage - $startPage + 1 < $this->visiblePages) {
            $startPage = max(1, $endPage - $this->visiblePages + 1);
        }

        $html = '<ul class="pagination">';

        if ($this->currentPage > 1) {
            $html .= '<li><a href="' . $baseUrl . ($this->currentPage - 1) . '">Previous</a></li>';
        }

        for ($i = $startPage; $i <= $endPage; $i++) {
            $active = ($i == $this->currentPage) ? 'class="active"' : '';
            $pageNum = (int) $i;
            $html .= '<li ' . $active . '><a href="' . $baseUrl . $pageNum . '">' . $pageNum . '</a></li>';
        }

        if ($this->currentPage < $this->totalPages) {
            $html .= '<li><a href="' . $baseUrl . ($this->currentPage + 1) . '">Next</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }
}
?>
