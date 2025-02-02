<div class="container mt-4">
        <div class="row">
            <!-- Left Column: Summary Section -->
            <div class="col-md-3">
                <div class="summary-card">
                    <h5>Monthly Balance</h5>
                    <!-- <p class="text-success fw-bold">$9,944.87</p> -->
                    <ul class="list-group list-group-flush">
                        @foreach($monthBalance as $balance)
                            <li class="list-group-item fw-bold">
                                <span>
                                <i class="bi bi-plus-circle"></i> {{ $balance['transaction_type'] }}
                                </span>{{ number_format($balance['total_amount']) }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="summary-card">
                    <h5>Recent Transactions</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($transactions as $transaction)
                            <li class="list-group-item">{{ $transaction['trxDate'] }} - GMD {{ number_format($transaction['transaction_amount']) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Right Column: Operations Form -->
            <div class="col-md-9">
                <div class="transaction-table">
                    <ul class="nav nav-tabs">
                    @if (isInputter())
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#addMoney">Add Money</a>
                        </li>
                    @endif

                        <li class="nav-item">
                            <a class="nav-link fw-bold" data-bs-toggle="tab" href="#addMoneyTrxnDetails">Add Money Transactions</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">   

                        <!-- Add Money Tab -->
                        @if (isInputter())
                        <div id="addMoney" class="tab-pane fade show active">
                            <h2 class="fw-bold text-center">Add Money</h2>
                            <form action="{{ route('addmoney/new') }}" method="post" enctype="multipart/form-data">
                                @foreach($ticketing_id as $id)
                                    <input type="hidden" name="transaction_id" value="{{ "APSW_". stringTime() . ($id['ticket_id'] + 1) }}">
                                @endforeach

                                <input type="hidden" name="transaction_filename" value="Add_Money_Transaction_{{ underlineDate() }}">
                                <input type="hidden" name="Transaction_type" value="Add_Money">

                                <div class="mb-3">
                                    <label for="Transaction_amount" class="form-label">Transaction Amount</label>
                                    <input type="text" class="form-control @if(isset($errors['Transaction_amount'])) is-invalid @endif" min="0" name="Transaction_amount" id="Transaction_amount" placeholder="Enter amount">

                                    @if(isset($errors['Transaction_amount']))
                                        <div id="Transaction_amount" class="invalid-feedback">{{ $errors['Transaction_amount'] }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="transaction_reason" class="form-label">Reason</label>
                                    <select class="form-select @if(isset($errors['transaction_reason'])) }}is-invalid @endif" id="addReason" name="transaction_reason">
                                        <option selected disabled>Select reason</option>
                                        <option>Internal Fund Transfer</option>
                                        <option>Replenishment</option>
                                        <option>Salary Disbursement</option>
                                        <option>Other</option>
                                    </select>

                                    @if(isset($errors['transaction_reason']))
                                        <div id="transaction_reason" class="invalid-feedback">{{ $errors['transaction_reason'] }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="wallet_number" class="form-label">Vendor Wallet Number</label>
                                    <input type="text" maxlength="7" class="form-control @if(isset($errors['wallet_number']))is-invalid @endif" name="wallet_number" id="wallet_number" placeholder="Enter Vendor wallet number">

                                    @if(isset($errors['wallet_number']))
                                        <div id="wallet_number" class="invalid-feedback">{{ $errors['wallet_number'] }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="wallet_name" class="form-label">Vendor Wallet Name</label>
                                    <input type="text" class="form-control @if(isset($errors['wallet_name'])) }}is-invalid @endif" min="0" name="wallet_name" id="wallet_name" placeholder="Enter Vendor wallet Name">

                                    @if(isset($errors['wallet_name']))
                                        <div id="wallet_name" class="invalid-feedback">{{ $errors['wallet_name'] }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="cm_serial" class="form-label">Create Money Serial Number</label>
                                    <input type="text" class="form-control @if(isset($errors['cm_serial']))is-invalid @endif" min="0" name="cm_serial" id="cm_serial" placeholder="Enter eTicketing Serial number of create Money">

                                     @if(isset($errors['cm_serial']))
                                        <div id="cm_serial" class="invalid-feedback">{{ $errors['cm_serial'] }}</div>
                                     @endif
                                </div>

                                <div class="mb-3">
                                    <label for="upload_file" class="form-label">Attached A Support Document</label>
                                    <input class="form-control" type="file" id="upload_file" name="upload_file">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                         @endif
                    
                        <!-- Kill Money Tab -->
                        <div id="addMoneyTrxnDetails" class="tab-pane fade  @if(isApprover() || isReviewer()) show active  @endif">
                        <!-- content -->
                        <h2 class="fw-bold text-center">Add Money Recent Transactions</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
