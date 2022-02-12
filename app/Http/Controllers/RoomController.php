<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Models\Room;
use App\Models\RoomStatus;
use App\Models\Transaction;
use App\Models\Type;
use App\Repositories\ImageRepository;
use App\Repositories\RoomRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;
use DB;
class RoomController extends Controller
{
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }
    public function index(Request $request)
    {
        $rooms = $this->roomRepository->getRooms($request);
        DB::table('rooms')->where('room_status_id', 2)->update(['room_status_id' => 1]);
        foreach($rooms as $room){
            $transaction = Transaction::where([['check_in', '<=', Carbon::now()], ['check_out', '>=', Carbon::now()], ['room_id', $room->id]])->first();
            if($transaction){
                $_room = Room::find($room->id);
                $_room->room_status_id = 2;
                $room->room_status_id = 2;
                $_room->save();    
            }
            
        }
        return view('room.index', compact('rooms'));
    }

    public function create()
    {
        $types = Type::all();
        $roomstatuses = RoomStatus::where('id', '<>', 2)->get();
        return view('room.create', compact('types', 'roomstatuses'));
    }

    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->all());
        return redirect()->route('room.index')->with('success', 'Room ' . $room->number . ' created');
    }

    public function show(Room $room)
    {
        $customer = [];
        $transaction = Transaction::where([['check_in', '<=', Carbon::now()], ['check_out', '>=', Carbon::now()], ['room_id', $room->id]])->first();
        if(!empty($transaction)) {
            $customer = $transaction->customer;
        }
        $roomstatuses = RoomStatus::where('id', '>', 2)->get();
        return view('room.show', compact('customer', 'room', 'roomstatuses'));
    }

    public function edit(Room $room)
    {
        $types = Type::all();
        $roomstatuses = RoomStatus::where('id', $room->room_status_id)->get();
        return view('room.edit', compact('room', 'types', 'roomstatuses'));
    }

    public function update(Room $room, StoreRoomRequest $request)
    {
        $room->update($request->all());
        return redirect()->route('room.index')->with('success', 'Room ' . $room->name . ' udpated!');
    }

    public function destroy(Room $room, ImageRepository $imageRepository)
    {
        try {
            $room->delete();

            $path = 'img/room/' . $room->number;
            $path = public_path($path);

            if (is_dir($path)) {
                $imageRepository->destroy($path);
            }

            return redirect()->route('room.index')->with('success', 'Room number ' . $room->number . ' deleted!');
        } catch (\Exception $e) {
            return redirect()->route('room.index')->with('failed', 'Customer ' . $room->number . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);
        }
    }


    public function status($id, $status)
    {
        $room = Room::findOrFail($id);
        $room->room_status_id = $status;
        $room->save();
        return $room;
    }

    public function search(Request $request){
        $rooms = Room::where('id', '>', 0);
         
        if($request->capacity){
            $rooms->where('capacity', '>=', $request->capacity);
        }
        $transactions = null;
        if($request->check_in && $request->check_out){
            $check_in = $request->check_in;
            $check_out = $request->check_out;
            $transactions = Transaction::where(function($query) use ($check_in, $check_out){
                $query->where('check_in', '<=', $check_in)->where('check_out', '<=', $check_in);
            });
            
            $transactions->orWhere(function($query) use ($check_in, $check_out){
                $query->where('check_in', '<=', $check_out)->where('check_out', '>=', $check_out); 
            });
            
            $transactions = $transactions->get()->keyBy('room_id');
        }
        $rooms = $rooms->paginate(50);
        
        if($transactions){
            foreach($rooms as $key => $item){
                if(isset($transactions[$item->id])){
                    unset($rooms[$key]);
                }
            }    
        }
        return view('room.index', compact('rooms'));

    }
}
