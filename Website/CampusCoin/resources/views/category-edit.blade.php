<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Category | CampusCoin</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- CSS -->
<style>

:root {

    --primary: #7c5cff;
    --primary-dark: #6546e8;
    --primary-light: #9b83ff;

    --income: #22c55e;
    --income-bg: rgba(34, 197, 94, 0.12);

    --expense: #ef4444;
    --expense-bg: rgba(239, 68, 68, 0.12);

    --body: #f5f6fa;
    --surface: #ffffff;
    --surface-2: #f8f9fc;

    --navbar: #ffffff;

    --text: #171923;
    --text-light: #737887;

    --border: #e5e7eb;

    --shadow: 0 10px 30px rgba(20, 20, 40, 0.07);

    --radius: 16px;

    --transition: 0.3s ease;
}


body.dark {

    --body: #0f1117;
    --surface: #181b24;
    --surface-2: #20242f;

    --navbar: #141720;

    --text: #f5f7fa;
    --text-light: #a7adba;

    --border: #303542;

    --shadow: 0 10px 30px rgba(0, 0, 0, 0.35);

    background: var(--body);
    color: var(--text);
}


body.dark .card {
    background: var(--surface);
    border-color: var(--border);
}

body.dark .input-wrapper input,
body.dark select {
    background: var(--surface-2);
    border-color: var(--border);
    color: var(--text);
}

body.dark .cancel-btn {
    background: var(--surface-2);
    color: var(--text);
    border-color: var(--border);
}


/* ================= RESET ================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body {

    font-family: "Inter", sans-serif;

    background: var(--body);

    color: var(--text);

    min-height: 100vh;

    transition:
        background var(--transition),
        color var(--transition);
}


button,
input,
select {
    font-family: inherit;
}


button {
    cursor: pointer;
}


a {
    text-decoration: none;
    color: inherit;
}


/* ================= MAIN ================= */

.main-content {

    min-height: 100vh;
}


.content {

    padding: 30px 35px 60px;

    max-width: 1400px;

    margin: 0 auto;
}


/* ================= PAGE HEADING ================= */

.page-heading {

    max-width: 560px;

    margin: 0 auto 25px;
}


.page-heading h1 {

    font-size: 22px;

    font-weight: 800;

    margin-bottom: 4px;
}


.page-heading p {

    color: var(--text-light);

    font-size: 12px;
}


/* ================= EDIT CARD ================= */

.card {

    background: var(--surface);

    border: 1px solid var(--border);

    border-radius: var(--radius);

    box-shadow: var(--shadow);
}


.edit-card {

    max-width: 560px;

    margin: 0 auto;

    padding: 34px;
}


.edit-card-header {

    display: flex;

    align-items: center;

    gap: 14px;

    margin-bottom: 28px;
}


.edit-icon {

    width: 50px;
    height: 50px;

    flex-shrink: 0;

    border-radius: 14px;

    display: flex;

    align-items: center;
    justify-content: center;

    background: rgba(124, 92, 255, 0.12);

    color: var(--primary);

    font-size: 20px;
}


.edit-card-header h2 {

    font-size: 17px;

    font-weight: 800;

    margin-bottom: 3px;
}


.edit-card-header p {

    color: var(--text-light);

    font-size: 12px;
}


/* ================= FORM ================= */

.form-group {

    margin-bottom: 22px;
}


.form-group label {

    display: block;

    font-size: 12px;

    font-weight: 700;

    margin-bottom: 8px;
}


.input-wrapper {

    position: relative;
}


.input-wrapper i {

    position: absolute;

    left: 14px;
    top: 50%;

    transform: translateY(-50%);

    color: var(--text-light);
}


.input-wrapper input {

    width: 100%;

    height: 46px;

    border: 1px solid var(--border);

    background: var(--surface-2);

    color: var(--text);

    border-radius: 11px;

    padding: 0 14px 0 40px;

    font-size: 13px;

    outline: none;

    transition: var(--transition);
}


.input-wrapper input:focus {

    border-color: var(--primary);
}


/* TYPE TOGGLE (income / expense pills) */

.type-options {

    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 10px;
}


.type-option input {
    display: none;
}


.type-option span {

    height: 50px;

    border: 1px solid var(--border);

    border-radius: 11px;

    display: flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    color: var(--text-light);

    font-size: 12px;

    font-weight: 700;

    cursor: pointer;

    transition: var(--transition);
}


.income-option input:checked+span {

    border-color: var(--income);

    background: var(--income-bg);

    color: var(--income);
}


.expense-option input:checked+span {

    border-color: var(--expense);

    background: var(--expense-bg);

    color: var(--expense);
}


/* ACTIONS */

.form-actions {

    display: flex;

    gap: 10px;

    margin-top: 30px;
}


.update-btn,
.cancel-btn {

    flex: 1;

    padding: 13px 18px;

    border-radius: 11px;

    font-size: 12.5px;

    font-weight: 700;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    border: 0;

    transition: var(--transition);
}


.update-btn {

    background: linear-gradient(135deg, var(--primary), var(--primary-light));

    color: white;
}


.update-btn:hover {

    transform: translateY(-2px);
}


.cancel-btn {

    background: var(--surface-2);

    color: var(--text-light);

    border: 1px solid var(--border);
}


.cancel-btn:hover {

    color: var(--text);

    border-color: var(--text-light);
}


/* ================= RESPONSIVE ================= */

@media (max-width: 600px) {

    .content {

        padding: 25px 20px 45px;
    }

    .edit-card {

        padding: 26px 20px;
    }

    .form-actions {

        flex-direction: column-reverse;
    }
}
</style>
</head>

<body>

    @include('nav')

    <main class="main-content">

        <section class="content">

            <div class="page-heading">
                <h1>Edit Category</h1>
                <p>Update the name or type of this category.</p>
            </div>

            <div class="card edit-card">

                <div class="edit-card-header">

                    <div class="edit-icon">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>

                    <div>
                        <h2>{{ $category->name }}</h2>
                        <p>Editing a {{ $category->type }} category</p>
                    </div>

                </div>

                <form action="{{ route('categories.update', $category->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="form-group">

                        <label for="categoryName">Category Name</label>

                        <div class="input-wrapper">

                            <i class="fa-solid fa-tag"></i>

                            <input
                                type="text"
                                id="categoryName"
                                name="name"
                                value="{{ $category->name }}"
                                placeholder="e.g. Freelancing"
                                required>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Category Type</label>

                        <div class="type-options">

                            <label class="type-option income-option">

                                <input
                                    type="radio"
                                    name="type"
                                    value="income"
                                    {{ $category->type == 'income' ? 'checked' : '' }}>

                                <span>
                                    <i class="fa-solid fa-arrow-trend-up"></i>
                                    Income
                                </span>

                            </label>

                            <label class="type-option expense-option">

                                <input
                                    type="radio"
                                    name="type"
                                    value="expense"
                                    {{ $category->type == 'expense' ? 'checked' : '' }}>

                                <span>
                                    <i class="fa-solid fa-arrow-trend-down"></i>
                                    Expense
                                </span>

                            </label>

                        </div>

                    </div>

                    <div class="form-actions">

                        <a href="{{ route('categories.index') }}" style="flex:1;">
                            <button type="button" class="cancel-btn">
                                <i class="fa-solid fa-xmark"></i>
                                Cancel
                            </button>
                        </a>

                        <button type="submit" class="update-btn">
                            <i class="fa-solid fa-check"></i>
                            Update Category
                        </button>

                    </div>

                </form>

            </div>

        </section>

    </main>

</body>

</html>