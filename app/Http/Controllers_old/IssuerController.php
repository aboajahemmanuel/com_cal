<?php

namespace App\Http\Controllers;

use App\Models\Issuer;
use Illuminate\Http\Request;
use App\Imports\IssuerImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class IssuerController extends Controller
{
    public function index(Request $request)
    {
        $data = Issuer::all();
        return view('issuers.index', compact('data'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'pdfFile' => 'required|file|mimes:pdf|max:20480', // 20MB
        ]);

        if ($request->hasFile('pdfFile')) {
            $pdf = $request->file('pdfFile');
            $originalFilename = $pdf->getClientOriginalName();
            $filename = pathinfo($originalFilename, PATHINFO_FILENAME) . '-' . time() . '.' . $pdf->getClientOriginalExtension();

            $pdf->move(public_path('upload_file'), $filename);

            // Save the filename to the database
            $file = new Issuer();
            $file->name = $filename;  // You could also choose to store the $originalFilename if you prefer
            $file->save();

            return back()->with('success', 'File uploaded successfully and saved to database.');
        }

        return back()->with('error', 'Failed to upload file.');
    }







    public function destroy($id)
    {
        Issuer::find($id)->delete();

        return redirect()->back()->with('success', 'Issuer  deleted  successfully.');
    }





    // public function importExcel(Request $request)
    // {
    //     try {
    //         Excel::import(new IssuerImport, $request->file('security_import_file'));
    //         return redirect()->back()->with('success', 'Imported Successfully');
    //     } catch (ValidationException $ex) {
    //         // Handle validation errors
    //         return redirect()->back()->withErrors($ex->errors());
    //     } catch (\Exception $ex) {
    //         // Handle other exceptions
    //         return redirect()->back()->with('message', 'Something went wrong. Please check the file and try again.');
    //     }
    // }
}
