<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>status Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen" style="display: flex; flex-direction: column">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md" >
        <h2 class="text-2xl font-bold text-center mb-4">{{$title}}</h2>
        <div class="flex flex-wrap gap-2 justify-center mt-6" style="display: flex; flex-direction: row">
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
                <input type="text"  name="key" class="w-full p-2 border rounded-lg" placeholder="Enter api key" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Secrate Key</label>
                <input type="text"  name="secret" class="w-full p-2 border rounded-lg" placeholder="Enter secrate key" required>
            </div>


            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Status</button>
       

        </form>
       
    </div>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md" style="margin-top: 30px">
    <h2 class="text-2xl font-bold text-center mb-4">Result</h2>
  
  @if(isset($result))
    <pre>{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>
    @endif
    

    </div>

</body>
<script>
   

   
</script>

</html>
