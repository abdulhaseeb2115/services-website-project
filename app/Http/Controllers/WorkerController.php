<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Order;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    //////REGISTER & LOGIN FUNCTION//////

    // login
    function login(Request $request)
    {
        // check session
        if (session()->has('data')) {
            return redirect('worker/dashboard');
        }

        $email = $request->email;
        $password = $request->login_password;

        $result = Worker::where('email', '=', $email)->where('password', '=', $password)->first();
        if (($result) != Null) {
            $request->session()->put('data', $result);
            return redirect('/worker/dashboard');
        } else {
            return view('worker.login', ["error" => "Invalid input !"]);
        }
    }

    // register
    function register(Request $request)
    {
        // check session
        if (session()->has('data')) {
            return redirect('worker/dashboard');
        }

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $category = $request->category;
        $password = $request->register_password;

        $worker = new Worker();
        $worker->name = $name;
        $worker->email = $email;
        $worker->phone = $phone;
        $worker->address = $address;
        $worker->category = $category;
        $worker->status = "working";
        $worker->password = $password;
        $worker->save();

        if ($worker->id) {
            $request->session()->put('data', $worker);
            return redirect('/worker/dashboard');
        } else {
            return view('worker.login', ["error" => "Invalid input !"]);
        }
    }



    //////PAGES//////

    // login page
    function loginPage()
    {
        // check session
        if (session()->has('data')) {
            return redirect('worker/dashboard');
        } else {
            $workers = Worker::all();
            return view('worker.login', ["workers" => $workers]);
        }
    }

    //  dashboard
    function dashboard()
    {
        // check session
        if (!session()->has('data')) {
            return redirect('worker/login');
        }


        $result = session('data');
        $worker_id = $result->id;
        // total orders
        $total_orders = Order::where('assigned_worker_id', '=', $worker_id)->get();
        // completed orders
        $completed_orders = Order::where('assigned_worker_id', '=', $worker_id)->where('status', '=', 'completed')->get();
        // pending orders
        $pending_orders =
            Order::where('orders.assigned_worker_id', $worker_id)
            ->where('orders.status', '=', 'pending')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.id', 'orders.description', 'orders.date', 'users.name')->get();

        // avg rating
        $avg_rating = 0;
        if (count($completed_orders) > 0) {
            foreach ($completed_orders as $order) {
                $avg_rating += $order->rating;
            }
            $avg_rating = $avg_rating / count($completed_orders);
        }

        return view(
            'worker/dashboard',
            [
                "avg_rating" => $avg_rating,
                "total_orders" => count($total_orders),
                "completed_orders" => count($completed_orders),
                "pending_orders_count" => count($pending_orders),
                "pending_orders" => $pending_orders,
            ]
        );
    }

    // history
    function history()
    {
        // check session
        if (!session()->has('data')) {
            return redirect('worker/login');
        }


        $result = session('data');
        $worker_id = $result->id;

        // pending orders
        $orders =
            Order::where('orders.assigned_worker_id', $worker_id)
            ->where('orders.status', '=', 'completed')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.id', 'orders.rating', 'orders.description', 'orders.date', 'users.name')->get();

        return view('worker/history', ["orders" => $orders]);
    }






    // LOGOUT
    function logout()
    {
        session()->flush();
        return redirect("/worker/login");
    }
}
