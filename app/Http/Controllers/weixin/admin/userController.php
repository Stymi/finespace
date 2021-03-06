<?php

namespace App\Http\Controllers\weixin\admin;


use App\Models\Product;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserAccountRepositoryInterface;
use App\Repositories\OrderItemRepositoryInterface;

use App\Tool\MessageResult;


class userController extends Controller
{
    //

    private $user;
    private $userAccount;
    private $order;

    public function __construct(UserRepositoryInterface $user,UserAccountRepositoryInterface $userAccount,
                                OrderRepositoryInterface $order)
    {

        $this->user =$user;
        $this->userAccount = $userAccount;
        $this->order = $order;
    }


    public function index()
    {

        return view('admin.weixinAdmin.home');
    }

    public function manageUser(Request $request)
    {
        $seachData = $request->input('seachData');
        $users = $this->user->manageUser($seachData,15);
        // $users = $this->user->selectAll(10);
        return view('admin.weixinAdmin.user.manageUser')->with('users',$users)->with('seachData',$seachData);

    }

    public function userDetail($id)
    {
        $user=$this->user->find($id);
        $account= null;

        if($user != null)
        {
            $userDetail = $this->user->getUserDetail($user);
            return view('admin.weixinAdmin.user.userDetail')->with('user',$user)
                                                    ->with('account',$userDetail['account'])
                                                    ->with('orders',$userDetail['orders'])
                                                    ->with('totalAmount',$userDetail['totalAmount']);
        }
        else
        {
            //错误页面
            return '页面不存在';
        }
    }

    public function seachUser(Request $request)
    {
        $users = $this->user->seachUser($request->input('seachData'));
        return view('admin.weixinAdmin.user.manageUser')->with('users',$users);
        // dd($users);
    }

}
