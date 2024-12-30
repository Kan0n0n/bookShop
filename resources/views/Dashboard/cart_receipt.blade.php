<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 150px;
            height: auto;
            margin-right: 20px;
        }

        .header-text {
            flex-grow: 1;
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/logo-removebg-preview.png') }}" alt="logo" class="logo">
        <div class="header-text">
            <h1>Reserve Book Receipt</h1>
            <p>Receipt #{{ $checkOutCart->id }}</p>
        </div>
    </div>

    <div class="details">
        <p><strong>User:</strong> {{ $checkOutCart->user->name }}</p>
        <p><strong>Date:</strong> {{ $checkOutCart->checkout_date }}</p>
        <p><strong>Return Date:</strong>
            {{ \Carbon\Carbon::parse($checkOutCart->checkout_date)->addDays(7)->format('Y-m-d') }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Book ID</th>
                <th>Copy ID</th>
                <th>Return Date</th>
                <th>Return Confirmation</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($checkOutCart->items as $item)
                <tr>
                    <td>{{ $item->book_copy->book->title }}</td>
                    <td>{{ $item->book_copy->book->author->name }}</td>
                    <td>{{ $item->book_copy->book_Id }}</td>
                    <td>{{ $item->book_copy_id }}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Thank you for reserving with us!</p>
        <p class="credit"> &copy; copyright @ <?php echo date('Y'); ?> by <span>No name</span> </p>
    </div>
</body>

</html>
