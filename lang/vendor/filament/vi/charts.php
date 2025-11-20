<?php

return [
    'total_patient_label'       => 'Bệnh Nhân Trong Hệ Thống',
    'total_patient_description' => 'Tổng Số Lượng Bệnh Nhân Hiện Tại Trong Hệ Thống.',
    'change_patient_label'      => 'Bệnh Nhân Mới Trong Tháng',
    'change_patient_description' => 'So Với Số Lượng Bệnh Nhân Tháng Trước.',
    'total_appointment_label'   => 'Số Ca Khám Bệnh',
    'total_appointment_description' => 'Tổng Số Ca Khám Bệnh Đã Thực Hiện Tại Phòng Khám',
    'change_appointment_label'  => 'Ca Khám Bệnh Mới Trong Tháng',
    'change_appointment_description' => 'So Với Số Lượng Ca Khám Bệnh Tháng Trước',
    'increase'                  => 'Đã Tăng',
    'decrease'                  => 'Đã Giảm',
    'filter'                    => 'Bộ Lọc',

    'appointments' => [
        'title' => 'Thống Kê Ca Khám Bệnh',
        'label' => 'Buổi Khám Bệnh',
        'group' => 'Nhóm Chức Năng Báo Cáo/ Thống Kê',

        'distribution' => [
            'title' => 'Biểu Đồ Thể Hiện Sự Phân Bố Của Các Ca Khám Bệnh Theo Khoa'
        ],


        'heatmap' => [
            'title' => 'Biểu Đồ Thể Hiện Tần Suất Của Các Ca Khám Bệnh Theo Từng Mốc Thời Gian'
        ],
    ],


    'patients' => [
        'title' => 'Thống Kê Bệnh Nhân',
        'label' => 'Bệnh Nhân',
        'group' => 'Nhóm Chức Năng Báo Cáo/ Thống Kê',


        'enrollments' => [
            'title' => 'Biểu Đồ Thể Hiện Số Lượng Bệnh Nhân Mới Tham Gia Vào Hệ Thống Qua Từng Thời Kỳ',
            'x-axis' => 'Tháng',
            'y-axis' => 'Số Bệnh Nhân'
        ],


        'ages' => [
            'title' => 'Biểu Đồ Thể Hiện Sự Phân Bố Độ Tuổi Của Bệnh Nhân Trong Hệ Thống',
        ],
    ],

];