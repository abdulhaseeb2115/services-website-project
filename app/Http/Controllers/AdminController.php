<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Worker;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    ////DASHBOARD////

    function dashboard()
    {
        // variables & arrays
        $categories = Category::all();
        $orders = Order::all();
        $categories1 = [];
        $category_orders = [];
        $month_orders = [];
        $month_orders_cancel = [];
        $no_of_workers = [];
        $category_feedback_avg = [];

        // orders per category
        foreach ($categories as $ctg) {
            $count = 0;
            foreach ($orders as $ord) {
                if ($ord->service == $ctg->name) {
                    $count++;
                }
            }
            array_push($categories1, $ctg->name);
            array_push($category_orders, $count);
        }

        //orders completed per month
        for ($i = 1; $i <= 12; $i++) {
            $complete = 0;
            $cancel = 0;
            foreach ($orders as $ord) {
                $month = date("m", strtotime($ord->date));
                if ($ord->status == "completed") {
                    if ((int)$month == $i) {
                        $complete++;
                    }
                } else if ($ord->status == "cancelled") {
                    if ((int)$month == $i) {
                        $cancel++;
                    }
                }
            }
            array_push($month_orders, $complete);
            array_push($month_orders_cancel, $cancel);
        }

        // no of service providers
        foreach ($categories1 as $ctg) {
            $count = count(Worker::where("category", "=", $ctg)->get());
            array_push($no_of_workers, $count);
        }

        // category feedback average
        foreach ($categories1 as $ctg) {
            $sum = 0;
            $count = 0;
            foreach ($orders as $odr) {
                if ($odr->service == $ctg) {
                    $sum += $odr->rating;
                    $count++;
                }
            }
            if ($count != 0) {
                $avg = ($sum / $count);
                array_push($category_feedback_avg, $avg);
            } else {
                array_push($category_feedback_avg, 0);
            }
        }


        // total values
        $total_users = count(User::all());
        $total_orders = count(Order::all());
        $orders_completed = count(DB::table('orders')->where('status', '=', 'completed')->get());
        $orders_cancelled = count(DB::table('orders')->where('status', '=', 'cancelled')->get());


        // return
        return view('admin.dashboard', [
            "categories" => $categories1,
            "category_orders" => $category_orders,
            "month_orders" => $month_orders,
            "total_users" => $total_users,
            "total_orders" => $total_orders,
            "orders_completed" => $orders_completed,
            "orders_cancelled" => $orders_cancelled,
            "no_of_workers" => $no_of_workers,
            "month_orders_cancelled" => $month_orders_cancel,
            "category_feedback_avg" => $category_feedback_avg,
        ]);
    }





    ////WORKER PAGE////

    function workers()
    {
        $categories = DB::select('select * from categories');
        return view('admin.workers', ['categories' => $categories]);
    }

    function addWorker(Request $request)
    {
        $name = $request->input("name");
        $email = $request->input("email");
        $phone = $request->input("phone");
        $address = $request->input("address");
        $category = $request->input("category");

        // DB::insert(`INSERT INTO workers("name", "email", "phone", "address", "category") VALUES ($name,$email,$phone,$address,$category)`);

        $values = array('name' => $name, 'email' => $email, 'phone' => $phone, 'address' => $address, 'category' => $category);
        DB::table('workers')->insert($values);

        return $this->workers();
    }

    function getWorker(Request $request)
    {
        $id = $request->input("searchId");
        $workerData = DB::select('select * from workers where id = ' . $id . '  limit 1');
        $categories = DB::select('select * from categories');
        return view('admin.workers', ['categories' => $categories, 'workerData' => $workerData]);
    }

    function suspendWorker()
    {
    }



    ////CATEGORY PAGE////

    // category
    function category()
    {
        return view("admin.category");
    }

    // add category
    function addCategory(Request $request)
    {
        $name = $request->input("name");
        $description = $request->input("description");

        $values = array('name' => $name, 'description' => $description);
        DB::table('categories')->insert($values);

        return $this->category();
    }





    ////REQUEST PAGE////

    //get requests
    function requests()
    {
        // pending orders
        $orders =
            Order::where('orders.status', '=', 'pending')
            ->where('orders.assigned_worker_id', '=', 0)
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.id', 'orders.rating', 'orders.description', 'orders.date', 'users.name', 'orders.service')->get();

        $workers = Worker::all();
        return view('admin/requests', ["requests" => $orders, "workers" => $workers]);
    }

    // cancel requests
    function cancelRequest(Request $request)
    {
        $order_id = $request->order_id;
        Order::where('id', $order_id)
            ->update(['status' => "cancelled"]);

        return redirect("/requests");
    }

    // approve requests
    function approveRequest(Request $request)
    {

        $order_id = $request->order_id;
        $worker_id = $request->worker_id;
        Order::where('id', $order_id)
            ->update(['assigned_worker_id' => $worker_id]);

        return redirect("/requests");
    }

    ////FEEDBACK PAGE//// 

    // get feedbacks
    function feedbacks()
    {
        // simple query
        $feedbacks = DB::select('select * from orders join users on orders.user_id=users.id where status="completed"');

        return view('admin.feedbacks', ['feedbacks' => $feedbacks]);
    }
}
