<?php

namespace Model;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * User class
 */
class User
{

    use Model;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $loginUniqueColumn = 'email';

    protected $allowedColumns = [

        'username',
        'slug',
        'password',
        'code',
        'email',
        'month',
        'day',
        'year',
        'bio',
        'location',
        'website',
        'avatar',
        'header',
        'tweets',
        'replies',
        'following',
        'followers',
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

        'email' => [
            'email',
            'unique',
            'required',
        ],
        'username' => [
            'alpha',
            'required',
        ],
        'password' => [
            'not_less_than_8_chars',
            'required',
        ],
        'bio' => [
            'alpha_numeric_symbol',
        ],
        'location' => [
            'alpha_numeric_symbol',
        ],
        'website' => [
            'alpha_numeric_symbol',
        ],
    ];

    public function signup($data)
    {
        if($this->validate($data))
        {
            // add extra columns here
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['slug'] = generate_slug($data['username']);
            $data['code'] = rand(100000000, 999999999);

            $this->insert($data);
            message('Profile created successfully! Please login to continue');
            redirect('login');
        } else {
            message('wtf');
        }
    }

    public function login_one($data)
    {
        $row = $this->first([$this->loginUniqueColumn=>$data[$this->loginUniqueColumn]]);

        if($row)
        {
            redirect('auth');
        }else {
            $this->errors[$this->loginUniqueColumn] = 'Wrong email';
        }

    }

    public function login($data)
    {
        $row = $this->first([$this->loginUniqueColumn=>$data[$this->loginUniqueColumn]]);

        if($row)
        {
            // confirm password
            if(password_verify($data['password'], $row->password))
            {
                $ses = new Session();
                $ses->auth($row);
                redirect('homefull');
            } else {
                $this->errors[$this->loginUniqueColumn] = 'Wrong email or password';
            }
        }else {
            $this->errors[$this->loginUniqueColumn] = 'Wrong email or password';
        }

    }
}
