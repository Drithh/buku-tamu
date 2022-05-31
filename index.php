<?php
require_once "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GPA Calculator</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;400&family=PT+Sans&family=Source+Sans+Pro&display=swap');
  </style>
  <script src="script.js"></script>
</head>

<body class="flex flex-col place-content-center place-items-center min-w-[768px]">
  <svg class="hidden" version="2.0">
    <defs>
      <symbol id="trash-bin" viewbox="0 0 24 24">
        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4z"></path>
      </symbol>
      <symbol viewBox="0 0 24 24" id="check">
        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path>
      </symbol>
      <symbol viewBox="0 0 24 24" id="cancel">
        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
      </symbol>
      <symbol id="edit" viewBox="0 0 24 24" aria-hidden="true" data-testid="edit">
        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.9959.9959 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path>
      </symbol>

    </defs>
  </svg>
  <header class="mt-20 flex place-content-center place-items-center flex-col">
    <div class="font-PT font-medium text-6xl text-primary mb-4 text-center">
      Buku Tamu
    </div>
    <div class="text-primary font-Josefin font-medium tracking-wider text-xl text-center">
      Catat tamu yang datang ke tempatmu!
    </div>
  </header>

  <main class="flex flex-col lg:w-[90%] w-full max-w-[1600px] mt-32">
    <div class="header-table flex h-16 px-4 place-items-center border-y-secondary border-y-[1px] border-opacity-50">
      <div class="font-PT font-bold text-base text-primary text-center w-[8%]">
        ID
      </div>
      <div class="font-PT font-bold text-base text-primary text-center w-[22%]">
        Nama
      </div>
      <div class="font-PT font-bold text-base text-primary text-center w-[20%]">
        Email
      </div>
      <div class="font-PT font-bold text-base text-primary text-center w-[15%]">
        Tanggal
      </div>
      <div class="font-PT font-bold text-base text-primary text-center w-[25%]">
        Komentar
      </div>
      <div class="font-PT font-bold text-base text-primary text-center w-[10%]">
        Action
      </div>
    </div>
    <section id="table-body">
    </section>

    <form id="form" onsubmit=" return false;" class="add-row mb-60 flex h-20 px-4 place-items-center border-b-secondary border-b-[1px] border-opacity-50 gap-x-4">
      <div class="font-Source text-base text-primary opacity-80 text-left w-[8%]">
        <div id="id" class="place-items-center h-[40px]  w-full text-primary rounded  px-4 leading-tight border-0 ring-1  ring-gray-300  bg-gray-200 flex place-content-center" type="text">
        </div>
      </div>
      <div class="font-Source text-base text-primary opacity-80 text-left w-[22%]">
        <input id="nama" required name="nama" class="appearance-none h-[40px] block w-full text-primary rounded py-3 px-4 leading-tight border-0 ring-1  ring-gray-300 focus:outline-none focus:ring-blue-500" type="text" placeholder="Nama" />
      </div>
      <div class="font-Source text-base text-primary opacity-80 text-left w-[20%]">
        <input id="email" required name="email" class="appearance-none h-[40px] block w-full text-primary rounded py-3 px-4 leading-tight border-0 ring-1  ring-gray-300 focus:outline-none focus:ring-blue-500" type="email" placeholder="Email" />
      </div>
      <div class="font-Source text-base text-primary opacity-80 text-left w-[15%]">
        <input id="date" step="any" name="tanggal" class="appearance-none h-[40px] block w-full text-primary rounded py-3 px-4 leading-tight border-0 ring-1  ring-gray-300 focus:outline-none focus:ring-blue-500" type="datetime-local" onclick="this.showPicker()" placeholder="Pilih Tanggal" />
      </div>
      <div class="font-Source text-base text-primary opacity-80 text-left w-[25%]">
        <input id="komentar" name="komentar" class="appearance-none h-[40px] block w-full text-primary rounded py-3 px-4 leading-tight border-0 ring-1  ring-gray-300 focus:outline-none focus:ring-blue-500" type="text" placeholder="Komentar" />
      </div>

      <div class="font-Source text-base text-primary opacity-80 text-left w-[10%] flex place-content-between px-2">
        <button onclick="addRow();" class="hover:bg-gray-100 w-12 h-12 duration-500 opacity-80 rounded-full flex place-content-center place-items-center" onclick="addRow();">
          <svg fill="#424242" store="#424242" width="35" height="35" version="2.0">
            <use href="#check" />
          </svg>
        </button>
        <button onclick="deleteRow(<?php echo $row['id']; ?>)" class="hover:bg-gray-100 w-12 h-12 duration-500 opacity-80 rounded-full flex place-content-center place-items-center">
          <svg fill="#424242" width="35" height="35" version="2.0">
            <use href="#cancel" />
          </svg>
        </button>
      </div>
    </form>
  </main>

</body>

</html>