<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creating an entry in a notebook</title>
    <link rel="stylesheet" href="https://netology-code.github.io/mq-simulator/fluid-images/phone-book/css/phone-book-common.css">
</head>
<body>
<div class="container">
    <h1>Create a record in the Notebook</h1>
    <form action="{{ route('notebook.create') }}" method="POST">
{{--        @csrf--}}
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" required>
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" required>
        </div>
        <div class="form-group">
            <label for="father_name">Father Name</label>
            <input type="text" name="father_name" id="father_name" required>
        </div>
        <div class="form-group">
            <label for="company_name">Company <span class="optional">(optional)</span></label>
            <input type="text" name="company_name" id="company_name">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" name="phone" id="phone" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="birth_date">Birth Date <span class="optional">(optional)</span></label>
            <input type="date" name="birth_date" id="birth_date">
        </div>
        <div class="form-group">
            <label for="photo">Photo <span class="optional">(optional)</span></label>
            <div class="custom-file-upload">
                <input type="file" name="photo" id="photo">
                <button type="button">Choose File</button>
                <span class="file-name">No file chosen</span>
            </div>
        </div>
        <button type="submit" class="create-record">Create Record</button>
    </form>
</div>
</body>
</html>

<style>
    .container {
        max-width: 500px;
        margin: 0 auto;
    }

    h1 {
        text-align: center;
    }

    input[type="text"],
    input[type="tel"],
    input[type="email"],
    input[type="date"],
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .form-group {
        margin-bottom: 10px;
        text-align: left;
    }

    label {
        display: block;
        color: #333;
    }

    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        position: relative;
    }

    .custom-file-upload button {
        background-color: rgba(194, 136, 227, 0.76);
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 13px;
    }

    .custom-file-upload .file-name {
        margin-left: 10px;
        color: #555;
    }

    .optional {
        font-size: 14px;
        color: #999;
    }

    .create-record {
        background-color: #82b2e1;
        color: white;
        padding: 12px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 50%;
    }

    .create-record:hover {
        background-color: #4493e0;
    }
</style>
