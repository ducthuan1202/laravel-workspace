<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $data
 */
?>

<div class="text-center text-secondary">
{{--    {{ sprintf('Hiển thị bản ghi từ %s tới %s trên tổng số %s',$data->firstItem(), $data->lastItem(), $data->lastotalItem()) }}--}}
</div>

@if($data->hasPages())
    <div role="pagination" class="text-center">
        @php($params = (isset($params) && is_array($params)) ? $params : [])
        {{ $data->appends($params)->links() }}
    </div>

@endif
