<?php
require_once "connection.php";
$column = isset($_GET['column']) ? $_GET['column'] : 'id';
$direction = isset($_GET['direction']) ? $_GET['direction'] : 'ASC';
$sqlData = "SELECT * FROM data_tamu";
$lastId = $conn->query("SHOW TABLE STATUS LIKE 'data_tamu'")->fetch_assoc();
$result =  $conn->query($sqlData);
if ($result->num_rows > 0) {
    $no = 1;
    while ($row = $result->fetch_assoc()) { ?>
        <form class="item-table flex h-16 gap-x-4 px-4 place-items-center border-b-secondary hover:bg-gray-100 border-b-[1px] border-opacity-50  ">
            <div class="id font-Source text-base text-primary opacity-80 text-center w-[8%]">
                <?php echo $row['id']; ?>
            </div>
            <div class="data font-Source text-base text-primary opacity-80 text-center w-[22%]">
                <?php echo $row['nama']; ?>
            </div>
            <div class="data font-Source text-base text-primary opacity-80 text-center w-[20%]">
                <?php echo $row['email']; ?>
            </div>
            <div class="data font-Source text-base text-primary opacity-80 text-center w-[15%]">
                <?php echo $row['tanggal']; ?>
            </div>
            <div class="data font-Source text-base text-primary opacity-80 text-center w-[25%]">
                <?php echo $row['komentar']; ?>
            </div>
            <div class="font-Source text-base text-primary opacity-80 text-left w-[10%] flex place-content-between px-2">
                <button onclick="editRow(this.parentElement.parentElement)" class="hover:bg-gray-200 w-12 h-12 duration-500 opacity-80 rounded-full flex place-content-center place-items-center">
                    <svg fill=" #424242" store="#424242" width="35" height="35" version="2.0">
                        <use href="#edit" />
                    </svg>
                </button>
                <button onclick="deleteRow(<?php echo $row['id']; ?>, event)" class="hover:bg-gray-200 w-12 h-12 duration-500 opacity-80 rounded-full flex place-content-center place-items-center">
                    <svg fill="#424242" width="35" height="35" version="2.0">
                        <use href="#trash-bin" />
                    </svg>
                </button>
            </div>
        </form>
    <?php
        $no++;
    }
} else { ?>
    <div class="text-primary font-Josefin font-medium tracking-wider text-xl text-center my-32">
        <?= "No Data"; ?>
    </div>

<?php }
?>
<div id="last-id" last-id="<?= $lastId['Auto_increment']; ?>"></div>