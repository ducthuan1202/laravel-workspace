<?php

return [
    'backend' => [
        'folder' => 'backend', // Tên thư mục chứa tài nguyên sử dụng trong backend
        'prefix_url' => 'admin', // Sử dụng làm tiền tố URL cho liên kết trong backend
        'prefix_router_name' => 'backend.', // Sử dụng làm tiền tố đặt tên cho route
    ],

    'permissions' => [
        'backend.home.index' => 'Bảng tin',
        'backend.home.permissions' => 'Lấy danh sách quyền',

        'backend.categories.index' => 'Danh sách danh mục',
        'backend.categories.get_data' => 'API lấy danh mục',
        'backend.categories.change_status' => 'API đổi trạng thái danh mục',
        'backend.categories.open_form' => 'Hành động tạo hoặc sửa danh mục',
        'backend.categories.save_form' => 'Hành động lưu thay đổi danh mục',

        'backend.roles.index' => 'Danh sách nhóm quyền',
        'backend.roles.get_data' => 'API lấy nhóm quyền',
        'backend.roles.open_form' => 'Hành động tạo hoặc sửa nhóm quyền',
        'backend.roles.save_form' => 'Hành động lưu thay đổi nhóm quyền',
        'backend.roles.choose_permissions' => 'Hành động chọn quyền cho nhóm',
        'backend.roles.save_permissions' => 'Hành động lưu quyền cho nhóm',
    ]
];
