<?php

namespace App\Libraries;

class RulesRegister
{
    public function regex_check_name($str)
    {
        if (!preg_match("/^[a-zA-ZÀ-ÿ ,.'-]{3,20}+$/i", $str)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function regex_check_password($str)
    {
        if (!preg_match("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[$&+,:;=?@#|'<>.-^*()%!])(?=\\S+$).{12,}$/", $str)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function regex_check_username($str)
    {
        if (!preg_match("/^[a-zA-ZÀ-ÿ0-9._-]{3,20}$/", $str)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function regex_check_postcode($str)
    {
        if (!preg_match("/^[0-9]{5}$/", $str)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function regex_check_city($str)
    {
        if (!preg_match("/^[a-zA-ZÀ-ÿ ,.'-]{3,25}+$/", $str)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}