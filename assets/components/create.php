<head>
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
<form action="#" method="POST">
        <div class="overflow-hidden shadow sm:rounded-md">
          <div class="bg-white px-4 py-5 sm:p-6">
            <div class="grid grid-cols-6 gap-6">

              <div class="col-span-6 sm:col-span-3">
                <input type="text" name="title" autofocus="autofocus" require="require" placeholder="Title" class="mt-1 block w-full rounded-md border-blue-500 border-solid p-2 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" >
              </div>

              <div class="col-span-6 sm:col-span-4">
                <input type="text" name="authors" require="require" placeholder="Author" class="mt-1 block w-full rounded-md border-blue-500 border-solid p-2 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div class="col-span-6">
                <input type="text" name="isbn" require="require" placeholder="ISBN" class="mt-1 block w-full rounded-md border-blue-500 border-solid p-2 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                <input type="text" name="imageUrl"  require="require" placeholder="Image URL"  class="mt-1 block w-full rounded-md border-blue-500 border-solid p-2 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <textarea rows="4" cols="1" type="text" name="description" require="require" placeholder="Description" class="mt-1 block w-full rounded-md border-blue-500 border-solid p-2 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea> 

              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white border-solid hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
          </div>

          <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <a href="index.php" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white border-solid hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</a>
          </div>

        </div>
      </form>
</body>