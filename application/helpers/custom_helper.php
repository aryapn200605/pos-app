<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('resultToArray')) {
    function result_to_array($datas, $filter)
    {
        $result = [];
        if (is_object($datas)) {
            $datas = json_decode(json_encode($datas), true);
        }

        foreach ($datas as $data) {
            $filteredRow = [];
            if (is_object($data)) {
                $data = json_decode(json_encode($data), true);
            }
            foreach ($filter as $key) {
                if (isset($data[$key])) {
                    $filteredRow[] = $data[$key];
                }
            }
            $result[] = $filteredRow;
        }
        return $result;
    }
}

if (!function_exists('numberFormatter')) {
    function numberFormatter($val) {
        return 'Rp. ' . number_format($val, 0, ',', ',');
    }    
}

if (!function_exists('badgeProgressStatus')) {
    function badgeProgressStatus($val) {
        switch ($val) {
            case 'Done':
                echo 'success';
                break;
            case 'Cancel':
                echo 'danger';
                break;
            default:
                echo 'warning';
                break;
        }        
    }    
}


if (!function_exists('is_authenticated')) {
    function is_authenticated()
    {
        $CI = &get_instance();
        if (!$CI->session->userdata('user_id')) {
            // echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            // redirect('/Auth');
            // redirect('/App');
            // header("Refresh:0");
            // show_error('Unauthorized access', 403);
            // exit;
        }
    }
}
if (!function_exists('get_uuid_from_api')) {
    function get_uuid_from_api()
    {
        $url = 'https://www.uuidtools.com/api/generate/v4'; // URL API Anda
        $ch = curl_init();

        // Setel opsi CURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        // Cek apakah ada error
        if ($response === false) {
            return null; // Jika curl gagal
        }

        return json_decode($response)[0];
    }
}

