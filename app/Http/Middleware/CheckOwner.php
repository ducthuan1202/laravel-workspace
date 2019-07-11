<?php

namespace App\Http\Middleware;

use App\Admin;
use App\Entities\Category;
use Closure;

/**
 * Class CheckOwner
 * @package App\Http\Middleware
 *
 * Middleware này dùng để kiểm tra quyền sở hữu danh mục đối với user đăng nhập.
 */
class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        /** @var Category $category */
        $category = $request->route()->category;

        /** @var Admin $userLogin */
        $userLogin = auth()->user();

        if((int)$category->created_by === (int)$userLogin->id){
            return $next($request);
        }

        abort(403, 'admin nhưng không có nghĩa là được xem thông tin riêng tư của người khác.');

    }
}
