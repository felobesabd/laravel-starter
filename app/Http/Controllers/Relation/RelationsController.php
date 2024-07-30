<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation(Request $request) {
//        return var_dump($request->user()->id);
        $user = User::with(
            ['phone' => function($q) {
                $q->select('code', 'phone', 'user_id');
            }]
        )->find($request->user()->id);

        return response()->json($user);
    }

    public function hasOneReverseRelation(Request $request) {
        $phone = Phone::with(
            ['user' => function($q) {
                $q->select('id', 'name');
            }]
        )->find(1);

        // make visible user_id
        $phone->makeVisible('user_id');
        // make hidden code
        $phone->makeHidden('code');

        return response()->json($phone);
    }

    public function getUsersPhones()
    {
        // return User::whereHas('phone')->get();
         return User::whereHas(
             'phone', function($q) {
                 $q->where('code', '02');
             }
         )->get();
    }

    public function getUsersNotPhones()
    {
        return User::whereDoesntHave('phone')->get();
    }

/************************************* Start Relations One-Many ***************************************/
    public function hasManyRelation() {
        $hospital = Hospital::with('doctor')->find(1);
        $doctors = $hospital->doctor;

        // return $doctors;
//        foreach ($doctors as $doctor) {
//            echo $doctor->name.'<br>';
//        }

        $doctor = Doctor::find(3);
        return $doctor->hospital;

        // return response()->json($hospital);
    }

    public function hospitals() {
        $hospitals = Hospital::select('id', 'name', 'address')->get();
        return view('relation.hospital', compact('hospitals'));
    }

    public function doctors($hospital_id) {
        $hospitals = Hospital::find($hospital_id);
        $doctors = $hospitals->doctor;

        return view('relation.doctor', compact('doctors'));
    }

    public function getHospitalsHaveDoctors()
    {
        return Hospital::whereHas('doctor')->get();
    }

    public function getMaleDoctors()
    {
        return Hospital::with(
            ['doctor' => function($q) {
                $q->where('gender', 1);
            }
        ])->whereHas('doctor')->get();
    }

    public function getHospitalsNotHaveDoctors()
    {
        return Hospital::whereDoesntHave('doctor')->get();
    }
/************************************* End Relations One-Many *****************************************/

/************************************* Start Relations Many-Many **************************************/
    public function getDoctorServices($doctor_id) {
        // $doctorServices = Doctor::with('services')->find(5);
        $doctor = Doctor::find($doctor_id);
        $services = $doctor->services; //doctor services

        $doctors = Doctor::select('id', 'name')->get();
        $allServices = Service::select('id', 'name')->get(); // all db serves

        return view('relation.service', compact('services', 'doctors', 'allServices'));
    }

    public function getServiceDoctors() {
        $serviceDoctors = Service::with(
            ['doctors' => function($q) {
                $q->select('doctors.id', 'name');
            }]
        )->find(1);

        return response()->json($serviceDoctors);
    }

    public function createDoctorServices(Request $request) {
         $doctor = Doctor::find($request->doctor_id);
         if (!$doctor) {
             return abort('404');
         }

        // $doctor->services()->attach($request->servicesIds); // An addition even if the selected items already exist db

        // $doctor->services()->sync($request->servicesIds); // update items (must addition old items and new items every one)

        $doctor->services()->syncWithoutDetaching($request->servicesIds);

        return redirect()->back()->with(['success' => __('offer.success')]);
    }
/************************************* End Relations Many-Many ****************************************/

/************************************* Start Relations has-one-through **************************************/
    public function getPatientDoctor()
    {
        $patient = Patient::with('doctor')->find(1);
        return $patient;
    }
/************************************* End Relations has-one-through ****************************************/

/************************************* Start Accessors&Mutators *********************************************/
    public function getDoctors() {
        return $doctors = Doctor::select('id', 'name', 'gender')->get();
        /* if (isset($doctors) && $doctors->count() > 0) {
             foreach ($doctors as $doctor) {

                 $doctor->gender = $doctor->gender == 1 ? 'male' : 'female';
                 // $doctor -> newVal = 'new';
             }
         }
         return $doctors;*/
    }
/************************************* End Accessors&Mutators ***********************************************/
}
