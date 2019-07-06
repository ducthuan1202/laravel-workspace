<?php

if (!function_exists('get_admin_prefix_url')) {

    /**
     * Hàm trả về tiền tố URL trong backend
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_admin_prefix_url()
    {
        return config('custom.backend.prefix_url', 'admin');
    }
}

if (!function_exists('get_admin_prefix_name')) {

    /**
     * Hàm trả về tên tiền tố đặt tên cho route trong backend
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_admin_prefix_name()
    {
        return config('custom.backend.prefix_router_name', 'backend');
    }
}

if (!function_exists('get_admin_view_folder')) {

    /**
     * Hàm trả về tên thư mục chứa tài nguyên sử dụng trong backend
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_admin_view_folder()
    {
        return config('custom.backend.folder');
    }
}


if (!function_exists('admin_route')) {

    /**
     * Hàm trả về URL của router backend
     *
     * @param $name
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    function admin_route($name, $parameters = [], $absolute = true)
    {
        return route(get_admin_prefix_name() . $name, $parameters, $absolute);
    }
}

if (!function_exists('admin_request_is')) {

    /**
     * Hàm check link backend
     *
     * @param $name
     * @return bool
     */
    function admin_request_is($name)
    {
        return request()->is(get_admin_prefix_url() . '/' . $name);
    }
}

if (!function_exists('admin_asset')) {

    /**
     * Hàm trả về đường dẫn liên kết tới tài nguyên trong backend
     *
     * @param $path
     * @param null $secure
     * @return string
     */
    function admin_asset($path, $secure = null)
    {
        return asset(get_admin_view_folder() . '/' . $path, $secure);
    }
}
