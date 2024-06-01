<?php

class userModel
{
    public function __construct()
    {
        $this->formatSql = new c_MySQLi();
    }

    public function m_consulta($tipo, $param = [])
    {

        switch ($tipo) {
            case 0: // trae select de todo los usuarios
                  $cond = implode(' ', $param);

                return
            'SELECT  CONCAT(U.id_us,"|||",U.fk_doc), CONCAT (U.firt_name, " ", U.last_name , " " ,U.second_name)
         FROM users U 
         JOIN roles R ON R.id_ac_rol = U.fk_rol' . $cond;
            break;
            case 1: // consulta medidas de usario
                  $cond = implode(' ', $param);

                return
            'SELECT
         U.fk_doc, CONCAT (U.firt_name, " ", U.last_name , " " ,U.second_name) , U.img, U.date_of_birth , U.gender,
         M.date_create, M.caracter,
         MT.name_type_n, 
         N.name_type_m
         FROM users U 
         JOIN measures M ON M.fk_us = U.id_us 
         JOIN types_n N ON  N.id_n = M.fk_type_n 
         JOIN types_m MT ON M.fk_type_m = MT.id_m'
            . $cond;
            case 2: //  documentos
                return 'SELECT * FROM `type_docs`';
            case 3: // peso de un usuario
                return 'SELECT * FROM `measures`' . $param;
            break;
            case 4: // login de usario
                  $cond = implode(' ', $param);

                return 'SELECT * FROM users
         ' . $cond;
            case 5://consulta La solicitudes de consulta
                if (!isset($param)) {
                    $param = [];
                }
                $cond = implode(' ', $param);

                return
            'SELECT QU.fk_doc, QU.fk_us,
         Q.id, Q.date_request, Q.date_quote, Q.obs, Q.status,
         CONCAT(U.firt_name," ", U.second_name," ", U.last_name ), R.name_rol
         FROM quotes Q
         LEFT JOIN quote_users QU ON  QU.fk_quote = Q.id
         LEFT JOIN users U ON U.id_us = QU.fk_us
         LEFT JOIN roles R ON R.id_ac_rol = U.fk_rol  ' . $cond;
            case 6:
                  $cond = implode(' ', $param);

                return
            'SELECT DISTINCT QU.fk_doc, QU.fk_us,
         U.firt_name, U.second_name, U.last_name, R.name_rol, U.email, U.date_of_birth, U.password
         FROM quotes Q
         LEFT JOIN quote_users QU ON  QU.fk_quote = Q.id
         LEFT JOIN users U ON U.id_us = QU.fk_us
         LEFT JOIN roles R ON R.id_ac_rol = U.fk_rol ' . $cond;
            break;
            case 7:
                  $cond = implode(' ', $param);

                return
            "INSERT INTO `plans` (`id_plan`, `name`, `date_create`, `fk_doc`, `fk_us`) 
         VALUES (NULL, 'Comidas df', '2021-03-23 00:00:00', 'CE', '5') $cond ";
            break;
            case 8:
                  $cond = implode(' ', $param);

                return
            'SELECT P.id_plan, P.name, P.date_create, 
         IFNULL(E.id_eje, F.id) , IFNULL(E.instruccion, F.obs),
         IFNULL( E.repetitions, F.portions ) ,
         U.fk_doc, CONCAT( U.firt_name," ", U.second_name," ",  U.last_name  ) , U.id_us,
         IFNULL(E.eje, F.food)
         FROM plans P
         LEFT JOIN foods F ON P.id_plan = F.fk_plan
         LEFT JOIN ejes E ON P.id_plan = E.fk_plan
         LEFT JOIN users U ON P.fk_us = U.id_us ' . $cond;
            break;
            case 10;
                $cond = implode(' ', $param);

 return
            'SELECT 
         s.name category_name, # 0
         s.id service_id,      # 1
         t.body,               # 2
         1 service_status,     # 3
         s.created_at service_created_at, # 4 
         c.name category_name, # 5
         s.category_id, # 6
         s.img,         # 7
         s.alt,         # 8
         t.body,        # 9
         s.modal_head,  # 10
         s.modal_footer, # 11
         s.modal_imgs,   # 12
         s.modal_title,  # 13
         s.is_modal,     # 14
         c.id            # 15
         FROM services s  
         INNER JOIN categories c ON c.id  = s.category_id
         INNER JOIN templates t ON  t.id = s.template_id 
         WHERE TRUE ' . $cond;
            break;
            case 11:
                  $cond = implode(' ', $param);

                return
            'SELECT 
         u.id user_id,
         u.name user_name, 
         u.photo user_phone,
         u.document user_document,
         u.created_at user_created_at,
         u.rol_id,
         r.name rol_name,
         u.status user_status
         FROM users u
         INNER JOIN roles r ON r.id = u.rol_id' . $cond;
            case 12:
                return
            'INSERT INTO users
         SET
         name = "' . $param[0] . '",
         pass = "' . $param[1] . '",
         photo = "' . $param[2] . '",
         document = "' . $param[3] . '",
         document_type_id = ' . $param[4] . ',
         created_at = "' . $param[5] . '",
         updated_at = "' . $param[6] . '",
         rol_id = ' . $param[3];
            case 13:
                return
            'SELECT kernel FROM templates WHERE id =1';
            case 14:
                return
            'UPDATE templates SET kernel = ' . $param[0] . ' WHERE id =1';
            case 15:
                return
            'SELECT 
         u.name,
         ur.comment,
         u.photo,
         ur.calification
         FROM
         user_recommendations ur
         INNER JOIN users u ON u.id = ur.user_id
         WHERE ur.status = 1
         AND u.rol_id =3
         LIMIT 4';
            default:
                  false;

                break;
        }
    }

    public function m_update($param, $tipo = null)
    {

// UPDATE quotes SET date_quote ='2021-03-18',  status ="A" ;
        if (!isset($tipo)) {
            return 'UPDATE ' . $param[0] . ' SET ' . $param[1];
        } else {
            switch ($tipo) {
                case 1: // UPDATE PLAN ->asignaPlan
                                                                                                                                                                                    $sql = 'UPDATE plans P 
            LEFT JOIN foods F ON P.id_plan = F.fk_plan 
            LEFT JOIN ejes  E ON P.id_plan = E.fk_plan 
            LEFT JOIN users U ON P.fk_us   = U.id_us 
            SET F.obs     =  "' . $param[3] . '"  
            WHERE U.id_us =  ' . $param[1] ;

                    break;
            }
            return $sql;
        }
    }

    public function m_delete($param)
    {

        return 'DELETE  FROM ' . $param[0] . ' WHERE ' . $param[1] . ' = ' . $param[2];
    }

    public function m_insert($param, $id_No_Default = null)
    {

        if (isset($id_No_Default)) {
            return 'INSERT INTO ' . $param[0] . ' VALUES ("' . implode('","', $param[1]) . '")';
        } else {
            return 'INSERT INTO ' . $param[0] . ' VALUES ( DEFAULT, "' . implode('","', $param[1]) . '")';
        }
    }

    public function m_ultimo_id($param)
    {

        $obj = ($this->db->m_ejecuta('SELECT MAX(' . $param[0] . ') from ' . $param[1] . ''));
        $i = 0;
        while ($result = mysqli_fetch_row($obj)) {
            $data[0] = $result;
            $i++;
        }
        return $data[0][0];
    }
}
