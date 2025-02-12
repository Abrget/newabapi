<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-4">Main Page</h2>
        <div class="flex flex-wrap gap-2 justify-center mt-6">
              <a href="{{ route('status') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Status</a>
                <a href="{{ route('spot') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Spot Balance</a>
                <a href="{{ route('funding') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Funding Balance</a>
                <a href="{{ route('withdraw') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Withdraw</a>
                </div> 
         <form action="{{ route('status') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Api Key</label>
                <input type="text" name="key" class="w-full p-2 border rounded-lg" placeholder="Enter your full name" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Secrate Key</label>
                <input type="text" name="secret" class="w-full p-2 border rounded-lg" placeholder="Enter your email" required>
            </div>


   <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Status</button>
               

        </form>
    </div>

</body>
</html>
