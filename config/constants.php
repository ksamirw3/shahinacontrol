<?php

return[
    'roles_sections' => [
        'أنواع' => 'أنواع',
        'أقسام' => 'أقسام',
        'مستخدم نشر' => 'مستخدم نشر',
        'كتب' => 'كتب',
        'مستخدمين' => 'مستخدمين'
    ],
    'status' => [
        0 => 'Rejected',
        1 => 'Approved',
        2 => 'Pending'
    ],
    'status_class' => [
        0 => 'danger',
        1 => 'success',
        2 => 'info'
    ],
    'publisher_types' => [
        1 => 'شركة',
        2 => 'فرد',
    ],
    'genders' => [
        'm' => 'رجل',
        'f' => 'إمرأه',
        'o' => 'أخرى'
    ],
    'image_sizes' => [
        'resize,100x100,small',
        'resize,400x300,meduim',
        'resize,600x480,large'
    ],
    'launch' => [
        'now' => 'الان',
        'soon' => 'قريبا',
    ],
    'perPage' => 10,
    'perLink' => 5,
    'prices' => [
        1 => 'مدفوع',
        0 => 'مجانا',
    ],
    'gender' => [
        'f' => 'Female',
        'm' => 'Male',
        'o' => 'Other'
    ],
    'age' => [
        1 => [20, 25],
        2 => [25, 30],
        3 => [35, 40],
        4 => [40, 50],
        5 => [50, 80],
    ],
    "validUplodedVideos" => 1,
    "maxUploadedImagesForCategory" => 4,
    'mediaCode' => [
        3100 => "no files",
        3101 => "invalid files",
        3102 => "you have uploaded more than one video",
        3103 => "you already has a video",
        3104 => "another feature exist",
        3105 => "no image has been uploaded",
        200 => "uploaded successfully",
    ],
    'weekend' => [
        0 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wendesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
    ],
    'boolean' => [
        0 => 'Not',
        1 => '',
        '' => 'Not'
    ]
];
