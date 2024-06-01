<?php

class c_string
{
    //Genera un string aleatorio, recibe la longitud del string que se desea -- RetaxMaster
    public static function m_randon_string(int $cantidadCaracteres)
    {
        $string_base         = 'ABCDEFGHIJLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $random_string       = '';
        $string_base_lenght  = strlen($string_base);
        for ($i = 0; $i < $cantidadCaracteres; $i++) {
            $random         = mt_rand(0, $string_base_lenght - 1);
            $random_string .= substr($string_base, $random, 1);
        }
        return $random_string;
    }

    public static function m_filter_string(string $string, string $type): string
    {
        switch ($type) {
            case 'string':
                 $sanitized = filter_var(trim($string), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);

                break;
            case 'keep_html_characters':
                 $sanitized = htmlentities($string);

                break;
            case 'remove_special_chars_low':
                 $sanitized = preg_replace("/[^A-Za-z0-9А-За-з., ?!.:;]/", "", $string);

                break;
            case 'remove_special_chars_medium':
                 $sanitized = preg_replace("/[^A-Za-z0-9А-За-з., ?!]/", "", $string);

                break;
            case 'remove_special_chars_high':
                 $sanitized = preg_replace("/[^A-Za-z0-9А-За-з ]|©|║/", "", $string);

                break;
            case 'keep_only_words': // quita numeros
                 $sanitized = preg_replace("/\d/", "", $string);

                break;
            case 'keep_only_numbers': // quita letras
                 $sanitized = preg_replace("/\D/", "", $string);

                break;
            case 'email':
                 $sanitized = filter_var(trim($string), FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH);

                break;
            default:
                 $sanitized = trim($string);

                break;
        }
        return $sanitized;
    }

    public static function m_valida_string(string $string, string $type): bool
    {
        switch ($type) {
            case 'email':
                 $validated = filter_var($string, FILTER_VALIDATE_EMAIL);

                break;
            case 'float':
                 $validated = filter_var($string, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND);

                break;
            case 'int':
                 $validated = ctype_digit($string);

                break;
            case 'ip':
                 $validated = filter_var($string, FILTER_VALIDATE_IP);

                break;
            case 'url':
                 $validated = filter_var($string, FILTER_VALIDATE_URL);

                break;
            default:
                 $validated = false;

                break;
        }
        return $validated;
    }

    public static function m_remueve_acento(string $string): string
    {
        $string = str_replace(
            array('А', 'Ю', 'Д', 'Б', '╙', 'а', 'ю', 'б', 'д'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );
        $string = str_replace(
            array('И', 'Х', 'К', 'Й', 'и', 'х', 'й', 'к'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );
        $string = str_replace(
            array('М', 'Л', 'О', 'Н', 'м', 'л', 'о', 'н'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );
        $string = str_replace(
            array('С', 'Р', 'Ж', 'Т', 'с', 'р', 'ж', 'т'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );
        $string = str_replace(
            array('З', 'Ы', 'Э', 'Ш', 'з', 'ы', 'ш', 'э'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );
        $string = str_replace(
            array('Я', 'я', 'Г', 'г'),
            array('n', 'N', 'c', 'C',),
            $string
        );
        return $string;
    }

   //Convierte a number format
    public function m_format_number($money, $tipo = 'n', $decimas = 0): string
    {
        switch ($tipo) {
            case '$':
                return '$' . number_format($money, $decimas);
            break;
            case 'n':
                return number_format($money, $decimas);
            break;
        }
    }
}

?>
</body>
</html>
