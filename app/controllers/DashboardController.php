<?php
require_once __DIR__ . '/../models/User.php';

class DashboardController {
    public static function index($userId) {
        require_once __DIR__ . '/../models/User.php';
        $user = User::find($userId);
        require_once __DIR__ . '/../views/dashboard/index.php';
    }

    public static function orders($userId) {
        require_once __DIR__ . '/../models/Order.php';
        $orders = Order::getByUser($userId);
        require_once __DIR__ . '/../views/dashboard/orders.php';
    }

    public static function gallery($userId) {
        require_once __DIR__ . '/../models/User.php';
        $images = User::getImages($userId);
        require_once __DIR__ . '/../views/dashboard/gallery.php';
    }

    public static function messages($userId) {
        require_once __DIR__ . '/../models/Message.php';
        $messages = Message::getByUser($userId);
        require_once __DIR__ . '/../views/dashboard/messages.php';
    }
}
