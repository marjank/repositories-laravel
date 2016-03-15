<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\AdminRepositoryInterface;

class AdminController extends Controller
{
    public function __construct(
        AdminRepositoryInterface $admin
    ) {
        $this->admin = $admin;
    }

    public function getIndex()
    {
        // Fetch the data
        $admins = $this->admin->allAdmins();

        // Return the view with the admins collection
        return view('welcome', ['admins' => $admins]);
    }

    public function postCreateAdmin(Request $request)
    {
        // Save the data
        $created = $this->admin->createAdmin($request->all());

        // Check if storing went through
        if ($created) {
            // If the admin was created, redirect with a success message
            return Redirect::route('get-index')->with('success', 'The admin has been saved successfully');
        } else {
            // Else redirect with an error message
            return Redirect::route('get-index')->with('error', 'There was an error while saving the admin');
        }
    }
}
