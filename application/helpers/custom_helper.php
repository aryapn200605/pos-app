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
        try {
            if (!is_numeric($val)) {
                throw new Exception("Bukan angka coy");
            }
            return 'Rp. ' . number_format($val, 0, ',', ',');
        } catch (Exception $e) {
            return 'error while formatting';
        }
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

if (!function_exists('platList')) {
    function platList()
    {
        $platOptions = [
            "1" => "Plat 1",
            "2" => "Plat 2",
            "3" => "Plat 3",
            "4" => "Plat 4"
        ];

        return $platOptions;
    }
}

if (!function_exists('bahanList')) {
    function bahanList()
    {
        $bahanOptions = [
            "HVS" => "HVS",
            "Ivory" => "Ivory",
            "Art Paper" => "Art Paper",
            "Art Carton" => "Art Carton",
            "Stiker" => "Stiker",
            "Duplek" => "Duplek",
            "Tik" => "Tik",
            "Samson" => "Samson",
            "NCR" => "NCR",
            "Koran" => "Koran",
            "Kraff" => "Kraff",
            "Kraff PE" => "Kraff PE",
            "BW (Bristol Board)" => "BW (Bristol Board)",
            "Concord" => "Concord",
            "Linen Jepang" => "Linen Jepang",
            "Bufallou" => "Bufallou",
            "MG" => "MG",
            "Roti" => "Roti",
            "Board" => "Board",
            "Linen Kain" => "Linen Kain",
            "efload" => "efload"
        ];

        return $bahanOptions;
    }
}

if (!function_exists('gramasiList')) {
    function gramasiList()
    {
        $gramasiOptions = [
            "60" => "60 gsm",
            "70" => "70 gsm",
            "80" => "80 gsm",
            "90" => "90 gsm",
            "100" => "100 gsm",
            "120" => "120 gsm",
            "150" => "150 gsm",
            "190" => "190 gsm",
            "210" => "210 gsm",
            "230" => "230 gsm",
            "250" => "250 gsm",
            "270" => "270 gsm",
            "290" => "290 gsm",
            "310" => "310 gsm",
            "350" => "350 gsm",
            "400" => "400 gsm",
            "450" => "450 gsm"
        ];

        return $gramasiOptions;
    }
}

if (!function_exists('ukuranList')) {
    function ukuranBahanList()
    {
        $ukuranOptions = [
            "21,29.7" => "21 x 29.7",
            "21,33" => "21 x 33",
            "29.7,42" => "29.7 x 42",
            "61,86" => "61 x 86",
            "61,92" => "61 x 92",
            "65,90" => "65 x 90",
            "65,100" => "65 x 100",
            "70,108" => "70 x 108",
            "79,109" => "79 x 109",
            "90,120" => "90 x 120",
            "79,120" => "79 x 120",
            "66,127" => "66 x 127",
            "80,110" => "80 x 110",
            "120,160" => "120 x 160"
        ];

        return $ukuranOptions;
    }
}

if (!function_exists('mesinCetakList')) {
    function mesinCetakList()
    {
        $mesinCetakOptions = [
            "Mesin GTO{}1000{}300000{}60" => "Mesin GTO",
            "Mesin Riobi66 - 1 Warna{}1000{}120000{}120" => "Mesin Riobi66 - 1 Warna",
            "Mesin Riobi66 - 2 Warna{}1000{}240000{}120" => "Mesin Riobi66 - 2 Warna",
            "Mesin Riobi66 - 3 Warna{}1000{}450000{}120" => "Mesin Riobi66 - 3 Warna",
            "Mesin Oliver48{}1000{}70000{}30" => "Mesin Oliver48",
            "Mesin SM74{}1000{}750000{}180" => "Mesin SM74",
            "Mesin Toko / Multilit{}1000{}10000{}10" => "Mesin Toko / Multilit"
        ];

        return $mesinCetakOptions;
    }
}

if (!function_exists('laminasiList')) {
    function laminasiList()
    {
        $laminasiOptions = [
            "Glossy{}100{}16{}0.16" => "Glossy",
            "Vernis / Spot UV{}100{}12{}0.12" => "Vernis / Spot UV",
            "Laminasi Doff{}100{}18{}0.18" => "Laminasi Doff"
        ];

        return $laminasiOptions;
    }
}

