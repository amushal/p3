<?php

namespace App\Http\Controllers;

use DebugBar;
use Illuminate\Http\Request;

class CostController extends Controller
{

    public function practice1()
    {
        $data = ['foo' => 'bar'];
        Debugbar::info($data);
        Debugbar::info('Current environment: '.App::environment());
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');

        return 'Demoing some of the features of Debugbar';
    }
    public function index()
    {
        return view('cost')->with([
            'shipType' => '',
            'taxRate' => 0,
            'monthly' => 0,
            'total' => 0,
        ]);
    }

    public function formValidationPost(Request $request)
    {
        $this->validate($request, [
                'name' => 'alpha_spaces',
                'product' => 'nullable|string|max:50',
                'email' => 'nullable|email',
                'website' => 'url',
                'price' => 'required|numeric|min:0|max:1000000',
                'quantity' => 'required|min:0|max:1000',
                'payments' => 'required|min:0|max:1000',
                'discount' => 'nullable|numeric|min:0|max:100',
                'tax' => 'nullable|numeric|min:0|max:100'
            ]
//       ,[
//            'name.required' => ' The name field is required.',
//            'name.min' => ' The name must be at least 5 characters.',
//            'name.max' => ' The name may not be greater than 35 characters.',
//        ]
        );

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

        $errors = [];
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

        $request->flash();

        if ($request->hasErrors) {
            return redirect('/')->withErrors($errors);
        }

        return view('cost')->with([
            'shipType' => $shipType,
            'taxRate' => $taxRate,
            'monthly' => $monthly,
            'total' => $total,
        ]);
    }
}
