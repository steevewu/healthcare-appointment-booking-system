<?php

return [
    'total_patient_label' => 'Patients In The System',
    'total_patient_description' => 'Total Number Of Patients Currently In The System.',
    'change_patient_label' => 'New Patients This Month',
    'change_patient_description' => 'Compared To The Number Of Patients Last Month.',
    'total_appointment_label' => 'Number Of Medical Appointments',
    'total_appointment_description' => 'Total Number Of Medical Appointments Performed At The Clinic.',
    'change_appointment_label' => 'New Appointments This Month',
    'change_appointment_description' => 'Compared To The Number Of Medical Appointments Last Month.',
    'increase' => 'Has Increased',
    'decrease' => 'Has Decreased',
    'filter'   => 'Filter',

    'appointments' => [
        'title' => 'Medical Appointment Statistics',
        'label' => 'Medical Appointment',
        'group' => 'Report/Statistics Function Group',

        'distribution' => [
            'title' => 'Chart Showing The Distribution Of Medical Appointments By Department'
        ],

        'heatmap' => [
            'title' => 'Chart Showing The Frequency Of Medical Appointments By Time Period'
        ],
    ],


    'patients' => [
        'title' => 'Patient Statistics',
        'label' => 'Patient',
        'group' => 'Report/Statistics Function Group',

        'enrollments' => [
            'title' => 'Chart Showing The Number Of New Patients Joining The System Over Time',
            'x-axis' => 'Month',
            'y-axis' => 'Number Of Patients'
        ],


        'ages' => [
            'title' => 'Chart Showing The Age Distribution Of Patients In The System',
        ],
    ],

];