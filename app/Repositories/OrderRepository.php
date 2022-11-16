<?php

namespace App\Repositories;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Contracts\OrderContract;
use Illuminate\Http\Request;
use Cart;

class OrderRepository implements OrderContract
{
    protected $model;
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function storeOrderDetails($params )
    {
        //declaration des variables 
        $items =session()->get('basket');
        $total = 0;//total des prix *qte des produits qui sont dans le panier
        $countquantity = 0;//total des quantites des produits qui sont dans le panier
        //produit1=price * quantity + ....
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
            $countquantity += $item['quantity'];//qt1+qt2+qt3+...
        }
        $order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'user_id'           => auth()->user()->id,
            'status'            =>  'pending',
            'grand_total'       =>  $total,
            'item_count'        =>  $countquantity,
            'payment_status'    =>  0,
            'payment_method'    =>  null,
            'first_name'        =>  $params['first_name'],
            'last_name'         =>  $params['last_name'],
            'address'           =>  $params['address'],
            'city'              =>  $params['city'],
            'country'           =>  $params['country'],
            'post_code'         =>  $params['post_code'],
            'phone_number'      =>  $params['phone_number'],
            'notes'             =>  $params['notes']
        ]);
    //appelation des models q'on va utiliser , on les affecte a une variable
          $orders = Order::all();
          $products = Product::all();
          $order_item = new OrderItem;
        foreach ($orders as $order) {
            $item = new OrderItem;
            $total = $item['price'] * $item['quantity'];
            $item_quantity = $item['quantity'];
            $order_item->order_id = $order->id;
            foreach ($products as $product) {
            $order_item->product_id = $product['id'];
            $order_item->price = $product['price'];
            $order_item->quantity = $order->item_count ;
            }
            $order_item->save();
        }
    
        return $order;
    }
}