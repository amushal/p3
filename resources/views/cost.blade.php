@extends('layouts.master')

@section('content')

    <div class="col-md-4 order-md-2 mb-4">

        @if ($errors->any())
            <h4 class="alert alert-danger d-flex justify-content-between align-items-center mb-3">
                <strong>Invalid input</strong>
                <span class="badge badge-secondary badge-pill">{{ count($errors) }}</span>
            </h4>
            <ul class="list-group alert-danger">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item">{{ $error }}</li>
                @endforeach
            </ul>

        @else
            @if (Request::isMethod('post'))
                <h4 class="alert alert-success d-flex justify-content-between align-items-center mb-3">
                    <strong>Result</strong>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Name</h6>
                        </div>
                        <span class="text-muted">{{ old('name') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Email</h6>
                        </div>
                        <span class="text-muted">{{ old('email') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Product Name</h6>
                        </div>
                        <span class="text-muted">{{ old('product') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Price</h6>
                        </div>
                        <span class="text-muted">{{ @'$' . number_format(old('price'), 2, '.', ',') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Quantity</h6>
                        </div>
                        <span class="text-muted">{{ old('quantity') }}</span>
                    </li>

                    @if (old('discount') != 0)

                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Discount</h6>
                            </div>
                            <span class="text-success">{{ round(old('discount'), 2) }}
                                <small>{{ old('discountType') }}</small>
                                </span>
                        </li>

                    @endif

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Tax</h6>
                            <small>{{ old('tax') }}</small>

                        </div>
                        <span class="text-muted">{{ $taxRate }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Shipping</h6>
                            <small>{{ $shipType }}</small>
                        </div>

                        @if (old('shipping') != 0)
                            <span class="text-muted">{{ old('shipping') }}</span>
                        @endif

                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Number of payments</h6>
                        </div>
                        <span class="text-muted">{{ old('payments') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>{{ @'$' . number_format($total, 2, '.', ',') }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Monthly payments</span>
                        <strong>{{ @'$' . number_format($monthly, 2, '.', ',') }}</strong>
                    </li>

                    @if (old('emailMe'))
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Will send the results at a later time</h6>
                            </div>
                        </li>
                    @endif


                </ul>
            @endif
        @endif
    </div>


    <div class="col-md-8 order-md-1">

        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Please provide the requested information:</span>
        </h4>

        <hr class="mb-4">

        <form method='POST' action='/'>

            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text"
                               class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               placeholder="Enter your name"
                               id="name"
                               name="name"
                               value="{{ old('name') }}">
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email"
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : ''  }}"
                           id="email"
                           name="email"
                           aria-describedby="emailHelp"
                           placeholder="you@example.com"
                           value="{{ old('email') }}">

                    <small id="emailHelp"
                           class="form-text text-muted">if you like us to email you the result.
                    </small>
                </div>
            </div>

            <div class="mb-3">
                <label for="product">Product Name <span class="text-muted">(Optional)</span></label>
                <input type="text"
                       class="form-control {{ $errors->has('product') ? 'is-invalid' : '' }}"
                       id="product"
                       name="product"
                       placeholder="Enter a product name"
                       value="{{ old('product') }}">
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="price">Price </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text"
                               class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                               id="price"
                               name="price"
                               placeholder="Price in US Dollar"
                               value="{{ old('price') }}">
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="quantity">Quantity</label>
                    <input type="number"
                           class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}"
                           placeholder="Quantity"
                           id="quantity"
                           name="quantity"
                           value="{{ old('quantity') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="payments">Payments</label>
                    <input type="number"
                           class="form-control {{ $errors->has('payments') ? 'is-invalid' : '' }}"
                           placeholder="Payments"
                           id="payments"
                           name="payments"
                           value="{{ old('payments') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="discount">Discount <span class="text-muted">(Optional)</span></label>
                    <input type="text"
                           class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                           placeholder="Discount"
                           id="discount"
                           name="discount"
                           value="{{ old('discount') }}">
                </div>

                <div class="col-md-6 mb-3 custom-control custom-checkbox">
                    <fieldset class='radios'>
                        <label for="discountType">Discount Type </label><br>
                        <label><input type='radio'
                                      id="discountType"
                                      name='discountType'
                                      value='%' {{ (old('discountType') == '%') ? 'checked' : null }}>&nbsp;Percent</label>&nbsp;&nbsp;&nbsp;
                        <label><input type='radio'
                                      name='discountType'
                                      value='USD OFF' {{ (old('discountType') == 'USD OFF') ? 'checked' : null }}>&nbsp;USD OFF</label>
                    </fieldset>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tax">Tax <span class="text-muted">(Optional)</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">%</span>
                        </div>
                        <input type="text"
                               class="form-control"
                               id="tax"
                               name="tax"
                               placeholder="Tax amount"
                               value=''>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="shipping">Shipping</label>
                    <select class="custom-select d-block w-100" id="shipping" name="shipping">
                        <option value="" {{ (old('shipping') == '') ? 'selected' : null }}>Choose one...</option>
                        <option value="0" {{ (old('shipping') == '0') ? 'selected' : null }}>Free / Pickup</option>
                        <option value="9.95" {{ (old('shipping') == '9.95') ? 'selected' : null }}>Standard: 1 Week $9.95</option>
                        <option value="29.95" {{ (old('shipping') == '29.95') ? 'selected' : null }}>Expedite: 2nd day $29.95</option>
                    </select>
                </div>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox"
                       class="custom-control-input"
                       id="emailMe"
                       name="emailMe" {{ old('emailMe') ? 'checked' : '' }}>
                <label class="custom-control-label" for="emailMe">Send me the results</label>
            </div>

            <hr class="mb-4">

            <button class="btn btn-primary btn-lg btn-block" type="submit">Calculate cost</button>

        </form>

    </div>

@endsection
