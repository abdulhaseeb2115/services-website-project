<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\Null_;

class UserController extends Controller
{
    //////REGISTER & LOGIN FUNCTION//////

    // login--->
    function login(Request $request)
    {
        // check session
        if (session()->has('user')) {
            return redirect('user/dashboard');
        }


        $email = $request->email;
        $password = $request->login_password;

        $result = User::where('email', '=', $email)->where('password', '=', $password)->first();

        if (($result) != Null) {
            $request->session()->put('user', $result);
            return redirect('/user/dashboard');
        } else {
            return view('user.login', ["error" => "Invalid input !"]);
        }
    }

    // register--->
    function register(Request $request)
    {
        // check session
        if (session()->has('user')) {
            return redirect('user/dashboard');
        }

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $password = $request->register_password;

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->address = $address;
        $user->password = $password;
        $user->save();

        if ($user->id) {
            $request->session()->put('user', $user);
            return redirect('/user/dashboard');
        } else {
            return view('user.login', ["error" => "Invalid input !"]);
        }
    }



    ////////PAGES////////

    // login page
    function loginPage()
    {
        // check session
        if (session()->has('user')) {
            return redirect('user/dashboard');
        } else {
            return view('user.login');
        }
    }

    //  dashboard
    function dashboard()
    {
        // check session
        if (!session()->has('user')) {
            return redirect('user/login');
        }

        $result = session('user');
        $user_id = $result->id;
        // total orders
        $total_orders = Order::where('user_id', '=', $user_id)->get();
        // completed orders
        $completed_orders = Order::where('user_id', '=', $user_id)->where('status', '=', 'completed')->get();
        // pending orders
        $pending_orders =
            Order::where('orders.user_id', $user_id)
            ->where('orders.status', '=', 'pending')
            ->leftJoin('workers', 'orders.assigned_worker_id', '=', 'workers.id')
            ->select('orders.id', 'orders.description', 'orders.date', 'workers.name')->get();


        return view(
            'user/dashboard',
            [
                "total_orders" => count($total_orders),
                "completed_orders" => count($completed_orders),
                "pending_orders_count" => count($pending_orders),
                "pending_orders" => $pending_orders,
            ]
        );
    }

    // add feedback
    function addFeedback(Request $request)
    {
        // check session
        if (!session()->has('user')) {
            return redirect('user/login');
        }


        $order_id = $request->order_id;
        $rating = $request->rating;
        $feedback = $request->feedback;

        Order::where('id', $order_id)
            ->update(
                [
                    'status' => "completed",
                    'rating' => $rating,
                    'feedback' => $feedback
                ]
            );

        return redirect('/user/dashboard');
    }

    //  request page
    function requestPage()
    {
        // check session
        if (!session()->has('user')) {
            return redirect('user/login');
        }



        $result = Category::all();
        return view('user.request', ['categories' => $result]);
    }

    // add request
    function addRequest(Request $request)
    {
        // check session
        if (!session()->has('user')) {
            return redirect('user/login');
        }

        $user_id = $request->user_id;
        $service = $request->service;
        $description = $request->description;

        $order = new Order;
        $order->user_id = $user_id;
        $order->service = $service;
        $order->description = $description;
        $order->save();

        if ($order) {
            return redirect('/user/dashboard');
        }
    }

    // history
    function history()
    {
        // check session
        if (!session()->has('user')) {
            return redirect('user/login');
        }



        $result = session('user');
        $user_id = $result->id;

        // completed orders
        $orders =
            Order::where('orders.user_id', $user_id)
            ->where('orders.status', '=', 'completed')
            ->leftJoin('workers', 'orders.assigned_worker_id', '=', 'workers.id')
            ->select('orders.id', 'orders.rating', 'orders.description', 'orders.date', 'workers.name')->get();

        return view('user/history', ["orders" => $orders]);
    }




    // LOGOUT
    function logout()
    {
        session()->flush();
        return redirect("/user/login");
    }
}
