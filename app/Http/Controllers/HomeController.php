<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * GET /books
     */
//    public function index()
//    {
//        return 'Cost input Form goes here...';
//    }

    public function index()
    {
        //return view('form');
        return view('form')->with([
            'shipType'=>'',
            'taxRate'=>0,
            'monthly'=>0,
            'total' => 0,
        ]);
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function about()
    {
        return 'This is information about Foobooks';
    }

    public function contact()
    {
        return 'Questions? Email us at ' . Config::get('app.supportEmail');
    }

    public function formValidationPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'alpha',
            'product' => 'alpha_num|max:25',
            'email' => 'email',
            'website' => 'url',
            'price' => 'required|numeric|min:0|max:1000000',
            'quantity' => 'required|min:0|max:1000',
            'payments' => 'required|min:0|max:1000',
            'discount' => 'min:0|max:100',
            'tax' => 'min:0|max:100'
        ], [
            'name.required' => ' The name field is required.',
            'name.min' => ' The name must be at least 5 characters.',
            'name.max' => ' The name may not be greater than 35 characters.',
            // 'lastname.required' => ' The last name field is required.',
            // 'lastname.min' => ' The last name must be at least 5 characters.',
            // 'lastname.max' => ' The last name may not be greater than 35 characters.',
        ]);

        # Init
        $taxRate = 0;
        $shipType = '';
        $monthly = 0;
        $total = 0;

        # Get the Form data need for calculation
        $email = $request->get('email');
        $price = $request->get('price');
        $quantity = $request->get('quantity');
        $tax = $request->get('tax');
        $discount = (float)$request->get('discount');
        $discountType = $request->get('discountType');
        $payments = $request->get('payments');
        $shipping = $request->get('shipping');
        $emailMe = $request->has('emailMe');

        // Calculate the total:
        $total = $price * $quantity;
        $total = $total + (float)$shipping;

        // Factor discount amount based on selected type (discountType or Dollar value)
        if ($discountType == '%') {
            $total = $total * (1 - $discount / 100);
        } else {
            $total = $total - $discount;
        }

        // Determine the tax:
        if ($tax == '') {
            $tax = 'no Tax';
        } else {
            $taxRate = ($tax / 100) + 1;
            $total = $total * $taxRate;
            $tax = $tax . '%';
        }

        $errors = "";
        // Will not allow negative results at runtime
        if ($total < 0) {
            array_push($errors, '"Total" result cannot be less than 0.');
        }

        // Check if send via email is requested without an email address
        if ($emailMe && $email == '') {
            array_push($errors, '"Email" was not provided. Please uncheck "Send me the results" or input email.');
        }

        // Check if send via email is requested without an email address
        if ($discount > 0 && !$discountType) {
            array_push($errors, '"Discount type" was not specified.');
        }

        //raise exception
        if (count($errors) > 0)
            $request->hasErrors = true;

        // Calculate the monthly payments:
        $monthly = $total / $payments;

        if ($shipping == '0')
            $shipType = 'Free / Pickup';
        else if ($shipping == '9.95')
            $shipType = 'Standard: 1 Week $9.95';
        else if ($shipping == '29.95')
            $shipType = 'Expedite: 2nd day $29.95';
        else {
            $shipType = 'Not selected';
            $shipping = '';
        }

        //return view('form', array('discount' => $discount));

        //return redirect('form')->withInput();

        return view('form')->with([
            'shipType'=>$shipType,
            'taxRate'=>$discountType,
            'monthly'=>$monthly,
            'total' => $total,
        ]);
        //$car = Car::find($id);
        //return view('cars.show', array('car' => $car));

    }

    function format($value)
    {
        return '$' . number_format($value, 2, '.', ',');
    }


}
