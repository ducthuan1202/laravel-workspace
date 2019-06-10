<?php

if (!function_exists('get_admin_prefix_url')) {

    /**
     * tiền tố link của url admin
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_admin_prefix_url()
    {
        return 'admin';
    }
}

if (!function_exists('get_admin_prefix_name')) {

    /**
     * tiền tố tên của route admin
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_admin_prefix_name()
    {
        return 'backend';
    }
}

if (!function_exists('get_admin_view_folder')) {

    /**
     * tên thư mục
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    function get_admin_view_folder()
    {
        return 'backend';
    }
}


if (!function_exists('admin_route')) {

    /**
     * get route administrator
     *
     * @param $name
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    function admin_route($name, $parameters = [], $absolute = true)
    {
        return route(get_admin_prefix_name() . '.' . $name, $parameters, $absolute);
    }
}

if (!function_exists('admin_request_is')) {

    /**
     * check request to administrator
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
     * get path of backend assets
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
