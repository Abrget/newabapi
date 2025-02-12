<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen" style="display: flex; flex-direction: column">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-4">page</h2>
 <!-- Buttons -->
 <div class="flex flex-wrap gap-2 justify-center mt-6">
        <a href="{{ route('status') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Status</a>
                <a href="{{ route('spot') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Spot Balance</a>
                <a href="{{ route('funding') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Funding Balance</a>
                <a href="{{ route('withdraw') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Withdraw</a>
                </div> 
        <form action="{{ route('withdraw') }}" method="POST">
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

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Withdraw Address</label>
                <input type="text" name="address" class="w-full p-2 border rounded-lg" placeholder="Withdraw Address" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Amount</label>
                <input type="number" name="amount" class="w-full p-2 border rounded-lg" placeholder="Amount"required >
            </div>
           <!-- #region -->
           <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Wallet Type</label>
                <input type="number" name="walletType" class="w-full p-2 border rounded-lg" placeholder="Spot=0 Funding=1" required>
            </div>
            

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Withdraw</button>
       

        </form>

   
    </div>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md" style="margin-top: 30px">
    <h2 class="text-2xl font-bold text-center mb-4">Result</h2>
  @if(isset($result))
    <pre>{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>
    @endif
    </div>
</body>
</html>
