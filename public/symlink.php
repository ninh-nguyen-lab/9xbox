<?php
// store.php

// Đường dẫn tuyệt đối tới thư mục storage/app/public
$target = __DIR__ . '/storage/app/public';

// Đường dẫn tuyệt đối tới thư mục public/storage
$link = __DIR__ . '/public/storage';

if (file_exists($link)) {
    echo "Link đã tồn tại: $link\n";
} else {
    if (function_exists('symlink')) {
        if (symlink($target, $link)) {
            echo "Tạo storage link thành công!\n";
        } else {
            echo "Không thể tạo symlink. Có thể hosting không cho phép.\n";
        }
    } else {
        echo "Hàm symlink không khả dụng trên hosting này.\n";
    }
}
