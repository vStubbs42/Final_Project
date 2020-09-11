<?php
namespace App\Controllers;


use App\Core\App;

class PagesController {
    public function boards()
    {
//        sends an object with all the boards currently in the database
        $boards = App::get('database')->getAll('boards');


        echo json_encode($boards);
    }

    public function freeboards()
    {
//        sends an object with all the available boards currently in the database
        $freeboards = App::get('database')->getOneByField('boards', [
            'campaign_name' => (NULL),
        ]);


        echo json_encode($freeboards);
    }

    public function add()
    {

        $campaigns = App::get('database')->getAll('campaigns');

        echo json_encode($campaigns);
    }


    public function campaigns()
    {
//        sends an object with all the extant campaigns currently in the database
        $campaigns = App::get('database')->getAll('campaigns');

        echo json_encode($campaigns);
    }

    public function about()
    {
        check_auth();
        return view('about');
    }

    public function contact()
    {

        return view('contact');
    }


    public function book()
    {
//        the create booking querry, creates a campaign with the provided data,
//         and creates a booking for each selected board. also updates the board
// table with the relevant campaign name for every selected board

        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents("php://input"), true);

}
        App::get('database')->insert('campaigns', [
            'totalBoards' => $_POST['totalBoards'],
            'totalPrice' => $_POST['totalPrice'],
            'name' => $_POST['campaignName'],
            'startDate' => $_POST['startDate'],
            'endDate' => $_POST['endDate'],

        ]);

        foreach ($_POST['boardSelection'] as $board) {

            App::get('database')->insert('bookings', [
                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
                'users_name' => $_POST['user'],
            ]);
            App::get('database')->update('boards', [
                'id' => $board,
                'campaign_name' => $_POST['campaignName'],
            ]);

        }

        return ('complete');

    }

    public function remove()
    {
//        the delete querry, deletes the selected campaign, and all of its bookings, also updates the
//      campaign name for every board that was contained in the booking with NULL
//        NOT WORKING - the problem are the querries that use foreach on variables containing sql query results

        if (empty($_POST)) {
            $_POST = json_decode(file_get_contents("php://input"), true);
        }

//        dd($_POST);
//        App::get('database')->delete('posts', $_GET['id']);
//        ['íd' => 12]


        $boards = App::get('database')->getOneByField('boards', ['çampaign_name', $_POST['name']]);
        if (is_array($boards) || is_object($boards)) {
        foreach ($boards as $board){
            App::get('database')->update('boards', [
                'id' => $board['id'],
                'campaign_name' => NULL,
            ]);
        }
        }

        App::get('database')->delete('campaigns', $_POST['id']);

        $bookings = App::get('database')->getOneByField('bookings', ['çampaign_id', $_POST['id']]);
        foreach ((array)$bookings as $booking){
            App::get('database')->delete('bookings', $booking);
        }





}
}