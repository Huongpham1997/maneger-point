<?php


class Constant
{
    const ROLE_SUPPER_ADMIN = 1; // admin tổng
    const ROLE_TEACHER = 2; // quyền giáo viên

    const PAGE_SIZ_DEFAULT = 10;
    const MAX_PAGE_SIZE = 10;

    const MALE = 1;
    const FEMALE = 2;
    const OTHER = 3;

    const ACTIVE = 1;
    const INACTIVE = 2;

    static function getGender()
    {
        return [
            self::MALE => "Nam",
            self::FEMALE => "Nữ",
            self::OTHER => "Khác"
        ];
    }

    static function getStatus()
    {
        return [
            self::ACTIVE => "Hoạt động",
            self::INACTIVE => "Khóa",
        ];
    }

    static function substr($str, $length, $minword = 3)
    {
        $sub = '';
        $len = 0;
        foreach (explode(' ', $str) as $word) {
            $part = (($sub != '') ? ' ' : '') . $word;
            $sub .= $part;
            $len += strlen($part);
            if (strlen($word) > $minword && strlen($sub) >= $length) {
                break;
            }
        }
        return $sub . (($len < strlen($str)) ? '...' : '');
    }
}