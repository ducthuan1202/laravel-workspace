# Workspace
- [helpers laravel](https://laravel.com/docs/5.8/helpers)
- [faker](https://github.com/fzaninotto/Faker)

## Cơ bản
- Các event trong `Observer` sẽ thực hiện các hành động trước và sau khi `created`, `update`, `delete`
- Các scope global sẽ tự động được gán vào query thuộc model.

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
- Thêm 1 items vào mảng
```php
    $data = [
        2 => 'create',
        1 => 'update',
    ];

    // cách 1
    $data = collect(['0'=> 'chon'] + $data);

    // cách 2: cần truyền key (0) vào hàm `prepend()` để key trong array không bị thay đổi.
    $data = collect($data)->prepend('chọn hành động', 0);
```


