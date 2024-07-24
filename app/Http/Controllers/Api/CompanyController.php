<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\NewUserWelcomeMail;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CompanyResource::collection(Company::all());
    }

    /**
     * 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required',
            'address' => 'required',
            'website' => 'required',
        ]);
        $company = Company::create($validator->validated());
        dispatch(new NewUserWelcomeMail($company));
        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required',
            'address' => 'required',
            'website' => 'required',
        ]);
        $company->update($validator->validated());
        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response()->noContent();
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function formSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'file' => 'required',
        ]);
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);
        return response()->json(['success' => 'You have successfully upload file.']);
    }


    /**
     * TODO:
     * 
     * FIXME:
     * 
     * HACK:
     * 
     * NOTE:
     * 
     * DONE:
     * 
     * DETAILS:
     * 
     * The function `testComp` validates a request for a name and file, moves the uploaded file to a
     * specific directory, and returns a success message in JSON format.
     * 
     * @param Request request The `Request ` parameter in the `testComp` function is an
     * instance of the `Illuminate\Http\Request` class in Laravel. It represents an HTTP request that
     * is sent to the server.
     * 
     * @return A JSON response with the message 'You have successfully uploaded file.' is being
     * returned.
     */
    public function testComp(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'file' => 'required',
        ]);
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);
        return response()->json(['success' => 'You have successfully upload file.']);
    }


    public function exportFile(Request $request)
    {

        // // Create an array of elements 
        // $filePath = public_path("notifications.csv");
        // // Open a file in write mode ('w') 
        // $fp = fopen($filePath, 'w');

        // $chunk = 20;
        // $chunkNum = 1;
        // DB::table('notifications_test')->orderBy('notifications_test.userid')->chunk($chunk, function ($records) use ($chunk, $chunkNum) {
        //     foreach ($records as $key => $data) {
        //         // Create an array of elements 
        //         // $filePath = public_path("notifications/notifications_" . $key . ".csv");
        //         $filePath = public_path("notifications/notifications.csv");
        //         // Open a file in write mode ('w') 
        //         $fp = fopen($filePath, 'w');
        //         chmod($filePath, 0777);
        //         fputcsv($fp, (array) $data);
        //     }
        //     // fclose($fp);
        // });

        // die();
        // $filename = "gst_report.csv";
        // $fp = fopen('php://output', 'w');

        // $header = ['id','userid','title','message','seen','is_sent','created_at','updated_at'];
        // header('Content-type: application/csv');
        // header('Content-Disposition: attachment; filename=' . $filename);
        // fputcsv($fp, $header);

        // Create an array of elements 
        $filePath = public_path("notifications/notifications.csv");

        // Open a file in write mode ('w') 
        $fp = fopen(public_path("notifications/notifications.csv"), 'w');
        chmod($filePath, 0777);

        // Loop through file pointer and a line 
        fputcsv($fp, array_values(['id', 'userid', 'title', 'message', 'seen', 'is_sent', 'created_at', 'updated_at']));
        DB::table('notifications_test')->orderBy('notifications_test.userid')->chunk(500, function ($records) use ($fp) {
            foreach ($records as $data) {
                fputcsv($fp, (array) $data);
            }
        });

        fclose($fp);

        // For CSV Download.
        $headers = ['Content-Type: application/csv'];
        // New Name for downloaded file. non playing team
        $newName = 'notifications-' . date('Y-m-d') . '.csv';

        // Create a Job Here In which we can Attach the exported file and Send an Email.
        die("--------");

        DB::table('notifications_test')->orderBy('notifications_test.userid')->chunk(50, function ($records) use ($fp) {
            foreach ($records as $data) {
                fputcsv($fp, $data);
                print_r($data);
                echo "<hr/>";
            }
        });


        die();
        // Chunk
        // Execution time of script = 110.24235606194 sec
        // Good if fetching data/Records in millions.
        $start_time = microtime(true);
        DB::table('notifications_test')->orderBy('notifications_test.userid')->chunk(50, function ($records) {
            foreach ($records as $data) {
                print_r($data);
                echo "<hr/>";
            }
        });
        // End clock time in seconds 
        $end_time = microtime(true);
        // Calculate script execution time 
        $execution_time = ($end_time - $start_time);
        echo " Execution time of script = " . $execution_time . " sec";
        die(" - For Chunking Results - ");


        // Execution time of script = 0.58281397819519 sec
        // If Records are fixed.
        $start_time = microtime(true);
        $query = DB::table('notifications_test')->orderBy('notifications_test.userid');
        // Cursor
        $i = 1;
        foreach ($query->cursor() as $data) {
            echo $i . " : ";
            print_r($data);
            echo "<hr/>";
            $i++;
        }
        // End clock time in seconds 
        $end_time = microtime(true);

        // Calculate script execution time 
        $execution_time = ($end_time - $start_time);

        echo " Execution time of script = " . $execution_time . " sec";
        die(" - For Cursor Results - ");
    }
}
