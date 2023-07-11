<?php

namespace Model;

use Model\Session;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * User class
 */
class Lists
{

    use Model;

    protected $table = 'lists';
    protected $primaryKey = 'id';
    protected $loginUniqueColumn = 'slug';

    protected $allowedColumns = [

        'user_id',
        'title',
        'description',
        'date',
        'image',
        'role',

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
            'alpha_numeric_symbol',
        ],

        'title' => [
            'required',
            'alpha_numeric_symbol',
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
