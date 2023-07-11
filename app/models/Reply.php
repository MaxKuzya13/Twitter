<?php

namespace Model;

use Model\Model;
use Model\Session;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Reply class
 */
class Reply
{

    use Model;

    protected $table = 'reply';
    protected $primaryKey = 'id';
    protected $loginUniqueColumn = 'slug';

    protected $allowedColumns = [

        'tweet_id',
        'reply_id',
        'user_id',
        'replying_name',
        'replying_id',
        'description',
        'date',
        'file',
        'reply',
        'retweet',
        'likeable',
        'views',
        'bookmark',

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
