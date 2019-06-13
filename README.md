# Workspace

## Cơ bản

### Policy
Policy là nơi để định nghĩa quyền cho 1 model nhất định theo các hành động cơ bản:  `viewAny, view, create, update, delete, restore, forceDelete`
- Tạo 1 policy
```bash
php artisan make:policy PostPolicy --model=Post
```

- Đăng ký trong `AuthServiceProvider`
```php
   protected $policies = [
        Post::class => PostPolicy::class,
    ];
```

### Gate
Gate (cổng) là nơi định nghĩa ra 1 quyền để sử dụng ở nhiều nơi. Ví dụ bạn có 2 quyền là: `isAdmin` và `isMember` 
```php
Gate::define('isAdmin', function(Admin $admin){
    return (int)$admin->role === Admin::ROLE_ADMIN;
});

Gate::define('isMember', function(Admin $admin){
    return (int)$admin->role === Admin::ROLE_MEMBER;
});
```
## Chi tiết
