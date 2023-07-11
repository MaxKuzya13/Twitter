<?php

namespace Model;

use Model\Model;
use Model\Session;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Follow class
 */
class Follow
{

    use Model;

    protected $table = 'follow';
    protected $primaryKey = 'id';

    protected $allowedColumns = [

        'follower_id',
        'account_id',

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
