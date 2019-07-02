<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $data
 */
$params = (isset($params) && is_array($params)) ? $params : [];
?>
@if($data->hasPages())

    <hr class="mb-4">

    <div role="pagination" class="text-center">{{ $data->appends($params)->onEachSide(1)->links() }}</div>
@endif
