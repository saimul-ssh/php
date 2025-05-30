<?php 
// File upload system

/**
 * File Upload System
 */
function fileUpload($file, $location = '', $file_format = ['jpg', 'png', 'gif'], $file_type = null) {

    // File info
    $file_name = $file['name'];
    $file_name_tmp = $file['tmp_name'];

    // file name extension
    $file_array = explode('.', $file_name);
    $file_extension = strtolower(end($file_array));

    // File type default value
    if (!isset($file_type['type'])) {
        $file_type['type'] = 'image';
    }

    if (!isset($file_type['file_name'])) {
        $file_type['file_name'] = '';
    }

    if (!isset($file_type['fname'])) {
        $file_type['fname'] = '';
    }

    if (!isset($file_type['name'])) {
        $file_type['name'] = '';
    }

    // Generate file name based on type
    if ($file_type['type'] == 'image') {
        $file_name = md5(time() . rand()) . '.' . $file_extension;
    } elseif ($file_type['type'] == 'file') {
        $file_name = date('d_m_Y_g_h_s') . '_' . $file_type['file_name'] . '_' . $file_type['fname'] . '_' . $file_type['name'] . '.' . $file_extension;
    }

    $mess = '';

    // Check valid format
    if (!in_array($file_extension, $file_format)) {
        $mess = '<p class="alert alert-danger"> Invalid File Format! <button class="close" data-dismiss="alert">&times;</button> </p>';
    } else {
        // Ensure location ends with slash
        if ($location !== '' && substr($location, -1) !== '/') {
            $location .= '/';
        }

        // file upload to dir
        move_uploaded_file($file_name_tmp, $location . $file_name);
    }

    return [
        'mess' => $mess,
        'file_name' => $file_name
    ];
}



// old data refill
function old($field_name){
    if(isset($field_name)){
        if (isset($_POST[$field_name])) {
            echo $_POST[$field_name];
    }
    }
}






?>