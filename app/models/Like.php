<?php

namespace Model;

use Model\Model;
use Model\Session;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Like class
 */
class Like
{

    use Model;

    protected $table = 'likes';
    protected $primaryKey = 'id';
    protected $loginUniqueColumn = 'slug';

    protected $allowedColumns = [

        'user_id',
        'tweet_id',
        'reply_id',

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


}
