@extends('college.layouts.app')

@section('title', 'Make a Donation')

@section('main')
<main class="main">

    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Make a Donation</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('college.index') }}">Home</a></li>
            <li><a href="{{ route('college.alumni.index') }}">Alumni</a></li>
            <li class="current">Donate</li>
          </ol>
        </nav>
      </div>
    </div>

    <section class="section">
      <div class="container">
        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('college.alumni.process-donation') }}" method="POST">
                            @csrf
                            
                            <h4 class="mb-3">Donation Details</h4>
                            
                            <div class="mb-3">
                                <label for="campaign_id" class="form-label">Select Campaign</label>
                                <select class="form-select" id="campaign_id" name="campaign_id" required>
                                    <option value="" disabled {{ !$campaign ? 'selected' : '' }}>Choose a campaign...</option>
                                    @foreach($campaigns as $c)
                                        <option value="{{ $c->id }}" {{ ($campaign && $campaign->id == $c->id) ? 'selected' : '' }}>
                                            {{ $c->campaign_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Donation Amount ($)</label>
                                <input type="number" class="form-control" id="amount" name="amount" min="1" step="0.01" required>
                            </div>
                            
                            <hr class="my-4">
                            
                            <h4 class="mb-3">Donor Information</h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="donor_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="donor_name" name="donor_name" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="" disabled selected>Select payment method...</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="PayPal">PayPal</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                </select>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Complete Donation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm bg-light border-0">
                    <div class="card-body">
                        <h5>Why Donate?</h5>
                        <p class="small text-muted">Your contribution helps us support scholarships, improve facilities, and fund research projects that make a real difference.</p>
                        
                        <h6 class="mt-4">Tax Deductible</h6>
                        <p class="small text-muted">All donations are tax-deductible to the extent allowed by law.</p>
                        
                        <h6 class="mt-4">Need Help?</h6>
                        <p class="small text-muted mb-0">Contact our alumni office at <a href="mailto:alumni@example.com">alumni@example.com</a></p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

</main>
@endsection
