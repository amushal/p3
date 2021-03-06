<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

# Used for Testing
//use DebugBar;
//use Log;

class CostController extends Controller
{

    private $methods = [
        '0' => 'Free',
        '9.95' => 'Standard: 1 Week $9.95',
        '29.95' => 'Expedite: 2nd day $29.95'
    ];

    public function index()
    {
        return view('cost')->with([
            'shipType' => '',
            'taxRate' => 0,
            'monthly' => 0,
            'total' => 0,
            'methods' => $this->methods
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
        );

        # Get the Form data need for calculation
        $email = $request->get('email');
        $price = $request->get('price');
        $quantity = $request->get('quantity');
        $tax = (float)$request->get('tax');
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

        $taxRate = 0;
        // Determine the tax:
        if ($tax != 0) {
            $taxRate = ($tax / 100) + 1;
            $total = $total * $taxRate;
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

        $shipType = '';
        if ($shipping == '0')
            $shipType = 'Free';
        else if ($shipping == '9.95')
            $shipType = 'Standard: 1 Week $9.95';
        else if ($shipping == '29.95')
            $shipType = 'Expedite: 2nd day $29.95';

        $request->flash();

        if ($request->hasErrors) {
            return redirect('/')->withErrors($errors);
        }

        return view('cost')->with([
            'shipType' => $shipType,
            'taxRate' => $taxRate,
            'monthly' => $monthly,
            'total' => $total,
            'methods' => $this->methods
        ]);
    }
}
