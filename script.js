const deleteRow = async (id) => {
  const res = await fetch(`delete-row.php?id=${id}`);
  alert(await res.text());
  setTableData();
};

const addRow = async () => {
  const res = await fetch('insert-row.php', {
    method: 'POST',
    body: new FormData(document.querySelector('#form')),
  });
  const data = await res.text();
  alert(data);
  setTableData();
  console.log('test');
};

window.onload = async function () {
  await setTableData();
};

const setTableData = async () => {
  const res = await fetch('table-data.php');
  const data = await res.text();
  document.querySelector('#table-body').innerHTML = data;
  if (!data.includes('No Data')) {
    const lastId = parseInt(
      document.querySelector('.item-table').getAttribute('last-id')
    );

    document.querySelector('#id').innerHTML = lastId;
  }
  document.querySelectorAll('input').forEach((input) => {
    input.value = '';
  });
  document.querySelector('input#date').value = new Date()
    .toISOString()
    .split('.')[0];
};
