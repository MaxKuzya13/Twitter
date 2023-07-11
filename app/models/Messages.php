<?php

namespace Model;

use Model\Model;
use Model\Session;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * User class
 */
class Messages
{

    use Model;

    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $loginUniqueColumn = 'slug';

    protected $allowedColumns = [

        'sender_id',
        'recipient_id',
        'description',
        'date',
        'file',
        'direct_id',

    ];

//    /***********
//     *   rules include:
//     * required
//     * alpha
//     * email
//     * numeric
//     * unique
//     * symbol
//     * not_less_than_8_chars
//     * alpha_space
//     * alpha_numeric
//     * alpha_numeric_symbol
//     * alpha_symbol
//     *
//     *
//     */
    protected $validationRules = [

        'description' => [
            'required',
        ]

    ];

    public function add_user_data($rows)
    {
        foreach ($rows as $key => $row)
        {
            $res = $this->get_row("select * from users where id = :id", ['id'=>$row->user_id]);
            $rows[$key]->user = $res;
        }

        return $rows;
    }

}
