<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\ServiceReport;
use App\Models\touchStarEmp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Ramsey\Uuid\Uuid;
use App\Models\touchstarClient;
use Illuminate\Support\Facades\DB;


class ServiceController extends Controller
{
    public function report(){
        $employee_details = touchStarEmp::where('emp_id', Auth::guard('touchstaraccount')->user()->emp_id)->first();
        $machines = Machine::all();
        return view('service.report',compact('employee_details','machines'));
    }

    public function addReport(Request $req){
        $machine_id = $req->machine_id;
        $service_type = $req->service_type;
        $identification = $req->identification;
        $root_cause = $req->root_cause;
        $action_taken = $req->action_taken;
        $equipment_status = $req->equipment_status;
        $recommendations = $req->recommendations;
        $qty = json_decode($req->qty[0]);
        $particulars = json_decode($req->particulars[0]);
        $si_dr_no = json_decode($req->si_dr_no[0]);
        $medtech_signature = $req->medtech_signature;
        $approved_by = $req->approved_by;
        $service_engineer = $req->service_engineer;
        $service_engineer_department = $req->service_engineer_department;
        // $before_images = $req->file('before-images');
        // $after_images = $req->file('after_images');
        $images = $req->file('images');
        // $calibration_images = $req->file('calibration_images');

        $medtech_signature = str_replace("data:image/png;base64,","",$medtech_signature);
        $medtech_signature = str_replace(" ","+",$medtech_signature);

        $medtech_signature_filename = "client/signature/".Uuid::uuid4().".png";
        $medtech_signature = Storage::disk("public")->put($medtech_signature_filename,base64_decode($medtech_signature));

        $part_replaced = [];
        for ($i=0; $i < count($qty); $i++) {
            # code...
            $part = [
                'qty'=>$qty[$i],
                'particulars'=>$particulars[$i],
                'si_dr_no'=>$si_dr_no[$i]
            ];
            array_push($part_replaced, $part);
        }

        $service_images_paths = [];
        if($images != null){
            for ($i=0; $i < count($images); $i++) {
                $path = $images[$i]->store('service_images', 'public');
                array_push($service_images_paths, $path);
            }
        }

        // $before_images_paths = [];
        // if($before_images != null){
        //     for ($i=0; $i < count($before_images); $i++) {
        //         $path = $before_images[$i]->store('before_images', 'public');
        //         array_push($before_images_paths, $path);
        //     }
        // }

        // $after_images_paths = [];
        // if($after_images != null){
        //     for ($i=0; $i < count($after_images); $i++) {
        //         $path = $after_images[$i]->store('after_images', 'public');
        //         array_push($after_images_paths, $path);
        //     }
        // }



        // $calibration_images_paths = [];
        // if($calibration_images != null){
        //     for ($i=0; $i < count($calibration_images); $i++) {
        //         $path = $calibration_images[$i]->store('calibration_images', 'public');
        //         array_push($calibration_images_paths, $path);
        //     }
        // }

        $emp_id = touchStarEmp::where('emp_id',Auth::guard('touchstaraccount')->user()->emp_id)->first();

        $client_id = Machine::where('id',$machine_id)->first();

        ServiceReport::create([
            'client_id' =>$client_id->client_id,
            'machine_id'=>$machine_id,
            'service_type'=>json_encode(collect($service_type)->reject(fn($item)=> $item == null)->all()),
            'identification_verification'=>$identification,
            'root_cause_findings'=>$root_cause,
            'action_taken'=>$action_taken,
            'equipment_status'=>$equipment_status,
            'recommendations'=>$recommendations,
            'parts_replaced'=>json_encode($part_replaced),
            'approved_by'=>$approved_by,
            'medtech_signature'=>$medtech_signature_filename,
            'service_engineer'=>$service_engineer,
            'service_engineer_department'=>$service_engineer_department,
            'service_date'=>now()->format('Y-m-d'),
            'service_images'=>json_encode($service_images_paths),
            // 'before_images'=>json_encode($before_images_paths),
            // 'after_images'=>json_encode($after_images_paths),
            // 'calibration_images'=>json_encode($calibration_images_paths),
            'completed_by_user_id'=>$emp_id->emp_id,
        ]);

        $intervalDay = Machine::where('id',$machine_id)->value('service_interval_days');
        $newServiceDate = now()->addDays($intervalDay);
        Machine::where('id',$machine_id)->update([
            'last_service_date' => now()->format('Y-m-d'),
            'next_service_date' => $newServiceDate->format('Y-m-d'),
            ]);

        Machine::where('id',$machine_id)->update([
            'status' => $equipment_status
        ]);
        return Response()->json(["message"=>200]);
        //return redirect()->route('service.report')->with('success', 'Service report added successfully!');
    }

    // public function history(){
    //     $employee_details = touchStarEmp::where('emp_id', Auth::guard('touchstaraccount')->user()->emp_id)->first();
    //     $service_records = ServiceReport::orderByDesc('id')->offset(0)->limit(250)->get()->all();
    //     $touchstar_client = touchstarClient::all();
    //     $machines = Machine::all();
    //      // Mock data for testing
         
    //     return view('service.history',compact('employee_details','service_records','machines'));
    // }
   
    public function history(Request $request)
        {
            $employee_details = touchStarEmp::where('emp_id', Auth::guard('touchstaraccount')->user()->emp_id)->first();

            $query = ServiceReport::query()
                ->join('machines', 'service_records.machine_id', '=', 'machines.id')
                ->join('touchstarclient', 'service_records.client_id', '=', 'touchstarclient.client_id')
                ->leftJoin('touchstaremployee', 'service_records.completed_by_user_id', '=', 'touchstaremployee.emp_id')
                ->select(
                    'service_records.*',
                    'machines.serial_number',
                    'machines.model as machine_model',
                    'touchstarclient.client_name',
                    'touchstarclient.client_address',
                    \DB::raw("CONCAT(touchstaremployee.emp_first_name, ' ', touchstaremployee.emp_last_name) as completed_by_name")
                );

            $query->when($request->filled('client'), fn($q) => $q->where('touchstarclient.client_name', $request->client));
            $query->when($request->filled('serial'), fn($q) => $q->where('machines.serial_number', 'like', '%' . trim($request->serial) . '%'));
            $query->when($request->filled('location'), fn($q) => $q->where('machines.client_location', $request->location));
            $query->when($request->filled('service_type'), fn($q) => $q->where('service_records.service_type', $request->service_type));
            $query->when($request->filled('date_from'), fn($q) => $q->whereDate('service_records.service_date', '>=', $request->date_from));
            $query->when($request->filled('date_to'), fn($q) => $q->whereDate('service_records.service_date', '<=', $request->date_to));
            $query->when($request->filled('engineer'), fn($q) => $q->where('service_records.service_engineer', $request->engineer));
            $query->when($request->filled('eq_status'), fn($q) => $q->where('service_records.equipment_status', $request->eq_status));
            $query->when($request->filled('keyword'), function ($q) use ($request) {
                $keyword = trim($request->keyword);
                $q->where(function ($sub) use ($keyword) {
                    $sub->where('service_records.root_cause_findings', 'like', "%{$keyword}%")
                        ->orWhere('service_records.action_taken', 'like', "%{$keyword}%")
                        ->orWhere('service_records.recommendations', 'like', "%{$keyword}%");
                });
            });

            $service_records = $query->orderByDesc('service_records.id')
                ->limit(250)
                ->get();

            $machines = Machine::all();

            return view('service.history', compact('employee_details', 'service_records', 'machines'));
        }
    
}
