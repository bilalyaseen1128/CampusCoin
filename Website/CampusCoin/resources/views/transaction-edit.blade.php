<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: var(--bs-tertiary-bg); }

        .form-card { max-width: 560px; margin-inline: auto; }

        /* Income / Expense toggle takes the full row */
        .type-toggle .btn { padding-block: .65rem; font-weight: 500; }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
        }
    </style>
</head>

<body>

@php
    $currentType = old('type', $transaction->type);
@endphp

<div class="container py-4 py-md-5">

    <div class="form-card">

        <a href="{{ route('income.expense') }}"
           class="link-secondary text-decoration-none d-inline-block mb-3">
            &larr; Back to transactions
        </a>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <h1 class="h3 mb-1">Edit transaction</h1>
                <p class="text-body-secondary mb-4">
                    Changes apply to your balance and reports right away.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Fix the following before saving:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('transactions.update', $transaction->id) }}"
                      method="POST"
                      id="editTransactionForm"
                      novalidate>

                    @csrf
                    @method('PUT')

                    {{-- Type --}}
                    <div class="mb-4">
                        <div class="btn-group w-100 type-toggle" role="group" aria-label="Transaction type">

                            <input type="radio" class="btn-check" name="type" id="type_income"
                                   value="income" autocomplete="off"
                                   {{ $currentType === 'income' ? 'checked' : '' }} required>
                            <label class="btn btn-outline-success" for="type_income">Income</label>

                            <input type="radio" class="btn-check" name="type" id="type_expense"
                                   value="expense" autocomplete="off"
                                   {{ $currentType === 'expense' ? 'checked' : '' }}>
                            <label class="btn btn-outline-danger" for="type_expense">Expense</label>

                        </div>
                        @error('type')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Amount --}}
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number"
                               id="amount"
                               name="amount"
                               class="form-control form-control-lg @error('amount') is-invalid @enderror"
                               step="0.01"
                               min="0.01"
                               inputmode="decimal"
                               placeholder="0.00"
                               value="{{ old('amount', $transaction->amount) }}"
                               required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text"
                               id="description"
                               name="description"
                               class="form-control @error('description') is-invalid @enderror"
                               maxlength="255"
                               placeholder="e.g. Canteen lunch"
                               value="{{ old('description', $transaction->description) }}"
                               required>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Category + Date side by side on wider screens --}}
                    <div class="row g-3 mb-4">

                        <div class="col-sm-6">
                            <label for="category_id" class="form-label">Category</label>

                            @if ($categories->isEmpty())
                                <div class="form-text text-danger mt-0">
                                    No categories yet. Add one first, then come back to edit this transaction.
                                </div>
                            @else
                                <select id="category_id"
                                        name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror"
                                        required>
                                    @php $selectedCategory = old('category_id', $transaction->category_id); @endphp

                                    @unless ($categories->contains('id', $selectedCategory))
                                        <option value="" selected disabled>Choose a category</option>
                                    @endunless

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @selected($selectedCategory == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <label for="transaction_date" class="form-label">Date</label>
                            <input type="date"
                                   id="transaction_date"
                                   name="transaction_date"
                                   class="form-control @error('transaction_date') is-invalid @enderror"
                                   value="{{ old('transaction_date', optional($transaction->transaction_date)->format('Y-m-d')) }}"
                                   required>
                            @error('transaction_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4" id="saveBtn">
                            Save changes
                        </button>
                        <a href="{{ route('income.expense') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

<script>
    // Prevent double submits
    document.getElementById('editTransactionForm').addEventListener('submit', function () {
        const btn = document.getElementById('saveBtn');
        btn.disabled = true;
        btn.textContent = 'Saving…';
    });
</script>

</body>

</html>