<?php
require_once "connection.php";
$sqlData = "SELECT * FROM data_tamu ORDER BY nama ASC";
$lastId = $conn->query("SHOW TABLE STATUS LIKE 'data_tamu'")->fetch_assoc();
$result =  $conn->query($sqlData);
if ($result->num_rows > 0) {
    $no = 1;
    while ($row = $result->fetch_assoc()) { ?>
        <div last-id="<?= $lastId['Auto_increment']; ?>" class="item-table flex h-16 gap-x-4 px-4 place-items-center border-b-secondary border-b-[1px] border-opacity-50  ">
            <div class="font-Source text-base text-primary opacity-80 text-center w-[8%]">
                <?php echo $row['id']; ?>
            </div>
            <div class="font-Source text-base text-primary opacity-80 text-center w-[22%]">
                <?php echo $row['nama']; ?>
            </div>
            <div class="font-Source text-base text-primary opacity-80 text-center w-[20%]">
                <?php echo $row['email']; ?>
            </div>
            <div class="font-Source text-base text-primary opacity-80 text-center w-[15%]">
                <?php echo $row['tanggal']; ?>
            </div>
            <div class="font-Source text-base text-primary opacity-80 text-center w-[25%]">
                <?php echo $row['komentar']; ?>
            </div>
            <div class="font-Source text-base text-primary opacity-80 text-left w-[10%] flex place-content-between px-2">
                <button class="hover:bg-gray-100 w-12 h-12 duration-500 opacity-80 rounded-full flex place-content-center place-items-center" onclick="addRow();">
                    <svg fill="#424242" store="#424242" width="35" height="35" version="2.0">
                        <use href="#edit" />
                    </svg>
                </button>
                <button onclick="deleteRow(<?php echo $row['id']; ?>)" class="hover:bg-gray-100 w-12 h-12 duration-500 opacity-80 rounded-full flex place-content-center place-items-center">
                    <svg fill="#424242" width="35" height="35" version="2.0">
                        <use href="#trash-bin" />
                    </svg>
                </button>
            </div>
        </div>
    <?php
        $no++;
    }
} else { ?>
    <div class="text-primary font-Josefin font-medium tracking-wider text-xl text-center my-32">
        <?= "No Data"; ?>
    </div>

<?php }
?>