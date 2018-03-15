<?php
/**
 * Created by PhpStorm.
 * User: User
 * Author: Joshua Saputra
 * Date: 12/3/2018
 * Time: 2:58 PM
 */
namespace app\components\base;


class AppConstants
{
    // SESSIONS
    const SES_WEB_PROFILE = 'S_WEB_PROFILE';

    // APP CONFIG
    const DELIMITER = '#|#';
    const CONCAT = '|!|';
    const LIMIT_PER_PAGE = 20;
    const INVOICE_FORMAT = '{module}/{date}/{number}';
    const APP_BASE_URL = '/nagamas'; // localhost
    //const APP_BACKEND_BASE_URL = '/';
    const IMG_RESPONSIVE = 'img-responsive';

    //API V1 CONFIG

    //MESSAGE
    const ERR_INTEGRITY_CONSTRAINT_VIOLATION = 'Database Integrity Violation';
    const MESSAGE_SAVE_SUCCESS = 'Data is successfully saved';
    const MESSAGE_SAVE_UPDATE = 'Data is successfully updated';
    const MESSAGE_SAVE_DELETE = 'Data is successfully deleted';

    // VALIDATION MESSAGES
    const VALIDATE_REQUIRED = '{attribute} harus diisi.';
    const VALIDATE_INTEGER = '{attribute} harus berupa angka.';
    const VALIDATE_UNIQUE = '{attribute} sudah pernah digunakan.';
    const VALIDATE_TOO_SHORT = '{attribute} minimal {min} karakter.';
    const VALIDATE_TOO_LONG = '{attribute} maksimal {max} karakter.';
    const VALIDATE_EMAIL = '{attribute} harus benar.';
    const VALIDATE_MIN_VALUE = '{attribute} minimal {compareValue}.';
    const VALIDATE_LARGER_THAN = '{attribute} harus lebih besar dari {compareValue}.';
    const VALIDATE_LARGER_OR_EQUAL = '{attribute} harus lebih besar atau sama dengan {compareValue}.';
    const VALIDATE_WRONG_EXTENSION = 'Jenis file yang diizinkan adalah {extensions}.';
    const VALIDATE_UPLOAD_REQUIRED = 'Silahkan pilih minimal 1 file.';
    const VALIDATE_TOO_MANY = 'Maksimal {limit} file dalam sekali upload.';
    const VALIDATE_TOO_BIG = 'Ukuran file {file} melebihi batas maksimal 1MB.';
    const VALIDATE_LOGIN_FAILED = 'Username atau Password salah.';
    const VALIDATE_NOT_ALLOWED_IP = 'IP Address tidak terdaftar.';
    const VALIDATE_DATE = 'Format {attribute} tidak benar.';
    const VALIDATE_OVER_PAYMENT = 'Kelebihan pembayaran.';
    const VALIDATE_NOT_ENOUGH_DEPOSIT = 'Saldo tidak mencukupi.';
    const VALIDATE_REQUIRED_WHEN = '{attribute} harus diisi jika {second_attribute} tidak kosong.';
    const VALIDATE_COMPARE_MUST_EQUAL = '{attribute} harus sama dengan {compareAttribute}.';
    const VALIDATE_COMPARE_MUST_NOT_EQUAL = '{attribute} tidak boleh sama dengan {compareAttribute}.';
    const VALIDATE_CAPTCHA = 'Kode verifikasi captcha salah.';
    const VALIDATE_NOT_EXISTS = '{attribute} tidak ditemukan.';

    //DATE FORMAT
    const FORMAT_DATE_PHP_SHOW_MONTH = 'php:d mm Y';
    const FORMAT_DB_DATE_PHP = 'php:Y-m-d';

    //FORM TEMPLATE
    const ACTIVE_FORM_CLASS_LABEL_COL_3 = 'col-md-3 control-label no-padding-right';
    const ACTIVE_FORM_TEMPLATE_INPUT_COL_9_FULL = '{label} <div class="col-md-9">{input}<span class="help-inline col-xs-12"><span class="middle">{error}{hint}</span></span></div>';

    //MONTH
    public static $month = [
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];

    //MONTH
    public static $type = [
        '1' => 'Lelang',
        '2' => 'Non-Lelang',
        '3' => 'Harga 3',
        '4' => 'Harga 4',
        '5' => 'Harga 5',
    ];

    //YEAR
    public static $year = [
        '2000' => '2000',
        '2001' => '2001',
        '2002' => '2002',
        '2003' => '2003',
        '2004' => '2004',
        '2005' => '2005',
        '2006' => '2006',
        '2007' => '2007',
        '2008' => '2008',
        '2009' => '2009',
        '2010' => '2010',
        '2011' => '2011',
        '2012' => '2012',
        '2013' => '2013',
        '2014' => '2014',
        '2015' => '2015',
        '2016' => '2016',
        '2017' => '2017',
        '2018' => '2018',
        '2019' => '2019',
        '2020' => '2020',
        '2021' => '2021',
        '2022' => '2022',
        '2023' => '2023',
        '2024' => '2024',
        '2025' => '2025',
        '2026' => '2026',
        '2027' => '2027',
        '2028' => '2028',
        '2029' => '2029',
        '2030' => '2030',
    ];

}