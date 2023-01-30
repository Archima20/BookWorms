<div class="w-full flex flex-col items-center">
  <div class="w-4/5">
    <div class="flex">
      <img src="./assets/images/icon_book.png" alt="Book icon">
      <p>Let's create a book!</p>
    </div>
    <div>linea</div>
  </div>

  <form action="#" method="POST" class = "w-4/5">

      <div class="grid gap-5">

            <input type="text" name="title" autofocus="autofocus" require="require" placeholder="Title" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 p-2 w-full" >
    
            <input type="text" name="authors" require="require" placeholder="Author" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 p-2 w-full">
      
            <input type="text" name="isbn" require="require" placeholder="ISBN" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 p-2 w-full">
    
            <input type="text" name="imageUrl"  require="require" placeholder="Image URL"  class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 p-2 w-full">
        
            <textarea rows="4" cols="1" type="text" name="description" require="require" placeholder="Description" class="border border-solid border-blue-600 bg-yellow-50 rounded-md placeholder:text-blue-400 p-2 w-full"></textarea> 
      </div>

      <div class="flex gap-5 px-5 mt-5 mb-5 justify-between">
        <a href="index.php" class="w-1/2 py-2 bg-red-600 text-white text-center justify-center rounded-md border border-transparent" >Cancel</a>

        <button type="submit" class="w-1/2 py-2 bg-blue-600 text-white justify-center rounded-md border border-transparent" >Save</button>
      </div>

  </form>
</div>