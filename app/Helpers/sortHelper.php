<?php

if (!function_exists('sortableTableHeader')) {
    function sortableTableHeader($column, $label)
    {
        $sortBy = request()->get('sort_by');
        $sortOrder = request()->get('sort_order', 'asc');

        $url = route('contacts.index', array_merge(request()->query(), [
            'sort_by' => $column,
            'sort_order' => ($sortBy === $column && $sortOrder === 'asc') ? 'desc' : 'asc'
        ]));

        $icon = ($sortBy === $column) ? ($sortOrder === 'asc' ? '<i class="fas fa-arrow-up"></i>' : '<i class="fas fa-arrow-down"></i>') : '';

        return '<th><a href="' . $url . '">' . $label . $icon . '</a></th>';
    }
}
